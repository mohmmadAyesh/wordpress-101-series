<?php get_header(); ?>
<div id="content-wrapper">
    <div id="main-content">
        <h1>404 - Page Not Found</h1>
        <p>The page you are looking for does not exist.</p>
    </div>
    <?php the_widget('WP_Widget_Recent_Posts'); ?>
    <div class="widget">
        <h2 class="widget-title">most used Categories</h2>
        <?php get_search_form(); ?>
        <?php the_widget('WP_Widget_Recent_Comments'); ?>
        <ul>
            <!-- title_ti empty string to remove the title of list item -->
             <div class="widget widget_categories">
            
            <?php wp_list_categories(array(
                'order_by' => 'count',
                'order' => 'DESC',
                'show_count' => 1,
                "title_li" => '',
                'number' => 5,
            )); ?>
            </div>
        </ul>
        <!-- unique id for widget archive we accept some parameters whether to accept 
         dropdown or not  -->
         <!-- add it after title parameter -->
        <?php the_widget( 'WP_Widget_Archives', 'dropdown=1', 'after_title=</h2>' ); ?>
</div>
<?php get_footer(); ?>
