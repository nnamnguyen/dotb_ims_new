{*

*}
<span class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">
{ {{dotbvar  key='options' string=true}}[{{dotbvar key='value' string=true}}]}
</span>
{{if !empty($displayParams.enableConnectors)}}
{if !empty({{dotbvar  key='options' string=true}}[{{dotbvar key='value' string=true}}])}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}