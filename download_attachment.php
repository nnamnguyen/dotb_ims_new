<?php
if (file_exists('upload/' . $_GET['id'])) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $_GET['name'] . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('upload/' . $_GET['id']));
    readfile('upload/' . $_GET['id']);
    exit;
}