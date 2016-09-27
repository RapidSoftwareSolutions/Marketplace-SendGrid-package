<?php

$app->post('/api/SendGrid/testCampaign', function ($request, $response, $args) {
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
    if(empty($post_data['args']['campaign_id'])) {
        $error[] = 'campaign_id cannot be empty';
    }
    if(empty($post_data['args']['to'])) {
        $error[] = 'to cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $campaign_id = $post_data['args']['campaign_id'];
    $request_body['to'] = explode(',', $post_data['args']['to']);
    
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->campaigns()->_($campaign_id)->schedules()->test()->post($request_body);
    $body = $resp->body();
    
    if($resp->statusCode() == '204') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

