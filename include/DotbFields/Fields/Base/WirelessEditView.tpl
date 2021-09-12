{*

*}
<input type='text' name='{$vardef.name}' id='{$vardef.name}' size='{$displayParams.size|default:20}' {if !empty($vardef.len)}maxlength='{$vardef.len}'{elseif !empty($displayParams.maxlength)}maxlength='{$displayParams.maxlength}'{/if} value='{$vardef.value}' title='{$vardef.help}' {if !empty($vardef.readOnly) || !empty($displayParams.readOnly)}readonly="1"{/if} {$displayParams.field}> 