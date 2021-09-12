{*

*}
<input type="hidden" class="dotb_field" id="{{dotbvar key='name'}}" value="{{dotbvar key='value' string=true}}">
{if isset($displayParams.link)}
<a href='{{$displayParams.link}}'>
{else}
<a href="javascript:DOTB.image.lightbox(YAHOO.util.Dom.get('img_{{dotbvar key='name'}}').src)">
{/if}
<img
	id="img_{{dotbvar key='name'}}" 
	name="img_{{dotbvar key='name'}}" 
	{{if !empty($vardef.calculated)}}
	   src='{{dotbvar key='value'}}'
	{{else}}
	{if empty({{dotbvar key='value' string=true}})}
	   src='' 	
	{else}
	   src='index.php?entryPoint=download&id={{dotbvar key='value'}}&type=DotbFieldImage&isTempFile=1'
	{/if}
	{{/if}}
	style='
		{if empty({{dotbvar key='value' string=true}})}
			display:	none;
		{/if}
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
		'		
>
</a>
