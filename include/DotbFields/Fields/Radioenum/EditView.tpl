{*

*}
{if empty({{dotbvar key='value' string=true}})}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}
{capture name=idname assign=idname}{{dotbvar key='name'}}{/capture}
{{if !empty($displayParams.idName)}}
    {assign var=idname value=$displayParams.idName}
{{/if}}

{if isset({{dotbvar key='value' string=true}}) && {{dotbvar key='value' string=true}} != ''}
	{html_radios id="$idname" {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}   name="$idname" title="{{$vardef.help}}" options={{dotbvar key='options' string=true}} selected={{dotbvar key='value' string=true}} separator="{{$vardef.separator}}"}
{else}
	{html_radios id="$idname" {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}  name="$idname" title="{{$vardef.help}}" options={{dotbvar key='options' string=true}} selected={{dotbvar key='default' string=true}} separator="{{$vardef.separator}}"}
{/if}