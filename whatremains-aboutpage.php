<?php
/*
Template Name: What Remains Landing Page Template
*/

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Book.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Book.woff" as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Medium.woff" as="font" type="font/woff2" crossorigin="anonymous">
   
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Medium.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Book.ttf" as="font" type="font/ttf" crossorigin="anonymous">



    <?php  
        // $id ='13';
        $id ='3868';
        $sitename = esc_html( get_post_meta(  $id ,'sitename', true ) ); 
        $sitedates = esc_html( get_post_meta( $id , 'sitedates', true ) ); 
        $homelink= esc_html( "/what-remains" ); 
        $next_premiere_date = esc_html( get_post_meta( $id , 'next_premiere_date', true ) );
        $is_festival_live = esc_html( get_post_meta( $id, 'is_festival_live', true ) );
        $link_to_text = esc_html( get_post_meta( $id, 'link_to_text', true ) );
        $all_artists = esc_html( get_post_meta( $id, 'all_artists', true ) );


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
        $fase_sub_headline = esc_html( get_post_meta( $post->ID, 'fase_sub_headline', true ) );

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
                        <h1><?php echo $fase_sub_headline ?></h1>
                        <h2><?php echo $fase_artists ?></h2>
                    </div>
                </div>

                

            </div>
    
    
        <div class="content">
        <div class="entry-title">
             <h1 ><?php the_title(); ?></h1>
             <h1><?php echo $sitedates ?></h1>
             <h1><?php echo $all_artists ?></h1>
            </div>
        
            
      


            <div class="blockcontent">
                <?php the_content(); ?>
            </div>    
            
            <div class="spacer"></div>

            <?php if($link_to_text){?>
                    <div class="standard_button_look">
                        <a href="/what-remains-text" ><h2 class="can_be_clicked"><?php echo $link_to_text?></h2></a>
                    </div>
                    <div class="spacer"></div>

            <?php }?>  
              

             <div id="program">
                <h1><?php echo  $featured_talks_headline?></h1>
                <div class="program_row">
                    <?php echo do_shortcode('[featured_talks]'); ?>    
                </div>
                <div class="spacer"></div>

                <h1><?php echo  $featured_films_headline?></h1>

                <?php echo do_shortcode('[entire_program]'); ?>

             
             
             </div>
             <div class="spacer"></div>

        </div>
     
    <?php endwhile; endif; ?>


    </div>
</div>

<div class="what_remains_footer">
    <div class="container">
        <?php if( $next_premiere_date  != null) {?>
            <div class="standard_button_look">
                <h3><?php echo $next_premiere_date  ?></h3>
            </div>                   
        <?php }  ?>



        <div class="standard_button_look" >
            <a href="<?php  echo $homelink ?>" ><h2 class="can_be_clicked"><?php echo $sitename ?></h2></a>
        </div>
    </div>
    <div class="container">
        <img src="http://videoclub.org.uk/wp2018/wp-content/uploads/2022/03/videoclublogo.png" />           
        <img src="http://videoclub.org.uk/wp2018/wp-content/uploads/2022/03/lottery_Logo_White-CMYK.png" />
    </div>
</div>


</body>


