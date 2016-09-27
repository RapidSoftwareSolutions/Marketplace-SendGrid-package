# SendGrid Package
SendGrid is a cloud-based SMTP provider that allows you to send email without having to maintain email servers.
* Domain: sendgrid.com
* Credentials: api_key

## How to get credentials: 
0. Item one 
1. Item two

## TOC: 
* [createCampaign](#createCampaign)
* [getCampaigns](#getCampaigns)
* [getCampaign](#getCampaign)
* [getSpamReportsList](#getSpamReportsList)
* [deleteSpamReports](#deleteSpamReports)
* [getSpamReport](#getSpamReport)
* [deleteSpamReport](#deleteSpamReport)
* [deleteCampaign](#deleteCampaign)
* [updateCampaign](#updateCampaign)
* [sendCampaign](#sendCampaign)
* [scheduleCampaign](#scheduleCampaign)
 
<a name="createCampaign"/>
## SendGrid.createCampaign
Method description

| Field                 | Type  | Description
|-----------------------|-------|----------
| api_key               | String| The API key obtained from SendGrid.
| title                 | String| The title of your camapign.
| subject               | String| The Email subject of your camapign.
| sender_id             | String| The sender ID obtained from Sender Management.
| list_ids              | String| Optional: The list IDs,  which will receive your email. You can indicate more than one list with comma-separated.
| segment_ids           | String| Optional: The segment IDs,  which will receive your email. You can indicate more than one segment with comma-separated.
| categories            | String| Optional: This is a category that you can set for your emails. You can create up to 10 different categories with comma-separated.
| suppression_group_id  | String| Optional: The suppression group ID.
| custom_unsubscribe_url| String| Optional: The custom unsubscribe URL.
| ip_pool               | String| Optional: The name of pool IP.
| html_content          | String| Optional: The HTML content of campaign.
| plain_content         | String| Optional: The plain text of campaign.

#### Request example
```json
{	"api_key": "...",
	"title": "...",
	"subject": "...",
	"sender_id": "...",
	"list_ids": "...",
	"segment_ids": "...",
	"categories": "...",
	"suppression_group_id": "...",
	"custom_unsubscribe_url": "...",
	"ip_pool": "...",
	"html_content": "...",
	"plain_content": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="getCampaigns"/>
## SendGrid.getCampaigns
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.

#### Request example
```json
{	"api_key": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="getCampaign"/>
## SendGrid.getCampaign
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| campaign_id| String| The id of the campaign.

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="getSpamReportsList"/>
## SendGrid.getSpamReportsList
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| start_time| String| Optional: Refers start of the time range in unix timestamp when a spam report was created (inclusive).
| end_time  | String| Optional: Refers end of the time range in unix timestamp when a spam report was created (inclusive).
| limit     | String| Optional: Limit the number of results to be displayed per page.
| offset    | String| Optional: Paging offset. The point in the list to begin displaying results.

#### Request example
```json
{	"api_key": "...",
	"start_time": "...",
	"end_time": "...",
	"limit": "...",
	"offset": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="deleteSpamReports"/>
## SendGrid.deleteSpamReports
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| delete_all| String| Optional: delete all spam reports by setting to 'true'. Default 'false'.
| emails    | String| Optional: delete some spam reports by specifying the comma-separated email addresses.

#### Request example
```json
{	"api_key": "...",
	"delete_all": "...",
	"emails": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="getSpamReport"/>
## SendGrid.getSpamReport
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| email  | String| Email address of spam report entry.

#### Request example
```json
{	"api_key": "...",
	"email": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="deleteSpamReport"/>
## SendGrid.deleteSpamReport
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| email  | String| Email address of spam report entry.

#### Request example
```json
{	"api_key": "...",
	"email": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="deleteCampaign"/>
## SendGrid.deleteCampaign
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| campaign_id| String| The id of the campaign.

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="updateCampaign"/>
## SendGrid.updateCampaign
Method description

| Field                 | Type  | Description
|-----------------------|-------|----------
| api_key               | String| The API key obtained from SendGrid.
| campaign_id           | String| The id of the campaign.
| title                 | String| Optional: The title of your camapign.
| subject               | String| Optional: The Email subject of your camapign.
| sender_id             | String| Optional: The sender ID obtained from Sender Management.
| list_ids              | String| Optional: The list IDs,  which will receive your email. You can indicate more than one list with comma-separated.
| segment_ids           | String| Optional: The segment IDs,  which will receive your email. You can indicate more than one segment with comma-separated.
| categories            | String| Optional: This is a category that you can set for your emails. You can create up to 10 different categories with comma-separated.
| suppression_group_id  | String| Optional: The suppression group ID.
| custom_unsubscribe_url| String| Optional: The custom unsubscribe URL.
| ip_pool               | String| Optional: The name of pool IP.
| html_content          | String| Optional: The HTML content of campaign.
| plain_content         | String| Optional: The plain text of campaign.

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "...",
	"title": "...",
	"subject": "...",
	"sender_id": "...",
	"list_ids": "...",
	"segment_ids": "...",
	"categories": "...",
	"suppression_group_id": "...",
	"custom_unsubscribe_url": "...",
	"ip_pool": "...",
	"html_content": "...",
	"plain_content": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="sendCampaign"/>
## SendGrid.sendCampaign
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| campaign_id| String| The id of the campaign.

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

<a name="scheduleCampaign"/>
## SendGrid.scheduleCampaign
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| campaign_id| String| The id of the campaign.
| send_at    | String| The unix timestamp of the campaign schedule (in future).

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "...",
	"send_at": "..."
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"..."
		}
	}
}
```

