<?php



$layout_defs['OAuthKeys'] = array(
	// list of what Subpanels to show in the DetailView
	'subpanel_setup' => array(
		'tokens' => array(
			'order' => 30,
			'module' => 'OAuthTokens',
			'sort_order' => 'asc',
			'sort_by' => 'token_ts',
			'subpanel_name' => 'ForKeys',
			'get_subpanel_data' => 'tokens',
			'title_key' => 'LBL_TOKENS',
			'top_buttons' => array(
			),

		),
    )
);
