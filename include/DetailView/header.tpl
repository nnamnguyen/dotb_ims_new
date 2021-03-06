{*

*}
{{* Add the preForm code if it is defined (used for vcards) *}}
{{if $preForm}}
	{{$preForm}}
{{/if}}
<script type="text/javascript" src="{dotb_getjspath file='include/EditView/Panels.js'}"></script>
<script language="javascript">
{literal}
DOTB.util.doWhen(function(){
    return $("#contentTable").length == 0 && YAHOO.util.Event.DOMReady;
}, DOTB.themes.actionMenu);
{/literal}
</script>


<table cellpadding="0" cellspacing="0" border="0" width="100%" id="">
<tr>
<td class="buttons" align="left" NOWRAP width="80%">
<div class="actionsContainer">
{{if !isset($form.buttons)}}
    {{dotb_button module="$module" id="EDIT" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{dotb_button module="$module" id="DUPLICATE" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{dotb_button module="$module" id="DELETE" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
{{else}}
    {{counter assign="num_buttons" start=0 print=false}}
    {{foreach from=$form.buttons key=val item=button}}
        {{if !is_array($button) && in_array($button, $built_in_buttons)}}
        {{counter print=false}}
        {{dotb_button module="$module" id="$button" fields="$fields" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
        {{/if}}
    {{/foreach}}
    {{if count($form.buttons) > $num_buttons}}
        {{foreach from=$form.buttons key=val item=button}}
            {{if is_array($button) && $button.customCode}}
                {{dotb_button module="$module" id="$button" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
            {{/if}}
        {{/foreach}}
    {{/if}}
    {{dotb_button module="$module" id="PDFVIEW" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{dotb_button module="$module" id="PDFEMAIL" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
{{/if}}

{{if empty($form.hideAudit) || !$form.hideAudit}}
    {{dotb_button module="$module" id="Audit" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
{{/if}}

<form action="index.php" method="post" name="DetailView" id="formDetailView">
{dotb_csrf_form_token}
    <input type="hidden" name="module" value="{$module}">
    <input type="hidden" name="record" value="{$fields.id.value}">
    <input type="hidden" name="return_action">
    <input type="hidden" name="return_module">
    <input type="hidden" name="return_id">
    <input type="hidden" name="module_tab">
    <input type="hidden" name="isDuplicate" value="false">
    <input type="hidden" name="offset" value="{$offset}">
    <input type="hidden" name="action" value="EditView">
    <input type="hidden" name="dotb_body_only">
{{if isset($form.hidden)}}
{{foreach from=$form.hidden item=field}}
{{$field}}
{{/foreach}}
{{/if}}
</form>
{{dotb_action_menu id="detail_header_action_menu" buttons=$detail_header_buttons class="fancymenu" }}

</div>

</td>


<td align="right" width="20%">{$ADMIN_EDIT}
	{{if $panelCount == 0}}
	    {{* Render tag for VCR control if SHOW_VCR_CONTROL is true *}}
		{{if $SHOW_VCR_CONTROL}}
			{$PAGINATION}
		{{/if}}
		{{counter name="panelCount" print=false}}
	{{/if}}
</td>
{{* Add $form.links if they are defined *}}
{{if !empty($form) && isset($form.links)}}
	<td align="right" width="10%">&nbsp;</td>
	<td align="right" width="100%" NOWRAP class="buttons">
        <div class="actionsContainer">
            {{foreach from=$form.links item=link}}
                {{$link}}&nbsp;
            {{/foreach}}
        </div>
	</td>
{{/if}}
</tr>
</table>
