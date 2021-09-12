{*

*}
<span class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">
{dotb_number_format var={{dotbvar key='value' stringFormat='false'}} {{if isset($vardef.precision)}}precision={{$vardef.precision}}{{/if}} }
</span>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}} 
{{/if}}