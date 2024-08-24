<?php
/**
 * Blog setting for Customizer
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['byron_blog_post'] = array(
	'title' => esc_html__( 'General', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Blog', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'byron' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'byron' ),
				'description' => esc_html__( 'Example: 30px.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'byron' ),
				'type' => 'byron-sortable',
				'object' => 'Byron_Customize_Control_Sorter',
				'choices' => array(
					'title'           => esc_html__( 'Title', 'byron' ),
					'meta'            => esc_html__( 'Meta', 'byron' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'byron' ),
					'readmore'        => esc_html__( 'Read More', 'byron' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'byron' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['byron_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['byron_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['byron_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		// Blog Custom Meta
		array(
			'id' => 'blog_custom_meta',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Meta Style', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Basic', 'byron' ),
					'style-2' => esc_html__( 'Modern', 'byron' ),
				),
			),
		),
		array(
			'id' => 'blog_before_author',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'byron' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'author', 'date' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'byron' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'byron' ),
				'type' => 'byron-sortable',
				'object' => 'Byron_Customize_Control_Sorter',
				'choices' => array(
					'author'     => esc_html__( 'Author', 'byron' ),
					'date'       => esc_html__( 'Date', 'byron' ),
					'comments' => esc_html__( 'Comments', 'byron' ),
					'categories' => esc_html__( 'Categories', 'byron' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'byron-heading',
				'label' => esc_html__( 'Item Meta', 'byron' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['byron_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'byron' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'byron' ),
					'style-2' => esc_html__( 'Excerpt', 'byron' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'byron' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'byron' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'byron' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'byron' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['byron_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'byron' ),
	'panel' => 'byron_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'byron' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'byron' ),
				'type' => 'text',
			),
		),
	),
);

