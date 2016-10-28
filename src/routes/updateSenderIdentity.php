<?php

$app->post('/api/SendGrid/updateSenderIdentity', function ($request, $response, $args) {
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
    if(empty($post_data['args']['nickname'])) {
        $error[] = 'nickname cannot be empty';
    }
    if(empty($post_data['args']['sender_id'])) {
        $error[] = 'sender_id cannot be empty';
    }
    if(empty($post_data['args']['address'])) {
        $error[] = 'address cannot be empty';
    }
    if(empty($post_data['args']['city'])) {
        $error[] = 'city cannot be empty';
    }
    if(empty($post_data['args']['country'])) {
        $error[] = 'country cannot be empty';
    }
    if(empty($post_data['args']['from'])) {
        $error[] = 'from cannot be empty';
    }
    if(empty($post_data['args']['reply_to'])) {
        $error[] = 'reply_to cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $sender_id = $post_data['args']['sender_id'];
    $request_body['nickname'] = $post_data['args']['nickname'];
    $request_body['address'] = $post_data['args']['address'];
    $request_body['city'] = $post_data['args']['city'];
    $request_body['country'] = $post_data['args']['country'];
    
    if(!empty($post_data['args']['address_2'])) {
        $request_body['address_2'] = $post_data['args']['address_2'];
    }
    if(!empty($post_data['args']['state'])) {
        $request_body['state'] = $post_data['args']['state'];
    }
    if(!empty($post_data['args']['zip'])) {
        $request_body['zip'] = $post_data['args']['zip'];
    }
    
    $from = explode(',', $post_data['args']['from']);
    if(count($from) == 2) {
        foreach($from as $item) {
            $cond = explode(':', $item);
            $request_body['from'][$cond[0]] = $cond[1];
        }
    }

    $reply = explode(',', $post_data['args']['reply_to']);
    if(count($reply) == 2) {
        foreach($reply as $item) {
            $cond = explode(':', $item);
            $request_body['reply_to'][$cond[0]] = $cond[1];
        }
    }
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->senders()->_($sender_id)->patch($request_body);
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

