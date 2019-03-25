<?php

if (!session_id())
    session_start();

add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles');
function salient_child_enqueue_styles()
{

    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'));
    wp_enqueue_script('child_theme_script_handle', get_stylesheet_directory_uri() . '/js/affiliated-doctors.js', array('jquery'));

    if (is_rtl())
        wp_enqueue_style('salient-rtl', get_template_directory_uri() . '/rtl.css', array(), '1', 'screen');
}

function register_my_menu()
{
    register_nav_menu('extra-menu', __('Extra Menu'));
    register_nav_menu('top-right-menu', __('Top Right Menu'));
}

add_action('init', 'register_my_menu');

add_action('wp_head', 'check_for_source');
function check_for_source()
{
    $source = null;
    $post = get_post();

    if ($post) {
        $post_name = $post->post_name;
        $source = get_source($post_name);

        if ($source) {
            set_page_origin();
        }
    }
}


function set_page_origin()
{
    if (!isset($_SESSION['page_origin'])) {
        $post = get_post();
        if ($post != null) {
            $_SESSION['page_origin'] = $post->post_name;
            //setcookie('page_origin', $post->post_name, time() + 3600*365, "/");
        }
    }
}

function get_page_origin_field_value($field)
{
    $source = get_page_origin_source();
    if ($source) {
        return get_field($source[$field], 'options');
    }
    return get_field($field, 'options');
}

function get_page_origin_source()
{
    $source = null;
    $post = get_post();
    if ($post) {
        $post_name = $post->post_name;
        $source = get_source($post_name);
    }
    if (!$source) {
        if (isset($_SESSION['page_origin'])) {
            $source = get_source($_SESSION['page_origin']);
        }
    }
    return $source;
}

function set_source_origin()
{
    if (isset($_REQUEST['source'])) {
        $_SESSION['source_origin'] = $_REQUEST['source'];
        //setcookie('source_origin', $_REQUEST['source'], time() + 3600*365, "/");
    }
}

function get_source_origin()
{
    if (isset($_REQUEST['source'])) {
        return $_REQUEST['source'];
    }
    if (isset($_SESSION['source_origin'])) {
        return $_SESSION['source_origin'];
    }
    return '';
}

function get_sources()
{
    return [
        'invision-eye-health' => [
            'phone_number' => 'phone_number_invision_eye_health',
            'logo' => 'logo_invision_eye_health',
            'value' => 'Invision Eye Health',
        ],
        'the-eye-sight' => [
            'phone_number' => 'phone_number_the_eye_sight',
            'logo' => 'logo_the_eye_sight',
            'value' => 'The Eye Sight',
        ],
        'valley-vision-clinic-optical' => [
            'phone_number' => 'phone_number_valley_vision_clinic_optical',
            'logo' => 'logo_valley_vision_clinic_optical',
            'value' => 'Valley Vision Clinic & Optical',
        ],
        'southern-utah-vision-care' => [
            'phone_number' => 'phone_number_southern_utah_vision_care',
            'logo' => 'logo_southern_utah_vision_care',
            'value' => 'Southern Utah Vision Care',
        ],
        'ogden-vision-center' => [
            'phone_number' => 'phone_number_ogden_vision_center',
            'logo' => 'logo_ogden_vision_center',
            'value' => 'Ogden Vision Center'
        ],
        'seitz-eye-care' => [
            'phone_number' => 'phone_number_seitz_eye_care',
            'logo' => 'logo_seitz_eye_care',
            'value' => 'Seitz Eye Care'
        ],
        'lehi-vision-center' => [
            'phone_number' => 'phone_number_lehi_vision_center',
            'logo' => 'logo_lehi_vision_center',
            'value' => 'Lehi Vision Center'
        ],
        'alpine-vision-center' => [
            'phone_number' => 'phone_number_alpine_vision_center',
            'logo' => 'logo_alpine_vision_center',
            'value' => 'Alpine Vision Center'
        ],
        'mountain_west_eye-care' => [
            'phone_number' => 'phone_number_mountain_west_eye_care',
            'logo' => 'logo_mountain_west_eye_care',
            'value' => 'Mountain West Eye Care'
        ],
        'utah_valley_optometric_physicians' => [
            'phone_number' => 'phone_number_utah_valley_optometric_physicians',
            'logo' => 'logo_utah_valley_optometric_physicians',
            'value' => 'Utah Valley Optometric Physicians'
        ],
        'dr_doug_smith' => [
            'phone_number' => 'phone_number_dr_doug_smith',
            'logo' => 'logo_dr_doug_smith',
            'value' => 'Dr. Doug Smith'
        ]
    ];
}

