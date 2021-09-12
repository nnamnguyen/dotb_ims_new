<?php


class CalendarViewJson extends DotbView 
{

    public function display()
    {    
        if (!isset($this->view_object_map['jsonData']) || !is_array($this->view_object_map['jsonData'])) {
            $GLOBALS['log']->fatal("JSON data has not been passed from Calendar controller");
            dotb_cleanup(true);
        }
        
        $jsonData = $this->view_object_map['jsonData'];
        
        ob_clean();
        echo json_encode($jsonData);
    }
}

?>
