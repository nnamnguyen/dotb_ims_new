{*

*}
{if strval({{dotbvar key='value' stringFormat='false'}}) == "1" || strval({{dotbvar key='value' stringFormat='false'}}) == "yes" || strval({{dotbvar key='value' stringFormat='false'}}) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" value="0"> 
<input type="checkbox" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" 
value="1" title='{{$vardef.help}}' tabindex="{{$tabindex}}" {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}
{$checked} {{$displayParams.field}}>
