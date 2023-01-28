<?php
/*
Plugin Name: Custom Functionality Plugin for Siecus site
Description: Move functions away from functions.php
Author: Rad Campaign
Version: 0.4
Author URI: http://www.radcampaign.com
License: GPL2
*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_list-page',
		'title' => 'List Page',
		'fields' => array (
			array (
				'key' => 'field_5413309c48a80',
				'label' => 'List Item',
				'name' => 'list_item',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_541343c6e0a02',
						'label' => 'Header',
						'name' => 'header',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_541343dbe0a03',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'list_page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'priority' => 'high',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_resources',
		'title' => 'Single Detail',
		'fields' => array (
			array (
				'key' => 'field_54132f97e2ex2',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',

			),
			array (
				'key' => 'field_54132f97e2ea2',
				'label' => 'Files',
				'name' => 'files',
				'type' => 'file',
				'instructions' => 'Upload PDF\'s so that users can go to the file directly',
				'save_format' => 'url',
				'library' => 'all',
			),
			array (
				'key' => 'field_54401e0150f38',
				'label' => 'File Title',
				'name' => 'file_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54132fe9e2ea3',
				'label' => 'External Link',
				'name' => 'external_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'resources',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'priority' => 'high',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_slides',
		'title' => 'Slides',
		'fields' => array (
			array (
				'key' => 'field_54356c6ac43d9',
				'label' => 'Sub Text',
				'name' => 'slide_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54356c8bc43da',
				'label' => 'Link',
				'name' => 'slide_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'priority' => 'high',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_staff-profiles',
		'title' => 'Staff Profiles',
		'fields' => array (
			array (
				'key' => 'field_54132dd5fbc99',
				'label' => 'First name',
				'name' => 'first_name',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'First Name',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54132df5fbc9a',
				'label' => 'Last Name',
				'name' => 'last_name',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'Last Name',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_54132e12fbc9b',
				'label' => 'Job Title',
				'name' => 'job_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b47ab9ab7f72',
				'label' => 'Organization',
				'name' => 'organization',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b47aba1b7f73',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'staff_profile',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'priority' => 'high',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_events',
		'title' => 'Events',
		'fields' => array (
			array (
				'key' => 'field_54c961bf0732f',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'date_picker',
				'instructions' => 'Use this field if there is no specific start or end time for the event',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 0,
			),
			array (
				'key' => 'field_54c9608eb9561',
				'label' => 'Event Date with Start Time',
				'name' => 'event_time',
				'type' => 'date_time_picker',
				'instructions' => '',
				'show_date' => 'true',
				'date_format' => 'm/d/y',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'false',
			),
			array (
				'key' => 'field_54c961970732e',
				'label' => 'Event Date with End Time',
				'name' => 'event_time_end',
				'type' => 'date_time_picker',
				'show_date' => 'true',
				'date_format' => 'm/d/y',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'false',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'events',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'priority' => 'high',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>
