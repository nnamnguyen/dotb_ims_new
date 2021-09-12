{*

*}
{{if !$nolink && !empty($vardef.id_name)}} 
{if !empty({{dotbvar memberName='vardef.id_name' key='value' string='true'}})}
{capture assign="detail_url"}index.php?module={{$vardef.module}}&action=DetailView&record={{dotbvar  memberName='vardef.id_name' key='value'}}{/capture}
<a href="{dotb_ajax_url url=$detail_url}">{/if}
{{/if}}
<span id="{{$vardef.id_name}}" class="dotb_field" data-id-value="{{dotbvar memberName='vardef.id_name' key='value'}}">{{dotbvar key='value'}}</span>
{{if !$nolink && !empty($vardef.id_name)}}
{if !empty({{dotbvar memberName='vardef.id_name' key='value' string='true'}})}</a>{/if}
{{/if}}
{{if !empty($displayParams.enableConnectors) && !empty($vardef.id_name)}}
{if !empty({{dotbvar memberName='vardef.id_name' key='value' string='true'}})}
{{dotbvar_connector view='DetailView'}} 
{/if}
{{/if}}
