<?php
/*
Template Name: What Remains Landing Page Template
*/

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <?php  
        $id ='13';
        $sitename = esc_html( get_post_meta(  $id ,'sitename', true ) ); 
        $sitedates = esc_html( get_post_meta( $id , 'sitedates', true ) ); 
        $homelink= esc_html( "/what-remains" ); 
        $next_premiere_date = esc_html( get_post_meta( $id , 'next_premiere_date', true ) );
        $is_festival_live = esc_html( get_post_meta( $id, 'is_festival_live', true ) );

        
    ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $sitename ?></title>
	<?php wp_head(); ?>
    
</head>


<div class="what_remains_header">
    <div class="standard_button_look">
        <a href="<?php  echo $homelink ?>" ><h2 class="can_be_clicked"><?php echo $sitename ?></h2></a>
    </div>
    <div class="standard_button_look">
        <h3><?php echo $sitedates ?></h3>
    </div>
    <div class="standard_button_look">
        <a href="#program" ><h2 class="can_be_clicked">CREATORS</h2></a>
    </div>
</div>

<body <?php body_class(); ?>>



<div id="primary">
    <div id="content" role="main">


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $post->ID = get_the_ID();
        $video_url = esc_html( get_post_meta( $post->ID, 'trailer_url', true ) ); 
        $is_trailer_currently_featured =  esc_html( get_post_meta( $post->ID, 'is_trailer_currently_featured', true ) );  
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $is_trailer_currently_featured =  esc_html( get_post_meta( $post->ID, 'is_trailer_currently_featured', true ) );  
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
       
        $fase_headline = esc_html( get_post_meta( $post->ID, 'fase_headline', true ) );
        $fase_artists = esc_html( get_post_meta( $post->ID, 'fase_artists', true ) );

        $featured_films_headline = esc_html( get_post_meta( $post->ID, 'featured_films_headline', true ) );

        
        $featured_talks_headline = esc_html( get_post_meta( $post->ID, 'featured_talks_headline', true ) );

        

        

        ?>
      

            <div id="vimeo-wrapper">
                 <?php if($is_trailer_currently_featured == "yes"){?>
                    <iframe src="https://player.vimeo.com/video/<?php echo $video_url?>?background=1&autoplay=1&loop=1&byline=0&title=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay"></iframe>
                <? } else {?>
                    <img src="<?php echo $thumbnail_src?>" />           
                <?php } ?>
                
                <div class="gradient_overlay">

                    <div class="phase_details">  
                        <h1><?php echo $fase_headline ?></h1>
                        <h2><?php echo $fase_artists ?></h2>
                    </div>

                </div>

                

            </div>
    
    
        <div class="content">
            <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
      


            <div class="blockcontent">
                    <?php the_content(); ?>
            </div>        


        </div>
     
    <?php endwhile; endif; ?>


    </div>
</div>

<div class="what_remains_footer">
    <?php if( $next_premiere_date  != null) {?>
        <div class="standard_button_look">
            <h3><?php echo $next_premiere_date  ?></h3>
        </div>                   
     <?php }  ?> 

    <div class="standard_button_look" >
        <a href="<?php  echo $homelink ?>" ><h2 class="can_be_clicked"><?php echo $sitename ?></h2></a>
    </div>
</div>

</body>


