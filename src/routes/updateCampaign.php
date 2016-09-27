<?php

$app->post('/api/SendGrid/updateCampaign', function ($request, $response, $args) {
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
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $campaign_id = $post_data['args']['campaign_id'];
    if(!empty($post_data['args']['title'])) {
        $args['title'] =$post_data['args']['title'];
    }
    if(!empty($post_data['args']['subject'])) {
        $args['subject'] =$post_data['args']['subject'];
    }
    if(!empty($post_data['args']['sender_id'])) {
        $args['sender_id'] =$post_data['args']['sender_id'];
    }
    if(!empty($post_data['args']['list_ids'])) {
        $args['list_ids'] =explode(',', $post_data['args']['list_ids']);
    }
    if(!empty($post_data['args']['segment_ids'])) {
        $args['segment_ids'] =explode(',', $post_data['args']['segment_ids']);
    }
    if(!empty($post_data['args']['categories'])) {
        $args['categories'] =explode(',', $post_data['args']['categories']);
    }
    if(!empty($post_data['args']['suppression_group_id'])) {
        $args['suppression_group_id'] = $post_data['args']['suppression_group_id'];
    }
    if(!empty($post_data['args']['custom_unsubscribe_url'])) {
        $args['custom_unsubscribe_url'] = $post_data['args']['custom_unsubscribe_url'];
    }
    if(!empty($post_data['args']['ip_pool'])) {
        $args['ip_pool'] = $post_data['args']['ip_pool'];
    }
    if(!empty($post_data['args']['html_content'])) {
        $args['html_content'] = $post_data['args']['html_content'];
    }
    if(!empty($post_data['args']['plain_content'])) {
        $args['plain_content'] = $post_data['args']['plain_content'];
    }
    
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->campaigns()->_($campaign_id)->patch($args);
    $body = $resp->body();
    
    if(!empty($body) &&  $resp->statusCode() == '200') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

