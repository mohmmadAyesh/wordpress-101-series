<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
        <label class="screen-reader-text" for="s"><?php echo esc_html_x( 'Search for:', 'label', 'awesometheme' ); ?></label>
        <input
            type="search"
            id="s"
            class="form-control"
            placeholder="<?php echo esc_attr_x( 'Search posts...', 'placeholder', 'awesometheme' ); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                <span class="sr-only"><?php echo esc_html_x( 'Search', 'submit button', 'awesometheme' ); ?></span>
            </button>
        </span>
    </div>
</form>
