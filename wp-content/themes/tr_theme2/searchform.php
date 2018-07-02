<form class="form-inline my-2 my-lg-0" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input type="text" placeholder="    Search" value="<?php echo get_search_query() ?>" name="s" id="s" />
    <button class="search-submit" type="button" id="searchsubmit">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>

</form>