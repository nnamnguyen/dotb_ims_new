{*

*}
<a href="index.php?entryPoint=download&id={$parentFieldArray.ID}&type={$displayParams.module}{$vardef.displayParams.module}" class="tabDetailViewDFLink" target='_blank'>{dotb_fetch object=$parentFieldArray key=$col}
{if isset($vardef.allowEapm) && $vardef.allowEapm && isset($parentFieldArray.DOC_TYPE) }
{capture name=imageNameCapture assign=imageName}
{dotb_fetch object=$parentFieldArray key=DOC_TYPE}_image_inline.png
{/capture}
{capture name=imageURLCapture assign=imageURL}
{dotb_getimagepath file=$imageName}
{/capture}
{if strlen($imageURL)>1}{dotb_getimage name=$imageName alt=$imageName other_attributes='border="0" '}{/if}
{/if}
</a>