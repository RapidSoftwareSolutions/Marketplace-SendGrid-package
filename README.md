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
* [deleteRecipients](#deleteRecipients)
* [getRecipientList](#getRecipientList)
* [getRecipient](#getRecipient)
* [deleteRecipient](#deleteRecipient)
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
* [sendMail](#sendMail)
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
| api_key               | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'title': 'March Newsletter',
                            'subject': 'New Products for Spring!',
                            'sender_id': 124451,
                            'list_ids': [
                              110,
                              124
                            ],
                            'segment_ids': [
                              110
                            ],
                            'categories': [
                              'spring line'
                            ],
                            'suppression_group_id': 42,
                            'custom_unsubscribe_url': '',
                            'ip_pool': 'marketing',
                            'html_content': '<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>',
                            'plain_content': 'Check out our spring line!',
                            'status': 'Draft'
                          }"
		}
	}
}
```

<a name="getCampaigns"/>
## SendGrid.getCampaigns
Returns campaigns in reverse order they were created (newest first). Returns an empty array if no campaigns exist.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'result': [
                              {
                                'id': 986724,
                                'title': 'March Newsletter',
                                'subject': 'New Products for Spring!',
                                'sender_id': 124451,
                                'list_ids': [
                                  110,
                                  124
                                ],
                                'segment_ids': [
                                  110
                                ],
                                'categories': [
                                  'spring line'
                                ],
                                'suppression_group_id': 42,
                                'custom_unsubscribe_url': '',
                                'ip_pool': 'marketing',
                                'html_content': '<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>',
                                'plain_content': 'Check out our spring line!',
                                'status': 'Draft'
                              },
                              {
                                'id': 986723,
                                'title': 'February Newsletter',
                                'subject': 'Final Winter Product Sale!',
                                'sender_id': 124451,
                                'list_ids': [
                                  110,
                                  124
                                ],
                                'segment_ids': [
                                  110
                                ],
                                'categories': [
                                  'winter line'
                                ],
                                'suppression_group_id': 42,
                                'custom_unsubscribe_url': '',
                                'ip_pool': 'marketing',
                                'html_content': '<html><head><title></title></head><body><p>Last call for winter clothes!</p></body></html>',
                                'plain_content': 'Last call for winter clothes!',
                                'status': 'Sent'
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getCampaign"/>
## SendGrid.getCampaign
Get details about a specific campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'title': 'March Newsletter',
                            'subject': 'New Products for Spring!',
                            'sender_id': 124451,
                            'list_ids': [
                              110,
                              124
                            ],
                            'segment_ids': [
                              110
                            ],
                            'categories': [
                              'spring line'
                            ],
                            'suppression_group_id': 42,
                            'custom_unsubscribe_url': '',
                            'ip_pool': 'marketing',
                            'html_content': '<html><head><title></title></head><body><p>Check out our spring line!</p></body></html>',
                            'plain_content': 'Check out our spring line!',
                            'status': 'Draft'
                          }"
		}
	}
}
```

<a name="getSpamReportsList"/>
## SendGrid.getSpamReportsList
List all spam reports.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"[
                            {
                              'created': 1443651141,
                              'email': 'user1@example.com',
                              'ip': '10.63.202.100'
                            },
                            {
                              'created': 1443651154,
                              'email': 'user2@example.com',
                              'ip': '10.63.202.100'
                            }
                          ]"
		}
	}
}
```

<a name="deleteSpamReports"/>
## SendGrid.deleteSpamReports
You can delete all spam reports by setting "delete_all" to true in the request body.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getSpamReport"/>
## SendGrid.getSpamReport
Get a specific spam report.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"[
                            {
                              'created': 1454433146,
                              'email': 'test1@example.com',
                              'ip': 'xx.xx.xx.xx'
                            }
                          ]"
		}
	}
}
```

<a name="deleteSpamReport"/>
## SendGrid.deleteSpamReport
Delete a specific spam report.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="deleteCampaign"/>
## SendGrid.deleteCampaign
Delete a Campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="updateCampaign"/>
## SendGrid.updateCampaign
Update a campaign.

| Field                 | Type  | Description
|-----------------------|-------|----------
| api_key               | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'title': 'May Newsletter',
                            'subject': 'New Products for Summer!',
                            'sender_id': 124451,
                            'list_ids': [
                              110,
                              124
                            ],
                            'segment_ids': [
                              110
                            ],
                            'categories': [
                              'summer line'
                            ],
                            'suppression_group_id': 42,
                            'custom_unsubscribe_url': '',
                            'ip_pool': 'marketing',
                            'html_content': '<html><head><title></title></head><body><p>Check out our summer line!</p></body></html>',
                            'plain_content': 'Check out our summer line!',
                            'status': 'Draft'
                          }"
		}
	}
}
```

<a name="sendCampaign"/>
## SendGrid.sendCampaign
Send a Campaign

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'status': 'Scheduled'
                          }"
		}
	}
}
```

