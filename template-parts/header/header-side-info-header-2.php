<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package technix
   */

    $technix_side_hide = get_theme_mod( 'technix_side_hide', false );
    $technix_side_search = get_theme_mod( 'technix_side_search', false );
    $technix_side_logo = get_theme_mod( 'technix_side_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png' );
    $technix_extra_about_text = get_theme_mod( 'technix_extra_about_text', __( 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and will give you a complete account of the system and expound the actual teachings of the great explore', 'technix' ) );

    $technix_extra_map = get_theme_mod( 'technix_extra_map', __( '#', 'technix' ) );
    $technix_contact_title = get_theme_mod( 'technix_contact_title', __( 'Contact Info', 'technix' ) );
   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'technix@support.com', 'technix' ) );

   // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+88 01310-069824', 'technix' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'technix' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', __( 'https://www.google.com/maps/@36.0758266,-79.4558848,17z', 'technix' ) );


   //Offcanvas About Us
   $offcanvas_about_us = get_theme_mod( 'header_top_offcanvas_textarea', __( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'technix' ) );

   // Gallery Text 
   $gallery_text = get_theme_mod( 'header_side_gallery_text', __( 'Gallery', 'technix' ) );
   // Contacts Text 
   $contacts_text = get_theme_mod( 'header_side_contacts_text', __( 'Contacts', 'technix' ) );



   $gallery_repeater = get_theme_mod( 'header_side_gallery_repeater');

?>


<!-- offcanvas area start -->
<div class="offcanvas__area home-3-pos">
   <div class="offcanvas__wrapper">
      <div class="offcanvas__close">
         <button class="offcanvas__close-btn offcanvas-close-btn">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
               <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                  stroke-linejoin="round" />
            </svg>
         </button>
      </div>
      <div class="offcanvas__content">
         <div class="offcanvas__top mb-50 d-flex justify-content-between align-items-center">
            <div class="offcanvas__logo logo">
               <?php technix_header_logo(); ?>
            </div>
         </div>
         <div class="mobile-menu fix d-lg-none"></div>
         <div class="tp-mobile-menu-pos"></div>
         <div class="offcanvas__popup">
            <?php  if ( !empty( $offcanvas_about_us ) ): ?>
            <p><?php echo esc_html($offcanvas_about_us); ?></p>
            <?php endif;  ?>
            <div class="offcanvas__popup-gallery">
               <?php  if ( !empty( $gallery_text ) ): ?>
               <h4 class="offcanvas__title"><?php echo esc_html($gallery_text) ?></h4>
               <?php endif;  ?>
               <?php 
                        
                           foreach($gallery_repeater as $gallery){
                              if(! wp_attachment_is_image($gallery['gallery_image']  )){
                                 $gallery_image = esc_url_raw($gallery['gallery_image']);
                              }else{
                                 // $gallery_image = wp_get_attachment_image_src($gallery['gallery_image'], 'full');
                                 // $gallery_image = $gallery_image[0];
                                 $gallery_image = wp_get_attachment_url( $gallery['gallery_image'] );
                              }
                              ?>
               <a class="popup-image" href="<?php echo esc_url($gallery_image) ?>">
                  <img src="<?php echo esc_url($gallery_image) ?>" alt="<?php echo esc_url($gallery_image) ?>">
               </a>
               <?php
                           }
                         ?>

            </div>
         </div>
         <div class="offcanvas__contact">
            <?php  if ( !empty( $contacts_text ) ): ?>
            <h4 class="offcanvas__title"><?php echo esc_html($contacts_text) ?></h4>
            <?php endif;  ?>
            <?php  if ( !empty( $header_top_address_text ) ): ?>
            <div class="offcanvas__contact-content d-flex">
               <div class="offcanvas__contact-content-icon">
                  <i class="fa-sharp fa-solid fa-location-dot"></i>
               </div>
               <div class="offcanvas__contact-content-content">
                  <a href="<?php echo esc_attr($header_top_address_link); ?>"><?php echo esc_html($header_top_address_text); ?>
                  </a>
               </div>
            </div>
            <?php endif;  ?>
            <?php  if ( !empty( $header_top_email ) ): ?>
            <div class="offcanvas__contact-content d-flex">
               <div class="offcanvas__contact-content-icon">
                  <i class="fa-solid fa-envelope"></i>
               </div>
               <div class="offcanvas__contact-content-content">
                  <a href="mailto:<?php echo esc_attr($header_top_email); ?>"><?php echo esc_html($header_top_email); ?>
                  </a>
               </div>
            </div>
            <?php endif;  ?>

            <?php  if ( !empty( $header_top_phone ) ): ?>
            <div class="offcanvas__contact-content d-flex">
               <div class="offcanvas__contact-content-icon">
                  <i class="fa-solid fa-phone"></i>
               </div>
               <div class="offcanvas__contact-content-content">
                  <a href="tel:<?php echo esc_attr($header_top_phone); ?>">
                     <?php echo esc_attr($header_top_phone); ?></a>
               </div>
            </div>
         </div>
         <?php endif;  ?>
         <div class="offcanvas__social">
            <?php technix_header_side_info_social_profiles()?>
         </div>
      </div>
   </div>
</div>
<div class="body-overlay"></div>
<!-- offcanvas area end -->