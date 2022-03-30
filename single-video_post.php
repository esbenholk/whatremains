<?php
/*
Template Name: Video Post Template
*/

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Book.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Book.woff" as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="https://videoclub.org.uk/wp2018/wp-content/plugins/whatremains-plugin/fonts/FranklinGothic-Medium.woff" as="font" type="font/woff2" crossorigin="anonymous">


    <?php  
        $id ='3868';
            //  $id ='13';
        $sitename = esc_html( get_post_meta(  $id ,'sitename', true ) ); 
        $sitedates = esc_html( get_post_meta( $id , 'sitedates', true ) ); 
        $homelink= esc_html( "/what-remains" ); 
        $next_premiere_date = esc_html( get_post_meta( $id , 'next_premiere_date', true ) );
        $is_currently_featured = esc_html( get_post_meta( get_the_ID(), 'is_currently_featured', true ) );
        $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $video_url = esc_html( get_post_meta( $post->ID, 'video_url', true ) ); 
        $is_festival_live = esc_html( get_post_meta( $id, 'is_festival_live', true ) );
        $featured_films_headline = esc_html( get_post_meta( $id, 'featured_films_headline', true ) );



        
    ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $sitename ?></title>
	<?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                $post->ID = get_the_ID();
                $blurb = esc_html( get_post_meta( get_the_ID(), 'the_blurb', true ) ); ?>

    <div class="what_remains_header_single_post">
        <div class="standard_button_look">
            <a href="<?php  echo $homelink ?>" ><h2 class="can_be_clicked"><?php echo $sitename ?></h2></a>
        </div>
        <div class="videodetails">
            <div class="standard_button_look">
                <h3><?php echo esc_html( get_post_meta( get_the_ID(), 'video_creator', true ) ); ?></h3>
            </div>
            <div class="standard_button_look">
                <h3><?php echo esc_html( get_post_meta( $post->ID, 'video_title', true ) );  ?></h3>
            </div>
            <div class="standard_button_look">
                <h3>   <?php echo esc_html( get_post_meta( get_the_ID(), 'video_duration', true ) ); ?></h3>
            </div>
        
        </div>

        <?php if ($blurb) {?>
            <h3><?php  echo  $blurb?></h3>
        <?php } ?>
 
  
       
    </div>

    <div id="primary">
        <div id="content" role="main">
            
            <?php if(  $is_currently_featured == "feature"){?>
                        <div class="coverVideo">
                            <iframe id="videoplayer"src="<?php echo $video_url?>?loop=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allow="fullscreen;autoplay; encrypted-media;" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            </iframe>
                            <button id="playbutton" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                    <svg width="125" height="125" viewBox="0 0 125 125" fill="rgba(0,0,0,0);" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M62.5 0C28.0216 0 0 28.0216 0 62.5C0 96.9784 28.0472 125 62.5 125C96.9784 125 125 96.9528 125 62.5C125 28.0216 96.9784 0 62.5 0ZM62.5 116.246C32.8706 116.246 8.75357 92.1294 8.75357 62.5C8.75357 32.8706 32.8706 8.75357 62.5 8.75357C92.1294 8.75357 116.246 32.8706 116.246 62.5C116.246 92.1294 92.1294 116.246 62.5 116.246Z" fill="#FF9A9A"/>
                                    <path d="M95.932 58.825L51.0668 30.0378C49.7142 29.1701 48.0043 29.119 46.6007 29.8846C45.197 30.6503 44.3293 32.1305 44.3293 33.7127V91.2618C44.3293 92.8696 45.197 94.3242 46.6007 95.0899C47.2642 95.4471 47.9788 95.6258 48.6934 95.6258C49.51 95.6258 50.3267 95.3961 51.0668 94.9367L95.932 66.175C97.1826 65.3583 97.9482 63.9802 97.9482 62.5C97.9226 61.0198 97.1826 59.6162 95.932 58.825ZM53.0574 83.2738V41.7262L85.4431 62.5L53.0574 83.2738Z" fill="#FF9A9A"/>
                                    </svg>
                            </button>
                            <img class="cover" id="cover" style="display:none;"src="<?php echo $thumbnail_src?>" />    
                        </div>
                        <script src="https://player.vimeo.com/api/player.js"></script>     
            
                     <? } else {?>
                        <img class="cover" id="cover" src="<?php echo $thumbnail_src?>" />    
            <?php } ?>


            <article class="content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Display movie review contents -->
                <div class="blockcontent">
                    <?php the_content(); ?>
                </div>                
          

                <div class="columns">
                    <div class="contentcolumn">
                    </div>
                    <div  class="videocolumn">
                        <?php if( $is_festival_live){?>
                            <div class="spacer"></div>
                            <h1><?php echo $featured_films_headline?></h1>
                            <?php echo do_shortcode('[featured_videos]'); ?>
                        
                         <?php }?>
                         <?php if( $is_festival_live != "yes"){?>
                            <div class="spacer"></div>
                            <h1><?php echo  $featured_films_headline?></h1>
                            <?php echo do_shortcode('[all_videos]'); ?>
                    
                   <?php }?>
                  
                </div>
                </div>
            </article>
    
        
        </div>
    </div>
    <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>


    <div class="what_remains_footer">
    <div class="container">
        <?php if( $next_premiere_date  != null) {?>
            <div class="standard_button_look">
                <h3><?php echo $next_premiere_date  ?></h3>
            </div>                   
        <?php }  ?>

        <?php if($link_to_text &&  $is_festival_live == "yes"){?>
                    <div class="standard_button_look">
                        <a href="/what-remains-text" ><h2 class="can_be_clicked"><?php echo $link_to_text?></h2></a>
                    </div>
        <?php }?>

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




