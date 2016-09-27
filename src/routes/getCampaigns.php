<?php

$app->post('/api/SendGrid/getCampaigns', function ($request, $response, $args) {
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
    
    if(!$post_data['args']['one_page']) {
        $pagin = $this->pager;
        $ret = $pagin->page($query['limit'], $query['limit'], $apiKey);
        $all_data = array_merge($all_data['result'], $ret);
    }

    
    if(!empty($all_data) &&  $resp->statusCode() == '200') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($all_data);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

