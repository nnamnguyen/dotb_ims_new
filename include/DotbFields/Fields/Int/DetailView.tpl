{*

*}
<span class="dotb_field" id="{{dotbvar key='name'}}">
{{if $vardef.disable_num_format}}
{assign var="value" value={{dotbvar key='value' string=true}} }
{$value}
{{else}}
{dotb_number_format precision=0 var={{dotbvar key='value' stringFormat='false'}}}
{{/if}}
</span>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}} 
{{/if}}
