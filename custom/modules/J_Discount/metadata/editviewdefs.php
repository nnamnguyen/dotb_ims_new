<?php
$module_name = 'J_Discount';
$viewdefs[$module_name] =
array (
  'EditView' =>
  array (
    'templateMeta' =>
    array (
      'maxColumns' => '2',
      'javascript' => '
            {dotb_getscript file="custom/include/javascript/Select2/select2.min.js"}
            {dotb_getscript file="custom/include/javascript/Multifield/jquery.multifield.js"}
            <link rel="stylesheet" href="{dotb_getjspath file=\'custom/include/javascript/Select2/select2.css\'}"/>',
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
      'useTabs' => false,
      'tabDefs' =>
      array (
        'LBL_EDITVIEW_PANEL1' =>
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'includes' =>
      array (
        0 =>
        array (
          'file' => 'custom/modules/J_Discount/js/editview.js',
        ),
      ),
    ),
    'panels' =>
    array (
      'lbl_editview_panel1' =>
      array (
        0 =>
        array (
          0 => 'name',
          1 =>
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
            'customCode' => '{html_options  style="width: 140px;" name="status" id="status" options=$fields.status.options selected=$fields.status.value} ',
          ),
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'order_no',
            'customCode' => '<input type="text" tabindex="0" size="4" maxlength="10" name="order_no" id="order_no"  value="{$fields.order_no.value}" title="{$MOD.LBL_ORDER}">',
          ),
          1 =>
          array (
            'name' => 'category',
          ),
        ),
        2 =>
        array (
          0 =>
          array (
            'name' => 'discount_amount',
            'label' => 'LBL_DISCOUNT_AMOUNT',
            'customCode' => '<input type="text" class="currency" value="{dotb_number_format var=$fields.discount_amount.value}" name="discount_amount" title="{$MOD.LBL_DISCOUNT_AMOUNT}" id="discount_amount" size="25" style="font-weight: bold; color: rgb(165, 42, 42);"> <b style="font-weight: bold; color: rgb(165, 42, 42);"> VND </b>',
          ),
          1 =>
          array (
            'name' => 'start_date',
            'label' => 'LBL_START_DATE',
          ),
        ),
        3 =>
        array (
          0 =>
          array (
            'name' => 'discount_percent',
            'label' => 'LBL_DISCOUNT_PERCENT',
            'customCode' => '<input type="text" tabindex="0" size="4" maxlength="10" class="currency" name="discount_percent" id="discount_percent"  value="{$fields.discount_percent.value}" title="{$MOD.LBL_DISCOUNT_PERCENT}"> <b> %</b>',
          ),
          1 =>
          array (
            'name' => 'end_date',
            'label' => 'LBL_END_DATE',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
            'customCode' => '<table style=" border-collapse: collapse;" > <tr> <td style="  width: 150px;" >{html_options  style="width: 140px;" name="type" id="type" options=$fields.type.options selected=$fields.type.value} </td><td> <div id="div_rewards" style="display: none;"> {$MOD.LBL_COURSE}:  {html_options name="course" id="course" options=$fields.course.options selected=$fields.course.value} </div>{include file ="custom/modules/J_Discount/tpls/type_discount.tpl"}</td></tr> </table>',
          ),
          1 =>
          array (
            'name' => 'maximum_discount_percent',
            'customCode' => '<input type="text" name="maximum_discount_percent" id="maximum_discount_percent" size="5" maxlength="5" value="{dotb_number_format var=$fields.maximum_discount_percent.value precision=2}" title="{$MOD.LBL_MAXIMUM_DISCOUNT_PERCENT}" tabindex="0"  style="text-align: right; color: rgb(165, 42, 42);">
                        <img src="themes/RacerX/images/helpInline.png" class="paidAmountHelpTip">If the maximum discount is empty or zero. Total discount will be limit by default rate',
          ),
        ),
        5 =>
        array (
          0 =>
          array (
            'name' => 'discount_schema',
            'studio' => 'visible',
            'label' => 'LBL_DISCOUNT_SCHEMA',
            'customCode' => '{$SCHEMA_TABLE}',
          ),
          1 => 'is_chain_discount',
        ),
        6 =>
        array (
          0 =>
          array (
            'name' => 'policy',
            'studio' => 'visible',
            'label' => 'LBL_POLICY',
            'displayParams' =>
            array (
              'rows' => 4,
              'cols' => 60,
            ),
          ),
          1 =>
          array (
            'name' => 'is_trade_discount',
            'label' => 'LBL_IS_TRADE_DISCOUNT',
          ),
        ),
        7 =>
        array (
          0 =>
          array (
            'name' => 'description',
            'displayParams' =>
            array (
              'rows' => 4,
              'cols' => 60,
            ),
          ),
          1 => 'is_accumulate',
        ),
        8 =>
        array (
          0 =>
          array (
            'name' => 'ext_invoice_content',
          ),
          1 => '',
        ),
        9 =>
        array (
          0 =>
          array (
            'name' => 'team_name',
            'displayParams' =>
            array (
              'display' => true,
            ),
          ),
          1 => 'is_auto_set',
        ),
      ),
    ),
  ),
);
