<div class="dashletPanelMenu wizard" style="background-color: #fff;box-shadow: none;border: none;">
    {literal}
        <style>
            ul.admin-grid-icon {
                list-style-type: none;
                padding: 0;
                margin: 10px;
                display: inline-block;
            }

            .admin-grid-icon li {
                text-align: center;
                vertical-align: middle;
                display: inline-block;
                width: 100px;
                height: 95px;
                padding: 5px;
                border: solid 1px #ccc;
                line-height: 1.4;
                border-radius: 2px;
                margin-bottom: 5px;
                margin-top:5px;
            }

            .admin-grid-icon li:hover {
                border: solid 1px #000;
            }

            .admin-grid-icon li:hover>a{
                color:#000 !important;
            }

            .admin-grid-icon a {
                display: grid;
                text-decoration: none;
                vertical-align: middle;
                padding-top: 0;
                font-family: 'SFUIText', sans-serif;
                line-height: 14px;
                color: #535353 !important;
                height:90px
            }

            .admin-grid-icon a:link {
                text-decoration: none;
            }

            li > a > i.fa,
            li > a > i.fab,
            li > a > i.fad,
            li > a > i.fal,
            li > a > i.far,
            li > a > i.fas{
                font-size: 40px;
            }
        </style>
    {/literal}

    {foreach  from=$ADMIN_GROUP_HEADER key=j item=val1}
        <hr style="background:none;color:#ccc"/>
        <h2 style="color:#535353;margin-left:15px;">
            {if isset($GROUP_HEADER[$j][1])}
                {$GROUP_HEADER[$j][0]}{$GROUP_HEADER[$j][1]}
            {else}
                {$GROUP_HEADER[$j][0]}{$GROUP_HEADER[$j][2]}
            {/if}
        </h2>
        <ul class="admin-grid-icon">
            {assign var='i' value=0}
            {foreach  from=$VALUES_3_TAB[$j] key=link_idx item=admin_option}
                {if isset($COLNUM[$j][$i])}
                    <li><a href='{$ITEM_URL[$j][$i]}' target='{$ITEM_TARGET[$j][$i]}'>{$ITEM_HEADER_IMAGE[$j][$i]}{$ITEM_HEADER_LABEL[$j][$i]}</a></li>
                    {assign var='i' value=$i+1}
                    {if $COLNUM[$j][$i] == '0'}
                        <li><a href='{$ITEM_URL[$j][$i]}' target='{$ITEM_TARGET[$j][$i]}'>{$ITEM_HEADER_IMAGE[$j][$i]}{$ITEM_HEADER_LABEL[$j][$i]}</a></li>
                    {/if}
                {/if}
                {assign var='i' value=$i+1}
            {/foreach}
        </ul>
    {/foreach}

</div>