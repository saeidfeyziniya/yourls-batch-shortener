<?php
/*
Plugin Name: Batch Shortener API
Plugin URI:  
Description: Adds an endpoint to shorten multiple URLs in a single request.
Version:     1.0
Author:      Saeid Feyziniya
Author URI:  
*/

// Define custom action "batch_shortener"
yourls_add_filter('api_action_batch_shortener', 'batch_shortener_handle');

function batch_shortener_handle() {
    $input = json_decode(file_get_contents('php://input'), true);

    if(!isset($input['urls']) || !is_array($input['urls'])) {
        header('Content-Type: application/json');
        echo json_encode(['error'=>'Missing urls array']);
        exit;
    }

    $results = [];
    foreach($input['urls'] as $item) {
        if(!isset($item['id']) || !isset($item['url'])) continue;

        $id = $item['id'];
        $url = trim($item['url']);
        if(!$url) continue;

        $short = yourls_add_new_link($url);

        if($short) {
            $results[] = [
                'id' => $id,
                'url' => $url,
                'shorturl' => $short['shorturl'],
                'status' => 'success'
            ];
        } else {
            $results[] = [
                'id' => $id,
                'url' => $url,
                'shorturl' => null,
                'status' => 'error'
            ];
        }
    }

    // ارسال JSON خروجی
    header('Content-Type: application/json');
    echo json_encode(['results'=>$results]);
    exit;
}

