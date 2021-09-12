{*

*}
<span id='{{dotbvar key='name'}}'>
{dotb_number_format var={{dotbvar key='value' stringFormat='false'}} }
</span>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}