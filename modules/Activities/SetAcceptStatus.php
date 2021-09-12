<?php




    global $json,$current_user;
    
    
    if ($_REQUEST['object_type'] == "Meeting")
    {
        $focus = BeanFactory::newBean('Meetings');
        $focus->id = $_REQUEST['object_id'];
        $test = $focus->set_accept_status($current_user, $_REQUEST['accept_status']);
    }
    else if ($_REQUEST['object_type'] == "Call")
    {
        $focus = BeanFactory::newBean('Calls');
        $focus->id = $_REQUEST['object_id'];
        $test = $focus->set_accept_status($current_user, $_REQUEST['accept_status']);
    }
    print 1;
    exit;
?>
