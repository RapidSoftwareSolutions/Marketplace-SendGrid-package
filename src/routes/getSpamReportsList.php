<?php

$app->post('/api/SendGrid/getSpamReportsList', function ($request, $response, $args) {
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
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

