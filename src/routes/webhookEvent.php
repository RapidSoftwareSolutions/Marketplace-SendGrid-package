<?php
$app->post('/api/SendGrid/webhookEvent', function ($request, $response, $args) {
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

    $reply = [
        "http_resp" => '',
        "client_msg" => $post_data['args']['body']['_json'],
        "params" => $post_data['args']['params']
    ];

    $result['callback'] = 'success';
    $result['contextWrites']['to'] = $reply;
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});