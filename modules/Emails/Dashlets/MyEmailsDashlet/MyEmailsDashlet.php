<?php






class MyEmailsDashlet extends DashletGeneric {
    public function __construct($id, $def = null)
    {
        global $current_user, $app_strings, $dashletData;
		require('modules/Emails/Dashlets/MyEmailsDashlet/MyEmailsDashlet.data.php');

        parent::__construct($id, $def);

        if(empty($def['title']))
            $this->title = translate('LBL_MY_EMAILS', 'Emails');

        $this->searchFields = $dashletData['MyEmailsDashlet']['searchFields'];
        $this->hasScript = true;  // dashlet has javascript attached to it

        $this->columns = $dashletData['MyEmailsDashlet']['columns'];

        $this->seedBean = BeanFactory::newBean('Emails');
    }

    public function process($lvsParams = array())
    {
        global $current_language, $app_list_strings, $image_path, $current_user;
        //$where = 'emails.deleted = 0 AND emails.assigned_user_id = \''.$current_user->id.'\' AND emails.type = \'inbound\' AND emails.status = \'unread\'';
        $mod_strings = return_module_language($current_language, 'Emails');

        if ($this->myItemsOnly) {
        	$this->filters['assigned_user_id'] = $current_user->id;
        }
        $this->filters['type'] = array("inbound");
        $this->filters['status'] = array("unread");

        $lvsParams['custom_select'] = " ,emails_text.from_addr as from_addr ";
        $lvsParams['custom_from'] = " join emails_text on emails.id = emails_text.email_id ";
        parent::process($lvsParams);
    }

    function displayScript() {
        global $current_language;

        $mod_strings = return_module_language($current_language, 'Emails');
        $casesImageURL = "\"" . DotbThemeRegistry::current()->getImageURL('Cases.gif') . "\"";
        
        $leadsImageURL = "\"" . DotbThemeRegistry::current()->getImageURL('Leads.gif') . "\"";
        
        $contactsImageURL = "\"" . DotbThemeRegistry::current()->getImageURL('Contacts.gif') . "\"";
        
        $bugsImageURL = "\"" . DotbThemeRegistry::current()->getImageURL('Bugs.gif') . "\"";
        
        $tasksURL = "\"" . DotbThemeRegistry::current()->getImageURL('Tasks.gif') . "\"";
        $script = <<<EOQ
        <script>
        function quick_create_overlib(id, theme, el) {
        	
        var \$dialog = \$('<div></div>')
		.html('<a style=\'width: 150px\' class=\'menuItem\' onmouseover=\'hiliteItem(this,"yes");\' onmouseout=\'unhiliteItem(this);\' href=\'index.php?module=Cases&action=EditView&inbound_email_id=' + id + '\'>' +
            "<!--not_in_theme!--><img border='0' src='" + {$casesImageURL} + "' style='margin-right:5px'>" + '{$mod_strings['LBL_LIST_CASE']}' + '</a>' +

            
            "<a style='width: 150px' class='menuItem' onmouseover='hiliteItem(this,\"yes\");' onmouseout='unhiliteItem(this);' href='index.php?module=Leads&action=EditView&inbound_email_id=" + id + "'>" +
                    "<!--not_in_theme!--><img border='0' src='" + {$leadsImageURL} + "' style='margin-right:5px'>"

                    + '{$mod_strings['LBL_LIST_LEAD']}' + "</a>" +
                    
            "<a style='width: 150px' class='menuItem' onmouseover='hiliteItem(this,\"yes\");' onmouseout='unhiliteItem(this);' href='index.php?module=Contacts&action=EditView&inbound_email_id=" + id + "'>" +
                    "<!--not_in_theme!--><img border='0' src='" + {$contactsImageURL} + "' style='margin-right:5px'>"

                    + '{$mod_strings['LBL_LIST_CONTACT']}' + "</a>" +
             
             "<a style='width: 150px' class='menuItem' onmouseover='hiliteItem(this,\"yes\");' onmouseout='unhiliteItem(this);' href='index.php?module=Bugs&action=EditView&inbound_email_id=" + id + "'>"+
                    "<!--not_in_theme!--><img border='0' src='" + {$bugsImageURL} + "' style='margin-right:5px'>"

                    + '{$mod_strings['LBL_LIST_BUG']}' + "</a>" +
                    
             "<a style='width: 150px' class='menuItem' onmouseover='hiliteItem(this,\"yes\");' onmouseout='unhiliteItem(this);' href='index.php?module=Tasks&action=EditView&inbound_email_id=" + id + "'>" +
                    "<!--not_in_theme!--><img border='0' src='" + {$tasksURL} + "' style='margin-right:5px'>"

                   + '{$mod_strings['LBL_LIST_TASK']}' + "</a>")
		.dialog({
			autoOpen: false,
			title: '{$mod_strings['LBL_QUICK_CREATE']}',
			width: 150,
			position: { 
				    my: 'right top',
				    at: 'left top',
				    of: $(el)
			  }
		});
		\$dialog.dialog('open');
          
        }
        </script>
EOQ;
        return $script;
    }
}
