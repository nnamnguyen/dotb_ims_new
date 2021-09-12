<?php




/**
 * WebResourceObserver.php
 * This is a subclass of ResourceObserver to provide notification handling
 * for web clients.
 */
class WebResourceObserver extends ResourceObserver {
/**
 * notify
 * Web implementation to notify the browser
 * @param msg String message to possibly display
 * 
 */
public function notify($msg = '') {
   echo $msg;
   dotb_cleanup(true);
}	
	
}
