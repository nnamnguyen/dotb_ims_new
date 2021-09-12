{*

*}
{if !$displayParams.nolink}
<a href="index.php?module={$module}&action=DetailView&record={$values.primary.id}">
{/if}
{$values.primary.name}
{if !$displayParams.nolink}
</a>

{if !empty($values.secondaries)}
    <a href="javascript:collection['{$vardef.name}'].js_more_detail('{$values.primary.id}')" id='more_{$values.primary.id}' class="utilsLink">{dotb_getimage name="advanced_search" ext=".gif" width="8" height="8" alt=$app_strings.LBL_HIDE_SHOW other_attributes='border="0" id="more_img_{$values.primary.id}" '}</a>
    <div id='more_div_{$values.primary.id}' style="display:none">
    {foreach item=secondary_field from=$values.secondaries}
        <br><a href="index.php?module={$module}&action=DetailView&record={$secondary_field.id}">
        {$secondary_field.name}
        </a>
    {foreachelse}
    {/foreach}
    </div>
<script type="text/javascript" src='{dotb_getjspath file="include/DotbFields/Fields/Collection/DotbFieldCollection.js"}'></script>
<script type="text/javascript">
    var collection = (typeof collection == 'undefined') ? new Array() : collection;
    collection['{$vardef.name}'] = new DOTB.collection('{$displayParams.formName}', '{$vardef.name}', '{$module}', '{$displayParams.popupData}');
</script>
{/if}
{/if}