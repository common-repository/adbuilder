<?php

class AdBuilderBiz_Widget extends WP_Widget {
 
	function __construct() {
		parent::__construct( 
			'adbuilderbiz_widget', 
			__( 'AdBuilder Grid', 'adbuilderbiz_widget_domain' ),
			array(
				'description' => __( 'Widget that contains the AdBuilder Grid', 'adbuilderbiz_widget_domain' ),
			)
		);
	}

	// Public - widget output
	public function widget($args, $instance) {
		$bannerId = 'ssaBanner-' . $this->number;
		$publisherId = $instance['publisher_id'];
		$widgetId = $instance['widget_id'];
		$maxThumbs = $instance['max_thumbs'];
		$ssaStyle = $instance['ssa_style'];
		
		echo $args['before_widget'];
?>
<div class="adContainer"><div id="<?php echo $bannerId; ?>"></div><script src="///ads.adbuilder.biz/sdk/v1/ssa.js"></script> <script>var ssaBanner=null;window.addEventListener('load',function(){var x=document.createElement('link');x.rel='stylesheet';x.href='///ads.adbuilder.biz/sdk/v1/ssa.css';document.head.appendChild(x);var x=document.createElement('style');x.type='text/css';x.innerHTML='<?php echo trim(preg_replace('/\s\s+/','',$ssaStyle)); ?>';document.head.appendChild(x);var opts={widgetID:<?php echo $widgetId; ?>,publisherID:<?php echo $publisherId; ?>,vertical:false,allThumbs:true,maxThumbs:<?php echo $maxThumbs; ?>,showAllTop:'',showAllBottom:'Show All',addBizTop:'',addBizBottom:'Advertise Here',showHeader:false,headerTextLeft:'',headerTextCenter:'Our Favorite Local Deals',headerTextRight:''};ssaBanner=new SSABanner(document.getElementById("<?php echo $bannerId; ?>"),opts);ssaBanner.loadBanner();});</script></div>
<?php
		echo $args['after_widget'];
	}

	// Admin - configure widget 
	public function form( $instance )
	{
		$publisherId = 123;
		if ( isset( $instance['publisher_id']) == true ) {
			$publisherId = $instance['publisher_id'];
		}

		$widgetId = 456;
		if ( isset( $instance['widget_id']) == true ) {
			$widgetId = $instance['widget_id'];
		}
		
		$maxThumbs = 4;
		if ( isset( $instance['max_thumbs']) == true ) {
			$maxThumbs = $instance['max_thumbs'];
		}
		
		$ssaStyle = <<<'END'
.ssaHeader{ background-color:white; }
.ssaHeaderText{ color:#337ab7; }
.ssaAdThumb{ border:1px dotted #f5f5f5; margin:0px; max-width:144px; max-height:144px; width:144px; height:144px; }
.ssaAdThumbImgDiv{ height:60px; }
.ssaFadeBackground{ opacity:0.25; }
.adContainer{ border:0px solid black; }
END;
		if ( isset( $instance['ssa_style']) == true ) {
			$ssaStyle = $instance['ssa_style'];
		}
		
?>
<p><label for="<?php echo $this->get_field_id('publisher_id'); ?>"><?php _e('Publisher ID:', 'adbuilderbiz_widget_domain'); ?>
	<input class="widefat" id="<?php echo $this->get_field_id('publisher_id'); ?>" name="<?php echo $this->get_field_name('publisher_id'); ?>" type="text" value="<?php echo esc_attr($publisherId); ?>" />
	</label></p>
<p><label for="<?php echo $this->get_field_id('widget_id'); ?>"><?php _e('Widget ID:', 'adbuilderbiz_widget_domain'); ?>
	<input class="widefat" id="<?php echo $this->get_field_id('widget_id'); ?>" name="<?php echo $this->get_field_name('widget_id'); ?>" type="text" value="<?php echo esc_attr($widgetId); ?>" />
</label></p>
<p><label for="<?php echo $this->get_field_id('max_thumbs'); ?>"><?php _e('Thumbnail count: ', 'adbuilderbiz_widget_domain'); ?></label>
	<input class="tiny-text" id="<?php echo $this->get_field_id('max_thumbs'); ?>" name="<?php echo $this->get_field_name('max_thumbs'); ?>" type="number" step="1" min="0" value="<?php echo esc_attr($maxThumbs); ?>" size="3" /></p>
<p><label for="<?php echo $this->get_field_id('ssa_style'); ?>"><?php _e('Custom Style:', 'adbuilderbiz_widget_domain'); ?>
	<textarea class="widefat" id="<?php echo $this->get_field_id('ssa_style'); ?>" name="<?php echo $this->get_field_name('ssa_style'); ?>" rows="5"><?php echo esc_attr($ssaStyle); ?></textarea>
</label></p>
<p class="description">The publisher and widget IDs come from the <a href="https://console.adbuilder.biz" target="_blank">AdBuilder Management Console</a>.  If you have not yet created an account you can create one now by clicking <a href="https://console.adbuilder.biz/signup_publisher.php" target="_blank">here</a>.
</p>
<?php 
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['publisher_id'] = '';
		if ( empty( $new_instance['publisher_id'] ) == false ) {
			$instance['publisher_id'] = strip_tags( $new_instance['publisher_id'] );
		}
		
		$instance['widget_id'] = '';
		if (empty( $new_instance['widget_id'] ) == false ) {
			$instance['widget_id'] = strip_tags( $new_instance['widget_id'] );
		}
		
		$instance['max_thumbs'] = 4;
		if (empty( $new_instance['max_thumbs'] ) == false ) {
			$instance['max_thumbs'] = strip_tags( $new_instance['max_thumbs'] );
		}
		
		$instance['ssa_style'] = '';
		if ( empty($new_instance['ssa_style'] ) == false ) {
			$instance['ssa_style'] = strip_tags( $new_instance['ssa_style'] );
		}
		
		return $instance;
	}
}
