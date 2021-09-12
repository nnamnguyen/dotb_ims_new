<?php


$hook_array['after_relationship_add'][] = array(
    1,
    'update_attachment_visibility',
    DotbAutoLoader::requireWithCustom('modules/Emails/EmailsHookHandler.php'),
    DotbAutoLoader::customClass('EmailsHookHandler'),
    'updateAttachmentVisibility',
);