function get_source($key)
{
    $list = get_sources();
    if (isset($list[$key])) {
        return $list[$key];
    }
    return null;
}


 
if(function_exists('register_sidebar')) {
 
	register_sidebar(array('name' => 'Exit Popup', 'id' => 'exit-popup', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
 
}


///////////////////////////////////

// AFFILIATE DOCTORS

///////////////////////////////////

function setup_affiliate_doctors()
{

    register_post_type('affiliated_doctor', array(

        'labels' => array(

            'name' => __('Affliated Doctors', 'hoopes_vision'),

            'singular_name' => __('Affiliated Doctor', 'hoopes_vision')

        ),

        'public' => 'false',

        'publicly_queryable' => false,

        'exclude_from_search' => false,

        'show_ui' => true,

        'query_var' => true,

        'menu_position' => 21,

        'has_archive' => false,

        'capability_type' => 'post',

        'hierarchical' => false,

        'supports' => array('title')


    ));

}

add_action('init', 'setup_affiliate_doctors');



///////////////////////////////////

// AFFILIATE DOCTORS

///////////////////////////////////

function setup_exit_popup()
{

    register_post_type('exit_popup', array(

        'labels' => array(

            'name' => __('Exit Popup', 'hoopes_vision'),

            'singular_name' => __('Exit Popup', 'hoopes_vision')

        ),

        'public' => 'false',

        'publicly_queryable' => false,

        'exclude_from_search' => false,

        'show_ui' => true,

        'query_var' => true,

        'menu_position' => 11,

        'has_archive' => false,

        'capability_type' => 'post',

        'hierarchical' => false,

        'supports' => array('title')


    ));

}

add_action('init', 'setup_exit_popup');



/*function js_async_attr($tag)
{ return str_replace( ' src', ' async="async" src', $tag ); }
add_filter( 'script_loader_tag', 'js_async_attr', 10 );
*/

/**
 * Improve performance by adding defer or async to script tag
 *
 * @param string $tag Script element tag
 * @param string $handle Script handle.
 * @param string $url Script URL.
 * @return string Modified script tag.
 */
function lazy_scripts($tag, $handle, $url)
{
    /**
     * List of exceptions to ignore
     */
    static $exceptions = array(
        '/jquery.js',
        '/jsapi',
        'customize',  // WP Customizer scripts should not be deferred.
        'wp-',  // WP Customizer break if we don't eliminate this.
        'cloudflare.com'
        /* Add more exceptions here. */
    );

    /**
     * Static var so that we look up site domain only once per request.
     * @static
     * @var string $domain
     */
    static $domain = false;

    /**
     * Ignore non-javascript.
     */
    if (!strpos($url, '.js')) {
        return $tag;
    }

    /**
     * Ignore exceptions.
     */
    foreach ($exceptions as $exception) {
        if (strpos($url, $exception) !== false) {
            return $tag;
        }
    }

    /**
     * Get the domain if we don't already have it.
     */
    if (false === $domain) {
        $domain = parse_url(get_site_url(), PHP_URL_HOST);
    }

    /**
     * Ignore script tags that already contain defer or async
     */
    if (strpos($tag, ' defer') || strpos($tag, ' async')) {
        return $tag;
    }

    /**
     * If script URL contains domain name, use defer
     */
    if (strpos($url, $domain)) {
        return str_replace('></script>', ' defer="defer"></script>', $tag);
    }

    /**
     * If script is not in this domain, use async
     */
    return str_replace('></script>', ' async="async"></script>', $tag);
}

add_filter('script_loader_tag', 'lazy_scripts', PHP_INT_MAX, 3);

?>
