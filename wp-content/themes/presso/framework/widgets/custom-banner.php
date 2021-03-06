<?php

add_action( 'after_setup_theme', 'vw_setup_vw_widgets_init_custom_banner' );
function vw_setup_vw_widgets_init_custom_banner() {
	add_action( 'widgets_init', 'vw_widgets_init_custom_banner' );
}

function vw_widgets_init_custom_banner() {
	register_widget( 'Vw_widget_custom_banner' );
}

class Vw_widget_custom_banner extends WP_Widget {
	private $default = array(
		'supertitle' => '',
		'title' => '',
		'subtitle' => '',
		'imgurl' => '',
		'linkurl' => '',
		'buttontext' => '',
	);

	public function __construct() {
		// widget actual processes
		parent::__construct(
	 		'vw_widget_custom_banner', // Base ID
			'Envirra Custom Banner', // Name
			array( 'description' => __( 'Display banner', 'envirra-backend' ), ) // Args
		);
	}

	function widget( $args, $instance ) {
		extract($args);

		if ( function_exists( 'icl_t' ) ) {
			$instance['supertitle'] = icl_t( 'PRESSO Widget', $this->id.'_supertitle', $instance['supertitle'] );
			$instance['title'] = icl_t( 'PRESSO Widget', $this->id.'_title', $instance['title'] );
			$instance['subtitle'] = icl_t( 'PRESSO Widget', $this->id.'_subtitle', $instance['subtitle'] );
			$instance['buttontext'] = icl_t( 'PRESSO Widget', $this->id.'_buttontext', $instance['buttontext'] );
		}

		$supertitle_html = '';
		if ( ! empty( $instance['supertitle'] ) ) {
			$supertitle_html = sprintf( __( '<h6 class="banner-supertitle">%s</h6>', 'envirra' ), $instance['supertitle'] );
		}

		$title_html = '';
		if ( ! empty( $instance['title'] ) ) {
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
			$title_html = sprintf( __( '<h3 class="banner-title">%s</h3>', 'envirra' ), $title );
		}

		$subtitle_html = '';
		if ( ! empty( $instance['subtitle'] ) ) {
			$subtitle_html = sprintf( __( '<div class="banner-subtitle">%s</div>', 'envirra' ), $instance['subtitle'] );
		}

		$button_html = '';
		if ( ! empty( $instance['buttontext'] ) ) {
			$button_html = sprintf( __( '<a href="%s" class="banner-button read-more label label-large primary-bg">%s</a>', 'envirra' ), $instance['linkurl'], $instance['buttontext'] );
		}

		echo $before_widget;

		?>
			<div class="banner" style="background-image: url( <?php echo $instance['imgurl'] ?> )">
				<div class="banner-inner">
					<?php echo $supertitle_html ?>
					<?php echo $title_html ?>
					<?php echo $subtitle_html ?>
					<?php echo $button_html ?>
				</div>
			</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, $this->default );
		$instance['supertitle'] = strip_tags( $new_instance['supertitle'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['imgurl'] = strip_tags( $new_instance['imgurl'] );
		$instance['linkurl'] = strip_tags( $new_instance['linkurl'] );
		$instance['buttontext'] = strip_tags( $new_instance['buttontext'] );

		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'PRESSO Widget', $this->id.'_supertitle', $instance['supertitle'] );
			icl_register_string( 'PRESSO Widget', $this->id.'_title', $instance['title'] );
			icl_register_string( 'PRESSO Widget', $this->id.'_subtitle', $instance['subtitle'] );
			icl_register_string( 'PRESSO Widget', $this->id.'_buttontext', $instance['buttontext'] );
		}

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->default );

		$supertitle = strip_tags( $instance['supertitle'] );
		$title = strip_tags( $instance['title'] );
		$subtitle = strip_tags( $instance['subtitle'] );
		$imgurl = strip_tags( $instance['imgurl'] );
		$linkurl = strip_tags( $instance['linkurl'] );
		$buttontext = strip_tags( $instance['buttontext'] );
?>
		<!-- super title -->
		<p>
			<label for="<?php echo $this->get_field_id('supertitle'); ?>"><?php _e('Super-title:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('supertitle'); ?>" name="<?php echo $this->get_field_name('supertitle'); ?>" type="text" value="<?php echo esc_attr($supertitle); ?>" />
		</p>

		<!-- title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<!-- subtitle -->
		<p>
			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
		</p>

		<!-- image url -->
		<p>
			<label for="<?php echo $this->get_field_id('imgurl'); ?>"><?php _e('Image Url:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('imgurl'); ?>" name="<?php echo $this->get_field_name('imgurl'); ?>" type="text" value="<?php echo esc_attr($imgurl); ?>" />
		</p>

		<!-- link url -->
		<p>
			<label for="<?php echo $this->get_field_id('linkurl'); ?>"><?php _e('Link Url:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkurl'); ?>" name="<?php echo $this->get_field_name('linkurl'); ?>" type="text" value="<?php echo esc_attr($linkurl); ?>" />
		</p>

		<!-- button text -->
		<p>
			<label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Button Text:','envirra-backend'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo esc_attr($buttontext); ?>" />
		</p>
		
<?php
	}
}
