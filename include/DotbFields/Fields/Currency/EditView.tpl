{*

*}
{if strlen({{dotbvar key='value' string=true}}) <= 0}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}  
<input type='text' name='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' 
id='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' size='{{$displayParams.size|default:30}}' {{if isset($displayParams.maxlength)}}maxlength='{{$displayParams.maxlength}}'{{elseif isset($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{dotb_number_format var=$value}' title='{{$vardef.help}}' tabindex='{{$tabindex}}'
{{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} {{$displayParams.field}}>
