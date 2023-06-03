<?php
    get_header();
?>
    <section class="main-section bg-light">
        <div class="container">  
        <?php while(have_posts()) {
            the_post(); ?> 
            <h2><strong><?php the_title(); ?></strong></h2>   
            
           
        <?php  get_search_form(); } ?>
        </div>
        </section>


<?php
    get_footer();
?>