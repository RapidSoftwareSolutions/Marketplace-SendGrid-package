<?php

$app->post('/api/SendGrid/updateRecipient', function ($request, $response, $args) {
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
    if(empty($post_data['args']['email'])) {
        $error[] = 'email cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $apiKey = $post_data['args']['api_key'];
    $request_body['email'] = $post_data['args']['email'];
    if(!empty($post_data['args']['first_name'])) {
        $request_body['first_name'] = $post_data['args']['first_name'];
    }
    if(!empty($post_data['args']['last_name'])) {
        $request_body['last_name'] = $post_data['args']['last_name'];
    }
    if(!empty($post_data['args']['custom_field'])) {
        $fields = explode(',', $post_data['args']['custom_field']);
        foreach($fields as $field) {
            $item = explode(':', $field);
            $request_body[$item[0]] = $item[1];
        }
    }
    $_body[] = (object) $request_body;
    $res_body = json_encode($_body);
    $res_body = json_decode($res_body);
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->recipients()->patch($res_body);
    $body = $resp->body();
    
    if(!empty($body) && $resp->statusCode() == '201') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

