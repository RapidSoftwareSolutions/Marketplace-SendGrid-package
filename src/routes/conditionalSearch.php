<?php

$app->post('/api/SendGrid/conditionalSearch', function ($request, $response, $args) {
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
    if(empty($post_data['args']['conditions'])) {
        $error[] = 'conditions';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $apiKey = $post_data['args']['api_key'];
    $query_params = [];
    if(!empty($post_data['args']['list_id'])) {
        $query_params['list_id'] = $post_data['args']['list_id'];
    }
    $query_params_cond = [];
    $conditions = explode(';', $post_data['args']['conditions']);
    foreach($conditions as $condition) {
        $items = explode(',', $condition);
        if(count($items) == 4) {
            foreach($items as $item) {
                $cond = explode(":", $item);
                $parsed_data[$cond[0]] = $cond[1];
            }
        }
        array_push($query_params_cond, $parsed_data);
    }
    if(isset($query_params_cond[0]['and_or'])) {
        $query_params_cond[0]['and_or'] = '';
    }
    $query_params['conditions'] = $query_params_cond;
    $res_body = json_encode($query_params);

        
    $query_str = 'https://api.sendgrid.com/v3/contactdb/recipients/search';
    $headers['Authorization'] = 'Bearer '.$apiKey;
    
    $client = $this->httpClient;

    try {
        $resp = $client->post( $query_str, 
            [
                'json' => $query_params,
                'headers'=>$headers
            ]);
        $responseBody = $resp->getBody()->getContents();
        $code = $resp->getStatusCode();
        
        if(!empty($responseBody) && $code == '200') {

            $result['callback'] = 'success';
            $result['contextWrites']['to'] = !is_string($responseBody) ? $responseBody : json_decode($responseBody);

        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = !is_string($responseBody) ? $responseBody : json_decode($responseBody);
        }
        
    } catch (Exception $exception) {

        $responseBody = $exception->getMessage();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

