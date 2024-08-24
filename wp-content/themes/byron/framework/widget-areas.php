<?php
/**
 * Custom Widget Areas
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Byron_Custom_Sidebars' ) ) {

	class Byron_Custom_Sidebars {

		protected $widget_areas	= array();
		protected $orig			= array();

		/* Start up */
		public function __construct( $widget_areas = array() ) {
			add_action( 'init', array( $this, 'register_sidebars' ) , 1000 );
			add_action( 'admin_print_scripts-widgets.php', array( $this, 'add_widget_box' ) );
			add_action( 'load-widgets.php', array( $this, 'add_widget_area' ), 100 );
			add_action( 'load-widgets.php', array( $this, 'scripts' ), 100 );
			add_action( 'admin_print_styles-widgets.php', array( $this, 'inline_css' ) );
			add_action( 'wp_ajax_byron_delete_widget_area', array( $this, 'byron_delete_widget_area' ) ); 
		}

		/* Add the widget box inside a script */
		public function add_widget_box() {
			$nonce = wp_create_nonce ( 'delete-byron-widget_area-nonce' ); ?>
			  <script type="text/html" id="byron-add-widget-template">
				<div id="byron-add-widget" class="widgets-holder-wrap">
				 <div class="">
				  <input type="hidden" name="byron-nonce" value="<?php echo esc_attr( $nonce ); ?>" />
				  <div class="sidebar-name">
				   <h3><?php esc_html_e( 'Create a Widget Area', 'byron' ); ?> <span class="spinner"></span></h3>
				  </div>
				  <div class="sidebar-description">
					<form id="addWidgetAreaForm" action="" method="post">
					  <div class="widget-content">
						<input id="byron-add-widget-input" name="byron-add-widget-input" type="text" class="regular-text" title="<?php esc_attr_e( 'Name', 'byron' ); ?>" placeholder="<?php esc_attr_e( 'Name', 'byron' ); ?>" />
					  </div>
					  <div class="widget-control-actions">
						<div class="aligncenter">
						  <input class="addWidgetArea-button button-primary" type="submit" value="<?php esc_attr_e( 'Create Widget Area', 'byron' ); ?>" />
						</div>
						<br class="clear">
					  </div>
					</form>
				  </div>
				 </div>
				</div>
			  </script>
			<?php
		}        

		/* Create new Widget Area */
		public function add_widget_area() {
			if ( ! empty( $_POST['byron-add-widget-input'] ) ) {
				$this->widget_areas = $this->get_widget_areas();
				array_push( $this->widget_areas, $_POST['byron-add-widget-input'] );
				$this->save_widget_areas();
				wp_redirect( admin_url( 'widgets.php' ) );
				die();
			}
		}

		public function save_widget_areas() {
			set_theme_mod( 'widget_areas', array_unique( $this->widget_areas ) );
		}

		/* Register and display the custom widget area */
		public function register_sidebars() {

			// Get widget areas
			if ( empty( $this->widget_areas ) ) {
				$this->widget_areas = $this->get_widget_areas();
			}

			// Original widget areas is empty
			$this->orig = array();

			// Save widget areas
			if ( ! empty( $this->orig ) && $this->orig != $this->widget_areas ) {
				$this->widget_areas = array_unique( array_merge( $this->widget_areas, $this->orig ) );
				$this->save_widget_areas();
			}

			// If widget areas are defined add a sidebar area for each
			if ( is_array( $this->widget_areas ) ) {
				foreach ( array_unique( $this->widget_areas ) as $widget_area ) {
					$args = array(
						'id'			=> sanitize_key( $widget_area ),
						'name'			=> $widget_area,
						'class'			=> 'byron-custom',
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title"><span>',
						'after_title'   => '</span></h2>'
					);
					register_sidebar( $args );
				}
			}
		}

		/* Return the widget areas array */
		public function get_widget_areas() {

			// If the single instance hasn't been set, set it now.
			if ( ! empty( $this->widget_areas ) ) {
				return $this->widget_areas;
			}

			// Get widget areas saved in theem mod
			$widget_areas = byron_get_mod( 'widget_areas' );

			// If theme mod isn't empty set to class widget area var
			if ( ! empty( $widget_areas ) && is_array( $widget_areas ) ) {
				$this->widget_areas = array_unique( array_merge( $this->widget_areas, $widget_areas ) );
			}

			// Return widget areas
			return $this->widget_areas;
		}

		/* Delete widget_areas */
		public function byron_delete_widget_area() {
			// Check_ajax_referer('delete-byron-widget_area-nonce');
			if ( ! empty( $_REQUEST['name'] ) ) {
				$name = strip_tags( ( stripslashes( $_REQUEST['name'] ) ) );
				$this->widget_areas = $this->get_widget_areas();
				$key = array_search($name, $this->widget_areas );
				if ( $key >= 0 ) {
					unset( $this->widget_areas[$key] );
					$this->save_widget_areas();
				}
				echo "widget_area-deleted";
			}
			die();
		}

		/* Enqueue JS for the customizer controls */
		public function scripts() {

			// Load scripts
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script(
				'byron-widget-areas',
				get_template_directory_uri() . '/assets/admin/js/widget_areas.js',
				array('jquery'),
				time(),
				true
			);

			// Get widgets
			$widgets = array();
			if ( ! empty( $this->widget_areas ) ) {
				foreach ( $this->widget_areas as $widget ) {
					$widgets[$widget] = 1;
				}
			}

			// Localize script
			wp_localize_script(
				'byron-widget-areas',
				'byronWidgetAreasLocalize',
				array(
					'count'   => count( $this->orig ),
					'delete'  => esc_html__( 'Delete', 'byron' ),
					'confirm' => esc_html__( 'Confirm', 'byron' ),
					'cancel'  => esc_html__( 'Cancel', 'byron' ),
				)
			);
		}

		/* Adds inline CSS */
		public function inline_css() { ?>

			<style type="text/css">
				body #byron-add-widget h3 { text-align: center !important; padding: 15px 7px; font-size: 1.3em; margin-top: 5px; }
				body div#widgets-right .sidebar-byron-custom .widgets-sortables { padding-bottom: 45px }
				body div#widgets-right .sidebar-byron-custom.closed .widgets-sortables { padding-bottom: 0 }
				body .byron-widget-area-footer { display: block; position: absolute; bottom: 0; left: 0; height: 40px; line-height: 40px; width: 100%; border-top: 1px solid #e4e4e4; }
				body .byron-widget-area-footer > div { padding: 8px 8px 0 }
				body .byron-widget-area-footer .byron-widget-area-id { display: block; float: left; max-width: 48%; overflow: hidden; position: relative; top: -6px; }
				body .byron-widget-area-footer .byron-widget-area-buttons { float: right }
				body .byron-widget-area-footer .description { padding: 0 !important; margin: 0 !important; }
				body div#widgets-right .sidebar-byron-custom.closed .widgets-sortables .byron-widget-area-footer { display: none }
				body .byron-widget-area-footer .byron-widget-area-delete { display: block; float: right; margin: 0; }
				body .byron-widget-area-footer .byron-widget-area-delete-confirm { display: none; float: right; margin: 0 5px 0 0; }
				body .byron-widget-area-footer .byron-widget-area-delete-cancel { display: none; float: right; margin: 0; }
				body .byron-widget-area-delete-confirm:hover:before { color: red }
				body .byron-widget-area-delete-confirm:hover { color: #414042 }
				body .byron-widget-area-delete:hover:before { color: #919191 }
				body .activate_spinner { display: block !important; position: absolute; top: 10px; right: 4px; background-color: #ececec; }
				body #byron-add-widget form { text-align: center }
				body #widget_area-byron-custom,
				body #widget_area-byron-custom h3 { position: relative }
				body #byron-add-widget p { margin-top: 0 }
				body #byron-add-widget { margin: 10px 0 0; position: relative; }
				body #byron-add-widget-input { max-width: 95%; padding: 8px; margin-bottom: 14px; margin-top: 3px; text-align: center; }
			</style>

		<?php }
	
	}

	new Byron_Custom_Sidebars();
}