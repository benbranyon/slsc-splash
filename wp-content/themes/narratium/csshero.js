function csshero_theme_declarations(){

    // Menu Sidebar
    csshero_config_sidebar('#site-menu-block', '.widget', 'Widgets sidebar');
    csshero_config_menu('#site-menu-block .widget', 'ul', 'Widget menu');
    csshero_declare_item('#basic-sideheader .widget h2', 'Widget caption');

    // site header
    csshero_declare_item('#basic-sideheader', 'Site Header Column');
    csshero_declare_item('#basic-sideheader .site-header-title', 'Site title');
    csshero_declare_item('#basic-sideheader .site-header-subtitle', 'Site subtitle');

    // single post header Elements
    csshero_declare_item('#basic-sideheader .site-typeface-title', 'Object title');
    csshero_declare_item('#basic-sideheader .site-typeface-headline', 'Object subtitle');

    // header meta
    csshero_declare_item('#basic-sideheader .post-item-meta .meta', 'Object meta');

    // header navitagion
    csshero_declare_item('#basic-sideheader .nextprev-buttons > span', 'Header navigation');


    // single post
    csshero_declare_item('body.single-post #site-body h1.post-title', 'Post title');
    csshero_declare_item('body.single-post #site-body h2.post-subtitle', 'Post subtitle');
    csshero_declare_item('body.single-post #site-body .post-item-meta', 'Post meta');
    csshero_config_post('body.single-post #site-body', '.site-body-content', 'Post');
    csshero_declare_item('body.single-post #site-body p .icon-tag', 'Post tags');
    csshero_declare_item('body.single-post .nextprev-buttons > span', 'Post navigation buttons');


    // comments
    //new_csshero_config_comments('#comments','.comments-holder','.comment');
    csshero_config_comments('#comments');

    // respond
    csshero_config_respond('#comments', '#respond');



    // Grid Template
    csshero_declare_item('.template-grid-default .post-item', 'Template post item');
    csshero_declare_item('.template-grid-default .post-item .site-typeface-title', 'Template post item title');
    csshero_declare_item('.template-grid-default .post-item .site-typeface-headline', 'Template post item subtitle');
    csshero_declare_item('.template-grid-default .post-item .post-item-meta', 'Template post item meta');
    csshero_declare_item('.template-grid-default .post-item .by-user', 'Template post item author');




}
