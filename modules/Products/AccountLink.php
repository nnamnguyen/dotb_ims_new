<?php



class AccountLink extends Link2
{
    public function getSubpanelQuery($params = array(), $return_array = false)
    {
        $db = DBManagerFactory::getInstance();
        $result = parent::getSubpanelQuery($params, $return_array);
        if($return_array)
        {
            $result ['join'] .= ' LEFT JOIN quotes ON products.quote_id = quotes.id ';
            $result['where'] .= ' AND (quotes.quote_stage IS NULL OR quotes.quote_stage NOT IN (' . $db->quoted('Closed Lost') . ',' . $db->quoted('Closed Dead') . ')) AND ( quotes.deleted = 0 OR quotes.deleted IS NULL )';
            array_push($result['join_tables'], 'quotes');
        }
        return $result;
    }
}