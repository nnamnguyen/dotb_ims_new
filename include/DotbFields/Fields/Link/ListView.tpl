{*

*}
{capture name=getLink assign=link}{dotb_fetch object=$parentFieldArray key=$col}{/capture}
{if $vardef.gen && $vardef.default}
    {capture name=getDefault assign=default}{if is_string($vardef.default)}{$vardef.default}{else}{$link}{/if}{/capture}
    {dotb_replace_vars subject=$default use_curly=true assign='link' fields=$parentFieldArray}
{/if}

<a href="{$link|to_url}" {if $displayParams.link_target}target='{$displayParams.link_target}'{elseif $vardef.link_target}target='{$vardef.link_target}'{/if}>{$link}</a>
