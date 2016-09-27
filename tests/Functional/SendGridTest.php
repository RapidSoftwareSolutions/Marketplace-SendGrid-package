<?php
namespace Tests\Functional;
error_reporting(1);
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
    
}