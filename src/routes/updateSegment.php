<?php

$app->post('/api/SendGrid/updateSegment', function ($request, $response, $args) {
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
    if(empty($post_data['args']['name'])) {
        $error[] = 'name cannot be empty';
    }
    if(empty($post_data['args']['conditions'])) {
        $error[] = 'conditions cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $query_params['segment_id'] = $post_data['args']['segment_id'];
    $segment_id = $post_data['args']['segment_id'];
    $request_body['name'] = $post_data['args']['name'];
    if(!empty($post_data['args']['list_id'])) {
        $request_body['list_id'] = $post_data['args']['list_id'];
    }
    $conditions = explode(',', $post_data['args']['conditions']);
    foreach($conditions as $condition) {
        $item = explode(':', $condition);
        $cond[$item[0]] = $item[1];
    }
    $cond['and_or'] = '';
    
    $request_body['conditions'][] = (object) $cond;
    $request_body = json_encode($request_body);
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->segments()->_($segment_id)->patch(json_decode($request_body), $query_params);
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

