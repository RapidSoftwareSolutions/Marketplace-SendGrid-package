<?php

$app->post('/api/SendGrid/createCampaign', function ($request, $response, $args) {
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
    if(empty($post_data['args']['title'])) {
        $error[] = 'title';
    }
    if(empty($post_data['args']['subject'])) {
        $error[] = 'subject';
    }
    if(empty($post_data['args']['sender_id'])) {
        $error[] = 'sender_id';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $args['title'] = $post_data['args']['title'];
    $args['subject'] = $post_data['args']['subject'];
    $args['sender_id'] = $post_data['args']['sender_id'];
    if(!empty($post_data['args']['list_ids'])) {
        if (is_array($post_data['args']['list_ids'])) {
            $args['list_ids'] = $post_data['args']['list_ids'];
        }
        else {
            $args['list_ids'] = explode(',', $post_data['args']['list_ids']);
        }
    }
    if(!empty($post_data['args']['segment_ids'])) {
        if (is_array($post_data['args']['segment_ids'])) {
            $args['segment_ids'] = $post_data['args']['segment_ids'];
        }
        else {
            $args['segment_ids'] = explode(',', $post_data['args']['segment_ids']);
        }
    }
    if(!empty($post_data['args']['categories'])) {
        if (is_array($post_data['args']['categories'])) {
            $args['categories'] = $post_data['args']['categories'];
        }
        else {
            $args['categories'] = explode(',', $post_data['args']['categories']);
        }
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
    
    try {
        $resp = $sg->client->campaigns()->post($args);
        $body = $resp->body();

        if(!empty($body) &&  $resp->statusCode() == '201') {

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

