{*

*}
<!-- BEGIN Labels Line -->
    <tr id="lineLabel_{$vardef.name}" name="lineLabel_{$vardef.name}">
        <td>
           {if empty($displayParams.hideNameLabel)}
           {ldelim}dotb_translate label='LBL_COLLECTION_NAME'{rdelim}:
           {/if}
        </td>
        {foreach item=extra_field from=$displayParams.collection_field_list key=key_extra}
        <td>
            {$extra_field.label}
            <script type="text/javascript">
                collection['{$vardef.name}'].extra_fields_count++;
            </script>
        </td>
        {/foreach}
        <td>

        </td>
        <td>

        </td>
        <td id="lineLabel_{$vardef.name}_primary" {if empty($values.role_field)}style="display:none"{/if}>
            {ldelim}dotb_translate label='LBL_COLLECTION_PRIMARY'{rdelim}
        </td>
<!-- BEGIN Add and collapse -->
        <td rowspan='1' valign='top'>
            &nbsp;&nbsp;<a class="utilsLink" href="javascript:collection['{$vardef.name}'].js_more();" id='more_{$vardef.name}' {if empty($values.secondaries)}style="display:none"{/if}>{dotb_getimage name="advanced_search" ext=".gif" width="8" height="8" alt=$app_strings.LBL_HIDE_SHOW other_attributes='border="0" id="more_img_{$vardef.name}" '}</a>
        </td>
<!-- END Add and collapse -->
    </tr>
<!-- END Labels Line -->
    <tr id="lineFields_{$vardef.name}_0" name="lineFields_{$vardef.name}_0" class="lineFields_{$vardef.name}">
        <td valign='top'>
            <input type="text" name="{$vardef.name}_collection_0" class="sqsEnabled {$displayParams.class}" tabindex="{$tabindex}" id="{$vardef.name}_collection_0" size="{$displayParams.size}" value="" title='{$vardef.help}' autocomplete="off" {$displayParams.readOnly} {$displayParams.field}>
            <input type="hidden" name="id_{$vardef.name}_collection_0" id="id_{$vardef.name}_collection_0" value="">
            {if $showSelectButton}
           		<input type="button" name="btn_{$vardef.name}_collection_0" tabindex="{$tabindex}" title="{dotb_translate label="{{$displayParams.accessKeySelectTitle}}" class="button" value="{dotb_translate label="{{$displayParams.accessKeySelectLabel}}" onclick='open_popup("{$module}", 600, 400, "", true, false, {$displayParams.popupData}, "single", true);'>
            {/if}
        </td>
        {foreach item=extra_field from=$displayParams.collection_field_list key=key_extra}
        <td class="td_extra_field" valign='top'>
            {$extra_field.field}
        </td>
        {/foreach}
