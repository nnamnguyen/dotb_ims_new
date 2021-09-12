<?php


//Custom plugins
//Search through the plugins to include any custom_utils.php files
$dir_path = "./custom/workflow/plugins";
foreach(DotbAutoLoader::getDirFiles("custom/workflow/plugins", true) as $dir) {
    if(DotbAutoLoader::existing("$dir/custom_utils.php")) {
        include_once("$dir/custom_utils.php");
    }
}
