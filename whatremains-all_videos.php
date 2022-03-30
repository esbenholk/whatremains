
<?php    
    $current_video = get_the_ID();
  	$args = array(  
      'post_type' => 'video_post',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby' => 'title', 
      'order' => 'ASC', 
    );
  $loop = new WP_Query( $args ); 
?>

    <?php while ( $loop->have_posts() ) : $loop->the_post(); 
        $post->ID = get_the_ID();
        $is_currently_feature = esc_html( get_post_meta( $post->ID, 'is_currently_featured', true ) ); 
        $video_title = esc_html( get_post_meta( $post->ID, 'video_title', true ) ); 
        $outputString = preg_replace('/\s+/', '', $video_title); 
        $creator_link = "/about-what-remains#$outputString";;
        $video_creator = esc_html( get_post_meta( $post->ID, 'video_creator', true ) ); 
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $link = get_permalink( $post->ID );
        $should_show_on_front_page =  esc_html( get_post_meta( $post->ID, 'should_show_on_front_page', true ) ); 
                           
        
        if( $post->ID != $current_video ){?>
            <div class="thumbnail">
                <?php if( $is_currently_featured == "feature" ||  $is_currently_featured == "has been featured" || $should_show_on_front_page == "yes"){?>
                    <a href="<?php echo $link?>"> <img src="<?php echo $thumbnail_src?>" /></a>
                <?php } else {?>
                    <img src="<?php echo $thumbnail_src?>" />
                <?php } ?>
                                                                          
                <div class="gradient_overlay"> </div>   

                <div class="thumbnail_details">
                    <div class="standard_button_look">
                            <a href="<?php echo  $creator_link?>"><h3><?php echo $video_creator?></h3></a>
                    </div>
                    <div class="standard_button_look">
                            <a href="<?php echo $link?>"><h3 class="can_be_clicked"><?php echo $video_title?></h3></a>
                    </div>
                                                    
                </div>
            </div>

        <?php }
            
endwhile;?>


<?php wp_reset_postdata(); ?>
