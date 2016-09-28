<?php
$routes = [
    'createCampaign',
    'getCampaigns',
    'getCampaign',
    'getSpamReportsList',
    'deleteSpamReports',
    'getSpamReport',
    'deleteSpamReport',
    'deleteCampaign',
    'updateCampaign',
    'sendCampaign',
    'scheduleCampaign',
    'updateScheduledCampaign',
    'getScheduledTime',
    'unscheduleCampaign',
    'testCampaign',
    'createCustomField',
    'getCustomFieldList',
    'getCustomField',
    'deleteCustomField',
    'getReservedFieldsList',
    'createList',
    'getListsList',
    'deleteLists',
    'getList',
    'updateList',
    'deleteList',
    'getListRecipientsList',
    'addListRecipient',
    'deleteListRecipient',
    'addListRecipients',
    'addRecipient',
    'addRecipients',
    'updateRecipient',
    'deleteRecipient',
    'getRecipientList',
    'getRecipient',
    'getRecipientListSubscription',
    'getBillableRecipientsCount',
    'getRecipientsCount',
    'conditionalSearch',
    'getMatchingCriteria',
    'createSegment',
    'getSegmentList',
    'getSegment',
    'updateSegment',
    'deleteSegment',
    'getSegmentRecipientsList',
    'createSenderIdentity',
    'getAllSenderIdentities',
    'updateSenderIdentity',
    'deleteSenderIdentity',
    'resendSenderVerification',
    'getSenderIdentity',
    'getCategoriesList',
    'sendMail',
    'createTemplate',
    'getTemplates',
    'getTemplate',
    'editTemplate',
    'deleteTemplate',
    'createVersion',
    'activateVersion',
    'getVersion',
    'editVersion',
    'deleteVersion',
    'metadata'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

