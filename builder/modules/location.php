<?php
/*
Divi Icon Field Names
When using the et_pb_get_font_icon_list to render the icon picker,
make sure the field name is one of the following:
'font_icon', 'button_one_icon', 'button_two_icon',  'button_icon'
*/

class ET_Builder_CA_Location extends ET_Builder_CAWeb_Module{
	function init() {
		$this->name = esc_html__( 'Location', 'et_builder' );

		$this->slug = 'et_pb_ca_location_widget';

		$this->whitelisted_fields = array(
			'location_layout',
			'show_button',
			'featured_image',
		  'addr',
			'city',
			'zip',
			'show_icon',
			'state',
			'location_link',
			'font_icon',
			'show_contact',
			'name',
			'desc',
			'phone',
			'fax',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
			'max_width_last_edited',
			'module_class',
			'module_id',
			'admin_label',
		);

		$this->fields_defaults = array(
			'font_icon' => array('%-1%','add_default_setting'),
			'button_link' => array('http://','add_default_setting'),
		);

		$this->main_css_element = '%%order_class%%';

		$this->options_toggles = array(
		  'general' => array(
		    'toggles' => array(
		      'style'  => esc_html__( 'Style', 'et_builder'),
		      'header' => esc_html__( 'Header', 'et_builder'),
		      'body'   => esc_html__( 'Body', 'et_builder'),
		    ),
		  ),
		  'advanced' => array(
		    'toggles' => array(
          'style'  => esc_html__( 'Style', 'et_builder'),
		      'text' => array(
		        'title'    => esc_html__( 'Text', 'et_builder' ),
		        'priority' => 49,
		      ),
		      'width' => array(
		        'title'    => esc_html__( 'Sizing', 'et_builder' ),
		        'priority' => 65,
		      ),
		    ),
		  ),
		  'custom_css' => array(
		    'toggles' => array(
		    ),
		  ),
		);
	}
	function get_fields() {
		$fields = array(
			'location_layout' => array(
				'label'             => esc_html__( 'Style', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'contact' => esc_html__( 'Contact', 'et_builder'),
					'mini' => esc_html__( 'Mini', 'et_builder'),
					'banner'  => esc_html__( 'Banner', 'et_builder'),
				),
				'description'       => esc_html__( 'Here you can choose the style in which to display the location', 'et_builder' ),
				'affects' => array('featured_image','show_button','desc', 'show_icon', 'show_contact'),
				'toggle_slug' => 'style',
			),
			'featured_image' => array(
				'label' => esc_html__( 'Set Featured Image', 'et_builder' ),
				'type' => 'upload',
				'option_category' => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text' => esc_attr__( 'Choose a Background Image', 'et_builder' ),
				'update_text' => esc_attr__( 'Set As Background', 'et_builder' ),
				'description' => esc_html__( 'If defined, this image will be used as the background for this location. To remove a background image, simply delete the URL from the settings field.', 'et_builder' ),
				'depends_show_if' => 'banner',
				'toggle_slug' => 'style',
			),
			'name' => array(
				'label'           => esc_html__( 'Location Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a name for the location.', 'et_builder' ),
				'toggle_slug' 		=> 'body',
			),
			'desc' => array(
				'label'           => esc_html__( 'Location Description', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a description of the location.', 'et_builder' ),
				'depends_show_if' => 'banner',
				'toggle_slug' 		=> 'body',
				),
			'addr' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an address.', 'et_builder' ),
				'toggle_slug' 		=> 'body',
			),
			'city' => array(
				'label'           => esc_html__( 'City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a city.', 'et_builder' ),
				'toggle_slug' 		=> 'body',
			),
			'state' => array(
				'label'           => esc_html__( 'State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a state.', 'et_builder' ),
				'toggle_slug' 		=> 'body',
			),
			'zip' => array(
				'label'           => esc_html__( 'Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an zip.', 'et_builder' ),
				'toggle_slug' 		=> 'body',
			),
			'show_contact' => array(
				'label'           => esc_html__( 'Contact information', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'depends_show_if' => 'contact',
				'affects' => array('phone', 'fax',),
				'toggle_slug' 		=> 'body',
			),
			'phone' => array(
				'label'           => esc_html__( 'Phone Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a phone number.', 'et_builder' ),
				'depends_show_if' => "on",
				'toggle_slug' 		=> 'body',
			),
			'fax' => array(
				'label'           => esc_html__( 'Fax Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a fax number.', 'et_builder' ),
				'depends_show_if' => "on",
				'toggle_slug' 		=> 'body',
			),
			'show_icon' => array(
				'label'           => esc_html__( 'Use Icon', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('font_icon',),
				'depends_show_if_not' => 'banner',
				'toggle_slug' 		=> 'style',
				'tab_slug'		=> 'advanced',
			),
			'font_icon' => array(
				'label'           => esc_html__( 'Icon', 'et_builder' ),
				'type'            => 'text',
				'option_category'     => 'configuration',
				'class'               => array('et-pb-font-icon'),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'description'     => esc_html__( 'Select an icon.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug' 		=> 'style',
				'tab_slug'		=> 'advanced',
			),
			'show_button' => array(
				'label'           => esc_html__( 'Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'depends_show_if_not' => 'mini',
				'affects' => array('location_link',),
				'toggle_slug' 		=> 'body',
			),
			'location_link' => array(
				'label'           => esc_html__( 'Location URL', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter the URL for the location. (http:// must be included)', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug' 		=> 'body',
			),
			'max_width' => array(
			  'label'           => esc_html__( 'Max Width', 'et_builder' ),
			  'type'            => 'skip',
			  'option_category' => 'layout',
			  'mobile_options'  => true,
			  'tab_slug'        => 'advanced',
			  'toggle_slug'     => 'width',
			  'validate_unit'   => true,
			),
			'max_width_tablet' => array(
			  'type'        => 'skip',
			  'tab_slug'    => 'advanced',
			  'toggle_slug' => 'width',
			),
			'max_width_phone' => array(
			  'type'        => 'skip',
			  'tab_slug'    => 'advanced',
			  'toggle_slug' => 'width',
			),
			'max_width_last_edited' => array(
			  'type'        => 'skip',
			  'tab_slug'    => 'advanced',
			  'toggle_slug' => 'width',
			),
			'disabled_on' => array(
			  'label'           => esc_html__( 'Disable on', 'et_builder' ),
			  'type'            => 'multiple_checkboxes',
			  'options'         => array(
			    'phone'   => esc_html__( 'Phone', 'et_builder' ),
			    'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
			    'desktop' => esc_html__( 'Desktop', 'et_builder' ),
			  ),
			  'additional_att'  => 'disable_on',
			  'option_category' => 'configuration',
			  'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'visibility',
			),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
				'toggle_slug'	=> 'admin_label',
			),
			'module_id' => array(
			  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
				'toggle_slug'			=> 'classes',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
			  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
				'toggle_slug'			=> 'classes',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
		);

		return $fields;

	}
	function render( $unprocessed_props, $content = null, $render_slug ) {
		$module_id            	= $this->props['module_id'];
		$module_class         	= $this->props['module_class'];
		$max_width            	= $this->props['max_width'];
		$max_width_tablet     	= $this->props['max_width_tablet'];
		$max_width_phone      	= $this->props['max_width_phone'];
		$max_width_last_edited 	= $this->props['max_width_last_edited'];
		$location_layout 				= $this->props['location_layout'];
		$featured_image       	= $this->props['featured_image'];
		$name               		= $this->props['name'];
		$desc               		= $this->props['desc'];
		$addr               		= $this->props['addr'];
		$city              			= $this->props['city'];
		$state              		= $this->props['state'];
		$zip    								= $this->props['zip'];
		$show_contact    				= $this->props['show_contact'];
		$phone    							= $this->props['phone'];
		$fax    								= $this->props['fax'];
		$show_icon    					= $this->props['show_icon'];
		$icon    								= $this->props['font_icon'];
		$show_button    				= $this->props['show_button'];
		$location_link    			= $this->props['location_link'];

		$class = "et_pb_ca_location_widget et_pb_module location";
		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		$display_icon = ("on" == $show_icon ? caweb_get_icon_span($icon) : '');

		$address = array($addr, $city, $state, $zip);
		$address = array_filter( $address);
		$address = implode(", ", $address);

		if("contact" == 	$location_layout ){
				$display_other = ("on" == $show_contact ?
				sprintf('<p class="other">%1$s%2$s</p>',
				("" != $phone ? "General Information: {$phone}<br />" : ''),
				("" != $fax ?  "FAX: {$fax}" : '')	 ) : '');

			$display_button = ("on" == $show_button && "" != $location_link ? sprintf('<a href="%1$s" class="btn">More</a>', $location_link) : '' );

      $address = ( ! empty($name) ? sprintf('%1$s<br />%2$s', $name, caweb_get_google_map_place_link( $address ) ) :
                  caweb_get_google_map_place_link( $address ) );

				$output =sprintf('<div%1$s class="%2$s%3$s contact">%4$s<div class="contact"><p class="address">%5$s</p>%6$s%7$s</div></div>',
								( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
								esc_attr( $class ), ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
								$display_icon, $address, $display_other, $display_button );

		}elseif("mini" == 	$location_layout ){
			$output = sprintf('<div%1$s class="%2$s%3$s mini">%4$s<div class="contact"%8$s><div class="title"><a href="%5$s">%6$s</a></div>%7$s</div></div>',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			("on" == $show_icon ? sprintf('<div>%1$s</div>', $display_icon ) : ''), $location_link, $name,
       ( ! empty($address) ? sprintf('<div class="address">%1$s</div>', caweb_get_google_map_place_link( $address ) ): ''), ( empty($display_icon) ? ' style="margin-left: 0px;"' : '' ) );

		}else{
			$display_button = ("on" == $show_button && "" != $location_link ? sprintf('<a href="%1$s" class="btn">View More Details</a>', $location_link) : '' );

			$output = sprintf('<div%1$s class="%2$s%3$s banner"><div class="thumbnail"><img src="%4$s"></div><div class="contact"><div class="title">%5$s</div><div class="address">%6$s</div></div><div class="summary">%7$s%8$s</div></div>',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
      $featured_image, $name ,
     ( ! empty($address) ? sprintf(' <span class="ca-gov-icon-road-pin"></span>%1$s', caweb_get_google_map_place_link( $address ) ) : ''),
      ( ! empty($desc) ? sprintf('<div class="title">Description</div><div class="description">%1$s</div>', $desc) : ''), $display_button);

		}
		return $output;

	}
}
new ET_Builder_CA_Location;

?>
