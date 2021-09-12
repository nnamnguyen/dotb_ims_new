<?php


class Metric {

    public function __construct($type, $name)
    {
        $this->_name = $name;
        $this->_type = $type;
        $this->_mutable = $name == 'monitor_id' ? false : true;
    }
    
    function type() {
        return $this->_type;	
    }
    
    function name() {
        return $this->_name;
    }
    
    function isMutable() {
        return $this->_mutable;	
    }
    
}
