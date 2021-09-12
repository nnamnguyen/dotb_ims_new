<?php


    $server = new HTTP_WebDAV_Server_iCal();
    $server->ServeICalRequest();
    dotb_cleanup();
