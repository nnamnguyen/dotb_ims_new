{*

*}
{{if !$nolink}}
<input type="hidden" class="dotb_field" id="{{dotbvar key='name'}}" value="{{dotbvar key='value'}}">
<input type="hidden" class="dotb_field" id="{{$vardef.id_name}}" value="{{dotbvar key='value' memberName='vardef.id_name'}}">
<a href="index.php?module={{dotbvar objectName='fields' memberName='vardef.type_name' key='value'}}&action=DetailView&record={{dotbvar key='value' memberName='vardef.id_name'}}" class="tabDetailViewDFLink">{{/if}}{{dotbvar key='value'}}{{if !$nolink}}</a>
{{/if}}
{{if !empty($displayParams.enableConnectors)}}
{if !empty({{dotbvar key='value'}})}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}