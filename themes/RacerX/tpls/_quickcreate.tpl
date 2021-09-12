{*

*}

<div id="quickCreate">
<ul class="clickMenu" id="quickCreateUL">
    <li>
        <ul class="subnav iefixed showLess" id="quickCreateULSubnav">
            {foreach from=$DCACTIONS item=action name=quickCreate}
                <li {if $smarty.foreach.quickCreate.index > 4}class="moreOverflow"{/if}><a href="javascript: if ( DCMenu.menu ) DCMenu.menu('{$action.module}','{$action.createRecordTitle}', true);" id="{$action.module}_quickcreate">{$action.createRecordTitle}</a></li>

            {/foreach}

            {if count($DCACTIONS) > 4}
                <li class="moduleMenuOverFlowMore"><a href="javascript: DOTB.themes.toggleQuickCreateOverFlow('quickCreateULSubnav','more');">{$APP.LBL_SHOW_MORE} <div class="showMoreArrow"></div></a></li>
                <li class="moduleMenuOverFlowLess"><a href="javascript: DOTB.themes.toggleQuickCreateOverFlow('quickCreateULSubnav','less');">{$APP.LBL_SHOW_LESS} <div class="showLessArrow"></div></a></li>
            {/if}
        </ul>
    </li>
</ul>
</div>
