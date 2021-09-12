{*

*}

{if $SAVED_SEARCHES_OPTIONS != null}
<select style="width: auto !important; min-width: 150px;" name='saved_search_select' id='saved_search_select' onChange='DOTB.savedViews.shortcut_select(this, "{$SEARCH_MODULE}");'>
	{$SAVED_SEARCHES_OPTIONS}
</select>
<script>
{literal}
	//if the function exists, call the function that will populate the searchform
	//labels based on the value of the saved search dropdown
	if(typeof(fillInLabels)=='function'){
		fillInLabels();
	}
{/literal}	
</script>
{/if}

