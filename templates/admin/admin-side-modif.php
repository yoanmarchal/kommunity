<?php


/* admin page */

/*   ajoute la thumb au posts dans la partie admin   */
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults)
{
    $defaults['riv_post_thumbs'] = __('Image a la une', 'kommunity');

    return $defaults;
}
function posts_custom_columns($column_name, $id)
{
    if ($column_name === 'riv_post_thumbs') {
        echo the_post_thumbnail('thumb');
    }
}

/* */

function remove_admin_menus()
{
    global $menu;
    // all users
    $restrict = explode(',', 'Links,Comments');
    // non-administrator users
    $restrict_user = explode(',', 'Media,Profile,Appearance,Plugins,Users,Tools,Settings,Dashboard,Posts,Pages');
    // WP localization
    $f = create_function('$v,$i', 'return __($v);');
    array_walk($restrict, $f);
    if (!current_user_can('activate_plugins')) {
        array_walk($restrict_user, $f);
        $restrict = array_merge($restrict, $restrict_user);
    }
    // remove menus
    end($menu);
    while (prev($menu)) {
        $k = key($menu);
        $v = explode(' ', $menu[$k][0]);
        if (in_array(is_null($v[0]) ? '' : $v[0], $restrict)) {
            unset($menu[$k]);
        }
    }
}
add_action('admin_menu', 'remove_admin_menus');

function remove_submenus()
{
    if (!current_user_can('activate_plugins')) {
        global $submenu;
        unset($submenu['edit.php?post_type=agents'][10]); // Removes 'Add New'.
    }
}
add_action('admin_menu', 'remove_submenus');

function hide_button_not_need_adherents()
{
    if ('adherents' == get_post_type()) {
        echo '<style type="text/css">
	 #favorite-actions {display:none;}
    .add-new-h2{display:none;}
	/* navigation */ 

	#additional {}
	.h-ind {width: 70px;display: inline-block;}
	#horaires_adherent, #info_client, #metabox_adresse, #date_bonplan_sortie{display: inline-block;vertical-align: top;}
	#poststuff h3, .metabox-holder h3 {
	font-size: 16px;
	font-weight: bolder;
	padding: 7px 10px;
	margin: 0;
	line-height: 1;
	background: #534741;
	color: white;
	text-shadow: 0 0 0;
	font-family: helvetica;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	h3 span {
	font-weight: bold;
	}
	#poststuff #titlewrap:before {
	content: "Entrez votre titre ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	#content-add_media:before {
	content: "Entrez la description ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	.rwmb-images img {
	width: auto;
	height: auto;
	}
	.rwmb-images li {
	width: auto;
	}
	.rwmb-label {
	display: none;
	}
	
	.wp-media-buttons {
	line-height: 1;
	padding: 0;
	}
	
	#content-add_media:before {
	content: "!";
	padding: 0 6px;
	background: #C00000;
	color: white;
	border-radius: 15px;
	margin-right: 10px;
	-webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.5) inset;
	}
	
    </style>';
    }
}
add_action('admin_head', 'hide_button_not_need_adherents');

function hide_button_not_need_bonsplanssorties()
{
    if ('bonsplanssorties' == get_post_type()) {
        echo '<style type="text/css">
	 #favorite-actions {display:none;}
    .add-new-h2{display:none;}
	/* navigation */ 

	#additional {}
	.h-ind {width: 70px;display: inline-block;}
	#horaires_adherent, #info_client, #metabox_adresse, #date_bonplan_sortie, #metabox_adresse{display: inline-block;vertical-align: top;}
	#poststuff h3, .metabox-holder h3 {
	font-size: 16px;
	font-weight: bolder;
	padding: 7px 10px;
	margin: 0;
	line-height: 1;
	background: #534741;
	color: white;
	text-shadow: 0 0 0;
	font-family: helvetica;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	h3 span {
	font-weight: bold;
	}
	#poststuff #titlewrap:before {
	content: "Entrez votre titre ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	#wp-content-editor-container:before {
	content: "Entrez la description ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	.rwmb-images img {
	width: auto;
	height: auto;
	}
	.rwmb-images li {
	width: auto;
	}
	.rwmb-label {
	display: none;
	}
	#wp-content-media-buttons:before {
	content: "!";
	padding: 0 6px;
	background: #534741;
	color: white;
	border-radius: 15px;
	margin-right: 10px;
	-webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.5) inset;
	}
	
    </style>';
    }
}
add_action('admin_head', 'hide_button_not_need_bonsplanssorties');

function hide_button_not_need_remises()
{
    if ('remises' == get_post_type()) {
        echo '<style type="text/css">
	 #favorite-actions {display:none;}
    .add-new-h2{display:none;}
	/* navigation */ 

	#additional {}
	.h-ind {width: 70px;display: inline-block;}
	#horaires_adherent, #info_client, #metabox_adresse, #date_bonplan_sortie, #metabox_adresse{display: inline-block;vertical-align: top;}
	#poststuff h3, .metabox-holder h3 {
	font-size: 16px;
	font-weight: bolder;
	padding: 7px 10px;
	margin: 0;
	line-height: 1;
	background: #534741;
	color: white;
	text-shadow: 0 0 0;
	font-family: helvetica;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	h3 span {
	font-weight: bold;
	}
	#poststuff #titlewrap:before {
	content: "Entrez votre titre ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	
	#wp-content-editor-container:before {
	content: "Entrez la description ici";
	font-size: 17px;
	background: #534741;
	display: block;
	padding: 7px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	color: white;
	font-weight: bolder;
	-webkit-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.5) inset;
	}
	.rwmb-images img {
	width: auto;
	height: auto;
	}
	.rwmb-images li {
	width: auto;
	}
	.rwmb-label {
	display: none;
	}
	#wp-content-media-buttons:before {
	content: "!";
	padding: 0 6px;
	background: #534741;
	color: white;
	border-radius: 15px;
	margin-right: 10px;
	-webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.5) inset;
	}
	
    </style>';
    }
}
add_action('admin_head', 'hide_button_not_need_remises');

/* empeche un user de voir les media des autres user */
//Manage Your Media Only
function mymo_parse_query_useronly($wp_query)
{
    if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/upload.php') !== false) {
        if (!current_user_can('read_private_posts')) {
            global $current_user;
            $wp_query->set('author', $current_user->id);
        }
    }
}
add_filter('parse_query', 'mymo_parse_query_useronly');

/* end admin page */
