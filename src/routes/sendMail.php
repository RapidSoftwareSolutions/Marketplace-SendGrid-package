<?php

$app->post('/api/SendGrid/sendMail', function ($request, $response, $args) {
    $settings =  $this->settings;

    $data = '';
    $data = $request->getBody();
    if($data=='') {
        $post_data = $request->getParsedBody();
    } else {
        $toJson = $this->normalize;
        $data = $toJson->normalizeJson($data); 
        $post_data = json_decode($data, true);
    }
    
    if($post_data['args']['test']==1) {
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
        $error[] = 'api_key cannot be empty';
    }
    if(empty($post_data['args']['personalizations'])) {
        $error[] = 'personalizations cannot be empty';
    }
    if(empty($post_data['args']['from_email'])) {
        $error[] = 'from_email cannot be empty';
    }
    if(empty($post_data['args']['subject'])) {
        $error[] = 'subject cannot be empty';
    }
    if(empty($post_data['args']['content'])) {
        $error[] = 'content cannot be empty';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = implode(',', $error);
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
        $request_body['categories'] = explode(',', $post_data['args']['categories']);
    }
    if(!empty($post_data['args']['custom_args'])) {
        $custom = explode(',', $post_data['args']['custom_args']);
        foreach($custom as $item) {
            $cond = explode(':', $item);
            $request_body['custom_args'][$cond[0]] = $cond[1];
        }
    }
    if(!empty($post_data['args']['send_at'])) {
        $request_body['send_at'] = $post_data['args']['send_at'];
    }
    if(!empty($post_data['args']['batch_id'])) {
        $request_body['batch_id'] = $post_data['args']['batch_id'];
    }
    if(!empty($post_data['args']['asm'])) {
        $item = explode(';', $post_data['args']['asm']);
        $grp_id = explode(':', $item[0]);
        $request_body['asm']['group_id'] = $grp_id[1];
        
        $disp = explode(':', $item[1]);
        $to_display = [];
        foreach(explode(',', $disp[1]) as $key) {
            $to_display = array_push($to_display, $key);
        }
        $request_body['asm']['groups_to_display'] = $to_display;
    }
    if(!empty($post_data['args']['ip_pool_name'])) {
        $request_body['ip_pool_name'] = $post_data['args']['ip_pool_name'];
    }
    if(!empty($post_data['args']['mail_settings_bcc_enable'])) {
        $request_body['mail_settings']['bcc']['enable'] = (bool) $post_data['args']['mail_settings_bcc_enable'];
    }
    if(!empty($post_data['args']['mail_settings_bcc_email'])) {
        $request_body['mail_settings']['bcc']['email'] = $post_data['args']['mail_settings_bcc_email'];
    }
    if(!empty($post_data['args']['mail_settings_bypass_list_management_enable'])) {
        $request_body['mail_settings']['bypass_list_management']['enable'] = (bool) $post_data['args']['mail_settings_bypass_list_management_enable'];
    }
    if(!empty($post_data['args']['mail_settings_footer_enable'])) {
        $request_body['mail_settings']['footer']['enable'] = (bool) $post_data['args']['mail_settings_footer_enable'];
    }
    if(!empty($post_data['args']['mail_settings_footer_text'])) {
        $request_body['mail_settings']['footer']['text'] = $post_data['args']['mail_settings_footer_text'];
    }
    if(!empty($post_data['args']['mail_settings_footer_html'])) {
        $request_body['mail_settings']['footer']['html'] = $post_data['args']['mail_settings_footer_html'];
    }
    if(!empty($post_data['args']['mail_settings_sandbox_mode_enable'])) {
        $request_body['mail_settings']['sandbox_mode']['enable'] = (bool) $post_data['args']['mail_settings_sandbox_mode_enable'];
    }
    if(!empty($post_data['args']['mail_settings_spam_check_enable'])) {
        $request_body['mail_settings']['spam_check']['enable'] = (bool) $post_data['args']['mail_settings_spam_check_enable'];
    }
    if(!empty($post_data['args']['mail_settings_spam_check_threshold'])) {
        $request_body['mail_settings']['spam_check']['threshold'] = $post_data['args']['mail_settings_spam_check_threshold'];
    }
    if(!empty($post_data['args']['mail_settings_spam_check_post_to_url'])) {
        $request_body['mail_settings']['spam_check']['post_to_url'] = $post_data['args']['mail_settings_spam_check_post_to_url'];
    }
    if(!empty($post_data['args']['tracking_settings_click_tracking_enable'])) {
        $request_body['tracking_settings']['click_tracking']['enable'] = (bool) $post_data['args']['tracking_settings_click_tracking_enable'];
    }
    if(!empty($post_data['args']['tracking_settings_click_tracking_enable_text'])) {
        $request_body['tracking_settings']['click_tracking']['enable_text'] = (bool) $post_data['args']['tracking_settings_click_tracking_enable_text'];
    }
    if(!empty($post_data['args']['tracking_settings_open_tracking_enable'])) {
        $request_body['tracking_settings']['open_tracking']['enable'] = (bool) $post_data['args']['tracking_settings_open_tracking_enable'];
    }
    if(!empty($post_data['args']['tracking_settings_open_tracking_substitution_tag'])) {
        $request_body['tracking_settings']['open_tracking']['substitution_tag'] = $post_data['args']['tracking_settings_open_tracking_substitution_tag'];
    }
    if(!empty($post_data['args']['tracking_settings_subscription_tracking_enable'])) {
        $request_body['tracking_settings']['subscription_tracking']['enable'] = (bool) $post_data['args']['tracking_settings_subscription_tracking_enable'];
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
    if(!empty($post_data['args']['ganalytics_enable'])) {
        $request_body['tracking_settings']['ganalytics']['enable'] = (bool) $post_data['args']['ganalytics_enable'];
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
    
           
    $sg = new \SendGrid($apiKey);
    
    $resp = $sg->client->mail()->send()->post($request_body);
    $body = $resp->body();
    
    if($resp->statusCode() == '202') {

        $result['callback'] = 'success';
        $result['contextWrites']['to'] = json_encode($body);

    } else {
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_encode($body);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});

