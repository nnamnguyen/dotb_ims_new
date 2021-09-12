{*

*}
<!--end body panes-->
{if $use_table_container}
</td>
</tr>
</table>
{/if}
</div>
<div class="clear"></div>
</div>
<div id="bottomLinks">
{if $AUTHENTICATED}
{$BOTTOMLINKS}
{/if}
</div>

<div class="clear"></div>
<div id="arrow" title="Show" class="up"><i class="icon-chevron-down"></i></div>
<div id="footer">
{if $COMPANY_LOGO_URL}
    <img src="{$COMPANY_LOGO_URL}" class="logo" id="logo" title="{$STATISTICS}" border="0"/>
{/if}
    <div id="buffer"></div>
{if $HELP_LINK}
    <div id="help" class="help">{$HELP_LINK}</div>
{/if}
    <div id="partner">
        <div id="integrations">
        {foreach from=$DYNAMICDCACTIONS item=action}
                {$action.script} {$action.image}
            {/foreach}
        </div>
    </div>
{if $AUTHENTICATED}
    <div id="productTour">
        {$TOUR_LINK}
    </div>
{/if}
    <a href="http://www.dotbcrm.com" target="_blank" class="copyright">&#169; 2013 DotbCRM Inc.</a>
    <script>
        var logoStats = "&#169; 2019 DotBCRM Inc. All Rights Reserved. {$STATISTICS|addslashes}";
    </script>

{literal}


    <div class="clear"></div>
</div>
{/literal}
</body>
</html>

