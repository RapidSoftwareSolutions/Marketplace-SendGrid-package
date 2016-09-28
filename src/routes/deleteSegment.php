<?php

$app->post('/api/SendGrid/deleteSegment', function ($request, $response, $args) {
    $settings =  $this->settings;
  
    $data = $request->getBody();
    $post_data = json_decode($data, true);
    if(!isset($post_data['args'])) {
        $data = $request->getParsedBody();
        $post_data = $data;
    }
    
    $error = [];
    if(empty($post_data['args']['api_key'])) {
        $error[] = 'api_key cannot be empty';
    }
    if(empty($post_data['args']['segment_id'])) {
        $error[] = 'segment_id cannot be empty';
    }
    if(!empty($post_data['args']['delete_contacts']) && !in_array($post_data['args']['delete_contacts'], ['true', 'false'])) {
        $error[] = 'delete_contacts should be "true" or "false"';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $segment_id = $post_data['args']['segment_id'];
    if(!empty($post_data['args']['delete_contacts'])) {
        $query_params['delete_contacts'] = (bool) $post_data['args']['delete_contacts'];
    } else {
        $query_params['delete_contacts'] = true;
    }
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->segments()->_($segment_id)->delete(null, $query_params);
    $body = $resp->body();
    
    if($resp->statusCode() == '204') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

