<?php
if (ob_get_level() == 0) ob_start();
echo '<script>function rs(){var a=document.getElementById("process");a.parentNode.removeChild(a);}</script>';
function scandirectory($folder, &$folderWaitCheck)
{
    $files = scandir($folder);
    foreach ($files as $file) {
        if (is_dir($folder . '/' . $file)) {
            if ($file != '.' && $file != '..') {
                $folderWaitCheck[] = $folder . '/' . $file;
            }
        } else {
            if (preg_match('/\.php$/', $file)) {
//                $a = shell_exec('php -l ' . $folder . '/' . $file);
                $a = filesize($folder . '/' . $file);
                if ((int)$a > 1048576/2) echo $folder . '/' . $file . '<br/>';
//                if (preg_match('/Parse error/', $a)) echo '<div id="error"><br/>==========ERROR======<br/>' . $a . '<br/>===============<br/></div>';
                echo '<script>rs()</script><div id="process">' . $folder . '/' . $file . '<br/></div>';
                echo str_pad('', 4096) . "\n";
                ob_flush();
                flush();
                ob_clean();
            }
        }
    }
}

$folderWaitCheck = array();
scandirectory('.', $folderWaitCheck);
check:
if (count($folderWaitCheck) == 0) goto finish;
foreach ($folderWaitCheck as $key => $folder) {
    unset($folderWaitCheck[$key]);
    scandirectory($folder, $folderWaitCheck);
}
goto check;
finish:
ob_end_flush();

echo 'done!';
