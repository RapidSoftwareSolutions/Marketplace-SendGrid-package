<?php

$app->post('/api/SendGrid/getSegmentRecipientsList', function ($request, $response, $args) {
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
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $segment_id = $post_data['args']['segment_id'];
    if(!empty($post_data['args']['page'])) {
        $query_params['page'] = $post_data['args']['page'];
    } else {
        $query_params['page'] = 1;
    }
    if(!empty($post_data['args']['page_size'])) {
        $query_params['page_size'] = $post_data['args']['page_size'];
    } else {
        $query_params['page_size'] = 100;
    }
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->segments()->_($segment_id)->recipients()->get(null, $query_params);
    $body = $resp->body();
    
    if(!empty($body) && $resp->statusCode() == '200') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

