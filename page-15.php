<?php get_header(); ?>

<div class="row">

    <div class="col-xs-12">
    <?php 
        $lastBlog = new WP_Query('post_type=post&posts_per_page=1');
        if( $lastBlog->have_posts() ):

            while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>

                <?php get_template_part('content',get_post_format()); ?>

            <?php endwhile;
        endif;
        // this is safeguard to prevent our new query post to affect other query post if we want to use same variabley
        wp_reset_postdata();
    ?>
    </div>

    <div class="col-xs-12 col-sm-8">
        <h1>All Posts</h1>
        <?php

        if( have_posts() ):

            while( have_posts() ): the_post(); ?>

                <?php get_template_part('content',get_post_format()); ?>

            <?php endwhile;

        endif;
        //  offset=1 mean skip the first one
        //   $lastBlog = new WP_Query('type=post&posts_per_page=2&offset=1');
        //  using the array structures
        echo '<hr>';
        echo '<h1>Category 6 Posts</h1>';
        $args_cat = array(
            'include' => '6',
        );
        // store information related to categories
        // we use this so we can control how many post per category
        $categories = get_categories($args_cat);
        foreach($categories as $category):
         $args = array(
     'post_type' => 'post',
     'posts_per_page' => 1,
     'category__in' => $category->term_id, 
     'category__not_in' => array(7), // so in case of category 4 and 6 exist it will exclude the post that have category 4 and include the one that have category 6 
 );
 $lastBlog = new WP_Query($args);
        
         if( $lastBlog->have_posts() ):
             while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>
                 <?php get_template_part('content',get_post_format()); ?>
             <?php endwhile;
         endif;
         wp_reset_postdata();
        endforeach;
        
         ?>
        <hr>
        <!-- // offset=1 mean skip the first one
        // if we didnt use post per page it gonna use the one in reading setting -->
       <h1>tutorial posts</h1>
         <?php
        
         $lastBlog = new WP_Query('post_type=post&posts_per_page=-1&category_name=tutorial');
        if( $lastBlog->have_posts() ):

            while( $lastBlog->have_posts() ): $lastBlog->the_post(); ?>

                <?php get_template_part('content','featured'); ?>

            <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>

    <div class="col-xs-12 col-sm-4">
        <?php get_sidebar(); ?>
    </div>

</div>

<?php get_footer(); ?>
