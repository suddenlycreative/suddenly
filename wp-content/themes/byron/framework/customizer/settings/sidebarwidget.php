<?php
/**
 * Sidebar Widget setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Sidebar Widget General
$this->sections['byron_sidebar_widget_general'] = array(
	'title' => esc_html__( 'Widget General', 'byron' ),
	'panel' => 'byron_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Widget Bottom Margin', 'byron' ),
				'description' => esc_html__( 'Example: 30px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget',
				'alter' => 'margin-top',
			),
		),
		// Title Widget
		array(
			'id' => 'heading_widget_title',
			'control' => array(
				'type' => 'byron-heading',
				'label' => esc_html__( 'Title Widget', 'byron' ),
			),
		),
		array(
			'id' => 'sidebar_widget_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Widget: Margin', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 0px 0px 5px 0px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget .widget-title',
				),
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'sidebar_widget_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Widget: Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget .widget-title',
				'alter' => 'color',
			),
		),
	),
);

// Widget Search
$this->sections['byron_sidebar_widget_search'] = array(
	'title' => esc_html__( 'Widget: Search', 'byron' ),
	'panel' => 'byron_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_search_form_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-submit:before',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_search_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-field',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'sidebar_widget_search_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_search .search-form .search-field',
				'alter' => 'border-width',
			),
		),
	),
);

// Widget Built-In
$this->sections['byron_sidebar_widget_built_in'] = array(
	'title' => esc_html__( 'Widget: Categories, Archives, Meta...', 'byron' ),
	'panel' => 'byron_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_built_in_list_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Item Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 13px 0px', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget.widget_categories ul li',
					'#sidebar .widget.widget_meta ul li',
					'#sidebar .widget.widget_pages ul li',
					'#sidebar .widget.widget_archive ul li'
				),
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'sidebar_widget_built_in_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'#sidebar .widget.widget_categories ul li a',
					'#sidebar .widget.widget_meta ul li a',
					'#sidebar .widget.widget_pages ul li a',
					'#sidebar .widget.widget_archive ul li a'
				),
				'alter' => 'color',
			),
		),
	),
);

// Widget Tags
$this->sections['byron_sidebar_widget_tags'] = array(
	'title' => esc_html__( 'Widget: Tags', 'byron' ),
	'panel' => 'byron_sidebarwidget',
	'settings' => array(
		array(
			'id' => 'sidebar_widget_tags_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Ex: 2px 8px 2px 8px', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'byron' ),
				'description' => esc_html__( '0px is square.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_space_between',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Space Between Items', 'byron' ),
				'description' => esc_html__( 'Example: 6px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => array(
					'margin-right',
					'margin-bottom'
				),
			),
		),
		array(
			'id' => 'sidebar_widget_tags_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'sidebar_widget_tags_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '#sidebar .widget.widget_tag_cloud .tagcloud a',
				'alter' => 'background-color',
			),
		),
	),
);