<a name="scheduleCampaign"/>
## SendGrid.scheduleCampaign
Schedule a campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'send_at': 1489771528,
                            'status': 'Scheduled'
                          }"
		}
	}
}
```

<a name="updateScheduledCampaign"/>
## SendGrid.updateScheduledCampaign
Changes the send_at time for the specified campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 986724,
                            'send_at': 1489451436,
                            'status': 'Scheduled'
                          }"
		}
	}
}
```

<a name="getScheduledTime"/>
## SendGrid.getScheduledTime
Get scheduled time of a campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'send_at': 1489771528
                          }"
		}
	}
}
```

<a name="unscheduleCampaign"/>
## SendGrid.unscheduleCampaign
Unschedule a scheduled campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="testCampaign"/>
## SendGrid.testCampaign
Send a test campaign.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="createCustomField"/>
## SendGrid.createCustomField
Create a custom field.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'pet',
                            'type': 'text'
                          }"
		}
	}
}
```

<a name="getCustomFieldList"/>
## SendGrid.getCustomFieldList
Get a list of all custom fields

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'custom_fields': [
                              {
                                'id': 1,
                                'name': 'birthday',
                                'type': 'date'
                              },
                              {
                                'id': 2,
                                'name': 'middle_name',
                                'type': 'text'
                              },
                              {
                                'id': 3,
                                'name': 'favorite_number',
                                'type': 'number'
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getCustomField"/>
## SendGrid.getCustomField
Get details about a specific custom field.

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'pet',
                            'type': 'text'
                          }"
		}
	}
}
```

<a name="deleteCustomField"/>
## SendGrid.deleteCustomField
Delete a specific custom field by it's ID.

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getReservedFieldsList"/>
## SendGrid.getReservedFieldsList
List fields that are reserved and can't be used for custom field names.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'reserved_fields': [
                              {
                                'name': 'first_name',
                                'type': 'text'
                              },
                              {
                                'name': 'last_name',
                                'type': 'text'
                              },
                              {
                                'name': 'email',
                                'type': 'text'
                              },
                              {
                                'name': 'created_at',
                                'type': 'date'
                              },
                              {
                                'name': 'updated_at',
                                'type': 'date'
                              },
                              {
                                'name': 'last_emailed',
                                'type': 'date'
                              },
                              {
                                'name': 'last_clicked',
                                'type': 'date'
                              },
                              {
                                'name': 'last_opened',
                                'type': 'date'
                              },
                              {
                                'name': 'my_custom_field',
                                'type': 'text'
                              }
                            ]
                          }"
		}
	}
}
```

<a name="createList"/>
## SendGrid.createList
Create a list.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'listname',
                            'recipient_count': 0
                          }"
		}
	}
}
```

<a name="getListsList"/>
## SendGrid.getListsList
Returns a list of the lists in your account. The method will returns an empty list if you GET and no lists exist on your account.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'lists': [
                              {
                                'id': 1,
                                'name': 'the jones',
                                'recipient_count': 1
                              }
                            ]
                          }"
		}
	}
}
```

<a name="deleteLists"/>
## SendGrid.deleteLists
Delete multiple lists.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getList"/>
## SendGrid.getList
Get information about a specific list.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'listname',
                            'recipient_count': 0
                          }"
		}
	}
}
```

<a name="updateList"/>
## SendGrid.updateList
Update a list.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="deleteList"/>
## SendGrid.deleteList
Delete a list.

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getListRecipientsList"/>
## SendGrid.getListRecipientsList
Get a list of the recipients on a specific list.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'recipients': [
                              {
                                'created_at': 1422395108,
                                'email': 'e@example.com',
                                'first_name': 'Ed',
                                'id': 'YUBh',
                                'last_clicked': null,
                                'last_emailed': null,
                                'last_name': null,
                                'last_opened': null,
                                'updated_at': 1422395108
                              }
                            ]
                          }"
		}
	}
}
```

