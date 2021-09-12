<?php
global $mod_strings;
?>
<h2 style="color:#000;margin-left:15px;"><?php echo $mod_strings['LBL_UPGRADE_TITLE']; ?></h2>
<style>
    ul.admin-grid-icon {
        list-style-type: none;
        padding: 0;
        margin: 10px;
        display: inline-block;
    }

    .admin-grid-icon li {
        text-align: center;
        vertical-align: middle;
        display: inline-block;
        width: 100px;
        height: 95px;
        padding: 5px;
        border: solid 1px #ccc;
        line-height: 1.4;
        border-radius: 2px;
        margin-bottom: 5px;
        margin-top:5px;
    }

    .admin-grid-icon li:hover {
        border: solid 1px #000;
    }

    .admin-grid-icon li:hover>a{
        color:#000 !important;
    }

    .admin-grid-icon a {
        display: grid;
        text-decoration: none;
        vertical-align: middle;
        padding-top: 0;
        font-family: 'SFUIText', sans-serif;
        line-height: 14px;
        color: #535353 !important;
        height:90px
    }

    .admin-grid-icon a:link {
        text-decoration: none;
    }

    li > a > i.fa,
    li > a > i.fab,
    li > a > i.fad,
    li > a > i.fal,
    li > a > i.far,
    li > a > i.fas{
        font-size: 40px;
    }
</style>
<ul class="admin-grid-icon">
    <li><a href="./index.php?module=Administration&action=repair"><i class="fal fa-cogs"></i><?php echo $mod_strings['LBL_QUICK_REPAIR_AND_REBUILD']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RebuildRelationship"><i class="fal fa-network-wired"></i><?php echo $mod_strings['LBL_REBUILD_REL_TITLE']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RebuildJSLang"><i class="fal fa-cog"></i><?php echo $mod_strings['LBL_REBUILD_JAVASCRIPT_LANG_TITLE']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=upgradeTeams"><i class="fal fa-users"></i><?php echo $mod_strings['LBL_UPGRADE_TEAM_TITLE']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RebuildSchedulers"><i class="fal fa-alarm-clock"></i><?php echo $mod_strings['LBL_REBUILD_SCHEDULERS_TITLE']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RebuildDashlets"><i class="fal fa-tachometer-alt-average"></i><?php echo $mod_strings['LBL_REBUILD_DASHLETS_TITLE']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RebuildWorkFlow"><i class="fal fa-project-diagram"></i><?php echo $mod_strings['LBL_REBUILD_WORKFLOW']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RepairTeams&silent=0"><i class="fal fa-user-md"></i><?php echo $mod_strings['LBL_REPAIR_TEAMS']; ?></a></li>
    <li><a href="./index.php?module=ACL&action=install_actions"><i class="fal fa-key"></i><?php echo $mod_strings['LBL_REPAIR_ROLES']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RepairXSS"><i class="fal fa-bug"></i><?php echo $mod_strings['LBL_REPAIR_XSS']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=RepairActivities"><i class="fal fa-cogs"></i><?php echo $mod_strings['LBL_REPAIR_ACTIVITIES']; ?></a></li>
    <li><a href="./index.php?module=Administration&action=repairlang"><i class="fal fa-flag"></i><?php echo $mod_strings['LBL_REPAIR_LANGUAGE']; ?></a></li>
</ul>