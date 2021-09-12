{*

*}
<script type="text/javascript" src='{dotb_getjspath file="include/DotbFields/Fields/Address/DotbFieldAddress.js"}'></script>
{{assign var="key" value=$displayParams.key|upper}}
{{assign var="street" value=$displayParams.key|cat:'_address_street'}}
{{assign var="city" value=$displayParams.key|cat:'_address_city'}}
{{assign var="state" value=$displayParams.key|cat:'_address_state'}}
{{assign var="country" value=$displayParams.key|cat:'_address_country'}}
{{assign var="postalcode" value=$displayParams.key|cat:'_address_postalcode'}}
<fieldset id='{{$key}}_address_fieldset'>
<legend>{dotb_translate label='LBL_{{$key}}_ADDRESS' module='{{$module}}'}</legend>
<table border="0" cellspacing="1" cellpadding="0" class="edit" width="100%">
<tr>
<td valign="top" id="{{$street}}_label" width='25%' scope='row' >
{dotb_translate label='LBL_STREET' module='{{$module}}'}:
{if $fields.{{$street}}.required || {{if $street|lower|in_array:$displayParams.required}}true{{else}}false{{/if}}}
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span>
{/if}
</td>
<td width="*">
{{if $displayParams.maxlength}}
<textarea id="{{$street}}" name="{{$street}}" maxlength="{{$displayParams.maxlength}}" rows="{{$displayParams.rows|default:4}}" cols="{{$displayParams.cols|default:60}}" tabindex="{{$tabindex}}">{$fields.{{$street}}.value}</textarea>
{{else}}
<textarea id="{{$street}}" name="{{$street}}" rows="{{$displayParams.rows|default:4}}" cols="{{$displayParams.cols|default:60}}" tabindex="{{$tabindex}}">{$fields.{{$street}}.value}</textarea>
{{/if}}
</td>
</tr>

<tr>

<td id="{{$city}}_label" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' scope='row' >
{dotb_translate label='LBL_CITY' module='{{$module}}'}:
{if $fields.{{$city}}.required || {{if $city|lower|in_array:$displayParams.required}}true{{else}}false{{/if}}}
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span>
{/if}
</td>
<td>
<input type="text" name="{{$city}}" id="{{$city}}" size="{{$displayParams.size|default:30}}" {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{$fields.{{$city}}.value}' tabindex="{{$tabindex}}">
</td>
</tr>

<tr>
<td id="{{$state}}_label" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' scope='row' >
{dotb_translate label='LBL_STATE' module='{{$module}}'}:
{if $fields.{{$state}}.required || {{if $state|lower|in_array:$displayParams.required}}true{{else}}false{{/if}}}
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span>
{/if}
</td>
<td>
<input type="text" name="{{$state}}" id="{{$state}}" size="{{$displayParams.size|default:30}}" {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{$fields.{{$state}}.value}' tabindex="{{$tabindex}}">
</td>
</tr>

<tr>

<td id="{{$postalcode}}_label" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' scope='row' >

{dotb_translate label='LBL_POSTAL_CODE' module='{{$module}}'}:
{if $fields.{{$postalcode}}.required || {{if $postalcode|lower|in_array:$displayParams.required}}true{{else}}false{{/if}}}
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span>
{/if}
</td>
<td>
<input type="text" name="{{$postalcode}}" id="{{$postalcode}}" size="{{$displayParams.size|default:30}}" {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{$fields.{{$postalcode}}.value}' tabindex="{{$tabindex}}">
</td>
</tr>

<tr>

<td id="{{$country}}_label" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' scope='row' >

{dotb_translate label='LBL_COUNTRY' module='{{$module}}'}:
{if $fields.{{$country}}.required || {{if $country|lower|in_array:$displayParams.required}}true{{else}}false{{/if}}}
<span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span>
{/if}
</td>
<td>
<input type="text" name="{{$country}}" id="{{$country}}" size="{{$displayParams.size|default:30}}" {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{$fields.{{$country}}.value}' tabindex="{{$tabindex}}">
</td>
</tr>

{{if $displayParams.copy}}
<tr>
<td scope='row' NOWRAP>
{dotb_translate label='LBL_COPY_ADDRESS_FROM_LEFT' module=''}:
</td>
<td>
<input id="{{$displayParams.key}}_checkbox" name="{{$displayParams.key}}_checkbox" type="checkbox" onclick="{{$displayParams.key}}_address.syncFields();">
</td>
</tr>
{{else}}
<tr>
<td colspan='2' NOWRAP>&nbsp;</td>
</tr>
{{/if}}
</table>
</fieldset>
<script type="text/javascript">
    DOTB.util.doWhen("typeof(DOTB.AddressField) != 'undefined'", function(){ldelim}
		{{$displayParams.key}}_address = new DOTB.AddressField("{{$displayParams.key}}_checkbox",'{{$displayParams.copy}}', '{{$displayParams.key}}');
	{rdelim});
</script>
