<?php
/*
Plugin Name: [ES Toolbox] MRC Form
Plugin URI:  medicalrecords.com
Description: Emergent toolbox
Version:     1.0.0
Author:      Artem Makhulov
Author URI:  
License:     
License URI: 
Domain Path: /languages
*/


if ( ! function_exists( 'mrcform_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function mrcform_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/MrcForm.php';
	
	global $post;
    if (is_a($post, 'WP_Post')) {
        wp_enqueue_style('sm-ui-css', get_stylesheet_directory_uri() . '/css/jquery-ui.css');
        wp_enqueue_script('maskedjquery', get_stylesheet_directory_uri() . '/js/jquery.maskedinput.min.js', array('jquery'));
        wp_enqueue_script('lead_api_script', plugins_url('/js/script.js', __File__), array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'), '1.1.0');

        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        if (isset($_SERVER['HTTP_REFERER']) && filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL)) {
            $referer = $_SERVER['HTTP_REFERER'];
            $user_agent = filter_var($_SERVER['HTTP_REFERER'], FILTER_SANITIZE_SPECIAL_CHARS);
            wp_localize_script('lead_api_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'ip' => $ip, 'referer' => $referer, 'user_agent' => $user_agent));

        } else {
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
            $user_agent = isset($_SERVER['HTTP_REFERER']) ? filter_var($_SERVER['HTTP_REFERER'], FILTER_SANITIZE_SPECIAL_CHARS) : '';
            wp_localize_script('lead_api_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'ip' => $ip, 'referer' => $referer, 'user_agent' => $user_agent));
        }
    }
}
add_action( 'divi_extensions_init', 'mrcform_initialize_extension' );
endif;

// add_action('wp_ajax_short_form_handler_v2', 'short_form_handler_v2');
// add_action('wp_ajax_nopriv_short_form_handler_v2', 'short_form_handler_v2');

// add_action('wp_ajax_get_city_by_zip_v2', 'get_city_by_zip_v2');
// add_action('wp_ajax_nopriv_get_city_by_zip_v2', 'get_city_by_zip_v2');

// add_action('wp_ajax_lead_first_step_v2', 'lead_first_step_v2');
// add_action('wp_ajax_nopriv_lead_first_step_v2', 'lead_first_step_v2');

// add_action('wp_ajax_get_arrival_v2', 'get_arrival_v2');
// add_action('wp_ajax_nopriv_get_arrival_v2', 'get_arrival_v2');


// function getApiHeader_v2()
// {
// 	if (is_production_v2()) {
// 		return array(
// 			'api-key: prod_5e40039f-d603-4228-9dca-2eb0afea2a1b',
// 			'Content-Type: application/json'
// 		);
// 	} else {
// 		return array(
// 			'api-key: test_155c57b0-69ca-4072-988b-cd8bc0502615',
// 			'Content-Type: application/json'
// 		);
// 	}
// }

// function getIP_v2()
// {
// 	if (is_production_v2()) {
// 		return '52.71.61.35';
// 	} else {
// 		return '34.206.49.92';
// 	}
// }

// function short_form_handler_v2()
// {
// 	$ip = getIP_v2();
// 	$headers = getApiHeader_v2();
// 	$params = [
// 		'arrivalID' => $_POST['arrival_id'],
// 		'pageName' => $_POST['pageName'],
// 		'zip' => removeSpaces_v2($_POST['zip']),
// 		'birthday' => $_POST['birthday'],
// 		'gender' => $_POST['gender']
// 	];
// 	$post_fields = json_encode($params);
// 	$url = "http://{$ip}/slt_leads/lead_service/process/short_term_health";

// 	$ch = curl_init($url);

// 	curl_setopt($ch, CURLOPT_POST, 1);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

// 	$out = curl_exec($ch);
// 	curl_close($ch);

// 	$out_dec = json_decode($out, true);

// 	if (strcasecmp($out_dec['status'], 'success') == 0) {
// 		echo json_encode(['status' => true, 'url' => $out_dec['redirectURL']]);
// 	} else
// 		echo json_encode(['status' => false, 'message' => $out_dec['message']]);

// 	die();
// }

// function get_city_by_zip_v2()
// {
//     $zip = isset($_POST['zip']) ? $_POST['zip'] : '12345';
//     $data = geocode_req_v2(removeSpaces_v2($zip));
//     echo json_encode($data);
//     die();
// }

// function lead_first_step_v2()
// {
//     $ip = getIP_v2();
//     $headers = getApiHeader_v2();
//     $params = array(
//         'arrivalID' => $_POST['arrival_id'],
//         'zip' => removeSpaces_v2($_POST['zip'])
//     );
//     $post_fields = json_encode($params);

//     $url = "http://{$ip}/slt_leads/lead_service/zip_submit";
//     $ch = curl_init($url);

//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
//     //curl_exec($ch);

//     $out = curl_exec($ch);

//     curl_close($ch);

//     $resp = json_encode(array('zip' => removeSpaces_v2($_POST['zip']), 'arrival_id' => $_POST['arrival_id']));
//     echo $resp;
//     die();
// }

// function geocode_req_v2($zip)
// {
// 	/*
//      * Update google api key for  Lead API.
//      *
//      * @author Bojana <bojana@sobetechguru.com>
//      * @see https://gitlab.com/medicalrecords/medicalrecords-web/issues/80
//      * @since 1.1.1
//      */
//     $apikey = 'AIzaSyA0b-AIzaSyBrIE7nqMy2QboI_3ms8wK2r8pBgYtplvA';
//     $response = wp_remote_get("https://maps.googleapis.com/maps/api/geocode/json?key={$apikey}&address=" . $zip . "&language=en&components=country:US&sensor=false");
//     $body = json_decode(stripslashes($response['body']), true);
//     $data = [];
//     $data['state_long'] = '';
//     $data['city'] = '';
//     $data['state'] = '';
//     if (strcmp($body['status'], 'OK') == 0 && strcmp($body['results'][0]['types'][0], 'postal_code') == 0) {

//         $data['state_long'] = '';
//         $data['city'] = '';
//         $data['state'] = '';
//         foreach ($body['results'][0]['address_components'] as $gc) {

//             if (in_array('administrative_area_level_1', $gc['types'])) {
//                 $data['state'] = $gc['long_name'];
//                 $data['state_long'] = $gc['long_name'];
//             }
//             if (in_array('locality', $gc['types'])) {
//                 $data['city'] = $gc['long_name'];
//             }
//         }
//     } else
//         $data['error_msg'] = 'hasError';
//     return $data;
// }

// function removeSpaces_v2($str)
// {
//     return str_replace(" ", "", $str);
// }

// function get_arrival_v2()
// {
//     $ip = getIP_v2();
//     $headers = getApiHeader_v2();

// 	if (isset($_POST['source']))
//         $source_id = strcmp($_POST['source'], 'direct') == 0 ? 9999 : $_POST['source'];
//     else
//         $source_id = 9999;

// 		$params = array(
//         'webID' => '',
//         'IPAddress' => $_POST['ip'],
//         'landingURL' => $_POST['landing'],
//         'referer' => $_POST['referer'],
//         'userAgent' => $_POST['user_agent'],
//         'siteID' => 'mr_com_1',
//         'sourceID' => $source_id,
//         'campaign' => $_POST['campaign'],
//         'keyword' => $_POST['term'],
//         'verticalID' => $_POST['verticalID'],
//     );
//     $post_fields = json_encode($params);


//     $url = "http://{$ip}/slt_leads/lead_service/arrival_request";
//     $ch = curl_init($url);

//     curl_setopt($ch, CURLOPT_POST, 1);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

//     $out = curl_exec($ch);

//     curl_close($ch);

//     $out_dec = json_decode($out, true);
//     if ($out_dec['status'] != 'success') {
//         var_dump($params);
//         die();
//     }
//     $arrival_id = $out_dec['arrivalID'];
//     $resp = json_encode(array('arrival_id' => $arrival_id));
//     echo $resp;
//     die();
// }

// function is_production_v2()
// {
//     return strpos(get_site_url(null, '', 'https'), 'www.medicalrecords.com') !== FALSE ? TRUE : FALSE;
// }