<?php

class Ticket extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'close_ticket' => array(
                'reqType' => 'POST',
                'path' => array('ticket', 'close'),
                'pathVars' => array(''),
                'method' => 'closeTicket',
            )
        );
    }

    function closeTicket(ServiceBase $api, array $args)
    {
        $GLOBALS['db']->query("update cases set status='Closed' where id='{$args['id']}'");
        return ['success' => 1];
    }
}
