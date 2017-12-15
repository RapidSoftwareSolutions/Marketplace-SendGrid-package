<?php

$app->post('/api/SendGrid/sendMailWithTemplate', function ($request, $response, $args) {
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

    if(isset($post_data['args']['test']) && $post_data['args']['test']==1) {
        $post_data['args']['personalizations'] = json_decode($post_data['args']['personalizations']);
        $post_data['args']['content'] = json_decode($post_data['args']['content']);
        if(!empty($post_data['args']['attachments'])) {
            $post_data['args']['attachments'] = json_decode($post_data['args']['attachments']);
        }
        if(!empty($post_data['args']['sections'])) {
            $post_data['args']['sections'] = json_decode($post_data['args']['sections']);
        }
        if(!empty($post_data['args']['headers'])) {
            $post_data['args']['headers'] = json_decode($post_data['args']['headers']);
        }
    }


    $error = [];
    if(empty($post_data['args']['api_key'])) {
        $error[] = 'api_key';
    }
    if(empty($post_data['args']['personalizations'])) {
        $error[] = 'personalizations';
    }
    if(empty($post_data['args']['from_email'])) {
        $error[] = 'from_email';
    }
    if(empty($post_data['args']['subject'])) {
        $error[] = 'subject';
    }
    if(empty($post_data['args']['template_id'])) {
        $error[] = 'template_id';
    }

    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }


    $apiKey = $post_data['args']['api_key'];
    $request_body['personalizations'] = $post_data['args']['personalizations'];

    $request_body['from']['email'] = $post_data['args']['from_email'];
    if(!empty($post_data['args']['from_name'])) {
        $request_body['from']['name'] = $post_data['args']['from_name'];
    }

    if(!empty($post_data['args']['reply_to_email'])) {
        $request_body['reply_to']['email'] = $post_data['args']['reply_to_email'];
    }
    if(!empty($post_data['args']['reply_to_name'])) {
        $request_body['reply_to']['name'] = $post_data['args']['reply_to_name'];
    }

    $request_body['subject'] = $post_data['args']['subject'];
    $request_body['content'] = $post_data['args']['content'];
    if(!empty($post_data['args']['attachments'])) {
        $request_body['attachments'] = $post_data['args']['attachments'];
    }
    if(!empty($post_data['args']['template_id'])) {
        $request_body['template_id'] = $post_data['args']['template_id'];
    }
    if(!empty($post_data['args']['sections'])) {
        $request_body['sections'] = $post_data['args']['sections'];
    }
    if(!empty($post_data['args']['headers'])) {
        $request_body['headers'] = $post_data['args']['headers'];
    }
    if(!empty($post_data['args']['categories'])) {
        if (is_array($post_data['args']['categories'])) {
            $request_body['categories'] = $post_data['args']['categories'];
        }
        else {
            $request_body['categories'] = explode(',', $post_data['args']['categories']);
        }
    }
    if(!empty($post_data['args']['custom_args'])) {
        $custom = explode(',', $post_data['args']['custom_args']);
        foreach($custom as $item) {
            $cond = explode(':', $item);
            $request_body['custom_args'][$cond[0]] = $cond[1];
        }
    }
    if(!empty($post_data['args']['send_at'])) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $post_data['args']['send_at']);
        if ($date instanceof DateTime) {
            $request_body['send_at'] = $date->getTimestamp();
        }
        else {
            $request_body['send_at'] = $post_data['args']['send_at'];
        }
    }
    if(!empty($post_data['args']['batch_id'])) {
        $request_body['batch_id'] = $post_data['args']['batch_id'];
    }
    if(!empty($post_data['args']['asm'])) {
        $item = explode(';', $post_data['args']['asm']);
        $grp_id = explode(':', $item[0]);
        $request_body['asm']['group_id'] = (int) $grp_id[1];

        $disp = explode(':', $item[1]);
        $to_display = [];

        foreach(explode(',', $disp[1]) as $key) {

            $to_display[] = (int) $key;
        }

        $request_body['asm']['groups_to_display'] = $to_display;
    }


    if(!empty($post_data['args']['ip_pool_name'])) {
        $request_body['ip_pool_name'] = $post_data['args']['ip_pool_name'];
    }
    if(isset($post_data['args']['mail_settings_bcc_enable'])) {
        $request_body['mail_settings']['bcc']['enable'] = filter_var($post_data['args']['mail_settings_bcc_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['mail_settings_bcc_email'])) {
        $request_body['mail_settings']['bcc']['email'] = $post_data['args']['mail_settings_bcc_email'];
    }
    if(isset($post_data['args']['mail_settings_bypass_list_management_enable'])) {
        $request_body['mail_settings']['bypass_list_management']['enable'] = filter_var($post_data['args']['mail_settings_bypass_list_management_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(isset($post_data['args']['mail_settings_footer_enable'])) {
        $request_body['mail_settings']['footer']['enable'] = filter_var($post_data['args']['mail_settings_footer_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['mail_settings_footer_text'])) {
        $request_body['mail_settings']['footer']['text'] = $post_data['args']['mail_settings_footer_text'];
    }
    if(!empty($post_data['args']['mail_settings_footer_html'])) {
        $request_body['mail_settings']['footer']['html'] = $post_data['args']['mail_settings_footer_html'];
    }
    if(isset($post_data['args']['mail_settings_sandbox_mode_enable'])) {
        $post_data['args']['mail_settings_sandbox_mode_enable'] = (bool) $post_data['args']['mail_settings_sandbox_mode_enable'];
        $request_body['mail_settings']['sandbox_mode']['enable'] = filter_var($post_data['args']['mail_settings_sandbox_mode_enable'], FILTER_VALIDATE_BOOLEAN);

    }
    if(isset($post_data['args']['mail_settings_spam_check_enable'])) {
        $request_body['mail_settings']['spam_check']['enable'] = filter_var($post_data['args']['mail_settings_spam_check_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['mail_settings_spam_check_threshold'])) {
        $post_data['args']['mail_settings_spam_check_threshold'] = (int) $post_data['args']['mail_settings_spam_check_threshold'];
        $request_body['mail_settings']['spam_check']['threshold'] = $post_data['args']['mail_settings_spam_check_threshold'];
    }
    if(!empty($post_data['args']['mail_settings_spam_check_post_to_url'])) {
        $request_body['mail_settings']['spam_check']['post_to_url'] = $post_data['args']['mail_settings_spam_check_post_to_url'];
    }
    if(isset($post_data['args']['tracking_settings_click_tracking_enable'])) {
        $request_body['tracking_settings']['click_tracking']['enable'] = filter_var($post_data['args']['tracking_settings_click_tracking_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(isset($post_data['args']['tracking_settings_click_tracking_enable_text'])) {
        $request_body['tracking_settings']['click_tracking']['enable_text'] = filter_var($post_data['args']['tracking_settings_click_tracking_enable_text'], FILTER_VALIDATE_BOOLEAN);
    }
    if(isset($post_data['args']['tracking_settings_open_tracking_enable'])) {
        $request_body['tracking_settings']['open_tracking']['enable'] = filter_var($post_data['args']['tracking_settings_open_tracking_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['tracking_settings_open_tracking_substitution_tag'])) {
        $request_body['tracking_settings']['open_tracking']['substitution_tag'] = $post_data['args']['tracking_settings_open_tracking_substitution_tag'];
    }
    if(isset($post_data['args']['tracking_settings_subscription_tracking_enable'])) {
        $request_body['tracking_settings']['subscription_tracking']['enable'] = filter_var($post_data['args']['tracking_settings_subscription_tracking_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['tracking_settings_subscription_tracking_text'])) {
        $request_body['tracking_settings']['subscription_tracking']['text'] = $post_data['args']['tracking_settings_subscription_tracking_text'];
    }
    if(!empty($post_data['args']['tracking_settings_subscription_tracking_html'])) {
        $request_body['tracking_settings']['subscription_tracking']['html'] = $post_data['args']['tracking_settings_subscription_tracking_html'];
    }
    if(!empty($post_data['args']['tracking_settings_subscription_tracking_substitution_tag'])) {
        $request_body['tracking_settings']['subscription_tracking']['substitution_tag'] = $post_data['args']['tracking_settings_subscription_tracking_substitution_tag'];
    }
    if(isset($post_data['args']['ganalytics_enable'])) {
        $request_body['tracking_settings']['ganalytics']['enable'] = filter_var($post_data['args']['ganalytics_enable'], FILTER_VALIDATE_BOOLEAN);
    }
    if(!empty($post_data['args']['ganalytics_utm_source'])) {
        $request_body['tracking_settings']['ganalytics']['utm_source'] = $post_data['args']['ganalytics_utm_source'];
    }
    if(!empty($post_data['args']['ganalytics_utm_medium'])) {
        $request_body['tracking_settings']['ganalytics']['utm_medium'] = $post_data['args']['ganalytics_utm_medium'];
    }
    if(!empty($post_data['args']['ganalytics_utm_term'])) {
        $request_body['tracking_settings']['ganalytics']['utm_term'] = $post_data['args']['ganalytics_utm_term'];
    }
    if(!empty($post_data['args']['ganalytics_utm_content'])) {
        $request_body['tracking_settings']['ganalytics']['utm_content'] = $post_data['args']['ganalytics_utm_content'];
    }
    if(!empty($post_data['args']['ganalytics_utm_campaign'])) {
        $request_body['tracking_settings']['ganalytics']['utm_campaign'] = $post_data['args']['ganalytics_utm_campaign'];
    }


    $sg = new SendGrid($apiKey);


    try {
        $resp = $sg->client->mail()->send()->post($request_body);
        $body = $resp->body();

        if($resp->statusCode() == '202') {

            $result['callback'] = 'success';
            $result['contextWrites']['to'] = "send";

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

