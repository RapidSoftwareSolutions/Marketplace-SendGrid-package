<?php
namespace Tests\Functional;

class SendGridTest extends BaseTestCase
{
    protected $api_key = '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';
    protected $sender_id = '66784'; 
    
    public function testCreateCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['title'] = 'Test title';
        $post_data['args']['subject'] = 'Test subject';
        $post_data['args']['sender_id'] = $this->sender_id;
        
        $response = $this->runApp('POST', '/api/SendGrid/createCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetCampaigns() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['one_page'] = 1;
        
        $response = $this->runApp('POST', '/api/SendGrid/getCampaigns', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = '527713';
        
        $response = $this->runApp('POST', '/api/SendGrid/getCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetSpamReportsList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getSpamReportsList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testDeleteSpamReports() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['delete_all'] = true;
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteSpamReports', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetSpamReport() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['email'] = 'test@site.com';
        
        $response = $this->runApp('POST', '/api/SendGrid/getSpamReport', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('{"errors":[{"field":null,"message":"resource not found"}]}', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteSpamReport() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['email'] = 'test@site.com';
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteSpamReport', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('{"errors":[{"field":null,"message":"resource not found"}]}', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('{"errors":[{"message":"not found"}]}', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testUpdateCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/updateCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('"{\"errors\":[{\"message\":\"not found\"}]}"', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testSendCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/sendCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('"{\"errors\":[{\"message\":\"not found\"}]}"', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testScheduleCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        $post_data['args']['send_at'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/scheduleCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('"{\"errors\":[{\"message\":\"not found\"}]}"', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testUpdateScheduledCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        $post_data['args']['send_at'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/updateScheduledCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('"{\"errors\":[{\"message\":\"not found\"}]}"', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetScheduledTime() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/getScheduledTime', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertEquals('"{\"errors\":[{\"message\":\"not found\"}]}"', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testUnscheduleCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        
        $response = $this->runApp('POST', '/api/SendGrid/unscheduleCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testTestCampaign() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['campaign_id'] = "55667788";
        $post_data['args']['to'] = "test@site.com";
        
        $response = $this->runApp('POST', '/api/SendGrid/testCampaign', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testCreateCustomField() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['name'] = "new_field";
        $post_data['args']['type'] = "text";
        
        $response = $this->runApp('POST', '/api/SendGrid/createCustomField', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Custom Field name must be unique', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetCustomFieldList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getCustomFieldList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetCustomField() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['custom_field_id'] = "156265";
        
        $response = $this->runApp('POST', '/api/SendGrid/getCustomField', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testDeleteCustomField() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['custom_field_id'] = "156260";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteCustomField', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Custom field ID does not exist', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetReservedFieldsList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getReservedFieldsList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testCreateList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['name'] = "new list";
        
        $response = $this->runApp('POST', '/api/SendGrid/createList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Your list name must be unique against all other list and segment names', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetListsList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getListsList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testDeleteLists() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['id'] = "11111";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteLists', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testGetList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "11111";
        
        $response = $this->runApp('POST', '/api/SendGrid/getList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('List ID does not exist', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testUpdateList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612199";
        $post_data['args']['name'] = "new list update";
        
        $response = $this->runApp('POST', '/api/SendGrid/updateList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testDeleteList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('List not found:', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetListRecipientsList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/getListRecipientsList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('List ID does not exist', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testAddListRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612100";
        $post_data['args']['recipient_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/addListRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('no valid recipients were provided', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteListRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612100";
        $post_data['args']['recipient_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteListRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('no valid recipients were provided', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testAddListRecipients() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['list_id'] = "612100";
        $post_data['args']['recipient_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/addListRecipients', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('List ID does not exist', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testAddRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['email'] = "triongroup@gmail.com";
        
        $response = $this->runApp('POST', '/api/SendGrid/addRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testAddRecipients() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['recipients'] = "email=test@site.com;first_name=1Test;last_name=1Last name;custom_fields=test_field:qwqw";
        
        $response = $this->runApp('POST', '/api/SendGrid/addRecipients', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testUpdateRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['email'] = "triongroup@gmail.com";
        
        $response = $this->runApp('POST', '/api/SendGrid/updateRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testDeleteRecipients() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['recipient_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteRecipients', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('No recipient ids provided', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetRecipientList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getRecipientList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['recipient_id'] = "1234567890";
        
        $response = $this->runApp('POST', '/api/SendGrid/getRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('invalid ID', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteRecipient() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['recipient_id'] = "612100";
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteRecipient', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('invalid ID', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetRecipientListSubscription() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['recipient_id'] = "1234567890";
        
        $response = $this->runApp('POST', '/api/SendGrid/getRecipientListSubscription', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('recipient id is not valid', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetBillableRecipientsCount() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getBillableRecipientsCount', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetRecipientsCount() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getRecipientsCount', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testConditionalSearch() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['conditions'] = "field:email,value:triongroup@gmail.com,operator:eq,and_or:and";
        
        $response = $this->runApp('POST', '/api/SendGrid/conditionalSearch', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetMatchingCriteria() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['field_name'] = "email";
        $post_data['args']['value'] = "triongroup@gmail.com";
        
        $response = $this->runApp('POST', '/api/SendGrid/getMatchingCriteria', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testCreateSegment() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['name'] = "test segment";
        $post_data['args']['list_id'] = "1";
        $post_data['args']['conditions'] = "field:email,value:triongroup@gmail.com,operator:eq,and_or:and;field:last_name2,value:Miller2,operator:eq,and_or:and";
        
        $response = $this->runApp('POST', '/api/SendGrid/createSegment', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('list id does not exist', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetSegmentList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getSegmentList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetSegment() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['segment_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/getSegment', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Segment not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testUpdateSegment() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['segment_id'] = '1';
        $post_data['args']['name'] = "test segment";
        $post_data['args']['conditions'] = "field:email,value:triongroup@gmail.com,operator:eq,and_or:and;field:last_name2,value:Miller2,operator:eq,and_or:and";
        
        $response = $this->runApp('POST', '/api/SendGrid/updateSegment', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Segment not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteSegment() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['segment_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteSegment', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Segment not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetSegmentRecipientsList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['segment_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/getSegmentRecipientsList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Segment not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testCreateSenderIdentity() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['nickname'] = 'abdula';
        $post_data['args']['from'] = 'email:new_sender@site.com,name:new_sender';
        $post_data['args']['reply_to'] = 'email:new_sender@site.com,name:new_sender';
        $post_data['args']['address'] = 'address';
        $post_data['args']['city'] = 'city';
        $post_data['args']['country'] = 'country';
        
        $response = $this->runApp('POST', '/api/SendGrid/createSenderIdentity', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('You already have a sender identity with the same nickname', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetAllSenderIdentities() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getAllSenderIdentities', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testUpdateSenderIdentity() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['sender_id'] = '1';
        $post_data['args']['nickname'] = 'abdula';
        $post_data['args']['from'] = 'new_sender@site.com';
        $post_data['args']['reply_to'] = 'new_sender@site.com';
        $post_data['args']['address'] = 'address';
        $post_data['args']['city'] = 'city';
        $post_data['args']['country'] = 'country';
        
        $response = $this->runApp('POST', '/api/SendGrid/updateSenderIdentity', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteSenderIdentity() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['sender_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteSenderIdentity', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testResendSenderVerification() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['sender_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/resendSenderVerification', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetSenderIdentity() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['sender_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/getSenderIdentity', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetCategoriesList() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['sender_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/getCategoriesList', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty(json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testSendMail() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['from_email'] = 'test@site.com';
        $post_data['args']['subject'] = 'Test';
        $post_data['args']['personalizations'] = '[{"bcc": [{"email": "sam.doe@example.com","name": "Sam Doe"}], "cc": [{"email": "jane.doe@example.com","name": "Jane Doe"}], "custom_args": {"New Argument 1": "New Value 1","activationAttempt": "1","customerAccountNumber": "123"},"headers": {"X-Accept-Language": "en","X-Mailer": "MyApp"},"send_at": 1409348513,"subject": "Hello, World!","substitutions": {"id": "substitutions","type": "object"},"to": [ {"email": "john.doe@example.com","name": "John Doe"}]}]';
        $post_data['args']['content'] = '[{"type": "text/html","value": "<html><p>Hello, world!</p><img src=cid: werwer111></img></html>"}]';
        $post_data['args']['test'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/sendMail', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        
    }
    
    public function testCreateTemplate() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['name'] = 'new_template';
        
        $response = $this->runApp('POST', '/api/SendGrid/createTemplate', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('key exists', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testGetTemplates() {
        
        $post_data['args']['api_key'] = $this->api_key;
        
        $response = $this->runApp('POST', '/api/SendGrid/getTemplates', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetTemplate() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = 'b996aa90-5ad3-489e-89ea-99d965360d91';
        
        $response = $this->runApp('POST', '/api/SendGrid/getTemplate', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testEditTemplate() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['name'] = 'new name';
        
        $response = $this->runApp('POST', '/api/SendGrid/editTemplate', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        
    }
    
    public function testDeleteTemplate() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteTemplate', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testCreateVersion() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['name'] = '1';
        $post_data['args']['subject'] = '1';
        $post_data['args']['html_content'] = '1';
        $post_data['args']['plain_content'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/createVersion', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('could not find template', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testActivateVersion() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['version_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/activateVersion', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        
    }
    
    public function testGetVersion() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['version_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/getVersion', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testEditVersion() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['version_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/editVersion', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('JSON is malformed', json_decode($response->getBody())->contextWrites->to);
        
    }
    
    public function testDeleteVersion() {
        
        $post_data['args']['api_key'] = $this->api_key;
        $post_data['args']['template_id'] = '1';
        $post_data['args']['version_id'] = '1';
        
        $response = $this->runApp('POST', '/api/SendGrid/deleteVersion', $post_data);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('error', json_decode($response->getBody())->callback);
        $this->assertContains('Resource not found', json_decode($response->getBody())->contextWrites->to);
        
    }
    
}