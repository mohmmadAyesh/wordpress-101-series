<?php get_header(); ?>

<div class="row">
    <div class="col-xs-12 col-sm-8">
        <?php
        // if that didn't help check .htaccess is writable by everyone
        //  if we have 404 page you need to rollback perma link to plain and the return it back
        if( have_posts() ):
            while( have_posts() ): the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <?php if( has_post_thumbnail() ): ?>
                        <div class="pull-right"><?php the_post_thumbnail('thumbnail'); ?></div>
                    <?php endif; ?>

                    <small><?php 
                    echo awesome_get_terms_list($post->ID,'field'); 
                    ?> ||
                </small>
                <small><?php echo awesome_get_terms_list($post->ID,'software');
                    ?>
                        <?php 
                        // it mean it can edit the post or not 
                             if(current_user_can('manage_options')){
                                echo '||'; edit_post_link();
                             }
                            ?>
                </small>

                    <?php the_content(); ?>
                   
                    
                </article>

            <?php endwhile;
        endif;
        ?>
    </div>


</div>

<?php get_footer(); ?>
