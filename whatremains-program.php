


<?php    

    $current_video = get_the_ID();
  	$args = array(  
      'post_type' => array('video_post', 'talk_post'),
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'numberposts' => 2,
      'meta_query' => array(
          array(
              'key' => 'specific_date', // I've set this variable according to your examples
              'value' => date("Y-m-d"),
              'type' => 'DATE',
              'compare' => '>=' // Or > if strictly bigger dates are required
          )
      )
    );
  $loop = new WP_Query( $args ); ?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); 
                            $post->ID = get_the_ID();
                            $is_currently_featured = esc_html( get_post_meta( $post->ID, 'is_currently_featured', true ) ); 
                            $video_title = esc_html( get_post_meta( $post->ID, 'video_title', true ) ); 
                            $video_creator = esc_html( get_post_meta( $post->ID, 'video_creator', true ) ); 
                            $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                            $sign_up_link = esc_html( get_post_meta( $post->ID, 'sign_up_link', true ) ); 
                            $talk_date = esc_html( get_post_meta( $post->ID, 'talk_date', true ) );
                            $duration = esc_html( get_post_meta(  $post->ID, 'video_duration', true ) );

                            $link = get_permalink( $post->ID );
                           ?>

                                    <div class="program_item">
                                    <div class="thumbnail" id="<?php echo  $post->ID ?> ">

                                        <img src="<?php echo $thumbnail_src?>" /> 
                                        
                                        <div class="gradient_overlay"> </div>   

                                        <div class="thumbnail_details">
                                            <div class="standard_button_look">
                                                <h3><?php echo $video_creator?></h3>
                                            </div>
                                            <div class="standard_button_look">
                                                 <?php if( $is_currently_featured == "feature" ||  $is_currently_featured == "has been featured"){?>
                                                    <a href="<?php echo $link?>"><h3 class="can_be_clicked"><?php echo $video_title?></h3></a>
                                                <?php } else {?>
                                                    <h3 ><?php echo $video_title?></h3>
                                                <?php } ?>
                                            </div>

                                            <?php if( $duration != null){?>
                                                <div class="standard_button_look">
                                                    <h3><?php echo $duration?></h3>
                                                </div>
                                            <?php }?>

                                            <?php if( $is_currently_featured == "feature"){?>
                                                <div class="standard_button_look">
                                                    <a href="<?php echo $link?>"><h3 class="can_be_clicked">Watch Now</h3></a>
                                                </div>
                                            <?php }?>
                                           
                                            <?php if( $talk_date != null){?>
                                                <div class="standard_button_look">
                                                    <h3><?php echo $talk_date?></h3>
                                                </div>
                                            <?php }?>
                                                        
                                            
                                            <?php if( $sign_up_link != null){?>
                                                <div class="standard_button_look">
                                                    <a href="<?php echo $sign_up_link?>"><h3 class="can_be_clicked">Sign up</h3></a>
                                                </div>
                                                        
                                            <?php }?>
                            
                                    
                                        </div>
                                    </div>



                                    <div class="contentcolumn">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>

                                    

                            <?php

                           
              
                    
                        endwhile;
                    wp_reset_postdata(); ?>
