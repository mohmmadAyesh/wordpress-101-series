<!doctype html>
<html lang="en">
<head>
    <meta charset="<?php echo get_bloginfo('charset'); ?>" >
    <title><?php echo get_bloginfo('name'); ?> 
  
    <?php wp_title('||') ?>
</title>
  <!--  the first argument of wp_title is to customize the sperator above -->
<meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <!-- connect wordpress actions to tell wordpress to inject it to header header -->
    <?php wp_head(); ?>
</head>
<?php
// is_home is the page where blog are
// for home page we have is_front_page
if(is_front_page()){
    $awesome_classes = array('awesome-class','my-class');
}else{
    $awesome_classes = array('no-awesome-class');
}
?>
<body <?php body_class($awesome_classes); ?>>
    <img src="<?php header_image(); ?>" alt="Header Image" height="<?php echo get_custom_header()->height; ?>" 
    width="<?php echo get_custom_header()->width; ?>" 
    />
    <div class="search-form-container">
        <?php get_search_form(); ?>
    </div>
    <!-- wp_nav_menu hook accept an array of arguments one of them is the theme location -->
    <?php wp_nav_menu(array('theme_location' => 'primary',
    'container' => false,
    'menu_class' => 'nav navbar-nav navbar-right',
    'walker' => new Walker_Nav_Primary()
    )); ?>
