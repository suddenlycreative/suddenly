<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package technix
	*/

   // info
   $technix_topbar_switch = get_theme_mod( 'technix_topbar_switch', false );

   // contact button
   $technix_button_text = get_theme_mod( 'technix_button_text', __( 'Make Request', 'technix' ) );
   $technix_button_link = get_theme_mod( 'technix_button_link', __( '#', 'technix' ) );

   // acc button
   $technix_acc_button_text = get_theme_mod( 'technix_acc_button_text', __( 'Login', 'technix' ) );
   $technix_acc_button_link = get_theme_mod( 'technix_acc_button_link', __( '#', 'technix' ) );

   // header right
   $technix_header_right = get_theme_mod( 'header_right_switch', false );
   $technix_menu_col = $technix_header_right ? 'col-xxl-6 col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xxl-9 col-xl-9 col-lg-8 d-none d-lg-block text-end';
   $header_search_switch = get_theme_mod( 'header_search_switch', false );

   //Phone
   $header_top_phone = get_theme_mod( 'header_phone', __( '+88 0190 678956', 'technix' ) );
   
   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'technix@support.com', 'technix' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'technix' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', __( '#', 'technix' ) );

   $header_language_switch = get_theme_mod( 'header_language_switch', false );

?>

<!-- header area start -->
<header class="tp-header-3-area tp-header-3-transparent tp-header-height p-relative">
   <div class="tp-header-3-top tp-header-3-space d-none d-xl-block">
      <div class="container-fluid">
         <div class="row align-items-center">
            <div class="col-xl-10 col-xxl-8">
               <div class="tp-header-3-top-info d-flex">
                  <div class="tp-header-3-top-call d-flex">
                     <?php  if ( !empty( $header_top_phone ) ): ?>
                     <a
                        href="tel:<?php echo esc_attr( $header_top_phone ) ?>"><span><?php echo esc_html__( "Call", 'technix' ) ?></span></a>
                     <?php endif;  ?>
                     <?php  if ( !empty( $header_top_consult_text ) ): ?>
                     <p><?php echo esc_html( $header_top_consult_text ) ?></p>
                     <?php endif;  ?>
                  </div>
                  <ul>
                     <?php  if ( !empty( $header_top_address_text ) ): ?>
                     <li>
                        <a href="<?php echo esc_attr( $header_top_address_link ) ?>" target="_blank"><span><i
                                 class="fa-sharp fa-solid fa-location-dot"></i></span><?php echo esc_html( $header_top_address_text ) ?></a>
                     </li>
                     <?php endif;  ?>
                     <?php  if ( !empty( $header_top_email ) ): ?>
                     <li>
                        <a href="mailto:<?php echo esc_attr( $header_top_email ) ?>"><span><i
                                 class="fa-solid fa-envelope"></i></span><?php echo esc_html( $header_top_email ) ?></a>
                     </li>
                     <?php endif;  ?>
                  </ul>
               </div>
            </div>
            <div class="col-xl-2 col-xxl-4">
               <div class="tp-header-3-top-right d-flex justify-content-end align-items-center">
                  <div class="header-social d-xxl-block d-none">
                     <?php technix_header_social_profiles(); ?>
                  </div>
                  <?php  if ( !empty( $header_language_switch ) ): ?>
                  <div class="tp-header-3-lang-wrapper d-flex align-items-center">
                     <div class="tp-header-lang-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/logo-lang.png" alt="">
                     </div>
                     <?php  if ( !empty( $header_language_switch ) ): ?>
                     <div class="tp-header-lang">
                        <?php echo technix_header_lang_defualt(); ?>
                     </div>
                     <?php endif;  ?>
                  </div>
                  <?php endif;  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="header-sticky" class="tp-header-3-bottom p-relative">
      <div class="tp-header-3-bottom-inner p-relative">
         <div class="container-fluid gx-0">
            <div class="row gx-0 align-items-center">
               <div class="col-xl-2 col-6">
                  <div class="tp-header-2-main-left d-flex align-items-center justify-content-xl-center p-relative">
                     <div class="tp-header-3-logo">
                        <?php technix_header_logo();?>
                     </div>
                  </div>
               </div>
               <div class="col-xl-8 d-none d-xl-block">
                  <div class="tp-main-menu-3-area d-flex align-items-center justify-content-center">
                     <div class="tp-main-menu menu-icon">
                        <nav id="tp-mobile-menu">
                           <?php technix_header_menu(); ?>
                        </nav>
                     </div>
                     <div class="tp-header-search search-open-btn d-none d-xl-block">
                        <a href="javascript:void(0);"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M8.80758 0C3.95121 0 0 3.95121 0 8.80758C0 13.6642 3.95121 17.6152 8.80758 17.6152C13.6642 17.6152 17.6152 13.6642 17.6152 8.80758C17.6152 3.95121 13.6642 0 8.80758 0ZM8.80758 15.9892C4.84769 15.9892 1.62602 12.7675 1.62602 8.80762C1.62602 4.84773 4.84769 1.62602 8.80758 1.62602C12.7675 1.62602 15.9891 4.84769 15.9891 8.80758C15.9891 12.7675 12.7675 15.9892 8.80758 15.9892Z"
                                 fill="black" />
                              <path
                                 d="M19.76 18.6124L15.0988 13.9511C14.7811 13.6335 14.2668 13.6335 13.9492 13.9511C13.6315 14.2684 13.6315 14.7834 13.9492 15.1007L18.6104 19.762C18.7692 19.9208 18.9771 20.0002 19.1852 20.0002C19.3931 20.0002 19.6012 19.9208 19.76 19.762C20.0776 19.4446 20.0776 18.9297 19.76 18.6124Z"
                                 fill="black" />
                           </svg>
                        </a>
                     </div>
                  </div>
               </div>
               <?php if(!empty($technix_header_right)) : ?>
               <div class="col-xl-2 col-6">
                  <div class="tp-header-3-right">
                     <div class="tp-header-3-main-right d-flex align-items-center justify-content-end">
                        <div class="tp-header-3-phone d-flex align-items-center">
                           <div class="tp-header-3-phone-icon">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/img//icon/call.svg" alt="">
                           </div>
                           <?php  if ( !empty( $header_top_phone ) ): ?>
                           <div class="tp-header-3-phone-content">
                              <span><?php echo esc_html__( "Phone: ", "technix" ) ?><br> <a
                                    href="tel:<?php echo esc_attr( $header_top_phone ) ?>"><?php echo esc_html( $header_top_phone ) ?></a></span>
                           </div>
                           <?php endif;  ?>
                        </div>
                        <div class="tp-header-3-hamburger-btn offcanvas-open-btn">
                           <button class="hamburger-btn">
                              <span>
                                 <svg width="29" height="24" viewBox="0 0 29 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                       d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z"
                                       fill="currentColor" />
                                 </svg>
                              </span>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endif;  ?>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- header area end -->

<?php get_template_part( 'template-parts/header/header-side-info-header-2' ); ?>