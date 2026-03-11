<?php get_header(); 

?>
<div id="content-wrapper">

    <div id="main-content">
        <?php 
        $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        echo 'page pagniation'.$current_page;
        $args = array('posts_per_page' => 3,'paged' => $current_page);
        query_posts($args);
        if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); echo 'THIS IS THE FORMAT'.get_post_format(); ?>
            <!-- // this will look for content-{format}.php if the format is standard it will look for content.php -->
            <?php get_template_part('content',get_post_format()); ?>
            <!-- // the ability to include a specifc part of our theme inside theme directory     -->
            
            <?php endwhile; ?>
        <div class="col-xs-6 text-left">
            <?php next_posts_link('<< Older Posts');?>
        </div>
        <div class="col-xs-6 text-right">
            <?php previous_posts_link('Newer Posts >>');?>
        </div>
        <?php endif; 
        wp_reset_query(); // this is to reset the query to the default query that wordpress use in case we want to use the default query after our custom query
        ?>
    </div>

    <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>