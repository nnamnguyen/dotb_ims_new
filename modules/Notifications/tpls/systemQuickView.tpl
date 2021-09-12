{*

*}

<div id="SpotResults">
    <ul>
        {foreach from=$data item=n}
            <li>{$n}</li>
        {foreachelse}
            <li>-None-</li>
        {/foreach}
    </ul>
</div>