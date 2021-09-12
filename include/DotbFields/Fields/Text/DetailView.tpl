{*

*}
<span class="dotb_field" id="{{dotbvar key='name'}}">{{if empty($displayParams.textonly)}}{{dotbvar key='value' htmlentitydecode='true'}}{{else}}{{dotbvar key='value'}}{{/if}}</span>
{{if !empty($displayParams.enableConnectors)}}
{assign var="value" value={{dotbvar key='value' string='true'}} }
{if !empty($value)}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}
