<?php
    function getCenter($center_id) {
        global $db, $current_user;
        $qr = "";
        if(!$current_user->isAdmin()) {
            $sql_get_my_team = "SELECT DISTINCT
            rel.team_id
            FROM
            team_memberships rel
            RIGHT JOIN teams ON (rel.team_id = teams.id)
            WHERE rel.user_id = '".$current_user->id."' AND teams.private = 0
            AND rel.deleted = 0 AND teams.deleted = 0";
            $result = $db->query($sql_get_my_team);

            $teamIds = array();
            while($row = $db->fetchByAssoc($result))
                $teamIds[] = $row['team_id'] ;

            $qr = " AND t1.id IN ('".implode("','", $teamIds)."') ";
        }


        $sql_get_team = "
        (SELECT DISTINCT IFNULL(gl.id, '') id, IFNULL(gl.name, '') name, IFNULL(gl.code_prefix, '') center_code FROM teams gl WHERE gl.id = '1' AND gl.deleted = 0)
        UNION
        (SELECT DISTINCT IFNULL(t1.id, '') id, IFNULL(t1.name, '') name, IFNULL(t1.code_prefix, '') center_code
        FROM teams t1
        INNER JOIN teams t2 ON t1.parent_id = t2.id AND t2.deleted = 0
        $qr AND t1.deleted = 0 AND t1.id NOT IN (SELECT DISTINCT tt.parent_id FROM teams tt WHERE tt.private = 0 AND tt.deleted = 0 AND (tt.parent_id <> '' AND tt.parent_id IS NOT NULL))
        ORDER BY t1.name ASC)";
        $result = $db->query($sql_get_team);
        $team_array = array("" => "--None--");
        while($row = $db->fetchByAssoc($result))
            $team_array[$row['id']] = $row['name'];

        $team_options = get_select_options_with_id($team_array,$center_id);
        return $team_options;
    }
?>
