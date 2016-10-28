<?php

$app->post('/api/SendGrid/addRecipient', function ($request, $response, $args) {
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
    $request_body = '['.json_encode($request_body).']';
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->recipients()->post(json_decode($request_body));
    $body = $resp->body();
    
    if(!empty($body) && $resp->statusCode() == '201') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

