{*

*}
<select name='{{$vardef.type_name}}' {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  id='{{$vardef.type_name}}' title='{{$vardef.help}}'
onchange='document.{{$form_name}}.{{dotbvar key='name'}}.value="";document.{{$form_name}}.parent_id.value=""; 
        changeParentQSSearchView("{{dotbvar key='name'}}"); checkParentType(document.{{$form_name}}.{{$vardef.type_name}}.value, document.{{$form_name}}.btn_{{dotbvar key='name'}});'>
{html_options options={{dotbvar key='options' string=true}} selected=$fields.{{$vardef.type_name}}.value}
</select>
<br>
{if empty({{dotbvar key='options' string=true}}[$fields.{{$vardef.type_name}}.value])}
	{assign var="keepParent" value = 0}
{else}
	{assign var="keepParent value = 1}
{/if}
<input type="text" name="{{dotbvar key='name'}}" id="{{dotbvar key='name'}}" class="sqsEnabled" {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  size="{{$displayParams.size}}" value="{{dotbvar key='value'}}" autocomplete="off"><input type="hidden" name="{{$vardef.id_name}}" id="{{$vardef.id_name}}"  {if $keepParent}value="{{dotbvar memberName='vardef.id_name' key='value'}}"{/if}>
<span class="id-ff multiple">
<button type="button" name="btn_{{dotbvar key='name'}}" {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  title="{$APP.LBL_SELECT_BUTTON_TITLE}"
	   class="button{{if empty($displayParams.selectOnly)}} firstChild{{/if}}" value="{$APP.LBL_SELECT_BUTTON_LABEL}"
	   onclick='if(document.{{$form_name}}.{{$vardef.type_name}}.value != "") open_popup(document.{{$form_name}}.{{$vardef.type_name}}.value, 600, 400, "", true, false, {{$displayParams.popupData}}, "single", true);'>{dotb_getimage alt=$app_strings.LBL_ID_FF_SELECT name="id-ff-select" ext=".png" other_attributes=''}</button>
{{if empty($displayParams.selectOnly)}}
<button type="button" name="btn_clr_{{dotbvar key='name'}}" {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  title="{$APP.LBL_CLEAR_BUTTON_TITLE}"  class="button lastChild" onclick="this.form.{{dotbvar key='name'}}.value = ''; this.form.{{dotbvar key='id_name'}}.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
{dotb_getimage alt=$app_strings.LBL_ID_FF_CLEAR name="id-ff-clear" ext=".png" other_attributes=''}
</button>
{{/if}}
</span>
{literal}
<script type="text/javascript">
if (typeof(changeParentQSSearchView) == 'undefined'){
function changeParentQSSearchView(field) {
    if (typeof sqs_objects == 'undefined') {
       return;
    }
	field = YAHOO.util.Dom.get(field);
    var form = field.form;
    var sqsId = form.id + "_" + field.id;
    if (typeof sqs_objects[sqsId] == 'undefined'){
        return;
    }
    var typeField =  form.elements["{{$vardef.type_name}}"];
    var new_module = typeField.value;
    if(typeof(disabledModules[new_module]) != 'undefined') {
		sqs_objects[sqsId]["disable"] = true;
		field.readOnly = true;
	} else {
		sqs_objects[sqsId]["disable"] = false;
		field.readOnly = false;
    }
	//Update the SQS globals to reflect the new module choice
    sqs_objects[sqsId]["modules"] = new Array(new_module);
    if (typeof(QSFieldsArray[sqsId]) != 'undefined')
    {
        QSFieldsArray[sqsId].sqs.modules = new Array(new_module);
    }
	if(typeof QSProcessedFieldsArray != 'undefined')
    {
	   QSProcessedFieldsArray[sqsId] = false;
    }
    enableQS(false);
}}
YAHOO.util.Event.onContentReady(
{/literal}
"{{dotbvar key='name'}}"
{literal}
, function() {
    changeParentQSSearchView(
{/literal}
"{{dotbvar key='name'}}"
{literal}
    );
});
</script>
{{$displayParams.disabled_parent_types}}
{/literal}