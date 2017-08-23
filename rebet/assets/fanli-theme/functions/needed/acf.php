<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_site-settings',
		'title' => 'Site Settings',
		'fields' => array (
			array (
				'key' => 'field_541cf29950c7a',
				'label' => 'General',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_541cf1ff50c78',
				'label' => 'Logo Image',
				'name' => 'logo_image',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_541cf21850c79',
				'label' => 'Favicon Icon',
				'name' => 'favicon_icon',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
?>