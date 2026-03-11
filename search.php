<?php get_header(); 

?>
<div id="content-wrapper">

    <div id="main-content">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); echo 'THIS IS THE FORMAT'.get_post_format(); ?>
            <!-- // this will look for content-{format}.php if the format is standard it will look for content.php -->
            <?php get_template_part('content',get_post_format('search')); ?>
            <!-- // the ability to include a specifc part of our theme inside theme directory     -->
            
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>