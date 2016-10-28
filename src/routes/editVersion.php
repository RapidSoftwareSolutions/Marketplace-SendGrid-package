<?php

$app->post('/api/SendGrid/editVersion', function ($request, $response, $args) {
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
    if(empty($post_data['args']['template_id'])) {
        $error[] = 'template_id cannot be empty';
    }
    if(empty($post_data['args']['version_id'])) {
        $error[] = 'version_id cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $template_id = $post_data['args']['template_id'];
    $version_id = $post_data['args']['version_id'];
    $request_body = [];
    if(!empty($post_data['args']['name'])) {
        $request_body['name'] = $post_data['args']['name'];
    }
    if(!empty($post_data['args']['subject'])) {
        $request_body['subject'] = $post_data['args']['subject'];
    }
    if(!empty($post_data['args']['html_content'])) {
        $request_body['html_content'] = $post_data['args']['html_content'];
    }
    if(!empty($post_data['args']['plain_content'])) {
        $request_body['plain_content'] = $post_data['args']['plain_content'];
    }
    if(!empty($post_data['args']['active'])) {
        $request_body['active'] = $post_data['args']['active'];
    }
           
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->templates()->_($template_id)->versions()->_($version_id)->patch($request_body);
    $body = $resp->body();
    
    if(!empty($body) && $resp->statusCode() == '200') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

