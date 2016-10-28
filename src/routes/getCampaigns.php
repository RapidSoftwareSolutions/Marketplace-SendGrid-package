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
    
    $error = [];
    if(empty($post_data['args']['api_key'])) {
        $error[] = 'api_key cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    
    $apiKey = $post_data['args']['api_key'];
    $query['limit'] = 10;
    
    $sg = new \SendGrid($apiKey);
    
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
        $result['contextWrites']['to'] = !is_string($body) ? $body : json_decode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

