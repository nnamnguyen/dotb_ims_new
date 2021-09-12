{*

*}
<span class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">
<a href="index.php?entryPoint=download&id={{$vardef.value}}&type={$module}">{$fields.filename.value}</a>
</span>
{{if !empty($displayParams.enableConnectors)}}
{if !empty($fields.filename.value)}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}

