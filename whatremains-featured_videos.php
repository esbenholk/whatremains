


<?php    

    $current_video = get_the_ID();
  	$args = array(  
      'post_type' => 'video_post',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby' => 'title', 
      'order' => 'ASC', 
    );
  $loop = new WP_Query( $args ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); 
                            $post->ID = get_the_ID();
                            $is_currently_feature = esc_html( get_post_meta( $post->ID, 'is_currently_featured', true ) ); 
                            $video_title = esc_html( get_post_meta( $post->ID, 'video_title', true ) ); 
                            $video_creator = esc_html( get_post_meta( $post->ID, 'video_creator', true ) ); 
                            $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                            $link = get_permalink( $post->ID );
                           
                            if( $is_currently_feature=="feature" && $post->ID != $current_video){?>
                                    <div class="thumbnail">

                                        <img src="<?php echo $thumbnail_src?>" /> 
                                        
                                        <div class="gradient_overlay"> </div>   

                                        <div class="thumbnail_details">

                                        
                                                 <div class="standard_button_look">
                                                    <h3><?php echo $video_creator?></h3>
                                                </div>
                                                <div class="standard_button_look">
                                                    <a href="<?php echo $link?>"><h3 class="can_be_clicked"><?php echo $video_title?></h3></a>
                                                </div>
                                           
                                                <!-- <div class="standard_button_look">
                                                    <a href="<?php echo $link?>"><h3 class="can_be_clicked">Watch <?php echo $video_title?></h3></a>
                                                </div> -->
                                        </div>
                                    </div>

                                       




                            <?php }

                           
              
                    
                        endwhile;
                    wp_reset_postdata(); ?>
