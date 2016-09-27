<?php

$app->post('/api/SendGrid/getSpamReportsList', function ($request, $response, $args) {
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
    $query = [];
    if(!empty($post_data['args']['start_time'])) {
        $query['start_time'] =$post_data['args']['start_time'];
    }
    if(!empty($post_data['args']['end_time'])) {
        $query['end_time'] =$post_data['args']['end_time'];
    }
    if(!empty($post_data['args']['limit'])) {
        $query['limit'] =$post_data['args']['limit'];
    }
    if(!empty($post_data['args']['offset'])) {
        $query['offset'] =$post_data['args']['offset'];
    }
    
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->suppression()->spam_reports()->get(null, $query);
    $body = json_decode($resp->body());
    
    if($resp->statusCode() == '200') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

