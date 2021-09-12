{*

*}
<select name="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">
{{dotbvar key='value'}}
</select>