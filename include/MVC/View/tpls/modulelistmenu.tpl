{*

*}
[{foreach from=$LAST_VIEWED item=item name=lastViewed}{ldelim}"text":"{$item.item_summary_short|htmlentities:$smarty.const.ENT_QUOTES:'utf-8'}","url": "{dotb_link module=$item.module_name action='DetailView' record=$item.item_id link_only=1}"{rdelim}{if !$smarty.foreach.lastViewed.last},{/if}{foreachelse}{ldelim} "text": "{$APP.NTC_NO_ITEMS_DISPLAY}"{rdelim}{/foreach}]