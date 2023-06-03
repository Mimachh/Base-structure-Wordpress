<?php 
    get_header();
?>

<section class="main-section bg-light">
    <div class="container">
    <?php 
    while(have_posts()) {
        the_post(); ?> 
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>   
        <?php the_content(); ?>
    <?php }
?>
    </div>
    
</section>

<?php 
    get_footer();
?>