<!-- -->
{*

*}

<tr>
	<td class='mbLBL'>{dotb_translate label="LBL_CALCULATED"}:</td>
	<td>
		<input type="checkbox" name="calc_check" value="0" {if !empty($vardef.formula)}checked{/if} 
		onclick="toggleDisplay('{$vardef.name}_formula');toggleDisplay('{$vardef.name}_enforced');"/>
	</td>
</tr>
<tr id='{$vardef.name}_formula' {if empty($vardef.formula)}style='display:none'{/if} >
	<td class='mbLBL'>{dotb_translate label="LBL_FORMULA"}:</td>
	<td>
		<input id="formula" type="text" name="formula" value="{$vardef.formula|escape:'html'}" maxlength=255 />
         <input class="button" type=button name="editFormula" value="{dotb_translate label="LBL_BTN_EDIT_FORMULA"}" 
            onclick="ModuleBuilder.moduleLoadFormula(YAHOO.util.Dom.get('formula').value)"/>
    </td>
</tr>
<tr id='{$vardef.name}_enforced' {if empty($vardef.enforced)}style="display:none"{/if}><td class='mbLBL'>Enforced:</td>
    <td><input type="checkbox" name="enforced" id="enforced" value="1" onclick="ModuleBuilder.toggleEnforced();"{if !empty($vardef.enforced)}CHECKED{/if} {if $hideLevel > 5}disabled{/if}/>
        {if $hideLevel > 5}<input type="hidden" name="enforced" value="{$vardef.enforced}">{/if}
    </td>
</tr>
