<?php
global $in_blog;
$in_blog = true;

get_header(); ?>

<div class="clear"></div>
<div class="prepend-top"></div>

<div id="main" class="span-14 prepend-1 right-colborder clearfix">
  <?php if ( have_posts() ) : the_post(); ?>
    <div class="item green clearfix">
      <div class="title pull-1 clearfix">
        <div class="shadow"></div>
        <h1><?php the_title(); ?></h1>
      </div>
    </div>

    <div class="post clearfix">
      <div class="post-time span-14">
        <div class="shadow"></div>
        <div class="data"><div class="dia"><?php the_time("d"); ?></div><div class="mes-ano"><?php the_time("m/Y");?></div></div>
      </div><!-- .post-time -->
      <div class="span-2 post-comments">
        <span><?php comments_number("0", "1", "%"); ?></span>
      </div><!-- .post-comments -->
      <div class="span-12 last">
        <div class="post-categories">
        <?php the_category(' ') ?>
        </div><!-- .post-categories -->
        <div class="clear"></div>
        <?php the_content(); ?>
        <div class="clear"></div>
        <div class="post-tags">
          <p><?php the_tags(" "," "," "); ?></p>
        </div><!-- .post-tags -->
      </div>      
	  <?php comments_template(); ?>     
      <div class="clear"></div>
                        
    </div><!-- .post -->
    <div id="posts-navigation">
        	<?php previous_post_link('<div id="anterior">%link</div>','Post anterior', true); ?>
            <?php next_post_link('<div id="proximo">%link</div>', 'Próximo post', true); ?>            
    </div><!-- #posts-navigation -->
  <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
