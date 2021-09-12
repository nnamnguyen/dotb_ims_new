{*

*}
<span class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">
<a href="index.php?entryPoint=download&id={$fields.{{$vardef.fileId}}.value}&type={{$vardef.linkModule}}" class="tabDetailViewDFLink" target='_blank'>{{dotbvar key='value'}}</a>
</span>
{{if isset($vardef) && isset($vardef.allowEapm) && $vardef.allowEapm}}
{if isset($fields.{{$vardef.docType}}) && !empty($fields.{{$vardef.docType}}.value) && $fields.{{$vardef.docType}}.value != 'DotbCRM' && !empty($fields.{{$vardef.docUrl}}.value) }
{capture name=imageNameCapture assign=imageName}
{$fields.{{$vardef.docType}}.value}_image_inline.png
{/capture}
<a href="{$fields.{{$vardef.docUrl}}.value}" class="tabDetailViewDFLink" target="_blank">{dotb_getimage name=$imageName alt=$imageName other_attributes='border="0" '}</a>
{/if}
{{/if}}
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}
