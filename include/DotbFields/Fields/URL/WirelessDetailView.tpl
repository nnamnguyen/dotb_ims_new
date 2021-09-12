{*
{*

*}
{if !empty($vardef.value)}
{capture name=getStart assign=linkStart}{$vardef.value|substr:0:7}{/capture}
<a href='{if $linkStart != 'http://'}http://{/if}{$vardef.value}'>{$vardef.value}</a>
{/if}