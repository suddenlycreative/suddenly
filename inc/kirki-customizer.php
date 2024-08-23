<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Technix Panel', 'technix' ),
        'description' => esc_html__( 'Technix Panel Description.', 'technix' ),
    ]
);

// header_top_section
function header_top_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_top_section',
        [
            'title'       => esc_html__( 'Header Info', 'technix' ),
            'description' => esc_html__( 'Header Section Information.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'technix_header_elementor_switch',
            'label'       => esc_html__( 'Header Custom/Elementor Switch', 'technix' ),
            'description' => esc_html__( 'Header Custom/Elementor On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'technix' ),
            'section'     => 'header_top_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
                'header_2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
                'header_3'  => get_template_directory_uri() . '/inc/img/header/header-3.png'
            ],
            'default'     => 'header_1',
            'active_callback' => [
                [
                    'setting' => 'technix_header_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $header_posttype = array(
        'post_type'      => 'tp-header'
    );
    $header_posttype_loop = get_posts($header_posttype);
    $header_post_obj_arr = array();
    foreach($header_posttype_loop as $post){
        $header_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();


    new \Kirki\Field\Select(
        [
            'settings'    => 'technix_header_templates',
            'label'       => esc_html__( 'Elementor Header Template', 'technix' ),
            'section'     => 'header_top_section',
            'placeholder' => esc_html__( 'Choose an option', 'technix' ),
            'choices'     => $header_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'technix_header_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_topbar_switch',
            'label'       => esc_html__( 'Header Topbar Switch', 'technix' ),
            'description' => esc_html__( 'Header Topbar switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );    

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'technix' ),
            'description' => esc_html__( 'Header Right switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_preloader_switch',
            'label'       => esc_html__( 'Header Preloader Switch', 'technix' ),
            'description' => esc_html__( 'Header Preloader switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_search_switch',
            'label'       => esc_html__( 'Header Search Switch', 'technix' ),
            'description' => esc_html__( 'Header Search switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_language_switch',
            'label'       => esc_html__( 'Header Language Switch', 'technix' ),
            'description' => esc_html__( 'Header Language switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_backtotop_switch',
            'label'       => esc_html__( 'Header Back to Top Switch', 'technix' ),
            'description' => esc_html__( 'Header Back to Top switch On/Off', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_button_text',
            'label'    => esc_html__( 'Button Text', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'Get an Quatre ', 'technix' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_button_link',
            'label'    => esc_html__( 'Button URL', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'header_phone',
            'label'    => esc_html__( 'Phone Number', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( '+88 01310-069824', 'technix' ),
            'priority' => 10,
        ]
    );    

    new \Kirki\Field\Text(
        [
            'settings' => 'header_email',
            'label'    => esc_html__( 'Email ID', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'technix@support.com', 'technix' ),
            'priority' => 10,
        ]
    );    

    new \Kirki\Field\Text(
        [
            'settings' => 'header_address',
            'label'    => esc_html__( 'Address Text', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( '734 H, Bryan Burlington, NC 27215', 'technix' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_address_link',
            'label'    => esc_html__( 'Address URL', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => 'https://www.google.com/maps/@36.0758266,-79.4558848,17z',
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings' => 'header_top_office_date',
            'label'    => esc_html__( 'Header Office Date', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'Friday - Jul 27, 2023', 'technix' ),
            'priority' => 10,
        ]
    );
    new \Kirki\Field\Textarea(
        [
            'settings' => 'header_top_office_time',
            'label'    => esc_html__( 'Header Office Time', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( '<i class="fa-solid fa-clock"></i> Open Hours of City Govt. (Mon - Fri: <span>8.00</span> am - <span>6.00</span> pm)', 'technix' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'header_search_logo',
            'label'       => esc_html__( 'Header Search Logo', 'technix' ),
            'description' => esc_html__( 'Theme Search Logo Here', 'technix' ),
            'section'     => 'header_top_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/footer-logo.png',
        ]
    );

    // Consult 
    new \Kirki\Field\Textarea(
        [
            'settings' => 'header_top_consult_text',
            'label'    => esc_html__( 'Header Office Time', 'technix' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'Consult With It Advisor? <a href="#">Click Now</a>', 'technix' ),
            'priority' => 10,
        ]
    );

}
header_top_section();


// header_side_section
function header_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_side_section',
        [
            'title'       => esc_html__( 'Header Side Info', 'technix' ),
            'description' => esc_html__( 'Header Side Information.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Textarea(
        [
            'settings'    => 'header_top_offcanvas_textarea',
            'label'       => esc_html__( 'Offcanvas About Us', 'technix' ),
            'section'     => 'header_side_section',
            'default'     => esc_html__( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'technix' ),
        ]
    );
    // Gallery Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_gallery_text',
            'label'    => esc_html__( 'Gallery Text', 'technix' ),
            'section'  => 'header_side_section',
            'default'  => esc_html__( 'Gallery', 'technix' ),
            'priority' => 10,
        ]
    );

    // Gallery Repeter 
    new \Kirki\Field\Repeater(
        [
            'settings' => 'header_side_gallery_repeater',
            'label'    => esc_html__( 'Gallery', 'technix' ),
            'section'  => 'header_side_section',
            'priority' => 10,
            'fields'   => [
                'gallery_image'   => [
                    'type'        => 'image',
                    'label'       => esc_html__( 'Gallery Image', 'technix' ),
                    'description' => esc_html__( 'Upload Your Gallery Image Hear', 'technix' ),
                    'default'     => '',
                ]
            ],
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_contacts_text',
            'label'    => esc_html__( 'Contacts Text', 'technix' ),
            'section'  => 'header_side_section',
            'default'  => esc_html__( 'Contacts', 'technix' ),
            'priority' => 10,
        ]
    );

}
header_side_section();

// header_social_section
function header_social_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_social_section',
        [
            'title'       => esc_html__( 'Header Social', 'technix' ),
            'description' => esc_html__( 'Header Social URL.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 120,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_facebook_link',
            'label'    => esc_html__( 'Facebook URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_twitter_link',
            'label'    => esc_html__( 'Twitter URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_linkedin_link',
            'label'    => esc_html__( 'Linkedin URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_instagram_link',
            'label'    => esc_html__( 'Instagram URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_youtube_link',
            'label'    => esc_html__( 'Youtube URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_fb_link',
            'label'    => esc_html__( 'Facebook URL', 'technix' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

}
header_social_section();

// header_logo_section
function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'technix' ),
            'description' => esc_html__( 'Header Logo Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 130,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__( 'Header Logo', 'technix' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'technix' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__( 'Header Secondary Logo', 'technix' ),
            'description' => esc_html__( 'Theme Secondary Logo Here', 'technix' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/footer-logo.png',
        ]
    );

}
header_logo_section();


// header_logo_section
function header_breadcrumb_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'technix' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'technix' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'technix' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => __( 'Breadcrumb BG Color', 'technix' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'technix' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#f3fbfe',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Dimensions Control', 'technix' ),
            'description' => esc_html__( 'Description', 'technix' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );
    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__( 'Typography Control', 'technix' ),
            'description' => esc_html__( 'The full set of options.', 'technix' ),
            'section'     => 'header_breadcrumb_section',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

// header_logo_section
function full_site_typography(){
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title'       => esc_html__( 'Typography', 'technix' ),
            'description' => esc_html__( 'Typography Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'full_site_typography_settings',
            'label'       => esc_html__( 'Typography Control', 'technix' ),
            'description' => esc_html__( 'The full set of options.', 'technix' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();

// header_logo_section
function footer_layout_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'technix' ),
            'description' => esc_html__( 'Footer Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'technix' ),
            'choices'     => [
                '1' => esc_html__( '1', 'technix' ),
                '2' => esc_html__( '2', 'technix' ),
                '3' => esc_html__( '3', 'technix' ),
                '4' => esc_html__( '4', 'technix' ),
            ],
        ]
    );


    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'technix_footer_elementor_switch',
            'label'       => esc_html__( 'Footer Custom/Elementor Switch', 'technix' ),
            'description' => esc_html__( 'Footer Custom/Elementor On/Off', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    ); 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout',
            'label'       => esc_html__( 'Footer Layout Control', 'technix' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
                'footer_2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
                'footer_3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
            ],
            'default'     => 'footer_1',
            'active_callback' => [
                [
                    'setting' => 'technix_footer_elementor_switch',
                    'operator' => '==',
                    'value' => false
                ]
            ]
        ]
    );

    $footer_posttype = array(
        'post_type'      => 'tp-footer'
    );
    $footer_posttype_loop = get_posts($footer_posttype);
    $footer_post_obj_arr = array();
    foreach($footer_posttype_loop as $post){
        $footer_post_obj_arr[$post->ID] = $post->post_title;
    }

    wp_reset_postdata();

    new \Kirki\Field\Select(
        [
            'settings'    => 'technix_footer_templates',
            'label'       => esc_html__( 'Elementor Footer Template', 'technix' ),
            'section'     => 'footer_layout_section',
            'placeholder' => esc_html__( 'Choose an option', 'technix' ),
            'choices'     => $footer_post_obj_arr,
            'active_callback' => [
                [
                    'setting' => 'technix_footer_elementor_switch',
                    'operator' => '==',
                    'value' => true
                ]
            ]
        ]
    );



    // footer_layout_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_bg_image',
            'label'       => esc_html__( 'Footer BG Image', 'technix' ),
            'description' => esc_html__( 'Footer Image add/remove', 'technix' ),
            'section'     => 'footer_layout_section',
        ]
    );

    // footer_layout_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_logo_image',
            'label'       => esc_html__( 'Footer Logo Image', 'technix' ),
            'description' => esc_html__( 'Footer Logo add/remove', 'technix' ),
            'section'     => 'footer_layout_section',
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'footer_bg_color',
            'label'       => __( 'Footer BG Color', 'technix' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => '',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_layout_2_switch',
            'label'       => esc_html__( 'Footer Style 2 Switch', 'technix' ),
            'description' => esc_html__( 'Footer Style 2 On/Off', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );      
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_layout_3_switch',
            'label'       => esc_html__( 'Footer Style 3 Switch', 'technix' ),
            'description' => esc_html__( 'Footer Style 3 On/Off', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'technix' ),
                'off' => esc_html__( 'Disable', 'technix' ),
            ],
        ]
    );      

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'technix' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Copyright &copy; 2023 Theme_Pure. All Rights Reserved', 'technix' ),
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_area_links_switch',
            'label'       => esc_html__( 'Footer Area Links On / Off', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => false,
            'priority' => 10,
        ]
    ); 

  
    new \Kirki\Field\Textarea(
        [
            'settings'    => 'footer_area_links',
            'label'       => esc_html__( 'Footer Area Links', 'technix' ),
            'section'     => 'footer_layout_section',
            'default'     => esc_html__( '<a href="#">Terms and conditions</a> 
            <a class="ml-50" href="#"> Privacy policy</a>', 'technix' ),
        ]
    );


    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Dimensions Control', 'technix' ),
            'description' => esc_html__( 'Description', 'technix' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '100px',
                'padding-bottom' => '100px',
            ],
        ]
    );


}
footer_layout_section();

// blog_section
function blog_section(){
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title'       => esc_html__( 'Blog Section', 'technix' ),
            'description' => esc_html__( 'Blog Section Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'technix_blog_btn_switch',
            'label'       => esc_html__( 'Blog BTN On/Off', 'technix' ),
            'section'     => 'blog_section',
            'default'     => true,
            'priority' => 10,
        ]
    ); 

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'technix_blog_cat',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'technix' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'technix_blog_author',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'technix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'technix_blog_date',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'technix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'technix_blog_comments',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'technix' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'technix_blog_btn',
            'label'    => esc_html__( 'Blog Button Text', 'technix' ),
            'section'  => 'blog_section',
            'default'  => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'technix_singleblog_social',
            'label'    => esc_html__( 'Single Blog Social Share', 'technix' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

}
blog_section();


// 404 section
function error_404_section(){
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__( '404 Page', 'technix' ),
            'description' => esc_html__( '404 Page Settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );


    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'technix_error_title',
            'label'    => esc_html__( 'Not Found Title', 'technix' ),
            'section'  => 'error_404_section',
            'default'  => "Page not found",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Textarea(
        [
            'settings' => 'technix_error_desc',
            'label'    => esc_html__( 'Not Found description', 'technix' ),
            'section'  => 'error_404_section',
            'default'  => "Oops! The page you are looking for does not exist. It might have been moved or deleted.",
            'priority' => 10,
        ]
    );

    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'technix_error_link_text',
            'label'    => esc_html__( 'Error Link Text', 'technix' ),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );
}

// slug section
function slug_section(){

    // slug section 
    new \Kirki\Section(
        'slug_section',
        [
            'title'       => esc_html__( 'Custom Slug', 'technix' ),
            'description' => esc_html__( 'This section is for custom post type slug settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 200,
        ]
    );

    // services slug 
    new \Kirki\Field\Text(
        [
            'settings' => 'technix_services_slug',
            'label'    => esc_html__( 'Enter Services Slug', 'technix' ),
            'section'  => 'slug_section',
            'default'  => "services",
            'priority' => 10,
        ]
    );
}
slug_section();

// theme color section
function theme_color_section(){

    // Theme Color Section 
    new \Kirki\Section(
        'theme_color_section',
        [
            'title'       => esc_html__( 'Theme Color', 'technix' ),
            'description' => esc_html__( 'This section is for theme color settings.', 'technix' ),
            'panel'       => 'panel_id',
            'priority'    => 200,
        ]
    );

    // theme color 1
    new \Kirki\Field\Color(
        [
            'settings'    => 'theme_color_1',
            'label'       => __( 'Select Primary Color', 'kirki' ),
            'description' => esc_html__( 'Select theme primary color.', 'kirki' ),
            'section'     => 'theme_color_section',
            'default'     => '#020626',
        ]
    );

    // theme color 2
    new \Kirki\Field\Color(
        [
            'settings'    => 'theme_color_2',
            'label'       => __( 'Select Secondary Color', 'kirki' ),
            'description' => esc_html__( 'Select theme secondary color.', 'kirki' ),
            'section'     => 'theme_color_section',
            'default'     => '#05DAC3',
        ]
    );
}
theme_color_section();