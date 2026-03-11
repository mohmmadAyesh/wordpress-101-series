<?php get_header(); 
/*
Template Name: Portfolio Template
*/
?>
<div id="content-wrapper">

    <div id="main-content">
        <?php 
        $args = array('post_type' => 'portfolio','post_per_page' => 3);
        $loop = new WP_Query($args);
        if ( $loop -> have_posts() ) : 
        while ( $loop -> have_posts() ) : $loop -> the_post(); ?>
        <?php get_template_part('content','archive')?>
        <?php endwhile;
        endif;
        ?>
            

</div>

<?php get_footer(); ?>