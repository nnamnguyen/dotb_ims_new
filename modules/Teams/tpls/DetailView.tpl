{*

*}
{strip}
    {foreach from=$teams name=tn key=key item=team}
        {$team.title}{if $team.badges} (<em>{dotb_teamset_badges items=$team.badges}</em>){/if}
        {if !$smarty.foreach.tn.last}, {/if}
    {/foreach}
{/strip}
