<?php 
    if(class_exists('Redux')) {
        $font_google = rose_framework::rose_googlefont_option();
        $option_name = 'rose_option';

        Redux::setArgs( 
           $option_name,
            array(
               'display_name' => esc_html__('Rose Options', 'rose'), 
               'display_version' => 'Part 2', 
               'menu_title' => esc_html__('Rose Options', 'rose'), 
               'admin_bar' => false, 
               'page_slug' => 'rose_option',
               'menu_type' => 'submenu',
               'allow_sub_menu' => true, 
           ) 
        );

        Redux::setSection($option_name, array(
            'title'      => esc_html__('General Settings', 'rose'),
            'id'         => 'general',
            'fields'     => array(
                array(
                    'id'       => 'favicon',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Favicon', 'rose' ),
                    'subtitle' => esc_html__( 'Upload a favicon for your website.', 'rose' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'preloader',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Preloader', 'rose' ),
                    'subtitle' => esc_html__( 'Set enable preloader.', 'rose' ),
                    'default'   => '1'
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Header Settings', 'rose'),
            'id'         => 'header',
            'icon'       => 'dashicons  dashicons-archive',
            'fields'     => array(
                array(
                    'id'       => 'logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Logo Image', 'rose' ),
                    'subtitle' => esc_html__( 'Upload a logo for your website.', 'rose' ),
                    'label'    => true,
                ),

                array(
                    'id'       => 'logo_retina',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Retina Logo Image', 'rose' ),
                    'description'=> esc_html__('Some newer devices come with "Retina Display" which , it will make content look sharper and more clear. A retina logo image is the same as the normal logo image, though twice the size and it must be named the exact same as the regular logo image, though with @2x added onto the end of the name.', 'rose'),
                    'label'    => true,
                ),

                array(
                    'id'      => 'header_option',
                    'type'    => 'checkbox',
                    'inline'   => 'true',
                    'title'   => esc_html__( 'Header Options', 'rose' ),
                    'subtitle'    => esc_html__( 'Would you like to add Social/Search box to Header?', 'rose' ),
                    'options' => array(
                        'social_icon'  => esc_html__('Hide Social', 'rose'),
                        'search_icon'    => esc_html__('Hide Search', 'rose'),
                    ),
                    'default'     => array(
                        'social_icon'   => '0',
                        'search_icon'   => '0',
                    )
                ),

                array(
                    'id'             => 'logo_spacing',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'all'            => false,
                    'right'          => false,     // Disable the top
                    'left'           => false,     // Disable the bottom
                    'title'          => esc_html__( 'Set Padding Top and Padding Bottom For Logo', 'rose' ),
                    'units_extended' => 'true', 
                    'subtitle'       => esc_html__( 'Allow your users to set the  top and bottom space for logo.', 'rose' ),
                    'default'        => array(
                        'margin-top'    => '45px',
                        'margin-bottom' => '45px',
                    )
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Social Settings', 'rose'),
            'id'         => 'social',
            'icon'       => 'dashicons-share dashicons-before',
            'fields'     => array(

                array(
                    'id'       => 'fa-facebook',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Facebook', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-twitter',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Twitter', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-google-plus',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google Plus', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-pinterest',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Pinterest', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-linkedin',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Linkedin', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-rss',
                    'type'     => 'text',
                    'title'    => esc_html__( 'RSS', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-instagram',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-skype',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Skype', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-tumblr',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Tumblr', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-vimeo-square',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Vimeo', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),

                array(
                    'id'       => 'fa-yahoo',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Yahoo', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),
                array(
                    'id'       => 'fa-youtube',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Youtube', 'rose' ),
                    'subtitle'  => esc_html__('Leave empty If you don\'t want to display.', 'rose')
                ),

            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Blog Settings', 'rose'),
            'id'         => 'blog',
            'icon'      => 'dashicons-before dashicons-admin-post',
            'fields'     => array(

                array(
                    'id'       => 'blog_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog Style', 'rose'),
                    'subtitle' => esc_html__( 'Set style for your blog page.', 'rose' ),
                    'options'  => array(
                        'blog-standard'      => esc_html__('Blog Standrad', 'rose'),
                        'blog-masonry'       => esc_html__('Blog Masonry', 'rose')
                    ),
                    'default'  => 'blog-standard'
                ),
                array(
                    'id'       => 'blog_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Blog Sidebar', 'rose'),
                    'subtitle' => esc_html__( 'Set sidebar for blog page. Default is right.', 'rose' ),
                    'options'  => array(
                        'no_sidebar'        => esc_html__('No Sidebar', 'rose'),
                        'sidebar_left'      => esc_html__('Sidebar Left', 'rose'),
                        'sidebar_right'     => esc_html__('Sidebar Right', 'rose'),
                    ),
                    'default'  => 'sidebar_right'
                ),

                array(
                    'id'      => 'post_meta',
                    'type'    => 'checkbox',
                    'title'   => esc_html__( 'Meta box', 'rose' ),
                    'options' => array(
                        'blog_meta_author'  => esc_html__('Hide Author', 'rose'),
                        'blog_meta_date'    => esc_html__('Hide Date', 'rose'),
                        'blog_meta_cat' => esc_html__('Hide Category', 'rose'),
                        'blog_meta_comment' => esc_html__('Hide Comment', 'rose'),
                        'blog_meta_tag' => esc_html__('Hide Tag', 'rose'),
                        'blog_related_post' => esc_html__('Hide Related Post', 'rose'),
                        'blog_share_post' => esc_html__('Show Share Post', 'rose')
                    ),
                    'default'   => array(
                        'blog_meta_author'  => '0',
                        'blog_meta_date'    => '0',
                        'blog_meta_cat'     => '0',
                        'blog_meta_comment' => '0',
                        'blog_meta_tag'     => '1',
                        'blog_related_post' => '1',
                        'blog_share_post'   => '0'
                    )
                ),

                array(
                    'id'       => 'related_post_number',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of posts related', 'rose'),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'blog_excerpt',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Excerpt Length', 'rose'),
                    'subtitle'    => esc_html__( 'Set the length excerpt.', 'rose'),
                    'default'  => ''
                ),

                array(
                    'id'       => 'blog_paginate',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Alignment of pagination', 'rose'),
                    'options'  => array(
                        'text-left'      => esc_html__('Align Left', 'rose'),
                        'text-right'      => esc_html__('Align Right', 'rose'),
                        'text-center'      => esc_html__('Align Center', 'rose'),

                    ),
                    'default'  => 'text-left'
                ),


                array(
                   'id' => 'section_blog_start',
                   'type' => 'section',
                   'title' => esc_html__('Blog Home', 'rose'),
                   'indent' => true 
                ),

                array(
                    'id'       => 'blog_heading',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Heading',  'rose'),
                    'subtitle'     => esc_html__('Check this box if you don\'t want to display Heading section on blog page.', 'rose'),
                    'default'  => ''
                ),

                array(
                    'id'       => 'blog_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Heading Title',  'rose'),
                    'required' => array('blog_heading','equals', false ),
                    'default'   => esc_html__('Our Blog', 'rose')
                ),

                array(
                    'id'       => 'blog_attachment',
                    'type'     => 'media',
                    'required' => array('blog_heading','equals', false ),
                    'title'    => esc_html__( 'Heading Background', 'rose' )
                ),

                array(
                    'id'       => 'blog_overlay',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Heading Overlay', 'rose' ),
                    'required' => array('blog_heading','equals', false ),
                    'default'   => 'rgba(255,255,255,0.3)'
                ),

                array(
                    'id'     => 'start_blog_end',
                    'type'   => 'section',
                    'indent' => false,
                ),

                array(
                   'id' => 'section_archive_start',
                   'type' => 'section',
                   'title' => esc_html__('Blog Archive', 'rose'),
                   'indent' => true 
                ),

                array(
                    'id'       => 'archive_heading',
                    'type'     => 'checkbox',
                    'default'  => 0,
                    'title'    => esc_html__( 'Hide Heading',  'rose')
                ),

                array(
                    'id'       => 'archive_overlay',
                    'type'     => 'color_rgba',
                    'required' => array('archive_heading','equals', false ),
                    'title'    => esc_html__( 'Heading Overlay', 'rose' ),
                    'default'   => 'rgba(255,255,255,0.3)'
                ),

                array(
                    'id'       => 'archive_attachment',
                    'type'     => 'media',
                    'required' => array('archive_heading','equals', false ),
                    'title'    => esc_html__( 'Heading Background', 'rose' )
                ),

                array(
                    'id'     => 'section_archive_end',
                    'type'   => 'section',
                    'indent' => false,
                ),

                array(
                   'id' => 'section_single_start',
                   'type' => 'section',
                   'title' => esc_html__('Blog Single', 'rose'),
                   'indent' => true 
                ),

                array(
                    'id'       => 'single_heading',
                    'type'     => 'checkbox',
                    'default'  => 0,
                    'title'    => esc_html__( 'Hide Heading',  'rose')
                ),

                array(
                    'id'       => 'single_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Heading Title', 'rose' ),
                    'required' => array('single_heading','equals', false ),
                    'default'   => esc_html__('Blog Single', 'rose')
                ),

                array(
                    'id'       => 'single_overlay',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Heading Overlay', 'rose' ),
                    'required' => array('single_heading','equals', false ),
                    'default'   => 'rgba(255,255,255,0.3)'
                ),

                array(
                    'id'       => 'single_attachment',
                    'type'     => 'media',
                    'required' => array('single_heading','equals', false ),
                    'title'    => esc_html__( 'Heading Background', 'rose' )
                ),

                array(
                    'id'     => 'section_single_end',
                    'type'   => 'section',
                    'indent' => false,
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Portfolio Settings', 'rose'),
            'id'         => 'portfolio_setting',
            'icon'       => 'dashicons dashicons-portfolio',
            'fields'     => array(
                array(
                    'id'       => 'portfolio_url',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Portfolio Page', 'rose'),
                    'subtitle' => esc_html__( 'Enter the url of portfolio template.', 'rose' ),
                    'default'  => esc_url(home_url('/'))
                ),
                array(
                    'id'       => 'portfolio_nav',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Project Navigation', 'rose'),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'portfolio_text_visit',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Text Button Vist Project', 'rose'),
                    'default'  => esc_html__('Visit project', 'rose')
                ),

                array(
                    'id'       => 'portfolio_animation',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Reveal Items', 'rose'),
                    'subtitle' => esc_html__('Your animations will be revealed when the user scrolls.', 'rose'),
                ),

                array(
                    'id'       => 'portfolio_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sidebar Of Single portfolio', 'rose'),
                    'options'  => array(
                        'full_width'        => esc_html__('Sidebar Full Width', 'rose'),
                        'sidebar_left'      => esc_html__('Sidebar Left', 'rose'),
                        'sidebar_right'     => esc_html__('Sidebar Right', 'rose'),
                        'no_sidebar'        => esc_html__('No Sidebar', 'rose'),
                    ),
                    'default'  => 'sidebar_right'
                ),

                array(
                    'id'       => 'portfolio_single_heading',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Project Heading',  'rose'),
                    'default'   => '1'
                ),

                array(
                    'id'       => 'portfolio_single_social',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Show Share Project',  'rose'),
                    'default'   => '1'
                ),

                array(
                   'id' => 'section_archive-start',
                   'type' => 'section',
                   'title' => esc_html__('Archive Portfolio Options', 'rose'),
                   'indent' => true 
                ),

                array(
                    'id'       => 'portfolio_heading',
                    'type'     => 'checkbox',
                    'default'  => 0,
                    'title'    => esc_html__( 'Hide Heading',  'rose')
                ),

                array(
                    'id'       => 'portfolio_overlay',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Heading Overlay', 'rose' ),
                    'required' => array('portfolio_heading','equals', false ),
                    'default'   => 'rgba(255,255,255,0.3)'
                ),

                array(
                    'id'       => 'portfolio_attachment',
                    'type'     => 'media',
                    'required' => array('portfolio_heading','equals', false ),
                    'title'    => esc_html__( 'Heading Background', 'rose' )
                ),

                array(
                    'id'       => 'portfolio_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Style', 'rose'),
                    'options'  => array(
                        'style1'     => esc_html__('Modern', 'rose'),
                        'style2'      => esc_html__('Grid', 'rose'),
                        'style3'     => esc_html__('Masonry', 'rose'),
                    ),
                    'default'  => 'style1'
                ),

                array(
                    'id'       => 'caption_pos',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Caption Position', 'rose'),
                    'options'  => array(
                        'caption-middle'       => esc_html__( 'Middle', 'rose' ),
                        'caption-bottom'       => esc_html__( 'Bottom', 'rose' ),
                    ),
                    'default'  => 'caption-middle'
                ),

                array(
                    'id'       => 'category_pos',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Categories Position', 'rose'),
                    'options'  => array(
                        'bottom'       => esc_html__( 'Under Title', 'rose' ),
                        'top'       => esc_html__( 'Above Title', 'rose' ),
                    ),
                    'default'  => 'bottom'
                ),

                array(
                    'id'      => 'arichive_option',
                    'type'    => 'checkbox',
                    'title'   => esc_html__( 'Options', 'rose' ),
                    'options' => array(
                        'category' => esc_html__('Hide Category', 'rose'),
                        'line'     => esc_html__('Hide Line', 'rose'),
                        'favorite' => esc_html__('Hide Favorite', 'rose'),
                        'arrow' => esc_html__('Hide Arrow', 'rose'),
                    )
                ),

                array(
                    'id'       => 'show_post',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Show Projects',  'rose'),
                    'subtitle'     => esc_html__('Show the post on the page.', 'rose'),
                    'default'   => 8
                ),

                array(
                    'id'       => 'effect',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Hover Effect', 'rose'),
                    'required' => array('caption_pos','=', 'caption-middle'),
                    'options'  => array(
                        'effet-fade'            => esc_html__( 'Fade', 'rose' ),
                        'effet-push-top'        => esc_html__( 'Push Top', 'rose' ),
                        'effet-push-right'      => esc_html__( 'Push Right', 'rose' ),
                        'effet-push-bottom'     => esc_html__( 'Push Bottom', 'rose' ),
                        'effet-push-left'       => esc_html__( 'Push Left', 'rose' ),
                        'effet-move-top'        => esc_html__( 'Move Top', 'rose' ),
                        'effet-move-right'      => esc_html__( 'Move Right', 'rose' ),
                        'effet-move-bottom'     => esc_html__( 'Move Bottom', 'rose' ),
                        'effet-move-left'       => esc_html__( 'Move Left', 'rose' ),
                        'effet-classic'         => esc_html__( 'Classic', 'rose' ),
                        'effet-zoom-in'         => esc_html__( 'Zoom In', 'rose' ),
                        'effet-flip-y'          => esc_html__( 'Flip Y', 'rose' ),
                        'effet-flip-x'          => esc_html__( 'Flip X', 'rose' ),
                        'effet-slide-top'       => esc_html__( 'Slide Top', 'rose' ),
                        'effet-slide-right'     => esc_html__( 'Slide Right', 'rose' ),
                        'effet-slide-bottom'    => esc_html__( 'Slide Bottom', 'rose' ),
                        'effet-slide-left'      => esc_html__( 'Slide Left', 'rose' ),
                    ),
                    'default'  => 'effet-fade'
                ),

                array(
                    'id'       => 'col_lg',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Large devices - Desktops (≥1200px)', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'col_md',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Medium devices - Desktops (≥992px)', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'col_sm',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Small devices - Tablets (≥768px)', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '2'
                ),

                array(
                    'id'       => 'col_xs',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Extra small devices - Phones (<768px)', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '1'
                ),

                array(
                    'id'       => 'vertical',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Vertical Space', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'subtitle' => esc_html__( 'Specifies a left padding in percent of the width of the containing element.', 'rose' ),
                    'options'  => array(
                        '0'             => esc_html__( 'No Vertical', 'rose' ),
                        '5'             => esc_html__( '5px', 'rose' ),
                        '10'            => esc_html__( '10px', 'rose' ),
                        '15'            => esc_html__( '15px', 'rose' ),
                        '20'            => esc_html__( '20px', 'rose' ),
                        '25'            => esc_html__( '25px', 'rose' ),
                        '30'            => esc_html__( '30px', 'rose' ),
                    ),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'horizontal',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Horizontal Space', 'rose'),
                    'required' => array('portfolio_style', 'contains', array( 'style2','style3' ) ),
                    'subtitle' => esc_html__( 'Specifies a bottom padding in percent of the width of the containing element.', 'rose' ),
                    'options'  => array(
                        '0'             => esc_html__( 'No Horizontal', 'rose' ),
                        '5'             => esc_html__( '5px', 'rose' ),
                        '10'            => esc_html__( '10px', 'rose' ),
                        '15'            => esc_html__( '15px', 'rose' ),
                        '20'            => esc_html__( '20px', 'rose' ),
                        '25'            => esc_html__( '25px', 'rose' ),
                        '30'            => esc_html__( '30px', 'rose' ),
                    ),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'paging',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Pagination', 'rose'),
                    'options'  => array(
                        'click'     => esc_html__( 'Load More', 'rose' ),
                        'scroll'     => esc_html__( 'Infinite Scroll', 'rose' ),
                        'none'     => esc_html__( 'No Pagination', 'rose' ),
                    ),
                    'default'  => 'scroll'
                ),

                array(
                    'id'       => 'order',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Order', 'rose'),
                    'subtitle' => esc_html__( 'Designates the ascending or descending order of the orderby parameter.', 'rose' ),
                    'options'  => array(
                        'DESC'     => esc_html__( 'Descending', 'rose' ),
                        'ASC'      => esc_html__( 'Ascending', 'rose' )
                    ),
                    'default'  => 'DESC'
                ),

                array(
                    'id'       => 'orderby',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Order By', 'rose'),
                    'subtitle' => esc_html__( 'Sort retrieved projects by parameter.', 'rose' ),
                    'options'  => array(
                        'date'       => esc_html__( 'Date', 'rose' ),
                        'title'      => esc_html__( 'Title', 'rose' )
                    ),
                    'default'  => 'date'
                ),

                array(
                    'id'     => 'section-arich-end',
                    'type'   => 'section',
                    'indent' => false,
                ),

                array(
                    'id'       => 'portfolio_related',
                    'type'     => 'checkbox',
                    'title'    => esc_html__( 'Hide Portfolio Related',  'rose'),
                    'default'   => '1'
                ),

                array(
                   'id' => 'section_related-start',
                   'type' => 'section',
                   'required' => array('portfolio_related','=', false),
                   'title' => esc_html__('Related Projects', 'rose'),
                   'indent' => true 
                ),

                array(
                    'id'       => 'related_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Related Title', 'rose'),
                    'default'  => esc_html__('You may also like', 'rose')
                ),

                array(
                    'id'       => 'related_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Style', 'rose'),
                    'options'  => array(
                        'style1'     => esc_html__('Modern', 'rose'),
                        'style2'      => esc_html__('Grid', 'rose'),
                        'style3'     => esc_html__('Masonry', 'rose'),
                    ),
                    'default'  => 'style2'
                ),

                array(
                    'id'       => 'related_caption_pos',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Caption Position', 'rose'),
                    'options'  => array(
                        'caption-middle'       => esc_html__( 'Middle', 'rose' ),
                        'caption-bottom'       => esc_html__( 'Bottom', 'rose' ),
                    ),
                    'default'  => 'caption-middle'
                ),

                array(
                    'id'       => 'related_category_pos',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Categories Position', 'rose'),
                    'options'  => array(
                        'bottom'       => esc_html__( 'Under Title', 'rose' ),
                        'top'       => esc_html__( 'Above Title', 'rose' ),
                    ),
                    'default'  => 'bottom'
                ),

                array(
                    'id'      => 'related_options',
                    'type'    => 'checkbox',
                    'title'   => esc_html__( 'Options', 'rose' ),
                    'options' => array(
                        'category' => esc_html__('Hide Category', 'rose'),
                        'line'     => esc_html__('Hide Line', 'rose'),
                        'favorite' => esc_html__('Hide Favorite', 'rose'),
                        'arrow' => esc_html__('Hide Arrow', 'rose'),
                    )
                ),

                array(
                    'id'       => 'portfolio_related_post',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Show Projects',  'rose'),
                    'subtitle'     => esc_html__('Show the post on the page.', 'rose'),
                    'default'   => 4
                ),

                array(
                    'id'       => 'related_effect',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Hover Effect', 'rose'),
                    'required' => array('related_caption_pos','=', 'caption-middle'),
                    'options'  => array(
                        'effet-fade'            => esc_html__( 'Fade', 'rose' ),
                        'effet-push-top'        => esc_html__( 'Push Top', 'rose' ),
                        'effet-push-right'      => esc_html__( 'Push Right', 'rose' ),
                        'effet-push-bottom'     => esc_html__( 'Push Bottom', 'rose' ),
                        'effet-push-left'       => esc_html__( 'Push Left', 'rose' ),
                        'effet-move-top'        => esc_html__( 'Move Top', 'rose' ),
                        'effet-move-right'      => esc_html__( 'Move Right', 'rose' ),
                        'effet-move-bottom'     => esc_html__( 'Move Bottom', 'rose' ),
                        'effet-move-left'       => esc_html__( 'Move Left', 'rose' ),
                        'effet-classic'         => esc_html__( 'Classic', 'rose' ),
                        'effet-zoom-in'         => esc_html__( 'Zoom In', 'rose' ),
                        'effet-flip-y'          => esc_html__( 'Flip Y', 'rose' ),
                        'effet-flip-x'          => esc_html__( 'Flip X', 'rose' ),
                        'effet-slide-top'       => esc_html__( 'Slide Top', 'rose' ),
                        'effet-slide-right'     => esc_html__( 'Slide Right', 'rose' ),
                        'effet-slide-bottom'    => esc_html__( 'Slide Bottom', 'rose' ),
                        'effet-slide-left'      => esc_html__( 'Slide Left', 'rose' ),
                    ),
                    'default'  => 'effet-fade'
                ),

                array(
                    'id'       => 'related_col_lg',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Large devices - Desktops (≥1200px)', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'related_col_md',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Medium devices - Desktops (≥992px)', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '3'
                ),

                array(
                    'id'       => 'related_col_sm',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Small devices - Tablets (≥768px)', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '2'
                ),

                array(
                    'id'       => 'related_col_xs',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Extra small devices - Phones (<768px)', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'options'  => array(
                        '1'    => esc_html__( '1 Column', 'rose' ),
                        '2'    => esc_html__( '2 Columns', 'rose' ),
                        '3'    => esc_html__( '3 Columns', 'rose' ),
                        '4'    => esc_html__( '4 Columns', 'rose' ),
                        '5'    => esc_html__( '5 Columns', 'rose' ),
                        '6'    => esc_html__( '6 Columns', 'rose' )
                    ),
                    'default'  => '1'
                ),

                array(
                    'id'       => 'related_vertical',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Vertical Space', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'subtitle' => esc_html__( 'Specifies a left padding in percent of the width of the containing element.', 'rose' ),
                    'options'  => array(
                        '0'             => esc_html__( 'No Vertical', 'rose' ),
                        '5'             => esc_html__( '5px', 'rose' ),
                        '10'            => esc_html__( '10px', 'rose' ),
                        '15'            => esc_html__( '15px', 'rose' ),
                        '20'            => esc_html__( '20px', 'rose' ),
                        '25'            => esc_html__( '25px', 'rose' ),
                        '30'            => esc_html__( '30px', 'rose' ),
                    ),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'related_horizontal',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Horizontal Space', 'rose'),
                    'required' => array('related_style', 'contains', array( 'style2','style3' ) ),
                    'subtitle' => esc_html__( 'Specifies a bottom padding in percent of the width of the containing element.', 'rose' ),
                    'options'  => array(
                        '0'             => esc_html__( 'No Horizontal', 'rose' ),
                        '5'             => esc_html__( '5px', 'rose' ),
                        '10'            => esc_html__( '10px', 'rose' ),
                        '15'            => esc_html__( '15px', 'rose' ),
                        '20'            => esc_html__( '20px', 'rose' ),
                        '25'            => esc_html__( '25px', 'rose' ),
                        '30'            => esc_html__( '30px', 'rose' ),
                    ),
                    'default'  => '0'
                ),

                array(
                    'id'       => 'related_order',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Order', 'rose'),
                    'subtitle' => esc_html__( 'Designates the ascending or descending order of the orderby parameter.', 'rose' ),
                    'options'  => array(
                        'DESC'     => esc_html__( 'Descending', 'rose' ),
                        'ASC'      => esc_html__( 'Ascending', 'rose' )
                    ),
                    'default'  => 'DESC'
                ),

                array(
                    'id'       => 'related_orderby',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Order By', 'rose'),
                    'subtitle' => esc_html__( 'Sort retrieved projects by parameter.', 'rose' ),
                    'options'  => array(
                        'date'       => esc_html__( 'Date', 'rose' ),
                        'title'      => esc_html__( 'Title', 'rose' )
                    ),
                    'default'  => 'date'
                ),

                array(
                    'id'     => 'section_related-end',
                    'type'   => 'section',
                    'indent' => false,
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Twitter Settings', 'rose'),
            'id'         => 'twiter_setting',
            'icon'      => 'dashicons dashicons-twitter',
            'desc'       => wp_kses( __('<a href="http://blog.wiloke.com/how-to-get-twitter-api/" target="_blank">How to get twitter API key?</a>', 'rose'), array('a'=> array('href'=> array(), 'target'=> array())) ),
            'fields'     => array(
                array(
                    'id'       => 'consumer_key',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Comsumer Key', 'rose' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'consumer_secret',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Comsumer Secret', 'rose' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'access_token',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Access Token', 'rose' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'access_token_secret',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Access Token Secret', 'rose' ),
                    'label'    => true,
                ),
                array(
                    'id'       => 'cache_interval',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Cache Interval', 'rose' ),
                    'label'    => true,
                    'default'   => 0
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Footer Settings', 'rose'),
            'id'         => 'footer_setting',
            'icon'      => 'dashicons dashicons-editor-insertmore',
            'fields'     => array(
                array(
                    'id'       => 'footer_text',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Copyright', 'rose' ),
                    'label'    => true,
                    'default'   => esc_html__('COPYRIGHT © 2016 PORTFOLIO. ALL RIGHTS RESERVED', 'rose')
                ),

                array(
                   'id' => 'section-start',
                   'type' => 'section',
                   'title' => esc_html__('Footer Instagram', 'rose'),
                   'indent' => true 
                ),
                array(
                    'id'       => 'instagram_title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Title', 'rose' ),
                    'label'    => true,
                    'default'   => esc_html__('FOLLOW US ON INSTAGRAM', 'rose')
                ),

                array(
                    'id'       => 'instagram_userid',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram User ID', 'rose' ),
                    'label'    => true,
                ),

                array(
                    'id'       => 'instagram_access',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram Access Token', 'rose' ),
                    'label'    => true,
                    'description'=> wp_kses( (__('<a target="_blank" href="http://blog.wiloke.com/find-instagram-user-id-access-token/">Find My Instagram Access Token and User Id</a>', 'rose')), array('a'=>array('href'=>array(), 'title'=>array(), 'target'=>array())) )
                ),

                array(
                    'id'       => 'instagram_access',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram Access Token', 'rose' ),
                    'label'    => true,
                    'description'=> wp_kses( (__('<a target="_blank" href="http://blog.wiloke.com/find-instagram-user-id-access-token/">Find My Instagram Access Token and User Id</a>', 'rose')), array('a'=>array('href'=>array(), 'title'=>array(), 'target'=>array())) )
                ),

                array(
                    'id'       => 'instagram_cache_interval',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Cache Interval', 'rose' ),
                    'default'  => 86400,
                    'subtitle' => esc_html__('Leave empty to clear cache', 'rose')
                ),
                
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Typography', 'rose'),
            'id'         => 'typography',
            'icon'      => 'dashicons dashicons-media-text',
            'fields'     => array(
                array(
                    'id'            => 'rose_google_font',
                    'type'          => 'textarea',
                    'title'         => esc_html__( 'Enter your googlefonts. Note: After you have entered google font, hit Save Changes button then refresh this page.', 'rose' ),
                    'label'         => true,
                    'description'   => wp_kses( 'Enter each google font on the line. For example: <br>http://fonts.googleapis.com/css?family=Roboto+Condensed <br>https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic', array('br' => array())),
                    'default'       => ''
                ),
                array(
                    'id'       => 'rose_font_title',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Title font', 'rose'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
                array(
                    'id'       => 'rose_font_sub_title',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Sub-title font ', 'rose'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
                array(
                    'id'       => 'rose_font_content',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Content font', 'rose'),
                    'options'  => $font_google,
                    'default'  => 'default'
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Color Settings', 'rose'),
            'id'         => 'color_setting',
            'icon'       => 'dashicons dashicons-art',
            'fields'     => array(
                array(
                    'id'       => 'color_paragraph',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Paragraph Color', 'rose' ),
                    'default'   => ''
                ),
                array(
                    'id'       => 'color_title',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Title Color', 'rose' ),
                    'default'   => ''
                ),
                array(
                    'id'       => 'color_hover',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Hover Color', 'rose' ),
                    'default'   => ''
                ),
            )
        ));

        Redux::setSection($option_name, array(
            'title'      => esc_html__('Advanced Settings', 'rose'),
            'id'         => 'custom',
            'icon'      => 'dashicons dashicons-media-code',
            'fields'     => array(
                array(
                    'id'       => 'googlemap_api',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google Map API', 'rose' ),
                    'subtitle' => esc_html__( 'Enter Google Map API here. Go to this link https://developers.google.com/maps/documentation/javascript/get-api-key to create a new key.', 'rose' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'header_code',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Header Code', 'rose' ),
                    'subtitle' => esc_html__( 'The code will be inserted before close &lt;/head> tag.', 'rose' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'footer_code',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Footer Code', 'rose' ),
                    'subtitle' => esc_html__( 'The code will be inserted before close &lt;/body> tag.', 'rose' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom CSS', 'rose' ),
                    'subtitle' => esc_html__( 'Paste your CSS code here.', 'rose' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'   => ''
                ),
                array(
                    'id'       => 'custom_js',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom javascript', 'rose' ),
                    'subtitle' => esc_html__( 'Paste your JS code here.', 'rose' ),
                    'mode'     => 'javascript',
                    'theme'    => 'chrome',
                    'default'  => esc_html__("jQuery(document).ready(function(){\n\n});", 'rose')
                ),
            )
        ));

    }   
 ?>