<a name="addListRecipient"/>
## SendGrid.addListRecipient
Individual recipients may be added to a list one at a time with a limit of 1000 requests per second, where one recipient is added to the list per request.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="deleteListRecipient"/>
## SendGrid.deleteListRecipient
Delete a single recipient from a single list.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="addListRecipients"/>
## SendGrid.addListRecipients
Adds existing recipients to a list, passing in the recipient IDs to add. Recipient IDs should be passed exactly as they are returned from recipient endpoints.
Note: The rate at which recipients may be added to a list is limited to 1 request per second. Recipients may be added in batches of 1000.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="addRecipient"/>
## SendGrid.addRecipient
Add a single recipient.
The rate at which recipients may be uploaded is limited to 3 requests every 2 seconds. Recipients may be uploaded in batches of 1000 per request. This results in a maximum upload rate of 1500 recipients per second.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'error_count': 0,
                            'error_indices': [

                            ],
                            'unmodified_indices': [

                            ],
                            'new_count': 1,
                            'persisted_recipients': [
                              'am9uZXNAZXhhbXBsZS5jb20='
                            ],
                            'updated_count': 0
                          }"
		}
	}
}
```

<a name="addRecipients"/>
## SendGrid.addRecipients
Add multiple recipients.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'error_count': 1,
                            'error_indices': [
                              2
                            ],
                            'unmodified_indices': [
                              3
                            ],
                            'new_count': 2,
                            'persisted_recipients': [
                              'YUBh',
                              'bWlsbGVyQG1pbGxlci50ZXN0'
                            ],
                            'updated_count': 0,
                            'errors': [
                              {
                                'message': 'Invalid email.',
                                'error_indices': [
                                  2
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="updateRecipient"/>
## SendGrid.updateRecipient
Updates one or more recipients.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'error_count': 0,
                            'error_indices': [

                            ],
                            'unmodified_indices': [
                              1
                            ],
                            'new_count': 0,
                            'persisted_recipients': [
                              'am9uZXNAZXhhbXBsZS5jb20='
                            ],
                            'updated_count': 1
                          }"
		}
	}
}
```

<a name="deleteRecipients"/>
## SendGrid.deleteRecipients
Deletes one or more recipients.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getRecipientList"/>
## SendGrid.getRecipientList
Get a list of recipients.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'recipients': [
                              {
                                'created_at': 1422313607,
                                'email': 'jones@example.com',
                                'first_name': null,
                                'id': 'YUBh',
                                'last_clicked': null,
                                'last_emailed': null,
                                'last_name': 'Jones',
                                'last_opened': null,
                                'updated_at': 1422313790,
                                'custom_fields': [
                                  {
                                    'id': 23,
                                    'name': 'pet',
                                    'value': 'Indiana',
                                    'type': 'text'
                                  }
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getRecipient"/>
## SendGrid.getRecipient
Get details about a specific recipient.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'created_at': 1422313607,
                            'email': 'jones@example.com',
                            'first_name': null,
                            'id': 'YUBh',
                            'last_clicked': null,
                            'last_emailed': null,
                            'last_name': 'Jones',
                            'last_opened': null,
                            'updated_at': 1422313790,
                            'custom_fields': [
                              {
                                'id': 23,
                                'name': 'pet',
                                'value': 'Indiana',
                                'type': 'text'
                              }
                            ]
                          }"
		}
	}
}
```

<a name="deleteRecipient"/>
## SendGrid.deleteRecipient
Delete one recipient.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
| recipient_id| String| The recipient ID.

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
			"to":"[empty]"
		}
	}
}
```

<a name="getRecipientListSubscription"/>
## SendGrid.getRecipientListSubscription
Get the lists the recipient is on.

| Field       | Type  | Description
|-------------|-------|----------
| api_key     | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'lists': [
                              {
                                'id': 1,
                                'name': 'listname',
                                'recipient_count': 1
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getBillableRecipientsCount"/>
## SendGrid.getBillableRecipientsCount
Get a count of billable recipients.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'recipient_count': 2
                          }"
		}
	}
}
```

<a name="getRecipientsCount"/>
## SendGrid.getRecipientsCount
Get a count of recipients.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'recipient_count': 2
                          }"
		}
	}
}
```

