<?php
require_once get_template_directory() . '/inc/walker.php';

function awesome_script_enqueue(){
    // first argument simple name that wordpress use that file to enqueue
    // get template directory uri the absolute directory of the theme 
    // third argument is dependecy that css depend on it 
    // version of the file 
    // media parameter last parameter specify if the file has to be printed on all deviecdes or some premium devices
    // inject booststrap styles
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
     
    wp_enqueue_style('awesome-css', get_template_directory_uri() . '/css/awesome.css',array(),'1.0.0','all');
    // the last argument here to specify if javascript printed in footer or in the header if true its in footer otherwise in header
    
    wp_enqueue_script('awesome-js', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
}
// we want to call with an action our function and say to wordpress when he has to execute this function
// add action hook give us the ability to connect wordpress process with our custom function and say to wordpress when he has to execute this function
// we specify when this fucntion attached in case of scripts
add_action('wp_enqueue_scripts', 'awesome_script_enqueue');
function awesome_theme_setup(){
    add_theme_support('menus');
    //first value is the name of the location and the second value is the description of this location
    register_nav_menu('primary', 'Primary Header Navigation');
     register_nav_menu('secondary', 'Footer Navigation');
    add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats',array('aside','image','video'));
add_theme_support('html5',array('search-form')); // this is for the search form to make it html5 and we can style it with css
}
// after theme setup is done we use after_setup_theme
// init in the initialization of the theme
add_action('after_setup_theme', 'awesome_theme_setup');
/*
Sidebar function
*/
function awesome_widget_setup(){
    register_sidebar(
        array(
            "name" => "Sidebar",
            "id" => "sidebar-1",
            "class" => "custom",
            "description" => "Standard Sidebar",
            "before_widget" => '<aside id="%1$s" class="widget %2$s">',
            "after_widget" => "</aside>",
            "before_title" => "<h1 class='widget-title'>",
            "after_title" => "</h1>"
        )
    );
}
add_action('widgets_init', 'awesome_widget_setup');

/*
 head function remove some meta tag from it 
*/
function awesome_remove_version(){
    return '';
}
function awesome_custom_post_type(){
    /* we have an array of necessary information wordpress need to create 
     a custom post type */
     // add new what label gonna used in button to add new custom post
     // if we have a portfolio under another portfolio for example we use 
     // parent_item_colon
    $labels = array(
    'name' => 'Portfolio',
    'singular_name' => 'Portfolio',
    'add_new' => 'Add Portfolio Item',
    'all_items' => 'All Items',
     'add_new_item' => 'Add Item',
     "edit_item" => "Edit Item",
     "new_item" => 'New Item',
     'view_item' => 'View Item',
     "search_item" => 'Search Portfolio',
     'not_found' => 'no items found',
     'not_found_in_trash' => 'No items found in trash',
     'parent_item_colon' => 'Parent Item'
    );
    // publicly_queryable  it means our custom post can be accssed with query
    // we can create a custom slug based on our portfolio that in rewrite argument 
    // query_var it the name lower case that we gonna specify later when we reigster post type
    // we specify if the type has post or have a specific herarchy or not we use hierarchical
    // we specify exceprt in support to have ability to add preview text
    // menu_position the order in the admin panel
    // exclude from search to specify whether to exclude or not from search
    // we grab using capability type the capability of post because we want to use the same capability of post in our custom post type
    $args = array(
        'labels'=> $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'portfolio',
            'with_front' => false,
        ),
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        // 'taxonomies' => array('category','post_tag'),
        // 'taxonomies' => array('type'),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    // first value is the slug that gonna be used everywhere in adminstation or slug
    register_post_type('portfolio', $args);
}
function awesome_custom_taxonomy(){
    // we have option to create two type of taxonomies either hierarchical like category or non hierarchical like tags
    // add new taxonomy hirarchical 
    $labels = array(
        'name' => 'Fields',
        'singular_name' => 'Field',
        'search_items' => 'Search Fields',
        'all_items' => 'All Fields',
        'parent_item' => 'Parent Field',
        'parent_item_colon' => 'Parent Field:',
        'edit_item' => 'Edit Field',
        'update_item' => 'Update Field',
        'add_new_item' => 'Add New Field',
        'new_item_name' => 'New Field Name',
        'menu_name' => 'Fields'
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        // if it false it will not show in the admin panel and we can not add terms to it
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => 
        // if installation is mysite.com if i click on taxonomy without rewrite 
        // it will be mysite.com/development the name of taxonomy
        // with rewrite we click and we have mysite.com/type/development
        array('slug' => 'field')
    );
    register_taxonomy('field', array('portfolio'), $args);
    register_taxonomy('software','portfolio',array(
        'label' => 'Software',
        'rewrite' => array('slug' => 'software'),
        'hierarchical' => false,

    ) );

    // add new taxonomy not hierarchical
}
/*
    Custom Term Function
*/
function awesome_get_terms_list($postID, $term){
    $terms_list = wp_get_post_terms($postID, $term);
    $output = '';
    $i = 0;
    foreach($terms_list as $term){
        $i++;
        if($i > 1){
            $output .= ', ';
        }
        $output .= '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
    }
    return $output;
};
add_action( 'init', 'awesome_custom_post_type', 0 );
add_action( 'init', 'awesome_custom_taxonomy', 1 );

/*
 Ensure rewrite rules include custom post type and taxonomy routes.
 Runs once when switching to this theme.
*/
function awesome_rewrite_flush() {
    awesome_custom_post_type();
    awesome_custom_taxonomy();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'awesome_rewrite_flush' );


// it give us the ability to connect our own custom function to specifc point in wordpress generation
// here we choosed the generator meta tag that is the meta tag that show the version of wordpress in the source code and we want to remove it for security reasons because if we know the version of wordpress we can know the vulnerabilities of this version and attack it
add_filter('the_generator', 'awesome_remove_version');
