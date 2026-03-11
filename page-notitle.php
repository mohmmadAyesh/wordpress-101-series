
<?php 
// this template name for specifying to use this template for page-no-template
// Template Name: No Title Page
get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <!-- F -> month j -> date Y -> year -->
        <small>Posted on <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> by <?php the_author(); ?></small>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>