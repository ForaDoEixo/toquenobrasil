<?php 

global $wp_query;
$curauth = $wp_query->get_queried_object();
//var_dump($curauth );



?>
<?php get_header(); ?>

<div class="clear"></div>
<div class="prepend-top"></div>

<div class="span-14 prepend-1 right-colborder">

    <div class="item green">
      <div class="title pull-1">
        <div class="shadow"></div>
        <h1><?php echo $curauth->banda; ?></h1>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>

    <div id="intro"><?php echo $curauth->description; ?></div>

    <div class="artist clearfix">
        <?php echo get_avatar($curauth->ID); ?>
      <p>
        Responsável: <?php echo $curauth->responsavel; ?>
        <br/>
        Telefone: <?php echo $curauth->telefone_ddd; ?> <?php echo $curauth->telefone; ?>
        <br/>
        <a href="<?php echo $curauth->site; ?>"><?php echo $curauth->site; ?></a>
        <br/>
        <a href="mailto:<?php echo $curauth->user_email; ?>"><?php echo $curauth->user_email; ?></a>
      </p>
      <div class="thumb span-4">
        <?php 
      	    $medias = get_posts("post_type=images&meta_key=_media_index&author={$curauth->ID}");
        	foreach ($medias as $media){	        
	            $meta = get_post_meta($media->ID, '_wp_attachment_metadata');

//                var_dump($meta[0]);
	            
                preg_match('/(\d{4}\/\d\d\/).+/', $meta[0]['file'], $folder);
                $images_url = get_option('siteurl') . '/wp-content/uploads/';
                
                if (isset($meta[0]['sizes']) && array_key_exists('thumbnail', $meta[0]['sizes'])) {
                    $thumb = $folder[1] . $meta[0]['sizes']['thumbnail']['file'];
                } else {
                    $thumb = $meta[0]['file'];
                }
                
                if (isset($meta[0]['sizes']) && array_key_exists('medium', $meta[0]['sizes'])) {
                    $medium = $folder[1] . $meta[0]['sizes']['medium']['file'];
                } else {
                	$medium = $meta[0]['file'];
                }
                
                if (isset($meta[0]['sizes']) && array_key_exists('large', $meta[0]['sizes'])) {
                    $large = $folder[1] . $meta[0]['sizes']['large']['file'];
                } else {
                	$large = $meta[0]['file'];
                }
                    
                $thumburl = $images_url . $thumb;
                $mediumurl = $images_url . $medium;
                $largeurl = $images_url . $large;
	            
	            echo "<img src='" . $mediumurl ."'>";
	        }
      
        ?>
      </div>
      <div class="span-10 last">
        <?php 
        if(strlen($curauth->youtube)>0){
            $width = 390;
            $height = 317;
            $videoUrl = preg_replace("/\/watch\?v=/", "/v/" ,$curauth->youtube);
        echo  
					"<object width='$width' height='$height' data='$videoUrl?fs=1&amp;hl=en_US&amp;rel=0'>
						<param name='allowScriptAccess' value='always'/>
						<param name='allowFullScreen' value='True'/>
						<param name='movie' value='$videoUrl&autoplay=0&border=0&showsearch=0&enablejsapi=1&playerapiid=ytplayer&fs=1'></param>
						<param name='wmode' value='transparent'></param>
						<embed src='$videoUrl&autoplay=0&border=0&showsearch=0&fs=1' type='application/x-shockwave-flash' wmode='transparent'
							width='$width' height='$height' allowfullscreen='1'></embed>
						</object>
					</div>";
        }
        ?>
      </div>
      <div class="clear"></div>
      <div class="prepend-top"></div>
      <div class="hr"></div>
      <?php 
      
      $medias = get_posts("post_type=music&meta_key=_media_index&author={$curauth->ID}");
        		        
        foreach($medias as $media ){
            echo '<div class="span-4">';
            print_audio_player($media->ID);
            echo $media->post_title;
            echo '</div>';
        }
      
      ?>
</div>

<?php get_footer(); ?>
