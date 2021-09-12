{*

*}

{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
{if $range_search_option_enabled}
<tr>	
    <td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_ENABLE_RANGE_SEARCH"}:</td>
    <td>
        <input type='checkbox' name='enable_range_search' value=1 {if !empty($vardef.enable_range_search) }checked{/if} {if $hideLevel > 5}disabled{/if} />
        {if $hideLevel > 5}<input type='hidden' name='enable_range_search' value='{$vardef.enable_range_search}'>{/if}
    </td>	
</tr>
{/if}
<tr><td class='mbLBL'>{dotb_translate module="DynamicFields" label="COLUMN_TITLE_DEFAULT_VALUE"}:</td><td>
{if $hideLevel < 5}
<input type='text' id='default' name='default' value='{dotb_currency_format var=$vardef.default currency_symbol=false}'>
<script>
addToValidate('popup_form', 'default', 'float', false,'{dotb_translate module="DynamicFields" label="COLUMN_TITLE_DEFAULT_VALUE"}' );
</script>
{else}
<input type='hidden' name='default' value='{dotb_currency_format var=$vardef.default currency_symbol=false}'>{dotb_currency_format var=$vardef.default}
{/if}
</td></tr>{include file="modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl"}
