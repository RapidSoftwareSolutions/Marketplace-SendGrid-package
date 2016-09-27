<?php

$app->post('/api/SendGrid/conditionalSearch', function ($request, $response, $args) {
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
    if(empty($post_data['args']['conditions'])) {
        $error[] = 'conditions cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
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
            $result['contextWrites']['to'] = json_encode($responseBody);

        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to'] = json_encode($responseBody);
        }
        
    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

