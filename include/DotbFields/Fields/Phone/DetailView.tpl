{*

*}
{if !empty({{dotbvar key='value' string=true}})}
{assign var="phone_value" value={{dotbvar key='value' string=true}} }

{dotb_phone value=$phone_value usa_format="{{if !empty($vardef.validate_usa_format)}}1{{else}}0{{/if}}"}

{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}
{/if}