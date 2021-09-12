<?php



/**
 * Handle Dotb fields
 * @api
 */
class DotbFieldHandler
{
    static function fixupFieldType($field) {
        switch($field) {
            case 'double':
            case 'decimal':
                $field = 'Float';
                break;
            case 'uint':
            case 'ulong':
            case 'long':
            case 'short':
            case 'tinyint':
                $field = 'Int';
                break;
            case 'url':
                $field = 'Link';
                break;
            case 'link':
                $field = 'RelateLink';
                break;
            case 'varchar':
                $field = 'Base';
                break;
            default:
                $field = ucfirst($field);
                break;
        }

        return $field;
    }

    /**
     * return the singleton of the DotbField
     *
     * @param string $field Field type
     * @param boolean $returnNullIfBase
     * @return DotbFieldBase
     */
    static function getDotbField($field, $returnNullIfBase=false) {
        static $dotbFieldObjects = array();
        static $fixupField = array();

        if (!isset($fixupField[$field])) {
            $fixupField[$field] = static::fixupFieldType($field);
        }
        $field = $fixupField[$field];

        if(!isset($dotbFieldObjects[$field])) {
        	//check custom directory
        	$file = DotbAutoLoader::existingCustomOne("include/DotbFields/Fields/{$field}/DotbField{$field}.php");

        	if($file) {
                $type = $field;
        	} else {
                // No direct class, check the directories to see if they are defined
        		if( $returnNullIfBase &&
        		    !DotbAutoLoader::existing('include/DotbFields/Fields/'.$field)) {
                    return null;
                }
        		$file = 'include/DotbFields/Fields/Base/DotbFieldBase.php';
                $type = 'Base';
        	}
			require_once($file);

			$class = DotbAutoLoader::customClass('DotbField' . $type);
			//could be a custom class check it
       		$dotbFieldObjects[$field] = new $class($field);
        }
        return $dotbFieldObjects[$field];
    }

    /**
     * Returns the smarty code to be used in a template built by TemplateHandler
     * The DotbField class is choosen dependant on the vardef's type field.
     *
     * @param parentFieldArray string name of the variable in the parent template for the bean's data
     * @param vardef vardef field defintion
     * @param displayType string the display type for the field (eg DetailView, EditView, etc)
     * @param displayParam parameters for displayin
     *      available paramters are:
     *      * labelSpan - column span for the label
     *      * fieldSpan - column span for the field
     */
    static function displaySmarty($parentFieldArray, $vardef, $displayType, $displayParams = array(), $tabindex = 1) {
        $string = '';
        $displayTypeFunc = 'get' . $displayType . 'Smarty'; // getDetailViewSmarty, getEditViewSmarty, etc...

		// This will handle custom type fields.
		// The incoming $vardef Array may have custom_type set.
		// If so, set $vardef['type'] to the $vardef['custom_type'] value
		if(isset($vardef['custom_type'])) {
		   $vardef['type'] = $vardef['custom_type'];
		}
		if(empty($vardef['type'])) {
			$vardef['type'] = 'varchar';
		}

		$field = self::getDotbField($vardef['type']);
		if ( !empty($vardef['function']) ) {
			$string = $field->displayFromFunc($displayType, $parentFieldArray, $vardef, $displayParams, $tabindex);
		} else {
			$string = $field->$displayTypeFunc($parentFieldArray, $vardef, $displayParams, $tabindex);
		}

        return $string;
    }
}
