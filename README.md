# SendGrid Package
SendGrid is a cloud-based SMTP provider that allows you to send email without having to maintain email servers.
* Domain: sendgrid.com
* Credentials: api_key

## How to get credentials: 
0. Go to [SendGrid](https://sendgrid.com/). 
1. Sign up or login
2. Visit [API keys page](https://app.sendgrid.com/settings/api_keys)
3. Generate API key.
4. Please store API key somewhere safe because as soon as you navigate away from page, service will not be able to retrieve or restore this generated token.

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
* [updateScheduledCampaign](#updateScheduledCampaign)
* [getScheduledTime](#getScheduledTime)
* [unscheduleCampaign](#unscheduleCampaign)
* [testCampaign](#testCampaign)
* [createCustomField](#createCustomField)
* [getCustomFieldList](#getCustomFieldList)
* [getCustomField](#getCustomField)
* [deleteCustomField](#deleteCustomField)
* [getReservedFieldsList](#getReservedFieldsList)
* [createList](#createList)
* [getListsList](#getListsList)
* [deleteLists](#deleteLists)
* [getList](#getList)
* [updateList](#updateList)
* [deleteList](#deleteList)
* [getListRecipientsList](#getListRecipientsList)
* [addListRecipient](#addListRecipient)
* [deleteListRecipient](#deleteListRecipient)
* [addListRecipients](#addListRecipients)
* [addRecipient](#addRecipient)
* [addRecipients](#addRecipients)
* [updateRecipient](#updateRecipient)
* [deleteRecipient](#deleteRecipient)
* [getRecipientList](#getRecipientList)
* [getRecipient](#getRecipient)
* [getRecipientListSubscription](#getRecipientListSubscription)
* [getBillableRecipientsCount](#getBillableRecipientsCount)
* [getRecipientsCount](#getRecipientsCount)
* [conditionalSearch](#conditionalSearch)
* [getMatchingCriteria](#getMatchingCriteria)
* [createSegment](#createSegment)
* [getSegmentList](#getSegmentList)
* [getSegment](#getSegment)
* [updateSegment](#updateSegment)
* [deleteSegment](#deleteSegment)
* [getSegmentRecipientsList](#getSegmentRecipientsList)
* [createSenderIdentity](#createSenderIdentity)
* [getAllSenderIdentities](#getAllSenderIdentities)
* [updateSenderIdentity](#updateSenderIdentity)
* [deleteSenderIdentities](#deleteSenderIdentities)
* [resendSenderVerification](#resendSenderVerification)
* [getSenderIdentity](#getSenderIdentity)
* [getCategoriesList](#getCategoriesList)
* [createTemplate](#createTemplate)
* [getTemplates](#getTemplates)
* [getTemplate](#getTemplate)
* [editTemplate](#editTemplate)
* [deleteTemplate](#deleteTemplate)
* [createVersion](#createVersion)
* [activateVersion](#activateVersion)
* [getVersion](#getVersion)
* [editVersion](#editVersion)
* [deleteVersion](#deleteVersion)
 
<a name="createCampaign"/>
## SendGrid.createCampaign
Create a marketing campaign.

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
			"to":"{ 'id': 986724, 'title': 'March Newsletter', 'subject': 'New Products for Spring!', 'sender_id': 124451, 'list_ids': [ 110, 124 ], 'segment_ids': [ 110 ], 'categories': [ 'spring line' ], 'suppression_group_id': 42, 'custom_unsubscribe_url': '', 'ip_pool': 'marketing', 'html_content': '<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>', 'plain_content': 'Check out our spring line!', 'status': 'Draft' }"
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

<a name="updateScheduledCampaign"/>
## SendGrid.updateScheduledCampaign
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

<a name="getScheduledTime"/>
## SendGrid.getScheduledTime
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

<a name="unscheduleCampaign"/>
## SendGrid.unscheduleCampaign
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

<a name="testCampaign"/>
## SendGrid.testCampaign
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| campaign_id| String| The id of the campaign.
| to         | String| The addresses to send. Multiple addresses must be comma-separated.

#### Request example
```json
{	"api_key": "...",
	"campaign_id": "...",
	"to": "..."
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

<a name="createCustomField"/>
## SendGrid.createCustomField
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| name   | String| The name of the field.
| type   | String| The type of the field.

#### Request example
```json
{	"api_key": "...",
	"name": "...",
	"type": "..."
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

<a name="getCustomFieldList"/>
## SendGrid.getCustomFieldList
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

<a name="getCustomField"/>
## SendGrid.getCustomField
Method description

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | String| The API key obtained from SendGrid.
| custom_field_id| String| The id of the custom field.

#### Request example
```json
{	"api_key": "...",
	"custom_field_id": "..."
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

<a name="deleteCustomField"/>
## SendGrid.deleteCustomField
Method description

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | String| The API key obtained from SendGrid.
| custom_field_id| String| The id of the custom field.

#### Request example
```json
{	"api_key": "...",
	"custom_field_id": "..."
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

<a name="getReservedFieldsList"/>
## SendGrid.getReservedFieldsList
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

<a name="createList"/>
## SendGrid.createList
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| name   | String| The name of the list.

#### Request example
```json
{	"api_key": "...",
	"name": "..."
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

<a name="getListsList"/>
## SendGrid.getListsList
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

<a name="deleteLists"/>
## SendGrid.deleteLists
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| id     | String| The list ID to delete. Multiple list ID must be comma-separated

#### Request example
```json
{	"api_key": "...",
	"id": "..."
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

<a name="getList"/>
## SendGrid.getList
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| list_id| String| The ID of the list.

#### Request example
```json
{	"api_key": "...",
	"list_id": "..."
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

<a name="updateList"/>
## SendGrid.updateList
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| list_id| String| The ID of the list.
| name   | String| The name of the list.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"name": "..."
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

<a name="deleteList"/>
## SendGrid.deleteList
Method description

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | String| The API key obtained from SendGrid.
| list_id        | String| The ID of the list.
| delete_contacts| String| Optional: True or False. True to delete all contacts on the list in addition to deleting the list. Default: true.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"delete_contacts": "..."
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

<a name="getListRecipientsList"/>
## SendGrid.getListRecipientsList
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| list_id  | String| The ID of the list.
| page     | String| Optional: Page index of first recipient to return (must be a positive integer). Default: 1.
| page_size| String| Optional: Number of recipients to return at a time (must be a positive integer between 1 and 1000). Default: 100.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"page": "...",
	"page_size": "..."
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

<a name="addListRecipient"/>
## SendGrid.addListRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| list_id     | String| The ID of the list.
| recipient_id| String| The ID of your existing recipient.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"recipient_id": "..."
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

<a name="deleteListRecipient"/>
## SendGrid.deleteListRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| list_id     | String| The ID of the list.
| recipient_id| String| The ID of your existing recipient.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"recipient_id": "..."
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

<a name="addListRecipients"/>
## SendGrid.addListRecipients
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| list_id     | String| The ID of the list.
| recipient_id| String| The IDs of your existing comma-separated recipients.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"recipient_id": "..."
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

<a name="addRecipient"/>
## SendGrid.addRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| email       | String| The email of the recipient.
| first_name  | String| Optional: The First Name of the recipient.
| last_name   | String| Optional: The Last Name of the recipient.
| custom_field| String| Optional: The created custom fields with comma-separated. To indicate custom field and its value use the pattern [custom_field_name]:[value]. For example: age:30,occupation:developer etc. 

#### Request example
```json
{	"api_key": "...",
	"email": "...",
	"first_name": "...",
	"last_name": "...",
	"custom_field": "..."
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

<a name="addRecipients"/>
## SendGrid.addRecipients
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| recipients| String| separated values with | according with pattern 'email'=value;'first_name'=value;'last_name'=value;'custom_fields'=value|'email'=value;'first_name'=value;'last_name'=value;'custom_fields'=value etc. To indicate custom_fields use the pattern [custom_field_name]:[value], for example: age:30,occupation:developer etc.

#### Request example
```json
{	"api_key": "...",
	"recipients": "..."
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

<a name="updateRecipient"/>
## SendGrid.updateRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| email       | String| The email of the recipient.
| first_name  | String| Optional: The First Name of the recipient.
| last_name   | String| Optional: The Last Name of the recipient.
| custom_field| String| Optional: The created custom fields with comma-separated. To indicate custom field and its value use the pattern [custom_field_name]:[value]. For example: age:30,occupation:developer etc. 

#### Request example
```json
{	"api_key": "...",
	"email": "...",
	"first_name": "...",
	"last_name": "...",
	"custom_field": "..."
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

<a name="deleteRecipient"/>
## SendGrid.deleteRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| recipient_id| String| The comma-separated recipient IDs.

#### Request example
```json
{	"api_key": "...",
	"recipient_id": "..."
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

<a name="getRecipientList"/>
## SendGrid.getRecipientList
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| page     | String| Optional: Page index of first recipients to return (must be a positive integer). Default: 1.
| page_size| String| Optional: Number of recipients to return at a time (must be a positive integer between 1 and 1000). Default: 100.

#### Request example
```json
{	"api_key": "...",
	"page": "...",
	"page_size": "..."
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

<a name="getRecipient"/>
## SendGrid.getRecipient
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| recipient_id| String| The ID of the recipient.

#### Request example
```json
{	"api_key": "...",
	"recipient_id": "..."
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

<a name="getRecipientListSubscription"/>
## SendGrid.getRecipientListSubscription
Method description

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | String| The API key obtained from SendGrid.
| recipient_id| String| The ID of the recipient.

#### Request example
```json
{	"api_key": "...",
	"recipient_id": "..."
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

<a name="getBillableRecipientsCount"/>
## SendGrid.getBillableRecipientsCount
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

<a name="getRecipientsCount"/>
## SendGrid.getRecipientsCount
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

<a name="conditionalSearch"/>
## SendGrid.conditionalSearch
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| list_id   | String| Optional: the valid list ID for a list to limit the search.
| conditions| String| The list of conditions separated with semicolon values according with pattern 'field':value,'value':value,'operator':value,'and_or':value;'field':value,'value':value,'operator':value,'and_or':value etc.

#### Request example
```json
{	"api_key": "...",
	"list_id": "...",
	"conditions": "..."
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

<a name="getMatchingCriteria"/>
## SendGrid.getMatchingCriteria
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| field_name| String| The name of the field you're looking for.
| value     | String| The value of the field you're looking for.

#### Request example
```json
{	"api_key": "...",
	"field_name": "...",
	"value": "..."
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

<a name="createSegment"/>
## SendGrid.createSegment
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| name      | String| The name of the segment.
| list_id   | String| The valid list ID.
| conditions| String| The list of conditions separated with semicolon values according with pattern 'field':value,'value':value,'operator':value,'and_or':value;'field':value,'value':value,'operator':value,'and_or':value etc.

#### Request example
```json
{	"api_key": "...",
	"name": "...",
	"list_id": "...",
	"conditions": "..."
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

<a name="getSegmentList"/>
## SendGrid.getSegmentList
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

<a name="getSegment"/>
## SendGrid.getSegment
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| segment_id| String| The ID of the segment.

#### Request example
```json
{	"api_key": "...",
	"segment_id": "..."
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

<a name="updateSegment"/>
## SendGrid.updateSegment
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| segment_id| String| The ID of the segment.
| name      | String| The name of the segment.
| list_id   | String| Optional: The ID of the list.
| conditions| String| The conditions of the segment. Value must be according with pattern 'field':value,'value':value,'operator':value.

#### Request example
```json
{	"api_key": "...",
	"segment_id": "...",
	"name": "...",
	"list_id": "...",
	"conditions": "..."
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

<a name="deleteSegment"/>
## SendGrid.deleteSegment
Method description

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | String| The API key obtained from SendGrid.
| segment_id     | String| The ID of the segment.
| delete_contacts| String| Optional: true or false. True to delete all contacts matching the segment in addition to deleting the segment. Default: true.

#### Request example
```json
{	"api_key": "...",
	"segment_id": "...",
	"delete_contacts": "..."
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

<a name="getSegmentRecipientsList"/>
## SendGrid.getSegmentRecipientsList
Method description

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | String| The API key obtained from SendGrid.
| segment_id| String| The ID of the segment.
| page_size | String| Optional: Number of recipients to return at a time (must be a positive integer from 1 to 1000). Default: 100.
| page      | String| Optional: Page index of recipients to return (must be a positive integer). Default: 1.

#### Request example
```json
{	"api_key": "...",
	"segment_id": "...",
	"page_size": "...",
	"page": "..."
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

<a name="createSenderIdentity"/>
## SendGrid.createSenderIdentity
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| nickname | String| The nickname of the sender.
| from     | String| Name and email to indicate 'from' field. Pattern to fill email:value,name:value.
| reply_to | String| Name and email to indicate 'reply_to' field. Pattern to fill email:value,name:value.
| address  | String| The address of the sender.
| address_2| String| Optional: The second address of the sender.
| city     | String| The city of the sender.
| state    | String| Optional: The state of the sender.
| zip      | String| Optional: The zip of the sender.
| country  | String| The country of the sender.

#### Request example
```json
{	"api_key": "...",
	"nickname": "...",
	"from": "...",
	"reply_to": "...",
	"address": "...",
	"address_2": "...",
	"city": "...",
	"state": "...",
	"zip": "...",
	"country": "..."
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

<a name="getAllSenderIdentities"/>
## SendGrid.getAllSenderIdentities
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

<a name="updateSenderIdentity"/>
## SendGrid.updateSenderIdentity
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| sender_id| String| The ID of the sender.
| nickname | String| The nickname of the sender.
| from     | String| Name and email to indicate 'from' field. Pattern to fill email:value,name:value.
| reply_to | String| Name and email to indicate 'reply_to' field. Pattern to fill email:value,name:value.
| address  | String| The address of the sender.
| address_2| String| Optional: The second address of the sender.
| city     | String| The city of the sender.
| state    | String| Optional: The state of the sender.
| zip      | String| Optional: The zip of the sender.
| country  | String| The country of the sender.

#### Request example
```json
{	"api_key": "...",
	"sender_id": "...",
	"nickname": "...",
	"from": "...",
	"reply_to": "...",
	"address": "...",
	"address_2": "...",
	"city": "...",
	"state": "...",
	"zip": "...",
	"country": "..."
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

<a name="deleteSenderIdentities"/>
## SendGrid.deleteSenderIdentities
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| sender_id| String| The ID of the sender.

#### Request example
```json
{	"api_key": "...",
	"sender_id": "..."
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

<a name="resendSenderVerification"/>
## SendGrid.resendSenderVerification
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| sender_id| String| The ID of the sender.

#### Request example
```json
{	"api_key": "...",
	"sender_id": "..."
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

<a name="getSenderIdentity"/>
## SendGrid.getSenderIdentity
Method description

| Field    | Type  | Description
|----------|-------|----------
| api_key  | String| The API key obtained from SendGrid.
| sender_id| String| The ID of the sender.

#### Request example
```json
{	"api_key": "...",
	"sender_id": "..."
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

<a name="getCategoriesList"/>
## SendGrid.getCategoriesList
Method description

| Field   | Type  | Description
|---------|-------|----------
| api_key | String| The API key obtained from SendGrid.
| category| String| Optional: Performs a prefix search on this value.
| limit   | String| Optional: Optional field to limit the number of results returned. Defaults to 50.
| offset  | String| Optional: Optional beginning point in the list to retrieve from. Defaults to 0.

#### Request example
```json
{	"api_key": "...",
	"category": "...",
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

<a name="createTemplate"/>
## SendGrid.createTemplate
Method description

| Field  | Type  | Description
|--------|-------|----------
| api_key| String| The API key obtained from SendGrid.
| name   | String| Name of the new template. Max 100 characters.

#### Request example
```json
{	"api_key": "...",
	"name": "..."
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

<a name="getTemplates"/>
## SendGrid.getTemplates
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

<a name="getTemplate"/>
## SendGrid.getTemplate
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.

#### Request example
```json
{	"api_key": "...",
	"template_id": "..."
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

<a name="editTemplate"/>
## SendGrid.editTemplate
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.
| name       | String| The new name of the template.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"name": "..."
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

<a name="deleteTemplate"/>
## SendGrid.deleteTemplate
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.

#### Request example
```json
{	"api_key": "...",
	"template_id": "..."
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

<a name="createVersion"/>
## SendGrid.createVersion
Method description

| Field        | Type  | Description
|--------------|-------|----------
| api_key      | String| The API key obtained from SendGrid.
| template_id  | String| The ID of the template.
| name         | String| Name of the new version. Max 100 characters.
| subject      | String| Subject of the new version. <%subject%> tag must be present.
| html_content | String| HTML content of the new version. <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for html content.
| plain_content| String| Text/plain content of the new version. <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for plain content.
| active       | String| Optional: 0 - Inactive, 1 - Active. Set the new version as the active version associated with the template. Only one version of a template can be active. The first version created for a template will automatically be set to Active.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"name": "...",
	"subject": "...",
	"html_content": "...",
	"plain_content": "...",
	"active": "..."
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

<a name="activateVersion"/>
## SendGrid.activateVersion
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.
| version_id | String| The ID of the version.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"version_id": "..."
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

<a name="getVersion"/>
## SendGrid.getVersion
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.
| version_id | String| The ID of the version.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"version_id": "..."
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

<a name="editVersion"/>
## SendGrid.editVersion
Method description

| Field        | Type  | Description
|--------------|-------|----------
| api_key      | String| The API key obtained from SendGrid.
| template_id  | String| The ID of the template.
| version_id   | String| The ID of the version.
| name         | String| Optional: Name of the new version. Max 100 characters.
| subject      | String| Optional: Subject of the new version. <%subject%> tag must be present.
| html_content | String| Optional: HTML content of the new version. <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for html content.
| plain_content| String| Optional: Text/plain content of the new version. <%body%> tag must be inside the content. Maximum of 1048576 bytes allowed for plain content.
| active       | String| Optional: 0 - Inactive, 1 - Active. Set the new version as the active version associated with the template. Only one version of a template can be active. The first version created for a template will automatically be set to Active.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"version_id": "...",
	"name": "...",
	"subject": "...",
	"html_content": "...",
	"plain_content": "...",
	"active": "..."
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

<a name="deleteVersion"/>
## SendGrid.deleteVersion
Method description

| Field      | Type  | Description
|------------|-------|----------
| api_key    | String| The API key obtained from SendGrid.
| template_id| String| The ID of the template.
| version_id | String| The ID of the version.

#### Request example
```json
{	"api_key": "...",
	"template_id": "...",
	"version_id": "..."
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

