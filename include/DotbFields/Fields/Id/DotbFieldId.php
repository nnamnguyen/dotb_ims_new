<?php




class DotbFieldId extends DotbFieldBase 
{
    /**
     * @see DotbFieldBase::importSanitize()
     */
    public function importSanitize(
        $value,
        $vardef,
        $focus,
        ImportFieldSanitize $settings
        )
    {
        if ( strlen($value) > 36 ) {
            return false;
        }
        
        return $value;
    }
}
?>
