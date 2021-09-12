<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty plugin:
 * This is a Smarty plugin to create a multi-level menu using nasted ul lists.
 * The generated structure looks like this.
 * <ul $htmlOptions>
 *      <li $itemOptions>
 *          <elem></elem>
 *          <ul $submenuHtmlOptions>
 *              <li $itemOptions></li>
 *              <li $itemOptions>
 *                  <elem></elem>
 *                  <ul $submenuHtmlOptions>
 *                      <li $itemOptions></li>
 *                      ...
 *                  </ul>
 *              </li>
 *              ...
 *          </ul>
 *      </li>
 *      ...
 *  </ul>
 *
 *
 * @param $params array - look up the bellow example
 * @param $smarty
 * @return string - generated HTML code
 *
 * <pre>
 * smarty_function_dotb_menu(array(
 *      'id' => $string, //id property that is applied in root UL
 *      'items' => array(
 *          array(
 *              'html' => $html_string, //html container that renders in the LI tag
 *              'items' => array(), //nasted ul lists
 *          )
 *      ),
 *      'htmlOptions' => attributes that is applied in root UL, such as class, or align.
 *      'itemOptions' => attributes that is applied in LI items, such as class, or align.
 *      'submenuHtmlOptions' => attributes that is applied in child UL, such as class, or align.
 * ), $smarty);
 *
 * </pre>
 * * @author Justin Park (jpark@dotbcrm.com)
 */
function smarty_function_dotb_menu($params, &$smarty)
{
    $root_options = array(
        "id" => array_key_exists('id', $params) ? $params['id'] : ""
    );
    if(array_key_exists('htmlOptions', $params)) {
        foreach($params['htmlOptions'] as $attr => $value) {
            $root_options[$attr] = $value;
        }
    }
    $output = DotbHtml::createOpenTag("ul", $root_options);
    foreach($params['items'] as $item) {
        if(strpos($item['html'], "</") === 0) {
            $output .= $item['html'];
            continue;
        }
        $output .= DotbHtml::createOpenTag('li', !empty($params['itemOptions']) ? $params['itemOptions'] : array())
            .$item['html'];
        if(isset($item['items']) && count($item['items'])) {
            $output .= smarty_function_dotb_menu(array(
                'items' => $item['items'],
                'htmlOptions' => !empty($params['submenuHtmlOptions']) ? $params['submenuHtmlOptions'] : (!empty($item['submenuHtmlOptions']) ? $item['submenuHtmlOptions'] : array())
            ), $smarty);
        }
        $output .= DotbHtml::createCloseTag("li");
    }
    $output .= DotbHtml::createCloseTag("ul");
    return $output;
}
