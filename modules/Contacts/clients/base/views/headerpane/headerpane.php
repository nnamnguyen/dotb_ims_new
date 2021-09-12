<?php


$viewdefs['Contacts']['base']['view']['headerpane'] = array(
    'buttons' => array(
        array(
            'name'    => 'create_button',
            'type'    => 'button',
            'label'   => 'LBL_CREATE_BUTTON_LABEL',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'route' => array(
                'action'=>'create'
            )
        ),
        array(
            'name'    => 'import_vcard_button',
            'type'    => 'button',
            'label'   => 'LBL_IMPORT_VCARD',
            'css_class' => 'btn-primary',
            'acl_action' => 'import',
            'events' => array(
                'click' => 'function(e){
                    app.drawer.open({
                            layout : "vcard-import",
                            context: {
                                create: true
                            }
                        });
                    }'
            ),
        ),

        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
