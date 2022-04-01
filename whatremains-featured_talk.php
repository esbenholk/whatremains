<?php    
  	$args = array(  
      'post_type' => 'talk_post',
      'post_status' => 'publish',
      'posts_per_page' => -1, 
      'orderby'           => array( 'meta_value_num' => 'ASC' ),
      'meta_key' => 'specific_date',
    );

  $loop = new WP_Query( $args ); 

  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];



  
  
  while ( $loop->have_posts() ) : $loop->the_post(); 
                $post->ID = get_the_ID();
                $talk_name = esc_html( get_post_meta( $post->ID, 'video_title', true ) ); 
                $talk_creator = esc_html( get_post_meta( $post->ID, 'video_creator', true ) );
                $talk_date = esc_html( get_post_meta( $post->ID, 'talk_date', true ) );
                $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $outputString = preg_replace('/\s+/', '', $talk_name); 
                // $link = "/about-what-remains#$outputString";
                $link = "/about-what-remains#program";
                $sign_up_link = esc_html( get_post_meta( $post->ID, 'sign_up_link', true ) ); 
                $link_text = esc_html( get_post_meta( $post->ID, 'link_text', true ) ); ?>

            <div class="thumbnail_container">

            <div class="thumbnail" id="<?php echo  $outputString?>">
                    <a href="<?php echo  $sign_up_link?>"> <img src="<?php echo $thumbnail_src?>" /> </a>

                   

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
                                    <a href="<?php echo $sign_up_link?>"><h3 class="can_be_clicked"><?php echo $link_text ?> </h3></a>
                                </div>
                            
                        <?php }?>

                    </div>
            </div>

           <?php if (strpos($url,'about') !== false) {?>

                <div class="contentcolumn blockcontent list-item">
                        <?php the_content(); ?>
                </div>
            <?php }?>

            </div>                          

     <?php             
endwhile;
wp_reset_postdata(); ?>

