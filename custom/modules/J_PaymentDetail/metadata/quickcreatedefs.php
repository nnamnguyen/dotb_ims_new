<?php
$module_name = 'J_PaymentDetail';
$viewdefs[$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
          0 => '<input type="hidden" name="contacts_id" id="contacts_id" value="{$contacts_id}">',
          1 => '<input type="hidden" name="contacts_name" id="contacts_name" value="{$contacts_name}">',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '
            {dotb_getscript file="custom/modules/J_PaymentDetail/js/EditView.js"}
            ',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'customCode' => '{$fields.name.value}',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'subject',
          ),
          1 => 
          array (
            'name' => 'status',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
          ),
          1 => 
          array (
            'name' => 'receipt_type',
            'studio' => 'visible',
            'label' => 'LBL_RECEIPT_TYPE', 
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'c_contract_j_paymentdetail_1_name',
          ),
          1 => 
          array (
            'name' => 'payment_date',
            'label' => 'LBL_PAYMENT_DATE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'amount_bef_exchange',
            'customCode' => '<input type="text" name="amount_bef_exchange" id="amount_bef_exchange" size="30" value="{dotb_number_format var=$fields.amount_bef_exchange.value} ">
                        {html_options name="currency_unit" id="currency_unit" options=$fields.currency_unit.options selected=$fields.currency_unit.value}',
          ),
          1 => 
          array (
            'name' => 'remind_date',
            'label' => 'LBL_REMIND_DATE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'exchange_rate',
            'label' => 'LBL_EXCHANGE_RATE',
          ),
          1 => 
          array (
            'name' => 'filename',
            'comment' => 'File name associated with the note (attachment)',
            'label' => 'LBL_FILENAME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'payment_amount',
            'label' => 'LBL_PAYMENT_AMOUNT',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
        8 => 
        array (
          0 => 'assigned_user_name',
          1 => 
          array (
            'name' => 'team_name',
            'displayParams' => 
            array (
              'display' => true,
            ),
          ),
        ),
      ),
    ),
  ),
);
