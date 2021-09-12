{*

*}

{if !empty($vardef.value) && ($vardef.value != '^^')}
    <input type="hidden" class="dotb_field" id="{$vardef.name}" value="{$vardef.value}">
    {multienum_to_array string=$vardef.value assign="vals"}
    {foreach from=$vals item='item'}
    <li style="margin-left:10px;">{$vardef.options.$item}</li>
    {/foreach}
{/if}
