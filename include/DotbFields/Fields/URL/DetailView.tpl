{*

*}
{capture name=getLink assign=link}{{dotbvar key='value'}}{/capture}
{{if $vardef.gen}}
{dotb_replace_vars subject='{{$vardef.default|replace:'{':'['|replace:'}':']'}}' assign='link'}
{{/if}}
{if !empty($link)}
{capture name=getStart assign=linkStart}{$link|substr:0:7}{/capture}
<span class="dotb_field" id="{{dotbvar key='name'}}">
<a href='{$link|to_url}' {{if $displayParams.link_target}}target='{{$displayParams.link_target}}'{{elseif $vardef.link_target}}target='{{$vardef.link_target}}'{{/if}}>
{{if !empty($displayParams.title)}}{dotb_translate label='{{$displayParams.title}}' module=$module}{{else}}{$link}{{/if}}
</a>
</span>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}
{/if}
