{*

*}
<select name='parent_type' tabindex="{{$tabindex}}" id='parent_type' title='{{$vardef.help}}'  {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}
onchange='document.{$form_name}.{{dotbvar key='name'}}.value="";document.{$form_name}.parent_id.value=""; changeParentQS("{{dotbvar key='name'}}"); checkParentType(document.{$form_name}.parent_type.value, document.{$form_name}.btn_{{dotbvar key='name'}});'>
{html_options options={{dotbvar key='options' string=true}} selected=$fields.parent_type.value sortoptions=true}
</select>

{{if $displayParams.split}}
<br>
{{/if}}
{if empty({{dotbvar key='options' string=true}}[$fields.parent_type.value])}
	{assign var="keepParent" value = 0}
{else}
	{assign var="keepParent" value = 1}
{/if}
<input type="text" name="{{dotbvar key='name'}}" id="{{dotbvar key='name'}}" class="sqsEnabled" tabindex="{{$tabindex}}"
    size="{{$displayParams.size}}" {if $keepParent}value="{{dotbvar key='value'}}"{/if} autocomplete="off"><input type="hidden" name="{{dotbvar memberName='vardef.id_name' key='name'}}" id="{{dotbvar memberName='vardef.id_name' key='name'}}"  
{if $keepParent}value="{{dotbvar memberName='vardef.id_name' key='value'}}"{/if}>
<span class="id-ff multiple">
<button type="button" name="btn_{{dotbvar key='name'}}" id="btn_{{dotbvar key='name'}}" tabindex="{{$tabindex}}"	
title="{dotb_translate label="{{$displayParams.accessKeySelectTitle}}"}" class="button firstChild" value="{dotb_translate label="{{$displayParams.accessKeySelectLabel}}"}"
onclick='open_popup(document.{$form_name}.parent_type.value, 600, 400, "", true, false, {{$displayParams.popupData}}, "single", true);' {{if isset($displayParams.javascript.btn)}}{{$displayParams.javascript.btn}}{{/if}}><img src="{dotb_getimagepath file="id-ff-select.png"}"></button>{{if empty($displayParams.selectOnly)}}<button type="button" name="btn_clr_{{dotbvar key='name'}}" id="btn_clr_{{dotbvar key='name'}}" tabindex="{{$tabindex}}" title="{dotb_translate label="{{$displayParams.accessKeyClearTitle}}"}" class="button lastChild" onclick="this.form.{{dotbvar key='name'}}.value = ''; this.form.{{dotbvar memberName='vardef.id_name' key='name'}}.value = '';" value="{dotb_translate label="{{$displayParams.accessKeyClearLabel}}"}" {{if isset($displayParams.javascript.btn_clear)}}{{$displayParams.javascript.btn_clear}}{{/if}}><img src="{dotb_getimagepath file="id-ff-clear.png"}"></button>
</span>
{{/if}}

{literal}
<script type="text/javascript">
if (typeof(changeParentQS) == 'undefined'){
function changeParentQS(field) {
    if(typeof sqs_objects == 'undefined') {
       return;
    }
	field = YAHOO.util.Dom.get(field);
    var form = field.form;
    var sqsId = form.id + "_" + field.id;
    if(sqs_objects[sqsId] == undefined){
    	return;
    }
    var typeField =  form.elements.parent_type;
    var new_module = typeField.value;
    if(typeof(disabledModules) != 'undefined' && typeof(disabledModules[new_module]) != 'undefined') {
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
//change this in case it wasn't the default on editing existing items.
$(document).ready(function(){
	changeParentQS("parent_name")
});
</script>
{{$displayParams.disabled_parent_types}}
{{$quickSearchCode}}
{/literal}