<a name="conditionalSearch"/>
## SendGrid.conditionalSearch
Search using segment conditions. Body contains a JSON object with conditions, a list of conditions as described below, and an optional list_id, which is a valid list ID for a list to limit the search on.
Valid operators for create and update depend on the type of the field you are searching for.
Dates: "eq", "ne", "lt" (before), "gt" (after)
Text: "contains", "eq" (is - matches the full field), "ne" (is not - matches any field where the entire field is not the condition value)
Numbers: "eq", "lt", "gt"
Email Clicks and Opens: "eq" (opened), "ne" (not opened)
Search conditions using "eq" or "ne" for email clicks and opens should provide a "field" of either clicks.campaign_identifier or opens.campaign_identifier. The condition value should be a string containing the id of a completed campaign.
Search conditions list may contain multiple conditions, joined by an "and" or "or" in the "and_or" field. The first condition in the conditions list must have an empty "and_or", and subsequent conditions must all specify an "and_or".

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'recipients': [
                              {
                                'created_at': 1422313607,
                                'email': 'jones@example.com',
                                'first_name': null,
                                'id': 'YUBh',
                                'last_clicked': 12345,
                                'last_emailed': null,
                                'last_name': 'Miller',
                                'last_opened': null,
                                'updated_at': 1422313790,
                                'custom_fields': [
                                  {
                                    'id': 23,
                                    'name': 'pet',
                                    'value': 'Fluffy',
                                    'type': 'text'
                                  }
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getMatchingCriteria"/>
## SendGrid.getMatchingCriteria
Get a recipients' matching search criteria.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'recipients': [
                              {
                                'created_at': 1422313607,
                                'email': 'jones@example.com',
                                'first_name': null,
                                'id': 'YUBh',
                                'last_clicked': null,
                                'last_emailed': null,
                                'last_name': 'Jones',
                                'last_opened': null,
                                'updated_at': 1422313790,
                                'custom_fields': [
                                  {
                                    'id': 23,
                                    'name': 'pet',
                                    'value': 'Indiana',
                                    'type': 'text'
                                  }
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="createSegment"/>
## SendGrid.createSegment
Create segment.
Valid operators for create and update depend on the type of the field you are segmenting.
Dates: "eq", "ne", "lt" (before), "gt" (after)
Text: "contains", "eq" (is - matches the full field), "ne" (is not - matches any field where the entire field is not the condition value)
Numbers: "eq", "lt", "gt"
Email Clicks and Opens: "eq" (opened), "ne" (not opened)
Segment conditions using "eq" or "ne" for email clicks and opens should provide a "field" of either clicks.campaign_identifier or opens.campaign_identifier. The condition value should be a string containing the id of a completed campaign.Segments may contain multiple condtions, joined by an "and" or "or" in the "and_or" field. The first condition in the conditions list must have an empty "and_or", and subsequent conditions must all specify an "and_or".

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'Last Name Miller',
                            'list_id': 4,
                            'conditions': [
                              {
                                'field': 'last_name',
                                'value': 'Miller',
                                'operator': 'eq',
                                'and_or': ''
                              },
                              {
                                'field': 'last_clicked',
                                'value': '01/02/2015',
                                'operator': 'gt',
                                'and_or': 'and'
                              },
                              {
                                'field': 'clicks.campaign_identifier',
                                'value': '513',
                                'operator': 'eq',
                                'and_or': 'or'
                              }
                            ],
                            'recipient_count': 0
                          }"
		}
	}
}
```

<a name="getSegmentList"/>
## SendGrid.getSegmentList
Get a list of all segments.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'segments': [
                              {
                                'id': 1,
                                'name': 'Last Name Miller',
                                'list_id': 4,
                                'conditions': [
                                  {
                                    'field': 'last_name',
                                    'value': 'Miller',
                                    'operator': 'eq',
                                    'and_or': ''
                                  }
                                ],
                                'recipient_count': 1
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getSegment"/>
## SendGrid.getSegment
Get details about a specific segment.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'name': 'Last Name Miller',
                            'list_id': 4,
                            'conditions': [
                              {
                                'field': 'last_name',
                                'value': 'Miller',
                                'operator': 'eq',
                                'and_or': ''
                              }
                            ],
                            'recipient_count': 1
                          }"
		}
	}
}
```

<a name="updateSegment"/>
## SendGrid.updateSegment
Update fields in a specific segment.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 5,
                            'name': 'The Millers',
                            'list_id': 5,
                            'conditions': [
                              {
                                'field': 'last_name',
                                'value': 'Miller',
                                'operator': 'eq',
                                'and_or': ''
                              }
                            ],
                            'recipient_count': 1
                          }"
		}
	}
}
```

<a name="deleteSegment"/>
## SendGrid.deleteSegment
Delete a segment.

| Field          | Type  | Description
|----------------|-------|----------
| api_key        | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getSegmentRecipientsList"/>
## SendGrid.getSegmentRecipientsList
Get a list of recipients on a segment.

| Field     | Type  | Description
|-----------|-------|----------
| api_key   | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'recipients': [
                              {
                                'created_at': 1422313607,
                                'email': 'jones@example.com',
                                'first_name': null,
                                'id': 'YUBh',
                                'last_clicked': null,
                                'last_emailed': null,
                                'last_name': 'Jones',
                                'last_opened': null,
                                'updated_at': 1422313790,
                                'custom_fields': [
                                  {
                                    'id': 23,
                                    'name': 'pet',
                                    'value': 'Indiana',
                                    'type': 'text'
                                  }
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="createSenderIdentity"/>
## SendGrid.createSenderIdentity
This endpoint allows you to create a sender identity.
Sender Identities are required to be verified before use. If your domain has been white labeled it will auto verify on creation. Otherwise an email will be sent to the from.email.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'nickname': 'My Sender ID',
                            'from': {
                              'email': 'from@example.com',
                              'name': 'Example INC'
                            },
                            'reply_to': {
                              'email': 'replyto@example.com',
                              'name': 'Example INC'
                            },
                            'address': '123 Elm St.',
                            'address_2': 'Apt. 456',
                            'city': 'Denver',
                            'state': 'Colorado',
                            'zip': '80202',
                            'country': 'United States',
                            'verified': true,
                            'updated_at': 1449872165,
                            'created_at': 1449872165,
                            'locked': false
                          }"
		}
	}
}
```

