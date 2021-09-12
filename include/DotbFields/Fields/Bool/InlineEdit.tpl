{*

*}
{{assign var=fieldName value=$vardef.name}}
{{if strval($parentFieldArray->$fieldName) == "1"}}
{{assign var="checked" value="CHECKED"}}
{{else}}
{{assign var="checked" value=""}}
{{/if}}
<input type="hidden" name="{{$fieldName}}" value="0">
<input type="checkbox" class="checkbox" name="{{$fieldName}}" {{$checked}} onblur='InlineEditor.save()'>