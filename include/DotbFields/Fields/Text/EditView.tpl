{*

*}
{if empty({{dotbvar key='value' string=true}})}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}  


{{capture name=idname assign=idname}}{{dotbvar key='name'}}{{/capture}}
{{if !empty($displayParams.idName)}}
    {{assign var=idname value=$displayParams.idName}}
{{/if}}


<textarea  id='{{$idname}}' name='{{$idname}}'
rows="{{if !empty($displayParams.rows)}}{{$displayParams.rows}}{{elseif !empty($vardef.rows)}}{{$vardef.rows}}{{else}}{{4}}{{/if}}" 
cols="{{if !empty($displayParams.cols)}}{{$displayParams.cols}}{{elseif !empty($vardef.cols)}}{{$vardef.cols}}{{else}}{{60}}{{/if}}" 
title='{{$vardef.help}}' tabindex="{{$tabindex}}" {{$displayParams.field}}
{{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} >{$value}</textarea>



