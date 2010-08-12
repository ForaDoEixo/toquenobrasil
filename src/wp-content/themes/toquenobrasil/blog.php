<?php
/*
  Template Name: Home do blog
*/

?>

<?php get_header(); ?>

<div class="clear"></div>
<div class="prepend-top"></div>

<div class="span-14 prepend-1 right-colborder">
  <?php if ( have_posts() ) : the_post(); ?>
    <div class="item green">
      <div class="title pull-1">
        <div class="shadow"></div>
        <h1><?php the_title(); ?></h1>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      <?php the_content(); ?>
    </div>
    
    <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $wp_query = new WP_Query();
      $wp_query->query('post_type=post'.'&paged='.$paged);
    ?>
    
    <?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    
      <div class="post">
        <div class="post-time span-14">
          <div class="shadow"></div>
          <span><?php the_time("d/m/y"); ?></span>
        </div>
        <div class="span-2 post-comments">
          <span><?php comments_number("0", "1", "%"); ?></span>
        </div>
        <div class="span-12 last">
          <h2 class="span-10">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <div class="clear"></div>
          <div class="post-categories">
            <?php the_category(' ') ?>
          </div>
          <div class="clear"></div>
          <?php the_excerpt(); ?>
          <div class="clear"></div>
          <div class="post-tags">
            <?php the_tags(" "," "," "); ?>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      
    <?php endwhile; endif; wp_reset_query(); ?>
  <?php endif; ?>
</div>

<?php get_sidebar("blog"); ?>

<?php get_footer(); ?>