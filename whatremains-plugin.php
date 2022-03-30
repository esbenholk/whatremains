<?php
/**
 * WordPress Plugin whatremains
 *
 * @version 0.1
 * @author Esben Holk
 */
/*
  Plugin Name: What Remains
  Plugin URI: http://houseofkilling.com
  Description: Plugin for What Remains Video Film Festival - attached to videoclub.uk
  Author: Esben Holk @ HOUSE OF KILLING
  Author URI: http://houseofkilling.com
  License: GPLv3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}





//////ADD VIDEO POST
add_action( 'init', 'create_video_post' );
function create_video_post() {
    register_post_type( 'video_post',
        array(
            'labels' => array(
                'name' => 'WR:Videos',
                'singular_name' => 'Video',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Video',
                'edit' => 'Edit',
                      'view' => 'View',
                'view_item' => 'View Video Page',
                'search_items' => 'Search videoes',
            ),
 
            'public' => true,
            'rewrite' => true,
            'rewrite' => array('slug' => "what-remains"),
            'menu_position' => 1,
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array( '' ),        
        )
    );
}



function flush_rules_on_activate() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
} 
add_action( 'init', 'flush_rules_on_activate' );



add_action( 'init', 'create_talk_post' );
function create_talk_post() {
    register_post_type( 'talk_post',
        array(
            'labels' => array(
                'name' => 'WR:Talks',
                'singular_name' => 'Talk',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Talk',
                'edit' => 'Edit',
                      'view' => 'View',
                'view_item' => 'View Talk Page',
                'search_items' => 'Search Talks',
            ),
 
            'public' => true,
            'menu_position' => 1,
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array( '' ),        
        )
    );
}

/////ADD VIDEO POST META
add_action( 'admin_init', 'my_admin' );
function my_admin() {
    add_meta_box( 'video_meta_box',
        'Video Details',
        'display_video_meta_box',
        'video_post', 'normal', 'high'
        );

    add_meta_box( 'whatremains_landingpage_meta_box',
        'What Remains Page Details *only for WR',
        'display_whatremains_landingpage_meta_box',
        'page', 'advanced', 'high'
    );    
    
    add_meta_box( 'talk_meta_box',
    'Talk Details',
    'display_talk_meta_box',
    'talk_post', 'normal', 'high'
    );
}



/////SPECIFY VIDEO POST META DATA INPUT
function display_video_meta_box( $video_post ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $video_creator = esc_html( get_post_meta( $video_post->ID, 'video_creator', true ) );
    $video_title = esc_html( get_post_meta( $video_post->ID, 'video_title', true ) );
    $video_duration = esc_html( get_post_meta( $video_post->ID, 'video_duration', true ) );
    $is_currently_featured = esc_html( get_post_meta( $video_post->ID, 'is_currently_featured', true ) );
    $video_url= esc_html( get_post_meta( $video_post->ID, 'video_url', true ) );
    $specific_date = esc_html( get_post_meta( $video_post->ID, 'specific_date', true ) );
    $the_blurb = esc_html( get_post_meta( $video_post->ID, 'the_blurb', true ) );
    $should_show_on_front_page = esc_html( get_post_meta( $video_post->ID, 'should_show_on_front_page', true ) );

    ?>
    <table style="background-color: #9bd7ff">
        <tr>
            <td style="width: 100%">
            <strong>Is it currently featured? </strong>input "feature" to feature film and "has been featured" to take it off the program again. any other input means the film has yet to be featured </td>
            <td> 
                <input id="is_featured" name="is_currently_featured" placeholder="type 'feature' to feature film" value="<?php echo $is_currently_featured ?>"></input>          
            </td>

        </tr>
        <tr>
            <td style="width: 100%">Should show on frontpage even tho its not yet featured </td>
            <td> 
                <input id="is_featured" name="should_show_on_front_page" placeholder="type 'yes' to show the movie on front page" value="<?php echo $should_show_on_front_page ?>"></input>          
            </td>

        </tr>
        <tr>
            <td style="width: 100%">Video Creator</td>
            <td><input type="text" size="80" name="video_creator_name" value="<?php echo $video_creator ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">Video Title</td>
            <td><input type="text" size="80" name="video_title_name" value="<?php echo $video_title ?>" /></td>
        </tr>
        <tr>
            <td style="width: 150px">Duration</td>
            <td><input type="text" size="80" name="video_duration" value="<?php echo $video_duration ?>" /></td>
        </tr>

        <tr>
            <td style="width: 150px">The Blurb</td>
            <td> <input type="text" name="the_blurb" id="the_blurb" placeholder="short blurb" value="<?php echo $the_blurb?>"/></td>  
        </tr>  
        <tr>
            <td style="width: 150px">Video Link copied from Vimeo embed (copy first part of vimeo embed link)</td>
            <td> <input type="url" name="video_url" id="url" placeholder="video link"  pattern="https://player.vimeo.com/video/.+"value="<?php echo $video_url?>"/></td>  
        </tr>  
        <tr>
            <td style="width: 150px">number for sorting *required!!!!! lowest number appears first in program</td>
            <td><input type="number" size="80" name="specific_date" value="<?php echo $specific_date ?>" /></td>
        </tr>  
    </table>
    <?php
}

/////SPECIFY LANDING PAGE META DATA INPUT
function display_whatremains_landingpage_meta_box( $page ) {
  
        $trailer_url = esc_html( get_post_meta( $page->ID, 'trailer_url', true ) ); 
        $fase_headline = esc_html( get_post_meta( $page->ID, 'fase_headline', true ) ); 
        $fase_sub_headline = esc_html( get_post_meta( $page->ID, 'fase_sub_headline', true ) ); 
        $fase_artists = esc_html( get_post_meta( $page->ID, 'fase_artists', true ) ); 
        $all_artists = esc_html( get_post_meta( $page->ID, 'all_artists', true ) ); 

        $is_trailer_currently_featured =  esc_html( get_post_meta( $page->ID, 'is_trailer_currently_featured', true ) ); 
        $sitename =  esc_html( get_post_meta( $page->ID, 'sitename', true ) ); 
        $sitedates =  esc_html( get_post_meta( $page->ID, 'sitedates', true ) ); 
        $is_festival_live =  esc_html( get_post_meta( $page->ID, 'is_festival_live', true ) );
        $featured_films_headline =  esc_html( get_post_meta( $page->ID, 'featured_films_headline', true ) ); 
        $featured_talks_headline =  esc_html( get_post_meta( $page->ID, 'featured_talks_headline', true ) );
        $next_premiere_date =  esc_html( get_post_meta( $page->ID, 'next_premiere_date', true ) ); 
        $link_to_text =  esc_html( get_post_meta( $page->ID, 'link_to_text', true ) );
        $livestream_link  =  esc_html( get_post_meta( $page->ID, 'livestream_link', true ) );
        $shoudlshow_livestream_link  =  esc_html( get_post_meta( $page->ID, 'shoudlshow_livestream_link', true ) );
        $link_to_program  =  esc_html( get_post_meta( $page->ID, 'link_to_program', true ) );

        
        ?>

            <p>Update the pink fields every 2 weeks to create a new phase<br> In addition to updating the trailer on the front page and the phase info, dont forget to visit each video to configure if it is featured or not</p>

            <table>  

            <tr style="background-color: red">
                <td style="width: 100%">Site Name</td>    
                <td> <input type="text" name="sitename" id="sitename" placeholder="What Remains" value="<?php echo $sitename?>"/></td>  
            </tr> 
            <tr style="background-color:red">
                <td style="width: 100%">Dates</td>    
                <td> <input type="text" name="sitedates" id="sitedates" placeholder="dates" value="<?php echo $sitedates?>"/></td>  
            </tr> 
            <tr style="background-color: red">
                <td style="width: 100%">Is the festival Live ??? type "yes" to show featured films on front page</td>    
                <td> <input type="text" name="is_festival_live" id="is_festival_live" placeholder="type yes to show featured films" value="<?php echo $is_festival_live?>"/></td>  
            </tr>  
            <tr>
                <td style="width: 150px">All Artists (shows under headline)</td>
                <td> <input type="text" name="all_artists" id="all_artists" placeholder="names of the artists placed below headline" size="100%" value="<?php echo $all_artists?>"/></td>  
            </tr>  
            <div style="height: 30px"></div>
        

            <div style="height: 30px"></div>
            <tr style="background-color: #9bd7ff">
                <td style="width: 100%">Headline for featured films column</td>    
                <td> <input type="text" name="featured_films_headline" id="featured_films_headline" placeholder="fx: 'This periods feature films'" value="<?php echo $featured_films_headline?>"/></td>  
            </tr> 
            <tr style="background-color: rgb(250, 255, 127)">
                <td style="width: 100%">Headline for featured talks column</td>    
                <td> <input type="text" name="featured_talks_headline" id="featured_talks_headline" placeholder="fx: 'we have live talks'" value="<?php echo $featured_talks_headline?>"/></td>  
            </tr>   
            <tr>
                <td style="width: 100%">Text for link-to-text button</td>    
                <td> <input type="text" name="link_to_text" id="link_to_text" placeholder="Exhibition Text'" value="<?php echo $link_to_text?>"/></td>  
            </tr> 
            <tr>
                <td style="width: 100%">Text for link-to-program button</td>    
                <td> <input type="text" name='link_to_program' id="link_to_program" placeholder="About What Remains'" value="<?php echo $link_to_program?>"/></td>  
            </tr>     
       

           
            <tr style="background-color: #FF9A9A">
                <td style="width: 150px">Trailer ID (ID Number from Vimeo: check end of url when on video)</td>
                <td> <input type="text" name="trailer_url" id="trailer_url" placeholder="video id" size="100%" value="<?php echo $trailer_url?>"/></td>  
            </tr>   
            <tr style="background-color: #FF9A9A">
                <td style="width: 100%">Show featured trailer (if not "yes"), page shows image</td>    
                <td> <input type="text" name="is_trailer_currently_featured" id="is_trailer_currently_featured" placeholder="type yes to show trailer" value="<?php echo $is_trailer_currently_featured?>"/></td>  
            </tr> 

            <tr style="background-color: #FF9A9A">
                <td style="width: 150px">Phase Headline</td>
                <td> <input type="text" name="fase_headline" id="fase_headline" placeholder="Headline for the current feature series" size="100%" value="<?php echo $fase_headline?>"/></td>  
            </tr>   
            
            <tr style="background-color: #FF9A9A">
                <td style="width: 150px">Phase Sub Headline</td>
                <td> <input type="text" name="fase_sub_headline" id="fase_sub_headline" placeholder="SubHeadline - could be current dates" size="100%" value="<?php echo $fase_sub_headline?>"/></td>  
            </tr>   

            <tr style="background-color: #FF9A9A">
                <td style="width: 150px">Fase Artists</td>
                <td> <input type="text" name="fase_artists" id="fase_artists" placeholder="Name the artists featured in the phase" size="100%" value="<?php echo $fase_artists?>"/></td>  
            </tr>  
       
            <tr style="background-color: #FF9A9A">
                <td style="width: 150px">Next Premiere Date (write as full sentence ei. "next premiere 16.04")</td>
                <td> <input type="text" name="next_premiere_date" id="next_premiere_date" placeholder="next premiere date" size="100%" value="<?php echo $next_premiere_date?>"/></td>  
            </tr> 


            <div style="height: 30px"></div>
            <tr style="background-color: blue">
                <td style="width: 150px">Should show livestream</td>
                <td> <input type="text" name="shoudlshow_livestream_link" id="shoudlshow_livestream_link" placeholder="write yes to show livestream" size="100%" value="<?php echo $shoudlshow_livestream_link?>"/></td>  
            </tr>      
            <tr style="background-color: blue">
                <td style="width: 150px">facebook livestream link</td>
                <td> <input type="text" name="livestream_link" id="livestream_link" placeholder="facebook link to livestream" size="100%" value="<?php echo $livestream_link?>"/></td>  
            </tr>       
            </table>

<?php }


/////SPECIFY VIDEO POST META DATA INPUT
function display_talk_meta_box( $video_post ) {
    // Retrieve current name of the Director and Movie Rating based on review ID

        // Retrieve current name of the Director and Movie Rating based on review ID
        $video_creator = esc_html( get_post_meta( $video_post->ID, 'video_creator', true ) );
        $video_title = esc_html( get_post_meta( $video_post->ID, 'video_title', true ) );
        $video_duration = esc_html( get_post_meta( $video_post->ID, 'video_duration', true ) );
        $is_currently_featured = esc_html( get_post_meta( $video_post->ID, 'is_currently_featured', true ) );
        $video_url= esc_html( get_post_meta( $video_post->ID, 'video_url', true ) );
        $specific_date = esc_html( get_post_meta( $video_post->ID, 'specific_date', true ) );

        $talk_date = esc_html( get_post_meta( $video_post->ID, 'talk_date', true ) );
        $sign_up_link= esc_html( get_post_meta( $video_post->ID, 'sign_up_link', true ) );
        $link_text= esc_html( get_post_meta( $video_post->ID, 'link_text', true ) );

    
        ?>
        <table style="background-color: rgb(250, 255, 127)">
     
            <tr>
                <td style="width: 100%">Talk Creator</td>
                <td><input type="text" size="80" name="video_creator_name" value="<?php echo $video_creator ?>" /></td>
            </tr>
            <tr>
                <td style="width: 150px">Talk Title</td>
                <td><input type="text" size="80" name="video_title_name" value="<?php echo $video_title ?>" /></td>
            </tr>
            <tr>
            <td style="width: 150px">number for sorting *required!!!!! lowest number appears first in program</td>
                <td><input type="number" size="80" name="specific_date" value="<?php echo $specific_date ?>" /></td>
            </tr>  

            <tr>
                <td style="width: 150px">Date + Time</td>
                <td><input type="text" size="80" name="talk_date" value="<?php echo $talk_date ?>" /></td>
            </tr>
            <tr>
                <td style="width: 150px">Sign up Link (can also be used to link to the recording)</td>
                <td> <input type="url" name="sign_up_link" id="url" placeholder="zoom sign up link" value="<?php echo $sign_up_link?>"/></td>  
            </tr>  
            <tr>
                <td style="width: 150px">Link text </td>
                <td> <input type="text" name="link text" id="url" placeholder="link text" value="<?php echo $link_text?>"/></td>  
            </tr>  
        </table>
    
    <?php
}

////SAVE VIDEO POST META DATA
add_action( 'save_post', 'add_video_fields', 10, 2 );

function add_video_fields( $video_post_id, $video_post) {
    
    // Check if video post
    if ( $video_post->post_type == 'video_post' || $video_post->post_type == 'talk_post') {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['video_creator_name'] ) && $_POST['video_creator_name'] != '' ) {
            update_post_meta( $video_post_id, 'video_creator', $_POST['video_creator_name'] );
        }
        if ( isset( $_POST['is_currently_featured'] ) && $_POST['is_currently_featured'] != '' ) {
            update_post_meta( $video_post_id, 'is_currently_featured', $_POST['is_currently_featured'] );
        }
        if ( isset( $_POST['video_title_name'] ) && $_POST['video_title_name'] != '' ) {
            update_post_meta( $video_post_id, 'video_title', $_POST['video_title_name'] );
        }
        if ( isset( $_POST['video_duration'] ) && $_POST['video_duration'] != '' ) {
            update_post_meta( $video_post_id, 'video_duration', $_POST['video_duration'] );
        }
        if ( isset( $_POST['video_url'] ) && $_POST['video_url'] != '' ) {
            update_post_meta( $video_post_id, 'video_url', $_POST['video_url'] );
        }
        if ( isset( $_POST['the_blurb'] ) && $_POST['the_blurb'] != '' ) {
            update_post_meta( $video_post_id, 'the_blurb', $_POST['the_blurb'] );
        }
        if ( isset( $_POST['should_show_on_front_page'] ) ) {
            update_post_meta( $video_post_id, 'should_show_on_front_page', $_POST['should_show_on_front_page'] );
        }
    }

    if($video_post->post_type == 'talk_post'){
        // Store data in post meta table if present in post data
            if ( isset( $_POST['talk_date'] ) && $_POST['talk_date'] != '' ) {
                update_post_meta( $video_post_id, 'talk_date', $_POST['talk_date'] );
            }
            if ( isset( $_POST['sign_up_link'] ) ) {
                update_post_meta( $video_post_id, 'sign_up_link', $_POST['sign_up_link'] );
            }
            if ( isset( $_POST['link_text'] ) && $_POST['link_text'] != '' ) {
                update_post_meta( $video_post_id, 'link_text', $_POST['link_text'] );
            }
    

    }


    ///save on both video and talk
    if ( isset( $_POST['specific_date'] ) && $_POST['specific_date'] != '' ) {
        update_post_meta( $video_post_id, 'specific_date', $_POST['specific_date'] );
    }

    
    if ( isset( $_POST['program_text'] ) && $_POST['program_text'] != '' ) {
        $data = sanitize_text_field($_POST['program_text']);
        update_post_meta( $video_post_id, 'program_text', $data);
    }

    ////save on pages
    if ( isset( $_POST['trailer_url'] ) && $_POST['trailer_url'] != '' ) {
        update_post_meta( $video_post_id, 'trailer_url', $_POST['trailer_url'] );
    }
    if ( isset( $_POST['fase_headline'] ) && $_POST['fase_headline'] != '' ) {
        update_post_meta( $video_post_id, 'fase_headline', $_POST['fase_headline'] );
    }
    if ( isset( $_POST['fase_sub_headline'] ) && $_POST['fase_sub_headline'] != '' ) {
        update_post_meta( $video_post_id, 'fase_sub_headline', $_POST['fase_sub_headline'] );
    }
    if ( isset( $_POST['fase_artists'] ) && $_POST['fase_artists'] != '' ) {
        update_post_meta( $video_post_id, 'fase_artists', $_POST['fase_artists'] );
    }
    if ( isset( $_POST['all_artists'] ) ) {
        update_post_meta( $video_post_id, 'all_artists', $_POST['all_artists'] );
    }
    if ( isset( $_POST['is_trailer_currently_featured'] ) && $_POST['is_trailer_currently_featured'] != '' ) {
        update_post_meta( $video_post_id, 'is_trailer_currently_featured', $_POST['is_trailer_currently_featured'] );
    }
    if ( isset( $_POST['sitename'] ) && $_POST['sitename'] != '' ) {
        update_post_meta( $video_post_id, 'sitename', $_POST['sitename'] );
    }
    if ( isset( $_POST['sitedates'] ) && $_POST['sitedates'] != '' ) {
        update_post_meta( $video_post_id, 'sitedates', $_POST['sitedates'] );
    }
    if ( isset( $_POST['featured_films_headline'] ) && $_POST['featured_films_headline'] != '' ) {
        update_post_meta( $video_post_id, 'featured_films_headline', $_POST['featured_films_headline'] );
    }
    if ( isset( $_POST['is_festival_live'] ) && $_POST['is_festival_live'] != '' ) {
        update_post_meta( $video_post_id, 'is_festival_live', $_POST['is_festival_live'] );
    }
    if ( isset( $_POST['featured_talks_headline'] ) && $_POST['featured_talks_headline'] != '' ) {
        update_post_meta( $video_post_id, 'featured_talks_headline', $_POST['featured_talks_headline'] );
    }
    if ( isset( $_POST['next_premiere_date'] ) && $_POST['next_premiere_date'] != '' ) {
        update_post_meta( $video_post_id, 'next_premiere_date', $_POST['next_premiere_date'] );
    }
    if ( isset( $_POST['link_to_text'] )) {
        update_post_meta( $video_post_id, 'link_to_text', $_POST['link_to_text'] );
    }
    if ( isset( $_POST['link_to_program'] ) && $_POST['link_to_program'] != '' ) {
        update_post_meta( $video_post_id, 'link_to_program', $_POST['link_to_program'] );
    }
    if ( isset( $_POST['livestream_link'] ) && $_POST['livestream_link'] != '' ) {
        update_post_meta( $video_post_id, 'livestream_link', $_POST['livestream_link'] );
    }
    if ( isset( $_POST['shoudlshow_livestream_link'] ) && $_POST['shoudlshow_livestream_link'] != '' ) {
        update_post_meta( $video_post_id, 'shoudlshow_livestream_link', $_POST['shoudlshow_livestream_link'] );
    }
   
}


/////THIS IS WHERE WE CONDITION TEMPLATE FILES --- DDO ALSO FOR LANDING PAGE AND ABOUT PAGE
add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'video_post' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-video_post.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-video_post.php';
            }
        }
    }
    if ( is_page( 'what-remains' ) ) {
        if ( $theme_file = locate_template( array ( 'whatremains-landingpage.php' ) ) ) {
            $template_path = $theme_file;
        } else {
            $template_path = plugin_dir_path( __FILE__ ) . '/whatremains-landingpage.php';
        }
    }

    if ( is_page( 'about-what-remains' ) ) {
        if ( $theme_file = locate_template( array ( 'whatremains-aboutpage.php' ) ) ) {
            $template_path = $theme_file;
        } else {
            $template_path = plugin_dir_path( __FILE__ ) . '/whatremains-aboutpage.php';
        }
    }

    if ( is_page( 'what-remains-text' ) ) {
        if ( $theme_file = locate_template( array ( 'whatremains-text_page.php' ) ) ) {
            $template_path = $theme_file;
        } else {
            $template_path = plugin_dir_path( __FILE__ ) . 'whatremains-text_page.php';
        }
    }
    return $template_path;
}


////ENQUEE STYLESHEET FOR SUB PAGES
function wpse_enqueue_page_template_styles() {
    if ( get_post_type() == 'video_post' || is_page( 'what-remains' ) || is_page( 'about-what-remains' ) || is_page( 'what-remains-text' )   ) {
        wp_enqueue_style( 'whatremains_style', plugins_url( '/styles/whatremains_style.css', __FILE__ ) );
        wp_enqueue_script( 'whatremains_js', plugins_url( '/js/whatremains_js.js', __FILE__ ) );
    }
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_page_template_styles' );










////SHORTCODES

add_shortcode( 'featured_videos', 'show_featured_videos' );
function show_featured_videos(  ) {
    ob_start();

    include(plugin_dir_path( __FILE__ ) . '/whatremains-featured_videos.php');

    // save and return the content that has been output

    $content = ob_get_clean();
    return $content;
}

add_shortcode( 'all_videos', 'show_all_videos' );
function show_all_videos(  ) {
    ob_start();

    include(plugin_dir_path( __FILE__ ) . '/whatremains-all_videos.php');

    // save and return the content that has been output

    $content = ob_get_clean();
    return $content;
}


add_shortcode( 'featured_talks', 'show_featured_talks' );
function show_featured_talks(  ) {
    ob_start();

    include(plugin_dir_path( __FILE__ ) . '/whatremains-featured_talk.php');

    $content = ob_get_clean();
    return $content;
}


add_shortcode( 'entire_program', 'show_entire_program' );
function show_entire_program(  ) {
    ob_start();

    include(plugin_dir_path( __FILE__ ) . '/whatremains-program.php');

    $content = ob_get_clean();
    return $content;
}







