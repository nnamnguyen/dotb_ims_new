

// $Id: dotb_connection_event_listener.js 
// TODO remove this file

DOTB_callsInProgress = 0;

YAHOO.util.Connect.completeEvent.subscribe(function(event, data){
	DOTB_callsInProgress--;
	if (data[0].conn && data[0].conn.responseText && DOTB.util.isLoginPage(data[0].conn.responseText))
		return false;
});

YAHOO.util.Connect.startEvent.subscribe(function(event, data)
{
	DOTB_callsInProgress++;
});
