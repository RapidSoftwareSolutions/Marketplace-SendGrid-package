<?php

$app->post('/api/SendGrid/getCampaigns', function ($request, $response, $args) {
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
    $query['limit'] = 10;

    if (!empty($post_data['args']['limit'])) {
        $query['limit'] = $post_data['args']['limit'];
    }
    if (!empty($post_data['args']['offset'])) {
        $query['offset'] = $post_data['args']['offset'];
    }

    /** @var SendGrid $sg */
    $sg = new \SendGrid($apiKey);
    
    try {
        $resp = $sg->client->campaigns()->get(null, $query);
        $body = json_decode($resp->body());
        $all_data['result'] = $body->result;

        $pagin = $this->pager;
        $ret = $pagin->page($query['limit'], $query['limit'], $apiKey);
        $all_data = array_merge($all_data['result'], $ret);


        if(!empty($all_data) &&  $resp->statusCode() == '200') {

            $result['callback'] = 'success';
            $result['contextWrites']['to'][] = !is_string($all_data) ? $all_data : json_decode($all_data);

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