<a name="getAllSenderIdentities"/>
## SendGrid.getAllSenderIdentities
This endpoint allows you to retrieve a list of all of your sender identities.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'result': [
                              {
                                'id': 1,
                                'nickname': 'My Sender ID',
                                'from': {
                                  'email': 'from@example.com',
                                  'name': 'Example INC'
                                },
                                'reply_to': {
                                  'email': 'replyto@example.com',
                                  'name': 'Example INC'
                                },
                                'address': '123 Elm St.',
                                'address_2': 'Apt. 456',
                                'city': 'Denver',
                                'state': 'Colorado',
                                'zip': '80202',
                                'country': 'United States',
                                'verified': true,
                                'updated_at': 1449872165,
                                'created_at': 1449872165,
                                'locked': false
                              }
                            ]
                          }"
		}
	}
}
```

<a name="updateSenderIdentity"/>
## SendGrid.updateSenderIdentity
Updates to from.email require re-verification. If your domain has been whitelabeled it will auto verify on creation. Otherwise an email will be sent to the from.email.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'nickname': 'My Sender ID',
                            'from': {
                              'email': 'from@example.com',
                              'name': 'Example INC'
                            },
                            'reply_to': {
                              'email': 'replyto@example.com',
                              'name': 'Example INC'
                            },
                            'address': '123 Elm St.',
                            'address_2': 'Apt. 456',
                            'city': 'Denver',
                            'state': 'Colorado',
                            'zip': '80202',
                            'country': 'United States'
                          }"
		}
	}
}
```

<a name="deleteSenderIdentity"/>
## SendGrid.deleteSenderIdentities
This endpoint allows you to delete one of your sender identities.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="resendSenderVerification"/>
## SendGrid.resendSenderVerification
This endpoint allows you to resend the sender identity verification email.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="getSenderIdentity"/>
## SendGrid.getSenderIdentity
This endoint allows you to retrieve a specific sender identity.

| Field    | Type  | Description
|----------|-------|----------
| api_key  | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 1,
                            'nickname': 'My Sender ID',
                            'from': {
                              'email': 'from@example.com',
                              'name': 'Example INC'
                            },
                            'reply_to': {
                              'email': 'replyto@example.com',
                              'name': 'Example INC'
                            },
                            'address': '123 Elm St.',
                            'address_2': 'Apt. 456',
                            'city': 'Denver',
                            'state': 'Colorado',
                            'zip': '80202',
                            'country': 'United States',
                            'verified': true,
                            'updated_at': 1449872165,
                            'created_at': 1449872165,
                            'locked': false
                          }"
		}
	}
}
```

<a name="getCategoriesList"/>
## SendGrid.getCategoriesList
Retrieve a list of your categories.

| Field   | Type  | Description
|---------|-------|----------
| api_key | credentials| The API key obtained from SendGrid.
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
			"to":"[
                            {'category': 'cat1'},
                            {'category': 'cat2'},
                            {'category': 'cat3'},
                            {'category': 'cat4'},
                            {'category': 'cat5'}
                          ]"
		}
	}
}
```

<a name="sendMail"/>
## SendGrid.sendMail
This endpoint allows you to send email.

