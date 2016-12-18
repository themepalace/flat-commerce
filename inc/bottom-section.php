<?php

if( !function_exists( 'flat_commerce_bottom_section' ) ) :
/**
* Add Featured content.
*
* @uses action hook flat_commerce_before_content.
*
* @since Flat Commerce 0.1
*/
function flat_commerce_bottom_section() {
    global $wp_query, $post;

    $page_id        = get_queried_object_id();
    $options        = flat_commerce_get_theme_options();

    $enableslider   = $options['bottom_section_enable_option'];

    $flat_commerce_bottom_section = '';

    // Front page displays in Reading Settings
    $page_on_front  = get_option( 'page_on_front' ) ;
    $page_for_posts = get_option( 'page_for_posts' );

    if ( ( ( $page_id == $page_on_front && $page_id > 0 ) && $enableslider == 'homepage' ) ) {
       if ( ( !$flat_commerce_bottom_section = get_transient( 'flat_commerce_bottom_section' ) ) ) {
            echo '<!-- refreshing about us section -->';
            $flat_commerce_bottom_section =
            '<section id="bottom-section">
                <div class="container">
                    <div class="row">
                        <div class="col col-2-of-3 col-centered">
                            <div class="bottom-section-wrapper">';

                            $flat_commerce_bottom_section .= flat_commerce_bottom_section_custom_content( $options );
                            '</div><!-- .bottom-section-wrapper -->';
                                $flat_commerce_bottom_section .=
                                '<div class="social-icon">
                                    <ul>';
                                    for ( $i=1; $i <= 3; $i++ ) {
                                        if ( !empty( $options['bottom_section_social_media_icon'.$i] ) ) {
                                            $flat_commerce_bottom_section .='<li><a href="';

                                            if ( !empty( $options['bottom_section_social_media_url'.$i] ) ) {
                                                $flat_commerce_bottom_section .= esc_url( $options['bottom_section_social_media_url'.$i] );
                                            }

                                            $flat_commerce_bottom_section .= '"><span class="genericon genericon-'.esc_attr( $options['bottom_section_social_media_icon'.$i] ).'"></span></a></li>';
                                        }
                                    }
                                    '</ul>
                                </div><!-- .social-icon -->';
                        $flat_commerce_bottom_section .= '</div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </section><!-- #bottom-section -->';
            set_transient( 'flat_commerce_bottom_section', $flat_commerce_bottom_section, 86940 );
        }
        echo $flat_commerce_bottom_section;
    }
}
endif;
add_action( 'flat_commerce_after_content', 'flat_commerce_bottom_section', 20 );


if ( ! function_exists( 'flat_commerce_bottom_section_custom_content' ) ) :
/**
 * This function to display bottom section page content
 *
 * @param $options: flat_commerce_theme_options from customizer
 *
 * @since Flat Commerce 0.1
 */
function flat_commerce_bottom_section_custom_content( $options ) {
    $bottom_section_custom_content = '
        <header class="entry-header">
            <h2 class="entry-title">'.esc_html( $options['bottom_section_title'] ).'</h2>
        </header><!-- .entry-header -->
        <div class="entry-content">
            <p>'.esc_html( $options['bottom_section_sub_title'] ).'</p>
        </div><!-- .entry-content -->';
    return $bottom_section_custom_content;
}
endif;
