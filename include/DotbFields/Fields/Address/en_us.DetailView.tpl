{*

*}
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td width='99%'>
<input type="hidden" class="dotb_field" id="{{$displayParams.key}}_address_street" value="{$fields.{{$displayParams.key}}_address_street.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="dotb_field" id="{{$displayParams.key}}_address_city" value="{$fields.{{$displayParams.key}}_address_city.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="dotb_field" id="{{$displayParams.key}}_address_state" value="{$fields.{{$displayParams.key}}_address_state.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="dotb_field" id="{{$displayParams.key}}_address_country" value="{$fields.{{$displayParams.key}}_address_country.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
<input type="hidden" class="dotb_field" id="{{$displayParams.key}}_address_postalcode" value="{$fields.{{$displayParams.key}}_address_postalcode.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}">
{$fields.{{$displayParams.key}}_address_street.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}<br>
{$fields.{{$displayParams.key}}_address_city.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br} {$fields.{{$displayParams.key}}_address_state.value|escape:'htmlentitydecode'|strip_tags|url2html|nl2br}&nbsp;&nbsp;{$fields.{{$displayParams.key}}_address_postalcode.value|escape:'htmlentitydecode'|strip_tags|url2html|nl2br}<br>
{$fields.{{$displayParams.key}}_address_country.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}
</td>
{{if !empty($displayParams.enableConnectors)}}
<td class="dataField">
{{dotbvar_connector view='DetailView'}} 
</td>
{{/if}}
<td class='dataField' width='1%'>
{{* 
This is custom code that you may set to show on the second column of the address
table.  An example would be the "Copy" button present from the Accounts detailview.
See modules/Accounts/views/view.detail.php to see the value being set 
*}}
{$custom_code_{{$displayParams.key}}}
</td>
</tr>
</table>