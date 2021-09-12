<?php
//Add new 3 field side n (right) by nnamnguyen
// Field name, id đã tạo bên custom\Extension\modules\C_SiteDeployment\Ext\Vardefs\parent_c_sitedeployment.php
$dictionary['C_SiteDeployment']['fields']['lead_link'] =array(
    'name' => 'lead_link',
    'type' => 'link',
    'relationship' => 'lead_sitedeployments',
    'link_type' => 'many',
    'side' => 'right',
    'source' => 'non-db',
    'vname' => 'LBL_LEAD_NAME',
    'id_name' => 'parent_id',
);
/*
    => Xem lại có khi sai vì thiếu 2 field name và id vì tạo quan hệ 1-n, bên n thường tạo đủ 3 field chứ k dùng chung field name và id của flex related field
    => Chỉ có dùng flex related field mới dùng chung id (name thì phụ thuộc vào giá trị options)
*/