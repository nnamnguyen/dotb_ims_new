{*

*}
{if !empty($parentFieldArray.$col)}
{if !empty($vardef.calculated)}
<a href="javascript:DOTB.image.lightbox('{$parentFieldArray.$col}')">
<img src='{$parentFieldArray.$col}' style='height: 64px;'>
{else}
<a href="javascript:DOTB.image.lightbox('index.php?entryPoint=download&id={$parentFieldArray.$col}&type=DotbFieldImage&isTempFile=1')">
<img src='index.php?entryPoint=download&id={$parentFieldArray.$col}&type=DotbFieldImage&isTempFile=1'
    style='height: 64px;'>
{/if}

{/if}
