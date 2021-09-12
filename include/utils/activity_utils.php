<?php


function build_related_list_by_user_id($bean, $user_id,$where, $fill_additional_column_fields = true) {

    $bean_id_name = strtolower($bean->object_name).'_id';

    $query = new DotbQuery();
    $query->from($bean);
    $query->joinTable($bean->rel_users_table)
        ->on()
        ->equalsField($bean->rel_users_table . '.' . $bean_id_name, $bean->table_name . '.id');

    $query->where()
        ->equals($bean->rel_users_table . '.user_id', $user_id)
        ->equals($bean->rel_users_table . '.deleted', 0);

    $query->whereRaw($where);

    $result = $query->execute();

    $list = array();

    foreach ($result as $row) {
        $newbean = clone $bean;
        $row = $newbean->convertRow($row);
        $newbean->fetched_row = $row;
        $newbean->fromArray($row);

        $newbean->processed_dates_times = array();
        $newbean->check_date_relationships_load();

        if (method_exists($newbean, 'setFillAdditionalColumnFields')) {
            $newbean->setFillAdditionalColumnFields($fill_additional_column_fields);
        }
        $newbean->fill_in_additional_detail_fields();

        $list[] = $newbean;
    }

    return $list;
}
?>
