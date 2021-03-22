<?php

add_filter( 'cmb_meta_boxes', 'config_metabox' );

function config_metabox() {

    $args['heading_option'] = array(
        'id'         => 'heading_option',
        'title'      => esc_html__( 'Heading Option', 'rose' ),
        'pages'      => array( 'page'), // Post type
        'context'    => 'side',
        'priority'   => 'default',
        'show_names' => false, // Show field names on the left
        'fields'     => array(

            array(
                'id'        => 'heading_custom',
                'type'      => 'select',
                'default'   => 'visible',
                'options'    => array(
                    'hidden'     => esc_html__('No Heading', 'rose'),
                    'visible'   => esc_html__('Show Heading', 'rose'),
                )
            ),
        )
    );

    $args['heading_setting'] = array(
        'id'         => 'heading_setting',
        'title'      => esc_html__( 'Heading Page', 'rose' ),
        'pages'      => array( 'page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => esc_html__('Title Color', 'rose'),
                'id'   => 'color_title',
                'type' => 'colorpicker',
                'default'  => '',
            ),

            array(
                'name' => esc_html__('Hide Line', 'rose'),
                'id'   => 'hide_line',
                'desc'  => esc_html__('Show or show the line under title', 'rose'),
                'type' => 'checkbox',
            ),

            array(
                'name'      => esc_html__('Line Color', 'rose'),
                'id'        => 'color_line',
                'type'      => 'colorpicker',
                'default'   => '',
            ),

            array(
                'name'      => esc_html__('Description', 'rose'),
                'id'        => 'description',
                'type'      => 'textarea_small'
            ),

            array(
                'name'      => esc_html__('Height', 'rose'),
                'id'        => 'height',
                'type'      => 'text_small'
            ),

            array(
                'name'      => esc_html__('Font Size Title', 'rose'),
                'id'        => 'font_title',
                'type'      => 'text_small'
            ),

            array(
                'name'      => esc_html__('Font Size Description', 'rose'),
                'id'        => 'font_description',
                'type'      => 'text_small'
            ),

            array(
                'name' => esc_html__('Description Color', 'rose'),
                'id'   => 'color_description',
                'type' => 'colorpicker',
                'default'  => '',
            ),

            array(
                'name'      => esc_html__('Alignment', 'rose'),
                'desc'      => esc_html__('Select alignment text. Default text left.', 'rose'),
                'id'        => 'alignment',
                'type'      => 'select',
                'default'   => 'text-left',
                'options'   => array(
                    'text-left'   => esc_html__('Text Left', 'rose'),
                    'text-center' => esc_html__('Text Center', 'rose'),
                    'text-right'     => esc_html__('Text Right', 'rose'),
                )
            ),

            array(
                'name' => esc_html__('Background Overlay', 'rose'),
                'id'   => 'bg_overlay',
                'type' => 'colorpicker',
                'default'  => '',
            ),

            array(
                'name'      => esc_html__('Opacity', 'rose'),
                'id'        => 'bg_opacity',
                'type'      => 'select',
                'default'   => '0.2',
                'desc'      => esc_html__('The opacity property can take a value from 0.0 - 1.0. The lower value, the more transparent.', 'rose'),
                'options'    => array(
                    '0'     => esc_html__('0', 'rose'),
                    '0.1'   => esc_html__('0.2', 'rose'),
                    '0.2'   => esc_html__('0.3', 'rose'),
                    '0.3'   => esc_html__('0.4', 'rose'),
                    '0.4'   => esc_html__('0.5', 'rose'),
                    '0.5'   => esc_html__('0.6', 'rose'),
                    '0.6'   => esc_html__('0.7', 'rose'),
                    '0.7'   => esc_html__('0.8', 'rose'),
                    '0.9'   => esc_html__('0.9', 'rose'),
                    '1'     => esc_html__('1', 'rose')
                )
            ),

            array(
                'name' => esc_html__('Background Image', 'rose'),
                'id'   => 'attachment',
                'type' => 'file',
                'allow' => array( 'attachment' )
            ),
            array(
                'name'      => esc_html__('Background Parallax', 'rose'),
                'id'        => 'parallax',
                'type'      => 'select',
                'default'   => 'bg-scroll',
                'desc'      => esc_html__('Default background scroll.', 'rose'),
                'options'    => array(
                    'bg-scroll'     => esc_html__('Background Scroll', 'rose'),
                    'bg-fixed'      => esc_html__('Background Fixed', 'rose'),
                    'bg-parallax'   => esc_html__('Background Parallax', 'rose')
                )
            ),
            array(
                'name'      => esc_html__('Background Position', 'rose'),
                'id'        => 'bg_position',
                'type'      => 'select',
                'default'   => 'bg-center',
                'desc'      => esc_html__('Sets the starting position of a background image.', 'rose'),
                'options'    => array(
                    'bg-top'      => esc_html__('Background Top', 'rose'),
                    'bg-bottom'   => esc_html__('Background Bottom', 'rose'),
                    'bg-center'   => esc_html__('Background Center', 'rose')
                )
            )
        )
    );

    $args['portfolio_settings'] = array(

        'id'         => 'settings',
        'title'      => esc_html__( 'Portfolio Settings', 'rose' ),
        'pages'      => array( 'page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'dependency_on_template'    => array('=', 'template/portfolio.php'),
        'fields'     => array(
            array(
                'name'          => esc_html__('Specify Menu', 'rose'),
                'id'            => 'menu_specify',
                'type'          => 'select',
                'options'       => rose_framework::wiloke_get_nav_menus(),
                'description'   => esc_html__('As default this page will use the default menu. But You can specify for this page.', 'rose'),
                'default'       => -1
            ),
            array(
                'name'     => esc_html__( 'Content Position', 'rose' ),
                'desc'     => esc_html__( 'Where do you want to display the content in WordPress Editor?', 'rose' ),
                'id'       => 'pos',
                'type'     => 'select',
                'default'  => 'top',
                'options'  => array(
                    'top'       => esc_html__( 'Top', 'rose' ),
                    'bottom'    => esc_html__( 'Bottom', 'rose' )
                )
            ),

            array(
                'name'     => esc_html__( 'Portfolio Style', 'rose' ),
                'id'       => 'style',
                'type'     => 'select',
                'default'  => 'style1',
                'options'  => array(
                    'style1'       => esc_html__( 'Modern', 'rose' ),
                    'style2'       => esc_html__( 'Grid', 'rose' ),
                    'style3'       => esc_html__( 'Masonry', 'rose' ),
                )
            ),
            array(
                'name'     => esc_html__( 'Caption Position', 'rose' ),
                'id'       => 'caption_pos',
                'type'     => 'select',
                'default'  => 'caption-middle',
                'options'  => array(
                    'caption-middle'       => esc_html__( 'Middle', 'rose' ),
                    'caption-bottom'       => esc_html__( 'Bottom', 'rose' ),
                )
            ),
            array(
                'name'     => esc_html__( 'Categories Position', 'rose' ),
                'id'       => 'category_pos',
                'type'     => 'select',
                'default'  => 'bottom',
                'options'  => array(
                    'bottom'       => esc_html__( 'Under Title', 'rose' ),
                    'top'       => esc_html__( 'Above Title', 'rose' ),
                )
            ),
            array(
                'name'     => esc_html__( 'Categories Filter', 'rose' ),
                'desc'     => esc_html__( 'Choose the categories that you want to use for this template.', 'rose' ),
                'id'       => 'term_ids',
                'type'     => 'taxonomy_multicheck',
                'taxonomy' => 'category-portfolio', // Taxonomy Slug
                'inline'   => true
            ),
            array(
                'name'      => esc_html__('Options', 'rose'),
                'desc'      => esc_html__('Show or Hide features filter, category, line, favorite. Default show all.', 'rose'),
                'id'        => 'options',
                'type'      => 'multicheck',
                'inline'    => true,
                'options'   => array(
                    'filter'   => esc_html__('Hide Filter', 'rose'),
                    'category' => esc_html__('Hide Category', 'rose'),
                    'line'     => esc_html__('Hide Line', 'rose'),
                    'favorite' => esc_html__('Hide Favorite', 'rose'),
                    'arrow' => esc_html__('Hide Arrow', 'rose'),
                )
            ),
            array(
                'name' => esc_html__('Show Posts', 'rose'),
                'desc' => esc_html__('Show the posts on the page.', 'rose'),
                'default' => 8,
                'id' => 'show_post',
                'type' => 'text_small'
            ),
            array(
                'name'     => esc_html__( 'Hover Effect', 'rose' ),
                'desc'     => esc_html__( 'Select the hover effect. Default fade.', 'rose' ),
                'id'       => 'effect',
                'type'     => 'select',
                'default'  => 'effet-fade',
                'dependency'    => array('caption_pos' , 'contains','caption-middle'),
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
            ),
            array(
                'name'     => esc_html__( 'Large devices - Desktops (≥1200px)', 'rose' ),
                'id'       => 'col_lg',
                'type'     => 'select',
                'default'  => '3',
                'dependency'    => array('style', 'contains','style2,style3'),
                'options'  => array(
                    '1'    => esc_html__( '1 Column', 'rose' ),
                    '2'    => esc_html__( '2 Columns', 'rose' ),
                    '3'    => esc_html__( '3 Columns', 'rose' ),
                    '4'    => esc_html__( '4 Columns', 'rose' ),
                    '5'    => esc_html__( '5 Columns', 'rose' ),
                    '6'    => esc_html__( '6 Columns', 'rose' )
                ),
            ),

            array(
                'name'     => esc_html__( 'Medium devices - Desktops ≥992px).', 'rose' ),
                'id'       => 'col_md',
                'type'     => 'select',
                'default'  => '3',
                'dependency'    => array('style' , 'contains','style2,style3'),
                'options'  => array(
                    '1'    => esc_html__( '1 Column', 'rose' ),
                    '2'    => esc_html__( '2 Columns', 'rose' ),
                    '3'    => esc_html__( '3 Columns', 'rose' ),
                    '4'    => esc_html__( '4 Columns', 'rose' ),
                    '5'    => esc_html__( '5 Columns', 'rose' ),
                    '6'    => esc_html__( '6 Columns', 'rose' )
                ),
            ),

            array(
                'name'     => esc_html__( 'Small devices - Tablets (≥768px).', 'rose' ),
                'id'       => 'col_sm',
                'type'     => 'select',
                'default'  => '2',
                'dependency'    => array('style' , 'contains','style2,style3'),
                'options'  => array(
                    '1'    => esc_html__( '1 Column', 'rose' ),
                    '2'    => esc_html__( '2 Columns', 'rose' ),
                    '3'    => esc_html__( '3 Columns', 'rose' ),
                    '4'    => esc_html__( '4 Columns', 'rose' ),
                    '5'    => esc_html__( '5 Columns', 'rose' ),
                    '6'    => esc_html__( '6 Columns', 'rose' )
                ),
            ),

            array(
                'name'     => esc_html__( 'Extra small devices - Phones (<768px).', 'rose' ),
                'id'       => 'col_xs',
                'type'     => 'select',
                'default'  => '1',
                'dependency'    => array('style' , 'contains','style2,style3'),
                'options'  => array(
                    '1'    => esc_html__( '1 Column', 'rose' ),
                    '2'    => esc_html__( '2 Columns', 'rose' ),
                    '3'    => esc_html__( '3 Columns', 'rose' ),
                    '4'    => esc_html__( '4 Columns', 'rose' ),
                    '5'    => esc_html__( '5 Columns', 'rose' ),
                    '6'    => esc_html__( '6 Columns', 'rose' )
                ),
            ),
            array(
                'name'     => esc_html__( 'Vertical Space', 'rose' ),
                'desc'     => esc_html__( 'Specifies a left padding in percent of the width of the containing element.', 'rose' ),
                'id'       => 'vertical',
                'type'     => 'select',
                'dependency'    => array('style' , 'contains','style2,style3'),
                'default'  => '0',
                'options'  => array(
                    '0'             => esc_html__( 'No Vertical', 'rose' ),
                    '5'             => esc_html__( '5px', 'rose' ),
                    '10'            => esc_html__( '10px', 'rose' ),
                    '15'            => esc_html__( '15px', 'rose' ),
                    '20'            => esc_html__( '20px', 'rose' ),
                    '25'            => esc_html__( '25px', 'rose' ),
                    '30'            => esc_html__( '30px', 'rose' ),
                ),
            ),

            array(
                'name'     => esc_html__( 'Horizontal Space', 'rose' ),
                'desc'     => esc_html__( 'Specifies a bottom padding in percent of the width of the containing element', 'rose' ),
                'id'       => 'horizontal',
                'type'     => 'select',
                'default'  => '0',
                'dependency'    => array('style' , 'contains','style2,style3'),
                'options'  => array(
                    '0'             => esc_html__( 'No Horizontal', 'rose' ),
                    '5'             => esc_html__( '5px', 'rose' ),
                    '10'            => esc_html__( '10px', 'rose' ),
                    '15'            => esc_html__( '15px', 'rose' ),
                    '20'            => esc_html__( '20px', 'rose' ),
                    '25'            => esc_html__( '25px', 'rose' ),
                    '30'            => esc_html__( '30px', 'rose' ),
                ),
            ),
            array(
                'name'     => esc_html__( 'Pagination', 'rose' ),
                'id'       => 'paging',
                'type'     => 'select',
                'default'  => 'scroll',
                'options'  => array(
                    'click'     => esc_html__( 'Load More Button', 'rose' ),
                    'scroll'     => esc_html__( 'Infinite Scroll', 'rose' ),
                    'hidden'     => esc_html__( 'No Pagination', 'rose' ),
                ),
            ),
            array(
                'name'     => esc_html__( 'Order', 'rose' ),
                'desc'     => esc_html__( 'Designates the ascending or descending order of the orderby parameter. ', 'rose' ),
                'id'       => 'order',
                'type'     => 'select',
                'options'  => array(
                    'DESC'     => esc_html__( 'Descending', 'rose' ),
                    'ASC'      => esc_html__( 'Ascending', 'rose' )
                ),
                'default'  => 'DESC'
            ),
            array(
                'name'     => esc_html__( 'Order By', 'rose' ),
                'desc'     => esc_html__( 'Sort retrieved projects by parameter.', 'rose' ),
                'id'       => 'orderby',
                'type'     => 'select',
                'options'  => array(
                    'date'       => esc_html__( 'Date', 'rose' ),
                    'menu_order' => esc_html__( 'Menu Order', 'rose' ),
                    'title'      => esc_html__( 'Title', 'rose' )
                ),
                'default' => 'date'
            ),
        )
    );

    $args['portfolio_info'] = array(

        'id'         => 'portfolio_info',
        'title'      => esc_html__( 'Portfolio Info', 'rose' ),
        'pages'      => array( 'portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(

            array(
                'name'     => esc_html__( 'Released at:', 'rose' ),
                'id'       => 'date',
                'type'     => 'text_date_timestamp',
            ),
            array(
                'name'     => esc_html__( 'Project Url', 'rose' ),
                'id'       => 'url',
                'type'     => 'text_url',
            ),

            array(
                'name'     => esc_html__( 'Description', 'rose' ),
                'id'       => 'description',
                'type'     => 'textarea',
                'description'   => esc_html__('Allows use the simple html tags.', 'rose')
            ),

            array(
                'name'     => esc_html__( 'Client', 'rose' ),
                'id'       => 'client',
                'type'     => 'textarea',
                'description'   => esc_html__('Allows use the simple html tags.', 'rose')
            ),

            array(
                'name'     => esc_html__( 'Tasks', 'rose' ),
                'id'       => 'tasks',
                'type'     => 'textarea',
            ),
        )
    );

    $args['portfolio_single'] = array(

        'id'         => 'portfolio_single',
        'title'      => esc_html__( 'Header Image Setting', 'rose' ),
        'pages'      => array( 'portfolio'), // Post type
        'context'    => 'side',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'          => esc_html__( 'Header Image', 'rose' ),
                'id'            => 'header_img',
                'type'          => 'file',
                'allow' => array( 'attachment' ),
                'description'   => esc_html__('Upload background for heading of this project. Please note that you don\'t need upload this image if Hide Project Heading is checked(Appearance->Rose Options->Portfolio Settings->Hide Project Heading)', 'rose')
            ),
        )
    );

    $args['team_setting'] = array(

        'id'         => 'team_setting',
        'title'      => esc_html__( 'Team Settings', 'rose' ),
        'pages'      => array( 'team'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Position', 'rose' ),
                'id'       => 'job',
                'type'     => 'text_medium',
            ),
            array(
                'name'     => esc_html__( 'Facebook', 'rose' ),
                'id'       => 'fa-facebook',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Twitter', 'rose' ),
                'id'       => 'fa-twitter',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Google Plus', 'rose' ),
                'id'       => 'fa-google-plus',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Pinterest', 'rose' ),
                'id'       => 'fa-pinterest',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Linkedin', 'rose' ),
                'id'       => 'fa-linkedin',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'RSS', 'rose' ),
                'id'       => 'fa-rss',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Instagram', 'rose' ),
                'id'       => 'fa-instagram',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Skype', 'rose' ),
                'id'       => 'fa-skype',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Tumblr', 'rose' ),
                'id'       => 'fa-tumblr',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Vimeo', 'rose' ),
                'id'       => 'fa-vimeo',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Yahoo', 'rose' ),
                'id'       => 'fa-yahoo',
                'type'     => 'text',
            ),
            array(
                'name'     => esc_html__( 'Youtube', 'rose' ),
                'id'       => 'fa-youtube',
                'type'     => 'text',
            ),
        )
    );

    $args['testimonial_setting'] = array(

        'id'         => 'testimonial_setting',
        'title'      => esc_html__( 'Testimonial Settings', 'rose' ),
        'pages'      => array( 'testimonial'), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Position', 'rose' ),
                'id'       => 'work',
                'type'     => 'text_medium',
            ),
            array(
                'name'     => esc_html__( 'Testimonial', 'rose' ),
                'id'       => 'quote',
                'type'     => 'textarea',
            )
        )
    );

    $args['pricing_setting'] = array(

        'id'         => 'pricing_setting',
        'title'      => esc_html__( 'Pricing Settings', 'rose' ),
        'pages'      => array( 'pricing'), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Price', 'rose' ),
                'id'       => 'price',
                'type'     => 'text_medium',
                'price'
            ),
            
            array(
                'name'     => esc_html__( 'Unit', 'rose' ),
                'id'       => 'unit',
                'type'     => 'text_medium',
            ),

            array(
                'name'     => esc_html__( 'Highlight', 'rose' ),
                'id'       => 'highlights',
                'type'     => 'checkbox',
                'desc'      => esc_html__('Check this box if you want to highlight this pricing.', 'rose')
            ),


            array(
                'name'     => esc_html__( 'Button URL', 'rose' ),
                'id'       => 'link',
                'type'     => 'text'
            ),

            array(
                'name'     => esc_html__( 'Button Text', 'rose' ),
                'id'       => 'text_link',
                'type'     => 'text_medium',
                'desc'      => esc_html__('Enter text for this button', 'rose')
            ),

            array(
                'name'     => esc_html__( 'Packages', 'rose' ),
                'id'       => 'packages',
                'type'     => 'textarea_code',
            ),           
        )
    );

    /**
     * Specify categories for blog layout
     * @since 1.3.5
     */
    $args['blog_layout'] = array(
        'id'         => 'blog_layout',
        'title'      => esc_html__( 'Blog Layout Settings', 'rose' ),
        'pages'      => array( 'page'), // Post type
        'dependency_on_template' => array( 'contains', 'template/blog-masonry.php,template/blog-masonry-nosidebar.php,template/blog-standard.php,template/blog-standard-nosidebar.php'), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'     => esc_html__( 'Specify categories', 'rose' ),
                'id'       => 'is_specify_categories',
                'type'     => 'select',
                'options'  => array(
                    'no'    => esc_html__('Thanks, but no thanks', 'rose'),
                    'yes'   => esc_html__('Yep', 'rose'),
                )
            ),
            array(
                'name'     => esc_html__( 'Select Categories', 'rose' ),
                'desc'     => esc_html__( 'Select categories displayed on the page.', 'rose' ),
                'id'       => 'categories',
                'type'     => 'taxonomy_multicheck',
                'taxonomy' => 'category', // Taxonomy Slug
                'dependency'=> array('is_specify_categories', '=', 'yes'),
                'inline'   => true
            ),  
        )
    );

    return $args;
}