| Field           | Type  | Description
|---------        |-------|----------
| api_key         | credentials| The API key obtained from SendGrid.
| personalizations| JSON  | An array of messages and their metadata. Each object within personalizations can be thought of as an envelope - it defines who should receive an individual message and how that message should be handled. Parameters in personalizations will override the parameters of the same name from the message level. Example: [{"bcc": [{"email": "sam.doe@example.com","name": "Sam Doe"}], "cc": [{"email": "jane.doe@example.com","name": "Jane Doe"}], "custom_args": {"New Argument 1": "New Value 1","activationAttempt": "1","customerAccountNumber": "123"},"headers": {"X-Accept-Language": "en","X-Mailer": "MyApp"},"send_at": 1409348513,"subject": "Hello, World!","substitutions": {"id": "substitutions","type": "object"},"to": [ {"email": "john.doe@example.com","name": "John Doe"}]}]
| from_email      | String| The email address of the sender.
| from_name       | String| Optional: The name of the sender.
| reply_to_email       | String| Optional: The email address to which responses will be sent.
| reply_to_name       | String| Optional: The name of the individual who will receive responses to the email.
| subject       | String| The subject of your email. This may be overridden by personalizations[x].subject.
| content       | JSON| An array in which you may specify the content of your email. You can include multiple mime types of content, but you must specify at least one. To include more than one mime type, simply add another object to the array containing the type and value parameters. If included, text/plain and text/html must be the first indices of the array in this order. If you choose to include the text/plain or text/html mime types, they must be the first indices of the content array in the order text/plain, text/html. Example: [{"type": "text/html","value": "<html><p>Hello, world!</p><img src=cid: werwer111></img></html>"}]
| attachments       | JSON| Optional: An array of objects in which you can specify any attachments you want to include. Content - The Base64 encoded content of the attachment; type (optional) - The mime type of the content you are attaching. For example, application/pdf or image/jpeg; filename - The filename of the attachment; disposition (optional) - Defaults to "attachment". Can be either "attachment" or "inline"; content_id (optional) - A unique id that you specify for the attachment, ex: <img src="cid:ii_139db99fdb5c3704"></img>. Example: [{"content": "[BASE64 encoded content block here]","content_id": "ii_139db99fdb5c3704","disposition": "inline","filename": "file1.jpg","name": "file1","type": "jpg"}]
| template_id       | String| Optional: The id of a template that you would like to use. If you use a template that contains content and a subject (either text or html), you do not need to specify those in the respective personalizations or message level parameters.
| sections      | JSON| Optional: An object of key/value pairs that define large blocks of content that can be inserted into your emails using substitution tags. Example: {"section": {":sectionName1": "section 1 text", ":sectionName2": "section 2 text"}}
| headers      | JSON| Optional: An object containing key/value pairs of header names and the value to substitute for them. You must ensure these are properly encoded if they contain unicode characters. Must not be any of the following reserved headers: x-sg-id, x-sg-eid, received, dkim-signature, Content-Type, Content-Transfer-Encoding, To, From, Subject, Reply-To, CC, BCC.
| categories      | String| Optional: Category names for this message with comma-separate. Each category name may not exceed 255 characters. You cannot have more than 10 categories per request.
| custom_args      | String| Optional: Values according the pattern KEY:VALUE,KEY:VALUE etc., that are specific to the entire send that will be carried along with the email and its activity data. Substitutions will not be made on custom arguments, so any string that is entered into this parameter will be assumed to be the custom argument that you would like to be used. This parameter is overridden by any conflicting personalizations[x].custom_args if that parameter has been defined.
| send_at      | String| Optional: A unix timestamp allowing you to specify when you want your email to be sent from SendGrid. This is not necessary if you want the email to be sent at the time of your API request.
| batch_id      | String| Optional: This ID represents a batch of emails (AKA multiple sends of the same email) to be associated to each other for scheduling. Including a batch_id in your request allows you to include this email in that batch, and also enables you to cancel or pause the delivery of that entire batch.
| asm      | String| Optional: An object allowing you to specify how to handle unsubscribes. Use pattern group_id:value;groups_to_display:value1,value2,... etc.
| ip_pool_name      | String| Optional: The IP Pool that you would like to send this email from. Min 2, Max 64.
| mail_settings_bcc_enable      | String| Optional: true or false. Indicates if this setting is enabled.
| mail_settings_bcc_email      | String| Optional: The email address that you would like to receive the BCC.
| mail_settings_bypass_list_management_enable      | String| Optional: true or false. Indicates if this setting is enabled. Allows you to bypass all unsubscribe groups and suppressions to ensure that the email is delivered to every single recipient. This should only be used in emergencies when it is absolutely necessary that every recipient receives your email. Ex: outage emails, or forgot password emails.
| mail_settings_footer_enable      | String| Optional: true or false. Indicates if this setting is enabled. The default footer that you would like appended to the bottom of every email.
| mail_settings_footer_text      | String| Optional: The plain text content of your footer.
| mail_settings_footer_html      | String| Optional: The HTML content of your footer.
| mail_settings_sandbox_mode_enable      | String| Optional: true or false. Indicates if this setting is enabled. This allows you to send a test email to ensure that your request body is valid and formatted correctly.
| mail_settings_spam_check_enable      | String| Optional: true or false. Indicates if this setting is enabled. This allows you to test the content of your email for spam.
| mail_settings_spam_check_threshold      | String| The threshold used to determine if your content qualifies as spam on a scale from 1 to 10, with 10 being most strict, or most likely to be considered as spam.
| mail_settings_spam_check_post_to_url      | String| Optional: An Inbound Parse URL that you would like a copy of your email along with the spam report to be sent to. The post_to_url parameter must start with http or https.
| tracking_settings_click_tracking_enable      | String| Optional: true or false. Indicates if this setting is enabled. Allows you to track whether a recipient clicked a link in your email.
| tracking_settings_click_tracking_enable_text      | String| Optional: true or false. Indicates if this setting should be included in the text/plain portion of your email.
| tracking_settings_open_tracking_enable      | String| Optional: true or false. Indicates if this setting is enabled. Allows you to track whether the email was opened or not, but including a single pixel image in the body of the content. When the pixel is loaded, we can log that the email was opened.
| tracking_settings_open_tracking_substitution_tag      | String| Optional: Allows you to specify a substitution tag that you can insert in the body of your email at a location that you desire. This tag will be replaced by the open tracking pixel.
| tracking_settings_subscription_tracking_enable      | String| Optional: true or false. Indicates if this setting is enabled. Allows you to insert a subscription management link at the bottom of the text and html bodies of your email. If you would like to specify the location of the link within your email, you may use the substitution_tag.
| tracking_settings_subscription_tracking_text     | String| Optional: Text to be appended to the email, with the subscription tracking link. You may control where the link is by using the tag <% %>.
| tracking_settings_subscription_tracking_html     | String| Optional: HTML to be appended to the email, with the subscription tracking link. You may control where the link is by using the tag <% %>.
| tracking_settings_subscription_tracking_substitution_tag     | String| Optional: A tag that will be replaced with the unsubscribe URL. for example: [unsubscribe_url]. If this parameter is used, it will override both the textand html parameters. The URL of the link will be placed at the substitution tag’s location, with no additional formatting.
| ganalytics_enable     | String| Optional: true or false. Indicates if this setting is enabled. Allows you to enable tracking provided by Google Analytics.
| ganalytics_utm_source     | String| Optional: Name of the referrer source. (e.g. Google, SomeDomain.com, or Marketing Email).
| ganalytics_utm_medium     | String| Optional: Name of the marketing medium. (e.g. Email).
| ganalytics_utm_term     | String| Optional: Used to identify any paid keywords.
| ganalytics_utm_content    | String| Optional: Used to differentiate your campaign from advertisements.


