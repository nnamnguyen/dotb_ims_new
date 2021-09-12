{*

*}

<div class="ftsModuleFilterSpan">
    {if empty($moduleFilter)}
        <input type="checkbox" checked="checked" id="all" name="module_filter" class="ftsModuleFilter">
        <span id="all_label" class="checked">&nbsp;{$APP.LBL_EMAIL_SHOW_READ}</span>
    {else}
        <input type="checkbox" id="all" name="module_filter" class="ftsModuleFilter">
        <span id="all_label" class="unchecked">&nbsp;{$APP.LBL_EMAIL_SHOW_READ}</span>
    {/if}
</div>
{foreach from=$filterModules item=entry key=module}
    <div class="ftsModuleFilterSpan">
        {if is_array($moduleFilter) && in_array($entry.module, $moduleFilter)}
            <input type="checkbox" checked="checked" id="{$entry.module}" name="module_filter" class="ftsModuleFilter">
            <span id="{$entry.module}_label" class="checked">&nbsp;{$entry.label}</span>
            <span id="{$entry.module}_count" class="checked">{if is_int($entry.count)}({$entry.count}){/if}</span>
        {else}
            <input type="checkbox" id="{$entry.module}" name="module_filter" class="ftsModuleFilter">
            <span id="{$entry.module}_label" class="unchecked">&nbsp;{$entry.label}</span>
            <span id="{$entry.module}_count" class="unchecked">{if is_int($entry.count) }({$entry.count}){/if}</span>
        {/if}
    </div>
{/foreach}
