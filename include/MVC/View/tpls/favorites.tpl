{*

*}
[{foreach from=$FAVORITES item=item name=favorites}{ldelim}"text":"{$item.label|htmlentities:$smarty.const.ENT_QUOTES:'utf-8'}","url": "{dotb_link module=$item.module action='DetailView' record=$item.record_id link_only=1}"{rdelim}{if !$smarty.foreach.favorites.last},{/if}{foreachelse}{ldelim} "text": "{$APP.NTC_NO_ITEMS_DISPLAY}"{rdelim}{/foreach}]