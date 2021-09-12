{*

*}

<div id="SpotResults">
    <div>{$APP.LBL_NOTIFICATIONS}</div>
    <ul>
        {foreach from=$data item=n}
            <li><a href='javascript:void(0)' onclick="DCMenu.viewMiniNotification('{$n->id}');">{$n->name}</li>
        {foreachelse}
            <li>-None-</li>
        {/foreach}
    </ul>
</div>