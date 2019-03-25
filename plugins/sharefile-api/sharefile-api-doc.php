<?php

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
        wp_enqueue_style('patient_form_css', plugin_dir_url( __FILE__ ) . 'css/patient-forms.css');
        wp_enqueue_style('patient_form_css', 'http://fonts.googleapis.com/css?family=Parisienne');

        wp_enqueue_script( 'ajax-handle', plugin_dir_url( __FILE__ ) . 'js/patient-forms.js', array( 'jquery' ) );
        wp_localize_script( 'ajax-handle', 'ajaxBase', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
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

    private function create_doc() {
        $doc_created = false;

        $this->filename = $_POST['form'].'_'.time().'.html';
        $this->local_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/' . $this->filename;

        $handle = fopen($this->local_path, 'w+');
        chmod($this->local_path, 0777);

        foreach($_POST as $k => $v)
        {
            if($k !== 'action' && $k !== 'form') {
                $msg = '';
                if($k === 'first_name') {
                    $msg .= '----------------------------';
                    $msg .= '<h4>PATIENT INFORMATION</h4>';
                    $msg .= '----------------------------<br />';
                }

                if($k === 'patient_employer_company') {
                    $msg .= '<br />-----------------------------------------';
                    $msg .= '<h4>PATIENT\'S EMPLOYER INFORMATION</h4>';
                    $msg .= '-----------------------------------------<br />';
                }

                if($k === 'accident_date_of_incident') {
                    $msg .= '<br />------------------------------';
                    $msg .= '<h4>ACCIDENT INFORMATION</h4>';
                    $msg .= '------------------------------<br />';
                }

                if($k === 'referring_optometrist') {
                    $msg .= '<br />---------------------------------';
                    $msg .= '<h4>REFERRED BY INFORMATION</h4>';
                    $msg .= '---------------------------------<br />';
                }

                if($k === 'responsible_party_first_name') {
                    $msg .= '<br />----------------------------------------------------';
                    $msg .= '<h4>RESPONSIBLE (OR INSURED) PARTY INFORMATION</h4>';
                    $msg .= '----------------------------------------------------<br />';
                }

                if($k === 'insurance_company') {
                    $msg .= '<br />-------------------------------';
                    $msg .= '<h4>INSURANCE INFORMATION</h4>';
                    $msg .= '-------------------------------<br />';
                }

                if($k === 'asthma') {
                    $msg .= '<br />-------------------------';
                    $msg .= '<h4>HEALTH HISTORY</h4>';
                    $msg .= '-------------------------<br />';
                }

                if($k === 'medications_and_vitamins') {
                    $msg .= '<h5>PLEASE LIST ALL MEDICATION / VITAMINS YOU ARE TAKING:</h5>';
                }

                if($k === 'allergies') {
                    $msg .= '<h5>PLEASE LIST ALL ALLERGIES:</h5>';
                }

                if($k === 'cataracts') {
                    $msg .=  '<br />------------------------';
                    $msg .= '<h4>OCULAR HISTORY</h4>';
                    $msg .=  '------------------------<br />';
                    $msg .= '<p>(Have you been diagnosed with any of the following in the past?)</p>';
                }

                if($k === 'eye_disorder') {
                    $msg .= '<h5>OTHER EYE DISORDERS:</h5>';
                }

                if($k === 'glaucoma_family_history') {
                    $msg .= '<br />------------------------';
                    $msg .= '<h4>FAMILY HISTORY</h4>';
                    $msg .= '------------------------<br />';
                    $msg .= '<p>(Has anyone in your family (blood relative) had any of the following?)</p>';
                }

                if($k === 'other_eye_problems') {
                    $msg .= '<h5>OTHER EYE PROBLEMS:</h5>';
                }

                if($k === 'other_general_problems') {
                    $msg .= '<h5>OTHER GENERAL HEALTH PROBLEMS:</h5>';
                }

                if($k === 'surgery_date') {
                    $msg .=  '<br />-------------------------';
                    $msg .= '<h4>SURGICAL HISTORY</h4>';
                    $msg .=  '-------------------------<br />';
                }

                if($k === 'terms_conditions_signature') {
                    $msg .= '<br />------------------------------';
                    $msg .= '<h4>TERMS AND CONDITIONS</h4>';
                    $msg .= '------------------------------<br />';
                }

                if($k === 'emergency_contact_name') {
                    $msg .= '<h5>IN CASE OF EMERGENCY PLEASE CONTACT:</h5>';
                }

                if($k === 'privacy_practice_acknowledgement') {
                    $msg .= '<h5>NOTICE OF PRIVACY PRACTICES:</h5>';
                }

                if($v === 'on') {
                    $v = 'yes';
                }

                $msg .= ucwords(str_replace('_', ' ', $k)) . ': ' . $v . '<br />';
                $doc_created = fwrite($handle, $msg);

                if(!$doc_created)
                    break;
            }
        }

        /*if(!empty($row))
            $doc_created = fwrite($handle, $row);*/

        fclose($handle);

        return $doc_created;
    }

    /**
     * Creates a document from form data, then uploads to Sharefile: Shared Folders > Received Patient Forms
     */
    public function upload_file() {
        $doc = $this->create_doc();

        if(!empty($doc)) {

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
                    $post["File1"] = new CurlFile($this->local_path, 'text/html', $this->filename);
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

                    curl_close($ch);

                    header('Content-Type: application/json');
                    echo json_encode(array("status" => "success"));
                    die();
                }

            }
        } else {
            echo json_encode(array("status" => "error", "error" => "Document not created"));
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