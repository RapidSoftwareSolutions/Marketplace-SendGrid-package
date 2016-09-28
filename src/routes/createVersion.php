<?php

$app->post('/api/SendGrid/createVersion', function ($request, $response, $args) {
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
    if(empty($post_data['args']['template_id'])) {
        $error[] = 'template_id cannot be empty';
    }
    if(empty($post_data['args']['name'])) {
        $error[] = 'name cannot be empty';
    }
    if(empty($post_data['args']['subject'])) {
        $error[] = 'subject cannot be empty';
    }
    if(empty($post_data['args']['html_content'])) {
        $error[] = 'html_content cannot be empty';
    }
    if(empty($post_data['args']['plain_content'])) {
        $error[] = 'plain_content cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $template_id = $post_data['args']['template_id'];
    $request_body['name'] = $post_data['args']['name'];
    $request_body['subject'] = $post_data['args']['subject'];
    $request_body['html_content'] = $post_data['args']['html_content'];
    $request_body['plain_content'] = $post_data['args']['plain_content'];
    $request_body['template_id'] = $post_data['args']['template_id'];
    if(!empty($post_data['args']['active'])) {
        $request_body['active'] = $post_data['args']['active'];
    }
           
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->templates()->_($template_id)->versions()->post($request_body);
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