#### Request example
```json
{	"api_key": "...",
	"personalizations": "...",
	"from_email": "...",
	"from_name": "...",
	"reply_to_email": "...",
	"reply_to_name": "...",
	"subject": "...",
	"content": "...",
	"attachments": "...",
	"template_id": "...",
	"sections": "...",
	"headers": "...",
	"categories": "...",
	"custom_args": "...",
	"send_at": "...",
	"batch_id": "...",
	"asm": "...",
	"ip_pool_name": "...",
	"mail_settings_bcc_enable": "...",
	"mail_settings_bcc_email": "...",
	"mail_settings_bypass_list_management_enable": "...",
	"mail_settings_footer_enable": "...",
	"mail_settings_footer_text": "...",
	"mail_settings_footer_html": "...",
	"mail_settings_sandbox_mode_enable": "...",
	"mail_settings_spam_check_enable": "...",
	"mail_settings_spam_check_threshold": "...",
	"mail_settings_spam_check_post_to_url": "...",
	"tracking_settings_click_tracking_enable": "...",
	"tracking_settings_click_tracking_enable_text": "...",
	"tracking_settings_open_tracking_enable": "...",
	"tracking_settings_open_tracking_substitution_tag": "...",
	"tracking_settings_subscription_tracking_enable": "...",
	"tracking_settings_subscription_tracking_text": "...",
	"tracking_settings_subscription_tracking_html": "...",
	"tracking_settings_subscription_tracking_substitution_tag": "...",
	"ganalytics_enable": "...",
	"ganalytics_utm_source": "...",
	"ganalytics_utm_medium": "...",
	"ganalytics_utm_term": "...",
	"ganalytics_utm_content": "...",
}
```
#### Response example
```json
{
	"callback":"success",
	"contextWrites":{
		"#":{
			"to":"[empty]"
		}
	}
}
```

