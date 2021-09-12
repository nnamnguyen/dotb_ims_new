{*

*}
<input type="hidden" id="{$dashletId}_offset" name="{$dashletId}_offset" value="0">
<input type="hidden" id="{$dashletId}_interval" name="{$dashletId}_interval" value="{$dashletRefreshInterval}">
<script type='text/javascript'>
// <!--
document.getElementById("{$dashletId}_offset").value = "{$dashletOffset}";
document.getElementById("{$dashletId}_interval").value = "{$dashletRefreshInterval}";
if (typeof autoRefreshProcId{$strippedDashletId} != 'undefined') {ldelim}
    clearInterval(autoRefreshProcId{$strippedDashletId});
{rdelim}
if(document.getElementById("{$dashletId}_interval").value > 0) {ldelim}
    if (typeof refreshDashlet{$strippedDashletId} == 'undefined') {ldelim}
        function refreshDashlet{$strippedDashletId}() 
        {ldelim}
            //refresh only if offset is 0
            if (DOTB.myDotb && document.getElementById("{$dashletId}_offset").value == '0' ) {ldelim}
                DOTB.myDotb.retrieveDashlet("{$dashletId}","{$url}");
            {rdelim}
        {rdelim}
    {rdelim}
    autoRefreshProcId{$strippedDashletId} = setInterval('refreshDashlet{$strippedDashletId}()', document.getElementById("{$dashletId}_interval").value);
{rdelim}
// -->
</script>
