<?php    
  	$args = array(  
      'post_type' => 'talk_post',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby' => 'title', 
      'order' => 'ASC', 
    );

  $loop = new WP_Query( $args ); ?>


  <?php while ( $loop->have_posts() ) : $loop->the_post(); 
                $post->ID = get_the_ID();
                $talk_name = esc_html( get_post_meta( $post->ID, 'video_title', true ) ); 
                $talk_creator = esc_html( get_post_meta( $post->ID, 'video_creator', true ) );
                $talk_date = esc_html( get_post_meta( $post->ID, 'talk_date', true ) );
                $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $link = esc_html( "/about-what-remains#$talk_name" ); 
                $sign_up_link = esc_html( get_post_meta( $post->ID, 'sign_up_link', true ) ); ?>


            <div class="thumbnail">

                    <img src="<?php echo $thumbnail_src?>" /> 

                    <div class="gradient_overlay"> </div>   

                    <div class="thumbnail_details">    
                        <div class="standard_button_look">
                            <h3><?php echo $talk_creator?></h3>
                        </div>
                        <div class="standard_button_look">
                            <a href="<?php echo $link?>"><h3 class="can_be_clicked"><?php echo $talk_name?></h3></a>
                        </div>
                    
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

     <?php             
endwhile;
wp_reset_postdata(); ?>