<a name="createTemplate"/>
## SendGrid.createTemplate
Create a template.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '733ba07f-ead1-41fc-933a-3976baa23716',
                            'name': 'example_name',
                            'versions': []
                          }"
		}
	}
}
```

<a name="getTemplates"/>
## SendGrid.getTemplates
Retrieve all templates.

| Field  | Type  | Description
|--------|-------|----------
| api_key| credentials| The API key obtained from SendGrid.

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
			"to":"{
                            'templates': [
                              {
                                'id': 'e8ac01d5-a07a-4a71-b14c-4721136fe6aa',
                                'name': 'example template name',
                                'versions': [
                                  {
                                    'id': '5997fcf6-2b9f-484d-acd5-7e9a99f0dc1f',
                                    'template_id': '9c59c1fb-931a-40fc-a658-50f871f3e41c',
                                    'active': 1,
                                    'name': 'example version name',
                                    'updated_at': '2014-03-19 18:56:33'
                                  }
                                ]
                              }
                            ]
                          }"
		}
	}
}
```

<a name="getTemplate"/>
## SendGrid.getTemplate
Retrieve a single template.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': 'e8ac01d5-a07a-4a71-b14c-4721136fe6aa',
                            'name': 'example template name',
                            'versions': [
                              {
                                'id': 'de37d11b-082a-42c0-9884-c0c143015a47',
                                'user_id': 1234,
                                'template_id': 'd51480ba-ca3f-465c-bc3e-ceb71d73c38d',
                                'active': 1,
                                'name': 'example version',
                                'html_content': '<%body%><strong>Click to Reset</strong>',
                                'plain_content': 'Click to Reset<%body%>',
                                'subject': '<%subject%>',
                                'updated_at': '2014-05-22 20:05:21'
                              }
                            ]
                          }"
		}
	}
}
```

<a name="editTemplate"/>
## SendGrid.editTemplate
Edit a template.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '733ba07f-ead1-41fc-933a-3976baa23716',
                            'name': 'new_example_name',
                            'versions': []
                          }"
		}
	}
}
```

<a name="deleteTemplate"/>
## SendGrid.deleteTemplate
Delete a template.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

<a name="createVersion"/>
## SendGrid.createVersion
Create a new version for a template.

| Field        | Type  | Description
|--------------|-------|----------
| api_key      | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '8aefe0ee-f12b-4575-b5b7-c97e21cb36f3',
                            'template_id': 'ddb96bbc-9b92-425e-8979-99464621b543',
                            'active': 1,
                            'name': 'example_version_name',
                            'html_content': '<%body%>',
                            'plain_content': '<%body%>',
                            'subject': '<%subject%>',
                            'updated_at': '2014-03-19 18:56:33'
                          }"
		}
	}
}
```

<a name="activateVersion"/>
## SendGrid.activateVersion
Activate a version.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '8aefe0ee-f12b-4575-b5b7-c97e21cb36f3',
                            'template_id': 'e3a61852-1acb-4b32-a1bc-b44b3814ab78',
                            'active': 1,
                            'name': 'example_version_name',
                            'html_content': '<%body%>',
                            'plain_content': '<%body%>',
                            'subject': '<%subject%>',
                            'updated_at': '2014-06-12 11:33:00'
                          }"
		}
	}
}
```

<a name="getVersion"/>
## SendGrid.getVersion
Retrieve a specific version of a template.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '5997fcf6-2b9f-484d-acd5-7e9a99f0dc1f',
                            'template_id': 'd51480ca-ca3f-465c-bc3e-ceb71d73c38d'
                            'active': 1
                            'name': 'version 1 name',
                            'html_content': '<%body%>',
                            'plain_content': '<%body%>',
                            'subject': '<%subject%>',
                            'updated_at': '2014-03-19 18:56:33'
                          }"
		}
	}
}
```

<a name="editVersion"/>
## SendGrid.editVersion
Edit a version.

| Field        | Type  | Description
|--------------|-------|----------
| api_key      | credentials| The API key obtained from SendGrid.
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
			"to":"{
                            'id': '8aefe0ee-f12b-4575-b5b7-c97e21cb36f3',
                            'template_id': 'ddb96bbc-9b92-425e-8979-99464621b543',
                            'active': 1,
                            'name': 'updated_example_name',
                            'html_content': '<%body%>',
                            'plain_content': '<%body%>',
                            'subject': '<%subject%>',
                            'updated_at': '2014-03-19 18:56:33'
                          }"
		}
	}
}
```

<a name="deleteVersion"/>
## SendGrid.deleteVersion
Delete a version.

| Field      | Type  | Description
|------------|-------|----------
| api_key    | credentials| The API key obtained from SendGrid.
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
			"to":"[empty]"
		}
	}
}
```

