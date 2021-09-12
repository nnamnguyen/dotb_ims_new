{*

*}
<input type='password' id='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' 
name='{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}' 
size='{{$displayParams.size|default:30}}' value='{{dotbvar key='value'}}' title='{{$vardef.help}}' tabindex='{{$tabindex}}'	{{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}} >
