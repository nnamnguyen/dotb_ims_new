{*

*}
<div class="clear"></div>
<div class='listViewBody'>
<script type="text/javascript" src="{dotb_getjspath file='include/javascript/popup_parent_helper.js'}"></script>
{$TABS}
{{if $displayView == saved_views }}
{literal}
<script>DOTB.savedViews.handleForm();</script>
{/literal}
{{/if}}
{literal}
<script>
function submitOnEnter(e)
{
    var characterCode = (e && e.which) ? e.which : event.keyCode;

    if (characterCode == 13) {
        document.getElementById('search_form').submit();
        return false;
    } else {
        return true;
    }
}
</script>
{/literal}
<form name='search_form' id='search_form' class='search_form' method='post' action='index.php?module={$module}&action={$action}' onkeydown='submitOnEnter(event);'>
{dotb_csrf_form_token}
<input type='hidden' name='searchFormTab' value='{$displayView}'/>
<input type='hidden' name='module' value='{$module}'/>
<input type='hidden' name='action' value='{$action}'/> 
<input type='hidden' name='query' value='true'/>
{foreach name=tabIteration from=$TAB_ARRAY key=tabkey item=tabData}
<div id='{$module}{$tabData.name}_searchSearchForm' style='{$tabData.displayDiv}' class="edit view search {$tabData.name}">{if $tabData.displayDiv}{else}{$return_txt}{/if}</div>
{/foreach}
<div id='{$module}saved_viewsSearchForm' {{if $displayView != 'saved_views'}}style='display: none;'{{/if}}>{$saved_views_txt}</div>
