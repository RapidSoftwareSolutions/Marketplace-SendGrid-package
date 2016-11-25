<?php

$app->post('/api/SendGrid/createSenderIdentity', function ($request, $response, $args) {
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
    
    if(json_last_error() != 0) {
        $error[] = json_last_error_msg() . '. Incorrect input JSON. Please, check fields with JSON input.';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
        $result['contextWrites']['to']['status_msg'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $error = [];
    if(empty($post_data['args']['api_key'])) {
        $error[] = 'api_key';
    }
    if(empty($post_data['args']['nickname'])) {
        $error[] = 'nickname';
    }
    if(empty($post_data['args']['address'])) {
        $error[] = 'address';
    }
    if(empty($post_data['args']['city'])) {
        $error[] = 'city';
    }
    if(empty($post_data['args']['country'])) {
        $error[] = 'country';
    }
    if(empty($post_data['args']['from'])) {
        $error[] = 'from';
    }
    if(empty($post_data['args']['reply_to'])) {
        $error[] = 'reply_to';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
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
    
    try {
        $resp = $sg->client->senders()->post($request_body);
        $body = $resp->body();

        if(!empty($body) && $resp->statusCode() == '200') {

            $result['callback'] = 'success';
            $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);

        } else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = !is_string($body) ? $body : json_decode($body);
        }
    } catch (Exception $exception) {

        $responseBody = $exception->getMessage();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

