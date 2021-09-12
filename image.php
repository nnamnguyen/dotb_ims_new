<?php
header('HTTP/1.1 301 Moved Permanently');
header('Location: index.php?entryPoint=image&'.$_SERVER["QUERY_STRING"]);
?>
