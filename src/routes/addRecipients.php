<?php

$app->post('/api/SendGrid/addRecipients', function ($request, $response, $args) {
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
    if(empty($post_data['args']['recipients'])) {
        $error[] = 'recipietns';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
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
    
    try {
        $resp = $sg->client->contactdb()->recipients()->post(json_decode($res_body));
        $body = $resp->body();

        if(!empty($body) && $resp->statusCode() == '201') {

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

