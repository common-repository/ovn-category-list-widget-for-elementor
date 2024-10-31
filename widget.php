<?php

namespace CategoryList;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; 

class CLWE_Category extends Widget_Base {

	public static $slug = 'Category list';

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Category list', self::$slug); }

	public function get_icon() { return 'fas fa-tag'; }

	public function get_categories() { return [ 'general' ]; }

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Option', 'custom-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new Repeater();

		$taxonomies = get_taxonomies();
	
		$repeater->add_control(
			'title',	
			[
				'label' => __( 'Title', 'custom-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( "The Option's Value", 'custom-elementor'  ),
				'placeholder' => __( 'Value Attribute', 'custom-elementor' ),
			]
		);

		$this->add_control(
			'list_taxonomy',
			[
				'label' => __( 'Taxonomy', 'custom-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => $taxonomies, 'custom-elementor',	
			]
		);
		$this->add_control(
			'widget_title',
			[
				'label' => __( 'Title', 'custom-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'custom-elementor' ),
				'placeholder' => __( 'Type your title here', 'custom-elementor' ),
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		echo '<div class="the_title"><h2>' . esc_html($settings['widget_title']) . '</h2></div>';

		if ( ! empty( $settings['list_taxonomy'] ) ) {
			$this->add_render_attribute($settings['list_taxonomy'] );
		}
		$tags = get_tags(array('taxonomy' =>  $settings['list_taxonomy'] ,'orderby' => 'name', 'order' => 'ASC', 'hide_empty'=> false));
		?>
			<div class="the_taxonomy">
				<?php foreach($tags as $tag) : 
					$tag_link = get_tag_link( $tag->term_id );	
				?>
					<div class="lists_taxonomy">
						<div>
							<div class="post_tags">
								<a href="<?php print(esc_url($tag_link)) ?>" class="<?php print(esc_attr($tag->slug)) ?>">
									<?php print(esc_html($tag->name)) ?>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<style>
				.the_taxonomy{
					display: flex !important;
    				flex-wrap: wrap !important;
				}
				.lists_taxonomy {
					width:33%;
					padding-bottom:11px; 
				}
			</style>
		<?php	
	}
}
