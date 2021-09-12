<?php

 

class ContactsViewCloseContactAddressPopup extends ViewList {
 	function display() {
        if(isset($_REQUEST['close_window'])) echo "<script>window.close();</script>";
        parent::display();
 	}	
}
?>
