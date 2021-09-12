

/**
 * Handles loading the theme picker popup
 */
YAHOO.util.Event.onDOMReady(function()
{
	// open print dialog if we requested the print view
    if ( location.href.indexOf('print=true') > -1 )
        setTimeout("window.print();",  1000);
});
