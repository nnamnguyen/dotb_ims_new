{*

*}
<!---------------  START WORKFLOW SHOWCASE ------------>
<form action="index.php?module=ProcessMaker&action=routeCase" method="POST">
{dotb_csrf_form_token}
    <input type="hidden" name="cas_id" id="cas_id" value="{$cas_id}"/>
    <input type="hidden" name="cas_index" id="cas_index" value="{$cas_index}"/>
    <input type="hidden" name="cas_current_user_id" id="cas_current_user_id" value="{$cas_current_user_id}"/>
    <input type="hidden" name="act_adhoc_behavior" id="act_adhoc_behavior" value="{$act_adhoc_behavior}"/>
    <input type="hidden" name="act_adhoc_assignment" id="act_adhoc_assignment" value="{$act_adhoc_assignment}"/>
<!---------------  END WORKFLOW SHOWCASE ------------>