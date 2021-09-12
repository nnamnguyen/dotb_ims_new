<?php
// created: 2020-08-06 11:23:44
$viewdefs['Products']['base']['view']['subpanel-for-producttemplates-product_producttemplate_2'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
          array(
              'name' => 'code',
              'label' => 'LBL_CODE',
              'type' => 'base',
          ),
          array(
              'name' => 'product_template_name',
              'label' => 'LBL_PRODUCT_NAME',
              'widthClass' => 'cell-large',
              'type' => 'quote-data-relate',
              'required' => true,
          ),
          array(
              'name' => 'unit',
              'label' => 'LBL_UNIT',
              'type' => 'base',
              'css_class' => 'disabled',
              'readonly' => true,
              'disabled'=> true,
              'related_fields' => array(
                  'unit'
              ),
          ),
          array(
              'name' => 'quantity',
              'label' => 'LBL_QUANTITY',
              'widthClass' => 'cell-small',
              'css_class' => 'quantity',
              'type' => 'float',
          ),
          array(
              'name' => 'discount_price',
              'label' => 'LBL_DISCOUNT_PRICE',
              'type' => 'currency',
              'convertToBase' => true,
              'showTransactionalAmount' => true,
              'related_fields' => array(
                  'discount_price',
                  'currency_id',
                  'base_rate',
              ),
          ),
          array(
              'name' => 'discount',
              'type' => 'fieldset',
              'css_class' => 'quote-discount-percent',
              'label' => 'LBL_DISCOUNT_AMOUNT',
              'fields' => array(
                  array(
                      'name' => 'discount_amount',
                      'label' => 'LBL_DISCOUNT_AMOUNT',
                      'type' => 'discount',
                      'convertToBase' => true,
                      'showTransactionalAmount' => true,
                  ),
                  array(
                      'type' => 'discount-select',
                      'name' => 'discount_select',
                      'no_default_action' => true,
                      'buttons' => array(
                          array(
                              'type' => 'rowaction',
                              'name' => 'select_discount_amount_button',
                              'label' => 'LBL_DISCOUNT_AMOUNT',
                              'event' => 'button:discount_select_change:click',
                          ),
                          array(
                              'type' => 'rowaction',
                              'name' => 'select_discount_percent_button',
                              'label' => 'LBL_DISCOUNT_PERCENT',
                              'event' => 'button:discount_select_change:click',
                          ),
                      ),
                  ),
              ),
          ),
          array(
              'name' => 'total_amount',
              'label' => 'LBL_LINE_ITEM_TOTAL',
              'type' => 'currency',
              'widthClass' => 'cell-medium',
              'showTransactionalAmount' => true,
              'related_fields' => array(
                  'total_amount',
                  'currency_id',
                  'base_rate',
              ),
          ),
      ),
    ),
  ),
    'rowactions' =>
        array (
            'actions' =>
                array (
                    0 =>
                        array (
                            'type' => 'actiondropdown',
                            'name' => 'main_dropdown',
                            'primary' => true,
                            'showOn' => 'view',
                            'buttons' =>
                                array (
                                    0=> array (
                                        'name'=>'edit',
                                        'type' => 'rowaction',
                                        'css_class' => 'btn',
                                        'tooltip' => 'LBL_EDIT_BUTTON',
                                        'event' => 'list:editrow:fire',
                                        'icon' => 'fa-pencil',
                                        'acl_action' => 'edit',
                                    ),
                                    1=> array (
                                        'type' => 'rowaction',
                                        'name' => 'remove',
                                        'label' => 'LBL_DELETE_BUTTON',
                                        'acl_action' => 'view',
                                        'event' => 'list:removeProduct:fire',
                                    ),
                                ),
                        ),
                ),
        ),
  'type' => 'subpanel-list',
);