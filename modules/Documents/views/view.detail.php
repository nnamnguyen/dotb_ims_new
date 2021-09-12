<?php



class DocumentsViewDetail extends ViewDetail 
{

    public function display()
 	{
	//check to see if the file field is empty.  This should not occur and would only happen when an error has ocurred during upload, or from db manipulation of record.
         if(empty($this->bean->filename)){
	    //print error to screen
            $this->errors[] = $GLOBALS['mod_strings']['ERR_MISSING_FILE'];
            $this->displayErrors();
         }


        parent::display();
    }
    
}
