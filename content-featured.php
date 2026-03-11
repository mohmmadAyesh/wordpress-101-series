 <h3><?php the_title(); ?></h3>
             <div class="thumbnail-img"><?php the_post_thumbnail('large'); ?></div>
                <!-- F -> month j -> date Y -> year -->
                <small>Posted on <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> by <?php the_author(); ?></small>
                <p><?php the_content(); ?></p>
                <hr>