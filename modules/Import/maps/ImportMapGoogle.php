<?php




class ImportMapGoogle extends ImportMapOther
{
	/**
     * String identifier for this import
     */
    public $name = 'google';
    
    /**
     * Gets the default mapping for a module
     *
     * @param  string $module
     * @return array field mappings
     */
	public function getMapping($module)
    {
         $return_array = array(
             'first_name' => array('dotb_key' => 'first_name', 'dotb_label' => '', 'default_label' => 'Given Name'),
             'last_name' => array('dotb_key' => 'last_name', 'dotb_label' => '', 'default_label' => 'Family Name'),
             'birthday' => array('dotb_key' => 'birthdate', 'dotb_label' => '', 'default_label' => 'Birthday'),
             'title' => array('dotb_key' => 'title', 'dotb_label' => '', 'default_label' => 'Title'),
             'notes' => array('dotb_key' => 'description', 'dotb_label' => '', 'default_label' => 'Notes'),

             'alt_address_street' => array('dotb_key' => 'alt_address_street', 'dotb_label' => '', 'default_label' => 'Home Street'),
             'alt_address_postcode' => array('dotb_key' => 'alt_address_postalcode', 'dotb_label' => '', 'default_label' => 'Home Postcode'),
             'alt_address_city' => array('dotb_key' => 'alt_address_city', 'dotb_label' => '', 'default_label' => 'Home City'),
             'alt_address_state' => array('dotb_key' => 'alt_address_state', 'dotb_label' => '', 'default_label' => 'Home State'),
             'alt_address_country' => array('dotb_key' => 'alt_address_country', 'dotb_label' => '', 'default_label' => 'Home Country'),

             'primary_address_street' => array('dotb_key' => 'primary_address_street', 'dotb_label' => '', 'default_label' => 'Work Street'),
             'primary_address_postcode' => array('dotb_key' => 'primary_address_postalcode', 'dotb_label' => '', 'default_label' => 'Work Postcode'),
             'primary_address_city' => array('dotb_key' => 'primary_address_city', 'dotb_label' => '', 'default_label' => 'Work City'),
             'primary_address_state' => array('dotb_key' => 'primary_address_state', 'dotb_label' => '', 'default_label' => 'Work State'),
             'primary_address_country' => array('dotb_key' => 'primary_address_country', 'dotb_label' => '', 'default_label' => 'Work Country'),

             'phone_main' => array('dotb_key' => 'phone_other', 'dotb_label' => '', 'default_label' => 'Main Phone'),
             'phone_mobile' => array('dotb_key' => 'phone_mobile', 'dotb_label' => '', 'default_label' => 'Mobile Phone'),
             'phone_home' => array('dotb_key' => 'phone_home', 'dotb_label' => '', 'default_label' => 'Home phone'),
             'phone_work' => array('dotb_key' => 'phone_work', 'dotb_label' => '', 'default_label' => 'Work phone'),
             'phone_fax' => array('dotb_key' => 'phone_fax', 'dotb_label' => '', 'default_label' => 'Fax phone'),

             'email1' => array('dotb_key' => 'email1', 'dotb_label' => 'LBL_EMAIL_ADDRESS', 'default_label' => 'Email Address'),
             'email2' => array('dotb_key' => 'email2', 'dotb_label' => 'LBL_OTHER_EMAIL_ADDRESS', 'default_label' => 'Other Email'),

             'assigned_user_name' => array('dotb_key' => 'assigned_user_name', 'dotb_help_key' => 'LBL_EXTERNAL_ASSIGNED_TOOLTIP', 'dotb_label' => 'LBL_ASSIGNED_TO_NAME', 'default_label' => 'Assigned To'),
             'team_name' => array('dotb_key' => 'team_name', 'dotb_help_key' => 'LBL_EXTERNAL_TEAM_TOOLTIP','dotb_label' => 'LBL_TEAMS', 'default_label' => 'Teams'),
            );

        if($module == 'Users')
        {
            $return_array['status'] =  array('dotb_key' => 'status', 'dotb_label' => '', 'default_label' => 'Status');
            $return_array['full_name'] =  array('dotb_key' => 'user_name', 'dotb_label' => '', 'default_label' => 'Full Name');
        }
        return $return_array;
    }
}


?>
