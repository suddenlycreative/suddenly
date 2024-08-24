<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Post extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-portfolio-post';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio Post', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }   

	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
         'tp_portfolio_shape_switch',
            [
                'label'        => esc_html__( 'Enable Shape?', 'tpcore' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tpcore' ),
                'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
        
        // Product Query

        $this->tp_query_controls('tp-portfolios', 'Portfolio', '6', '10', 'tp-portfolios', 'portfolios-cat');


        // tp_post__columns_section
        $this->tp_columns('col', 'Portfolio Column');

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');

    }

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('tp-portfolios', 'portfolios-cat', $this->get_settings());

       // The Query
       $query = new \WP_Query($query_args);

       $filter_list = $settings['category'];

       $portfolio_filter_btn_active = 1; // for filter button active

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

<?php else: ?>

<div class="portfolio-area pt-100 pb-90">
    <div class="container">
        
        <?php if( !empty($filter_list) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="portfolio-filter masonary-menu text-center mb-35">

                    <?php 
                    $post_type = 'tp-portfolios';
                    $count_posts = wp_count_posts( $post_type );
                    $published_posts = $count_posts->publish;
                    foreach ( $filter_list as $list ):
                        $listSTR = str_replace('-', ' ', $list);
                        if ( $portfolio_filter_btn_active === 1 ): 
                        $portfolio_filter_btn_active++; 
                    ?>
                        <button class="active" data-filter="*"><span><?php echo esc_html__( 'See All','tpcore' ); ?></span></button>
                        <button data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button>
                        <?php else: ?>
                            <button data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row grid">
            <?php 
                while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $terms = get_the_terms($post->ID, 'portfolios-cat'); 
                $item_classes = '';
                $item_cat_names = '';
                $item_cats = get_the_terms( $post->ID, 'portfolios-cat' );
                if( !empty($item_cats) ):
                    $count = count($item_cats) - 1;
                    foreach($item_cats as $key => $item_cat) {
                        $item_classes .= $item_cat->slug . ' ';
                        $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                    }
                endif; 
                $tp_portfolio_sub_thumbnail = function_exists('get_field') ? get_field('tp-portfolio_sub_thumbnail') : '';
                $categories = get_the_terms( $post->ID, 'portfolios-cat' );
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> grid-item <?php echo $item_classes; ?>">
                <div class="inner-project-item mb-30">
                    <?php if ( has_post_thumbnail() ): ?>
                    <div class="inner-project-img fix p-relative">
                        <?php the_post_thumbnail(); ?>
                        <?php if(!empty($tp_portfolio_sub_thumbnail)) : ?>
                        <div class="inner-project-brand">
                            <img src="<?php echo esc_url($tp_portfolio_sub_thumbnail['url']); ?>" alt="">
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="inner-project-content">
                        <span class="inner-project-category-title"><?php echo $categories[0]->name; echo $categories[1]->name ? ', '.$categories[1]->name : NULL; ; ?></span>
                        <h4 class="inner-project-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h4>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                        <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</div>

<?php endif;
	}

}

$widgets_manager->register( new TP_Portfolio_Post() );