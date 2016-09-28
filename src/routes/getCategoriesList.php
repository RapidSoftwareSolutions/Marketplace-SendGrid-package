<?php

$app->post('/api/SendGrid/getCategoriesList', function ($request, $response, $args) {
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
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    if(!empty($post_data['args']['category'])) {
        $query_params['category'] = $post_data['args']['category'];
    }
    if(!empty($post_data['args']['limit'])) {
        $query_params['limit'] = $post_data['args']['limit'];
    } else {
        $query_params['limit'] = 50;
    }
    if(!empty($post_data['args']['offset'])) {
        $query_params['offset'] = $post_data['args']['offset'];
    } else {
        $query_params['offset'] = 0;
    }
           
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->categories()->get(null, $query_params);
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

