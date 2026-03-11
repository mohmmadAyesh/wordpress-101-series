<?php get_header(); 

?>
<div id="content-wrapper">
    
    <div id="main-content">
        <?php 
        if ( have_posts() ) : ?>
        <?php
        the_archive_title('<h1 class="archive-title">','</h1>');
        the_archive_description('<p class="taxonomy-description">','</p>');
        ?>
            <?php while ( have_posts() ) : the_post(); echo 'THIS IS THE FORMAT'.get_post_format(); ?>
            <!-- // this will look for content-{format}.php if the format is standard it will look for content.php -->
            <?php get_template_part('content',get_post_format()); ?>
            <!-- // the ability to include a specifc part of our theme inside theme directory     -->
            
            <?php endwhile; ?>
        <div class="col-xs-12 text-center">
            <?php the_posts_navigation();?>
    </div>
        <?php endif; 

        ?>
    </div>

    <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>