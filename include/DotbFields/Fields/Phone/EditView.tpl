{*

*}
{{capture name=idname assign=idname}}{{dotbvar key='name'}}{{/capture}}
{{if !empty($displayParams.idName)}}
   {{assign var=idname value=$displayParams.idName}}
{{/if}}

{if strlen({{dotbvar key='value' string=true}}) <= 0}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}  

<input type='text' name='{{$idname}}' id='{{$idname}}' size='{{$displayParams.size|default:30}}' {{if isset($displayParams.maxlength)}}maxlength='{{$displayParams.maxlength}}'{{elseif isset($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{$value}' title='{{$vardef.help}}' tabindex='{{$tabindex}}'	{{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}  class="phone" {{$displayParams.field}}>

