<?php

require_once('vendor/ytree/Tree.php');
require_once('vendor/ytree/Node.php');
require_once('modules/ProductTemplates/TreeData.php');

class ProductTemplatesViewPopup extends ViewPopup {

 	function display() {
         $catalogtree = new Tree('productcatalog');
         $catalogtree->set_param('module', 'ProductTemplates');

         $nodes = get_categories_and_products(null);
         foreach($nodes as $node)
         {
             $catalogtree->add_node($node);
         }
         $this->override_popup['template_data']['treeheader'] = $catalogtree->generate_header();
         $this->override_popup['template_data']['treeinstance'] = '{literal}' . $catalogtree->generate_nodes_array() . '{/literal}';

         parent::display();
 	}
}
