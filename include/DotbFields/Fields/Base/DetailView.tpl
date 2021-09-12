{*

*}
{if strlen({{dotbvar key='value' string=true}}) <= 0}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if} 
<span class="dotb_field" id="{{dotbvar key='name'}}">{{dotbvar key='value'}}</span>
{{if !empty($displayParams.enableConnectors)}}
{if !empty($value)}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}