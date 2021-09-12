<?php


function loadParentView($type)
{
    DotbAutoLoader::requireWithCustom('include/MVC/View/views/view.'.$type.'.php');
}


function getPrintLink()
{
    return "javascript:void window.open('index.php?',"
         . "'printwin','menubar=1,status=0,resizable=1,scrollbars=1,toolbar=0,location=1')";
}
