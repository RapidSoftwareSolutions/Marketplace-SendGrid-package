<?php

$app->post('/api/SendGrid/addRecipients', function ($request, $response, $args) {
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
    if(empty($post_data['args']['recipients'])) {
        $error[] = 'recipietns cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $apiKey = $post_data['args']['api_key'];
    
    $query_params_cond = [];
    $recipietns = explode('|', $post_data['args']['recipients']);
    foreach($recipietns as $recipient) {
        $items = explode(';', $recipient);
        foreach($items as $item) {
            $cond = explode('=', $item);
            if($cond[0] != 'custom_fields') {
                $request_body[$cond[0]] = $cond[1];
            } else {
                $fields = explode(',', $cond[1]);
                foreach($fields as $field) {
                    $item = explode(':', $field);
                    $request_body[$item[0]] = (string) $item[1];
                }
            }
        }
        array_push($query_params_cond, $request_body);
    }
    $_body = $query_params_cond;
    $res_body = json_encode($_body);
    
    $request_body = '['.json_encode($request_body).']';
        
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->contactdb()->recipients()->post(json_decode($res_body));
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

