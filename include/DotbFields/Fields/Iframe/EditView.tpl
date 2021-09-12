{*

*}
{{if !$vardef.gen}}
	{if !empty({{dotbvar key='value' string=true}})}
	<input type='text' name='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' 
	   id='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' size='{{$displayParams.size|default:30}}' 
	   {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} value='{{dotbvar key='value'}}' title='{{$vardef.help}}' tabindex='{{$tabindex}}'  {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} >
	{else}
	<input type='text' name='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' 
	   id='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' size='{{$displayParams.size|default:30}}' 
	   {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{/if}} 
	   {if $displayView=='advanced_search'||$displayView=='basic_search'}value=''{else}value='http://'{/if} title='{{$vardef.help}}' tabindex='{{$tabindex}}' {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} >
	{/if}
{{/if}}