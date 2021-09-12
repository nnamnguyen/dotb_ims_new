{*

*}

{multienum_to_array string=$vardef.value default=$vardef.default assign="values"}
<select id="{$vardef.name}" name="{$vardef.name}[]" multiple="true">
    {html_options options=$vardef.options selected=$values}
</select>
