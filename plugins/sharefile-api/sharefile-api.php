<?php
/*
Plugin Name: Sharefile API
Description: Creates documents from the patient forms and uploads them to ShareFile.
Version: 1.0
Author: Riser Agency
Author URI: riseragency.com
*/

ini_set('error_reporting', E_ALL);
error_reporting(E_ALL | E_WARNING);

$sf = ShareFile::singleton();

class ShareFile {
    private static $_instance = null;
    private $settings;
    private $token;
    private $filename;
    private $local_path;
    const RECEIVED_PATIENT_FORMS_FOLDER_ID = 'fo4d036f-e002-4b46-ba21-1fc3142d8989';

    private function __construct() {
        // Variables
        $this->settings = get_option('rsfa_settings');
        if (empty($this->settings)) {
            $this->settings = (Object) array(
                'hostname' => '',
                'username' => '',
                'password' => '',
                'client_secret' => '',
                'client_id' => ''
            );
        } else {
            $this->settings = json_decode($this->settings);
        }

        // Hooks
        add_action('admin_menu', array($this, 'menu_item'));
        add_action('init', array($this, 'sharefile_init'));
        add_action('wp_ajax_upload_to_sharefile', array($this, 'upload_file'));
        add_action( "wp_ajax_nopriv_upload_to_sharefile", array( $this, 'upload_file' ) );
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'plugin_settings_link' ) );
    }

    static public function singleton()
    {
        if(isset(self::$_instance))
            return self::$_instance;
        else
            self::$_instance = new self;
    }

    public function sharefile_init() {
      if ( !is_admin() ) {
        wp_enqueue_script( 'ajax-handle', plugin_dir_url( __FILE__ ) . 'js/patient-forms.js', array( 'jquery' ) );
        wp_localize_script( 'ajax-handle', 'ajaxBase', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
    }

    public function plugin_settings_link($links) {
        $url = get_admin_url() . 'options-general.php?page=sharefile-api';
        $settings_link = '<a href="'.$url.'">' . __( 'Settings', 'textdomain' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    /**
     * Authenticates with the ShareFile API.
     *
     * @param void
     * @return json token
     */
    private function get_token() {
        $uri = $this->settings->hostname."oauth/token";
        //echo "POST $uri\n";

        $data = array(
            "grant_type" => "password",
            "client_id" => $this->settings->client_id,
            "client_secret" => $this->settings->client_secret,
            "username" => $this->settings->username,
            "password" => $this->settings->password
        );
        $postdata = http_build_query($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));

        $curl_response = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error_number = curl_errno($ch);
        $curl_error = curl_error($ch);

        //echo $curl_response."\n"; // output entire response
        //echo $http_code."\n"; // output http status code

        curl_close($ch);
        $token = NULL;
        if ($http_code == 200) {
            $token = json_decode($curl_response);
            //var_dump($token); // print entire token object
        }
        return $token;
    }

    private function get_authorization_header() {
        return array("Authorization: Bearer ".$this->token->access_token);
    }

    private function get_hostname() {
        return $this->token->subdomain.".sf-api.com";
    }

    private function create_html() {
        $html_created = false;

        $form1 = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/sharefile-api/patient_form_1.html';
        $form1_filesize = filesize($form1);
        $form1_handle = fopen($form1, 'r');
        $form1_contents = fread($form1_handle, $form1_filesize);
        fclose($form1_handle);

        $form2 = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/sharefile-api/patient_form_2.html';
        $form2_filesize = filesize($form2);
        $form2_handle = fopen($form2, 'r');
        $form2_contents = fread($form2_handle, $form2_filesize);
        fclose($form2_handle);

        $form3 = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/sharefile-api/patient_form_3.html';
        $form3_filesize = filesize($form3);
        $form3_handle = fopen($form3, 'r');
        $form3_contents = fread($form3_handle, $form3_filesize);
        fclose($form3_handle);

        $patterns = array();
        $replacements = array();
        foreach($_POST as $k => $v)
        {
            if($k !== 'action' && $k !== 'form' && strpos($k, '_cbx') === false) {

                $patterns[] = '/%%'.$k.'%%/';
                $replacements[] = $v;
            }

            if(strpos($k, '_cbx') !== false) {
                $k = str_replace('_cbx', '', $k);
                if($v == true) {
                    $patterns[] = '/checked="'.$k.'"/';
                    $replacements[] = 'checked="checked"';
                } else {
                    $patterns[] = '/checked="'.$k.'"/';
                    $replacements[] = '';
                }
            }
        }

        $form1_new_contents = preg_replace($patterns, $replacements, $form1_contents);
        $form2_new_contents = preg_replace($patterns, $replacements, $form2_contents);
        $form3_new_contents = preg_replace($patterns, $replacements, $form3_contents);

        // add any secondary insurance company info
        $matches = preg_grep('/^insurance_+[a-z_]+\d/', array_keys($_POST));
        if(!empty($matches)) {
            $form1_2nd_ins = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/sharefile-api/patient_form_secondary_insurance.html';
            $form1_2nd_ins_filesize = filesize($form1_2nd_ins);
            $form1_2nd_ins_handle = fopen($form1_2nd_ins, 'r');
            $form1_2nd_ins_contents = fread($form1_2nd_ins_handle, $form1_2nd_ins_filesize);
            fclose($form1_2nd_ins_handle);

            $companies = array();
            foreach($matches as $match) {
                $num = substr($match, -1);
                $companies[$num][$match] = $_POST[$match];
            }

            foreach($companies as $company) {
                $pat = array();
                $rep = array();
                foreach($company as $key => $val) {
                    $pat[] = '/%%'.substr($key, 0, -1).'%%/';
                    $rep[] = $val;
                }
                $form1_2nd_ins_new_contents = preg_replace($pat, $rep, $form1_2nd_ins_contents);
                if(!empty($form1_2nd_ins_new_contents)) {
                    $form1_new_contents .= $form1_2nd_ins_new_contents;
                }
            }
        }

        $form1_new_contents .= '</div></div></form></section></body></html>';
        $this->form1 = $_POST['first_name'].'_'.$_POST['last_name'].'_patient_form_1_'.date('m-d-Y').'.html';
        $this->form1_local_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $this->form1;
        $form1_new_handle = fopen($this->form1_local_path , 'w+');
        chmod($this->form1_local_path, 0777);

        $html_created = fwrite($form1_new_handle, $form1_new_contents);
        fclose($form1_new_handle);

        if($html_created) {
            // Process Form 2 dynamic fields
            $form2_parts = explode('%%%%', $form2_new_contents);
            $form2_pt1 = $form2_parts[0]; // yes/no + med&vitamins
            $form2_pt2 = $form2_parts[1]; // allergies
            $form2_pt3 = $form2_parts[2]; // occular history + other eye disorders
            $form2_pt4 = $form2_parts[3]; // fam history + other eye problems
            $form2_pt5 = $form2_parts[4]; // other general health problems
            $form2_pt6 = $form2_parts[5]; // surgical history

            $form2_final_contents = $form2_pt1;

            // additional medications/vitamins
            $med_vit_matches = preg_grep('/^medications_and_vitamins_+\d/', array_keys($_POST));
            if(!empty($med_vit_matches)) {
                foreach($med_vit_matches as $med_vit) {
                    $form2_final_contents .= '<input value="' . $_POST[$med_vit] . '"  />';
                }
            }

            $form2_final_contents .= $form2_pt2;

            // additional allergies
            $allergies_matches = preg_grep('/^allergies_+\d/', array_keys($_POST));
            if(!empty($allergies_matches)) {
                foreach($allergies_matches as $allergy) {
                    $form2_final_contents .= '<input value="' . $_POST[$allergy] . '"  />';
                }
            }

            $form2_final_contents .= $form2_pt3;

            // additional eye disorders
            $disorder_matches = preg_grep('/^eye_disorder_+\d/', array_keys($_POST));
            if(!empty($disorder_matches)) {
                foreach($disorder_matches as $disorder) {
                    $form2_final_contents .= '<input value="' . $_POST[$disorder] . '"  />';
                }
            }

            $form2_final_contents .= $form2_pt4;

            // additional eye problems
            $problems_matches = preg_grep('/^other_eye_problems_+\d/', array_keys($_POST));
            if(!empty($problems_matches)) {
                foreach($problems_matches as $problem) {
                    $form2_final_contents .= '<input value="' . $_POST[$problem] . '"  />';
                }
            }

            $form2_final_contents .= $form2_pt5;

            // additional general health problems
            $health_probs_matches = preg_grep('/^other_general_problems_+\d/', array_keys($_POST));
            if(!empty($health_probs_matches)) {
                foreach($health_probs_matches as $health_problem) {
                    $form2_final_contents .= '<input value="' . $_POST[$health_problem] . '"  />';
                }
            }

            $form2_final_contents .= $form2_pt6;

            // additional surgeries
            $surgeries_matches = preg_grep('/^surgery_+[a-z_]+\d/', array_keys($_POST));
            if(!empty($surgeries_matches)) {
                $form2_surgeries = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/sharefile-api/patient_form_surgeries.html';
                $form2_surgeries_filesize = filesize($form2_surgeries);
                $form2_surgeries_handle = fopen($form2_surgeries, 'r');
                $form2_surgeries_contents = fread($form2_surgeries_handle, $form2_surgeries_filesize);
                fclose($form2_surgeries_handle);

                $surgeries = array();
                foreach($surgeries_matches as $surgery_match) {
                    $num = substr($surgery_match, -1);
                    $surgeries[$num][$surgery_match] = $_POST[$surgery_match];
                }

                foreach($surgeries as $surgery) {
                    $p = array();
                    $r = array();
                    foreach($surgery as $key => $val) {
                        $p[] = '/%%'.substr($key, 0, -1).'%%/';
                        $r[] = $val;
                    }
                    $form2_surgeries_contents_new = preg_replace($p, $r, $form2_surgeries_contents);
                    if(!empty($form2_surgeries_contents_new)) {
                        $form2_final_contents .= $form2_surgeries_contents_new;
                    }
                }
            }

            $form2_final_contents .= '</div></div></form></section></body></html>';
            $this->form2 = $_POST['first_name'].'_'.$_POST['last_name'].'_patient_form_2_'.date('m-d-Y').'.html';
            $this->form2_local_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $this->form2;
            $form2_new_handle = fopen($this->form2_local_path , 'w+');
            chmod($this->form2_local_path, 0777);

            $html_created = fwrite($form2_new_handle, $form2_final_contents);
            fclose($form2_new_handle);

            if($html_created) {
                $this->form3 = $_POST['first_name'].'_'.$_POST['last_name'].'_patient_form_3_'.date('m-d-Y').'.html';
                $this->form3_local_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $this->form3;
                $form3_new_handle = fopen($this->form3_local_path , 'w+');
                chmod($this->form3_local_path, 0777);

                $html_created = fwrite($form3_new_handle, $form3_new_contents);
                fclose($form3_new_handle);
            }
        }

        return $html_created;
    }

    /**
     * Creates 3 static html forms from form data, then uploads them to Sharefile: Shared Folders > Received Patient Forms
     */
    public function upload_file() {
        $html = $this->create_html();

        if(!empty($html)) {

            // upload to sharefile
            $this->token = $this->get_token();

            if($this->token) {
                $uri = "https://".$this->get_hostname()."/sf/v3/Items(".self::RECEIVED_PATIENT_FORMS_FOLDER_ID.")/Upload";
                //echo "GET ".$uri."\n";

                $headers = $this->get_authorization_header();

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $uri);
                curl_setopt($ch, CURLOPT_TIMEOUT, 300);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_VERBOSE, FALSE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $curl_response = curl_exec($ch);

                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curl_error_number = curl_errno($ch);
                $curl_error = curl_error($ch);

                $upload_config = json_decode($curl_response);

                if ($http_code == 200) {
                    $post["File1"] = new CurlFile($this->form1_local_path, 'text/html', $this->form1);
                    $post["File2"] = new CurlFile($this->form2_local_path, 'text/html', $this->form2);
                    $post["File3"] = new CurlFile($this->form3_local_path, 'text/html', $this->form3);
                    curl_setopt ($ch, CURLOPT_URL, $upload_config->ChunkUri);
                    curl_setopt ($ch, CURLOPT_POST, true);
                    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt ($ch, CURLOPT_VERBOSE, FALSE);
                    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt ($ch, CURLOPT_HEADER, true);

                    $upload_response = curl_exec($ch);

                    //echo "<br /><br />";
                    //echo $upload_response."\n";

                    // delete files from server
                    unlink($this->form1_local_path);
                    unlink($this->form2_local_path);
                    unlink($this->form3_local_path);

                    curl_close($ch);

                    header('Content-Type: application/json');
                    echo json_encode(array("status" => "success"));
                    die();
                }

            } else {
                echo json_encode(array("status" => "error", "error" => "Couldn't authenticate with Sharefile"));
                die();
            }
        } else {
            echo json_encode(array("status" => "error", "error" => "Html files not created"));
            die();
        }
    }

    /**
     * Renders the menu item in the WP admin sidebar.
     *
     * @param void
     * @return void
     */
    public function menu_item() {
        add_options_page('ShareFile API', 'ShareFile API', 'read', 'sharefile-api', array($this, 'settings_page'));
    }

    /**
     * Renders the settings page in the WP admin panel.
     *
     * @param void
     * @return void
     */
    public function settings_page() {
        if (isset($_POST['rsfa_hostname']) && isset($_POST['rsfa_username']) && isset($_POST['rsfa_password']) && isset($_POST['rsfa_client_secret']) && isset($_POST['rsfa_client_id'])) {
            $_POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $this->settings->hostname = $_POST['rsfa_hostname'];
            $this->settings->username = $_POST['rsfa_username'];
            $this->settings->password = $_POST['rsfa_password'];
            $this->settings->client_id = $_POST['rsfa_client_id'];
            $this->settings->client_secret = $_POST['rsfa_client_secret'];
            update_option('rsfa_settings', json_encode($this->settings));
        }
        ?>
        <style type="text/css">
            .rsfa-container label {
                display: block;
                margin-bottom: 10px;
            }
            .rsfa-container input {
                display: block;
            }
            .rsfa-container button {
                margin-top: 10px;
            }
        </style>
        <div class="rsfa-container">
            <h1>ShareFile API Settings</h1>
            <form method="POST" enctype="multipart/form-data">
                <label>
                    Hostname
                    <input type="text" name="rsfa_hostname" value="<?php echo $this->settings->hostname; ?>" />
                </label>
                <label>
                    Username
                    <input type="text" name="rsfa_username" value="<?php echo $this->settings->username; ?>" />
                </label>
                <label>
                    Password
                    <input type="password" name="rsfa_password" value="<?php echo $this->settings->password; ?>" />
                </label>
                <label>
                    Client ID
                    <input type="text" name="rsfa_client_id" value="<?php echo $this->settings->client_id; ?>" />
                </label>
                <label>
                    Client Secret
                    <input type="text" name="rsfa_client_secret" value="<?php echo $this->settings->client_secret; ?>" />
                </label>
                <button type="submit">Save Settings</button>
            </form>
        </div>
    <?php
    }

}
?>
