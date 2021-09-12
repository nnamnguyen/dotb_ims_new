{*

*}
{{assign var=fieldName value=$vardef.name}}
<input type='text' name='{{$fieldName}}' value='{{$parentFieldArray->$fieldName}}' onblur='InlineEditor.save()' size='40'>