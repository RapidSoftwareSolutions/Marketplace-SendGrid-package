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
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $query = [];
    if(!empty($post_data['args']['start_time'])) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $post_data['args']['start_time']);
        if ($date instanceof DateTime) {
            $query['start_time'] = $date->getTimestamp();
        }
        else {
            $query['start_time'] = $post_data['args']['start_time'];
        }
    }
    if(!empty($post_data['args']['end_time'])) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $post_data['args']['end_time']);
        if ($date instanceof DateTime) {
            $query['end_time'] = $date->getTimestamp();
        }
        else {
            $query['end_time'] = $post_data['args']['end_time'];
        }
    }
    if(!empty($post_data['args']['limit'])) {
        $query['limit'] =$post_data['args']['limit'];
    }
    if(!empty($post_data['args']['offset'])) {
        $query['offset'] =$post_data['args']['offset'];
    }
    
    $sg = new \SendGrid($apiKey);
    
    try {
        $resp = $sg->client->suppression()->spam_reports()->get(null, $query);
        $body = json_decode($resp->body());

        if($resp->statusCode() == '200') {

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

