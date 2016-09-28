<?php

$app->post('/api/SendGrid/sendMail', function ($request, $response, $args) {
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
    if(empty($post_data['args']['personalizations'])) {
        $error[] = 'personalizations cannot be empty';
    }
    if(empty($post_data['args']['from'])) {
        $error[] = 'from cannot be empty';
    }
    if(empty($post_data['args']['subject'])) {
        $error[] = 'subject cannot be empty';
    }
    if(empty($post_data['args']['content'])) {
        $error[] = 'content cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $request_body['personalizations'] = json_decode($post_data['args']['personalizations']);
    
    $from = explode(',', $post_data['args']['from']);
    foreach($from as $item) {
        $cond = explode(':', $item);
        $request_body['from'][$cond[0]] = $cond[1];
    }
    
    if(!empty($post_data['args']['reply_to'])) {
        $reply = explode(',', $post_data['args']['reply_to']);
        foreach($reply as $item) {
            $cond = explode(':', $item);
            $request_body['reply_to'][$cond[0]] = $cond[1];
        }
    }
    $request_body['subject'] = $post_data['args']['subject'];
    $request_body['content'] = json_decode($post_data['args']['content']); 
    /*if(!empty($post_data['args']['attachments'])) {
        $attachs = explode(',', $post_data['args']['attachments']);
        foreach($attachs as $item) {
            
            $request_body['reply_to'][$cond[0]] = $cond[1];
        }
    }*/
    if(!empty($post_data['args']['template_id'])) {
        $request_body['template_id'] = $post_data['args']['template_id'];
    }
    if(!empty($post_data['args']['sections'])) {
        $request_body['sections'] = json_decode($post_data['args']['sections']);
    }
    if(!empty($post_data['args']['headers'])) {
        $request_body['headers'] = json_decode($post_data['args']['headers']);
    }
    if(!empty($post_data['args']['categories'])) {
        $request_body['categories'] = explode(',', $post_data['args']['categories']);
    }
    if(!empty($post_data['args']['custom_args'])) {
        $request_body['custom_args'] = json_decode($post_data['args']['custom_args']);
    }
    if(!empty($post_data['args']['send_at'])) {
        $request_body['send_at'] = $post_data['args']['send_at'];
    }
    if(!empty($post_data['args']['batch_id'])) {
        $request_body['batch_id'] = $post_data['args']['batch_id'];
    }
    if(!empty($post_data['args']['asm'])) {
        $item = explode(';', $post_data['args']['asm']);
        $grp_id = explode(':', $item[0]);
        $request_body['asm']['group_id'] = $grp_id[1];
        
        $disp = explode(':', $item[1]);
        $to_display = [];
        foreach(explode(',', $disp[1]) as $key) {
            $to_display = array_push($to_display, $key);
        }
        $request_body['asm']['groups_to_display'] = $to_display;
    }
    if(!empty($post_data['args']['ip_pool_name'])) {
        $request_body['ip_pool_name'] = $post_data['args']['ip_pool_name'];
    }
    if(!empty($post_data['args']['mail_settings'])) {
        $request_body['mail_settings'] = json_decode($post_data['args']['mail_settings']);
    }
           
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->mail()->send()->post($request_body);
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

