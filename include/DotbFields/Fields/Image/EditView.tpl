{*

*}
{if empty({{dotbvar key='value' string=true}})}
{assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
{assign var="value" value={{dotbvar key='value' string=true}} }
{/if}  

{{capture name=idname assign=idname}}{{dotbvar key='name'}}{{/capture}}
{{if !empty($displayParams.idName)}}
    {{assign var=idname value=$displayParams.idName}}
{{/if}}

{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" id="{{$idname}}_duplicate" name="{{$idname}}_duplicate" value="{$value}"/>
{/if}

<input 
	type="file" id="{{$idname}}" name="{{$idname}}" 
	title="" size="30" maxlength="255" value="" tabindex="{{$tabindex}}"
	onchange="DOTB.image.confirm_imagefile('{{$idname}}');" 
	class="imageUploader"
	{if !empty({{dotbvar key='value' string=true}}) {{if !empty($vardef.calculated)}}|| true{{/if}} }
	style="display:none"
	{/if}  {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}
/>

{if empty({{dotbvar key='value' string=true}}) {{if !empty($vardef.calculated)}}&& false{{/if}}}
{else}
<a href="javascript:DOTB.image.lightbox(Dom.get('img_{{$idname}}').src)">
<img
	id="img_{{$idname}}" 
	name="img_{{$idname}}" 	
	{{if empty($vardef.calculated)}}
	   src='index.php?entryPoint=download&id={{dotbvar key='value'}}&type=DotbFieldImage&isTempFile=1'
	{{else}}
	   src='{{dotbvar key='value'}}'
	{{/if}}
	style='
		{if "{{$vardef.border}}" eq ""}
			border: 0; 
		{else}
			border: 1px solid black; 
		{/if}
		{if "{{$vardef.width}}" eq ""}
			width: auto;
		{else}
			width: {{$vardef.width}}px;
		{/if}
		{if "{{$vardef.height}}" eq ""}
			height: auto;
		{else}
			height: {{$vardef.height}}px;
		{/if}
		{if empty({{dotbvar key='value' string=true}})} 
		  visibility:hidden;
		{/if}
		'	

></a>
{{if empty($vardef.calculated)}}
<img
	id="bt_remove_{{$idname}}" 
	name="bt_remvoe_{{$idname}}" 
	alt="{dotb_translate label='LBL_REMOVE'}"
	title="{dotb_translate label='LBL_REMOVE'}"
	src="{dotb_getimagepath file='delete_inline.gif'}"
	onclick="DOTB.image.remove_upload_imagefile('{{$idname}}');" 	
	/>

<input 
	id="remove_imagefile_{{$idname}}" name="remove_imagefile_{{$idname}}" 
	type="hidden"  value="" />
{{/if}}
{/if}