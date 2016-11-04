<?php

$app->post('/api/SendGrid/deleteList', function ($request, $response, $args) {
    $settings =  $this->settings;
    
    $data = $request->getBody();

    if($data=='') {
        $post_data = $request->getParsedBody();
    } else {
        $toJson = $this->toJson;
        $data = $toJson->normalizeJson($data); 
        $data = str_replace('\"', '"', $data);
        $post_data = json_decode($data, true);
    }
    
    $error = [];
    if(empty($post_data['args']['api_key'])) {
        $error[] = 'api_key cannot be empty';
    }
    if(empty($post_data['args']['list_id'])) {
        $error[] = 'list_id cannot be empty';
    }
    if(!empty($post_data['args']['delete_contacts']) && !in_array($post_data['args']['delete_contacts'],['true', 'false'])) {
        $error[] = 'delete_contacts must be "true" or "false"';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $list_id = $post_data['args']['list_id'];
    if(!empty($post_data['args']['delete_contacts'])) {
        $query_params['delete_contacts'] = (bool) $post_data['args']['delete_contacts'];
    } else {
        $query_params['delete_contacts'] = true;
    }
    
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->lists()->_($list_id)->delete(null, $query_params);
    $body = $resp->body();
    
    if($resp->statusCode() == '202') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = "deleted";

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

