<?php
namespace Models;

Class NextPage {
    protected $all_data = [];
    protected $offset = 0;
    
    public function page($limit='', $offset='', $api_key='') {
        
        if($api_key!='') {
            $query['offset'] = $offset;
            $query['limit'] = $limit;

            $sg = new \SendGrid($api_key);
    
            $resp = $sg->client->campaigns()->get(null, $query);
            $body = json_decode($resp->body());

            if(!empty($body->result)) {
                $this->all_data = array_merge($this->all_data, $body->result);
                
                $this->page($limit, $offset+$limit, $api_key);
            }
        }
        
        return $this->all_data;
    }    
    
}

