<?php
class ET_Builder_Module_Panel extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Panel', 'et_builder' );

		$this->slug = 'et_pb_ca_panel';
		$this->fb_support = true;

		$this->whitelisted_fields = array(
				'max_width', 'max_width_tablet', 'max_width_phone',
				'module_class', 'module_id', 'admin_label',
			'panel_layout', 'show_button', 'use_icon', 'icon', 'heading_align',
			'button_link','title','heading_text_color', 'content_new',
		);

		$this->fields_defaults = array(
			'panel_layout' => array( 'default' ),
			'button_link' => array( 'http://','add_default_setting'),
		);

		$this->main_css_element = '%%order_class%%';

					// Custom handler: Output JS for editor preview in page footer.
		add_action( 'wp_footer', array( $this, 'js_frontend_preview' ) );
	}
	function get_fields() {
		$fields = array(
			'panel_layout' => array(
				'label'             => esc_html__( 'Style','et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'none' => esc_html__( 'None','et_builder'),
					'default' => esc_html__( 'Default','et_builder'),
					'standout'  => esc_html__( 'Standout','et_builder'),
					'standout highlight'  => esc_html__( 'Standout Highlight','et_builder'),
					'overstated'  => esc_html__( 'Overstated','et_builder'),
					'understated'  => esc_html__( 'Understated','et_builder'),
				),
				'description'       => esc_html__( 'Here you can choose the style of panel to display','et_builder' ),
				'affects' => array('#et_pb_heading_text_color'),
			),
			'title' => array(
				'label'           => esc_html__( 'Heading','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a Heading Title.','et_builder' ),
			),
			'heading_align' => array(
				'label'             => esc_html__( 'Heading Alignment','et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'left' => esc_html__( 'Left','et_builder'),
					'center' => esc_html__( 'Center','et_builder'),
					'right'  => esc_html__( 'Right','et_builder'),
				),
				'description'       => esc_html__( 'Here you can choose the alignment for the panel heading','et_builder' ),
			),
			'heading_text_color' => array(
				'label'             => esc_html__( 'Heading Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom heading color for the title.', 'et_builder' ),
				'depends_show_if' => 'none',
			),
			'use_icon' => array(
				'label'           => esc_html__( 'Icon', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'affects' => array('#et_pb_icon',),
				'description' => 'Choose whether to display an icon before the Heading',
			),
			'icon' => array(
				'label'           => esc_html__( 'Heading Icon','et_builder' ),
				'type'            => 'text',
				 'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
  			'renderer'            => 'et_pb_get_font_icon_list',
			'renderer_with_field' => true,
				'depends_show_if' => 'on',
				'description'     => esc_html__( 'Here you can select a Heading Icon','et_builder' ),
			),
			'show_button' => array(
				'label'           => esc_html__( 'Read More Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_button_link',),
				'description'     => esc_html__( 'Here you can select to display a button.','et_builder' ),
			),
			'button_link' => array(
				'label'           => esc_html__( 'Button Link','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter the URL for the button. (http:// must be included)','et_builder' ),
				'depends_show_if' => "on",
				),
		'content_new' => array(
				'label'           => esc_html__( 'Content','et_builder'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can create the content that will be used within the module.','et_builder' ),
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
			),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
			  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
			  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$panel_layout    = $this->shortcode_atts['panel_layout'];

		$use_icon               = $this->shortcode_atts['use_icon'];

		$icon               = $this->shortcode_atts['icon'];

		$title    = $this->shortcode_atts['title'];

		$heading_align    = $this->shortcode_atts['heading_align'];

		$heading_text_color    = $this->shortcode_atts['heading_text_color'];

		$show_button    = $this->shortcode_atts['show_button'];

		$button_link    = $this->shortcode_atts['button_link'];

		$content_new    = $this->shortcode_atts['content_new'];

			$class = "et_pb_ca_panel et_pb_module";

			$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		$display_icon = ("on" == $use_icon ? get_icon_span( $icon ) : '');

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}


		$headingSize = ("none" == $panel_layout ? 'h1' : 'h2');

		$heading_text_color = ("none" == $panel_layout && "" != $heading_text_color ?
						sprintf(' style="color: %1$s;"', $heading_text_color) : '');

		$option_padding = ("right" == $heading_align ? ' style="padding-left: 10px;"' : '');

		$heading_align = ("left" != $heading_align ? sprintf('text-align: %1$s; width: 100%;', $heading_align ) : '');

		$heading_style = ("" != $heading_text_color || "" != $heading_align ?
						sprintf(' style="%1$s%2$s"', $heading_text_color, $heading_align )  : '');

		$remove_overflow = ("none" == $panel_layout ? 'style="overflow: visible;"' : '');

		$display_options = ($show_button == "on" ? sprintf('<div class="options" %2$s>
		<a href="%1$s" class="btn btn-default">Read More</a></div>',$button_link,  $option_padding ) : '') ;

		$display_title = ("" != $title ? sprintf('<div class="panel-heading" ><%1$s%2$s>%3$s %4$s%5$s</%1$s></div>',
				$headingSize, ("" != $heading_style ? $heading_style : ''), $display_icon, $title, $display_options) : '');

		$output = sprintf('<div%5$s class="%6$s%7$s panel panel-%1$s" %2$s>
								%3$s
									<div class="panel-body">%4$s</div></div> <!-- .et_pb_panel -->',
					$panel_layout, $remove_overflow, $display_title,  $this->shortcode_content,
      	  ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
           );

		return $output;

	}

	// This is a non-standard function. It outputs JS code to render the
		// module preview in the new Divi 3 frontend editor.
		// Return value of the JS function must be full HTML code to display.
		function js_frontend_preview() {
			?>
			<script>
			window.<?php echo $this->slug; ?>_preview = function(args) {
				var id = !Boolean(args.module_id)  ? ' id="' + args.module_id + '"' : '';
				var classes =  !Boolean(args.module_class) ?  args.module_class + '"' : '';
				var heading_size = "none" == args.panel_layout ? "h1" : "h2";
				var heading_text_color = "none" == args.panel_layout && !Boolean(args.heading_text_color) ? ' style="color: ' + args.heading_text_color + '; "' : '';
				var option_padding = "right" == args.heading_align ? ' style="padding-left: 10px;"' : '';
			 	var heading_align = "left" != args.heading_align ? 'text-align: ' + args.heading_align + '; width: 100%;' : '';
				var heading_style = !Boolean(heading_text_color) || !Boolean(heading_align) ? ' style="' + heading_text_color + heading_align +'"'  : '';
 				var remove_overflow = "none" == args.panel_layout ? 'style="overflow: visible;"' : '';
				var dispay_icon = "on" == args.use_icon ? args.icon : '';
  			var display_options =  "on" == args.show_button ? '<div class="options" ' + option_padding + '><a href="'+ args.button_link +'" class="btn btn-default">Read More</a></div>' : '' ;
				var display_title = Boolean(args.title) ? '<div class="panel-heading" ><' + heading_size + heading_style +'>'+ dispay_icon + args.title + display_options +'</' + heading_size + '></div>' : '';

				var output =  '<div' + id + ' class="' + classes + ' panel panel-'+ args.panel_layout +'" ' + remove_overflow + '>' + display_title + '<div class="panel-body">' + this.props.content +'</div></div> <!-- .et_pb_panel -->';

				return output;

			}
			</script>
			<?php
		}
}
new ET_Builder_Module_Panel;

class ET_Builder_CA_Card extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Card', 'et_builder' );

		$this->slug = 'et_pb_ca_card';

		//$this->fb_support = true;
		$this->whitelisted_fields = array(
			'card_color', 'show_image', 'featured_image',
			 'title', 'content','show_button','button_text',
			  'button_link','include_header', 'card_layout',
				'include_footer','footer_text','text_color',
				'max_width', 'max_width_tablet', 'max_width_phone',
				'module_class', 'module_id', 'admin_label',
		);

		$this->fields_defaults = array(
			'button_link' => array( 'http://','add_default_setting'),
		);

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields() {
		$fields = array(
			'card_layout' => array(
				'label'             => esc_html__( 'Style','et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'default' => esc_html__( 'Default','et_builder'),
					'standout'  => esc_html__( 'Standout','et_builder'),
					'overstated'  => esc_html__( 'Overstated','et_builder'),
					'understated'  => esc_html__( 'Understated','et_builder'),
					'custom' => esc_html__( 'Custom','et_builder'),
				),
					'affects' => array('#et_pb_card_color',),
				),
			'card_color' => array(
				'label'             => esc_html__( 'Set Card Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom card color.', 'et_builder' ),
				'depends_show_if' => 'on',
			),
			'text_color' => array(
				'label'             => esc_html__( 'Set Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom text color.', 'et_builder' ),
				'depends_show_if'			 => 'on',
			),
			'show_image' => array(
				'label'           => esc_html__( 'Include Image', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_featured_image',),
			),
			'featured_image' => array(
					'label' => esc_html__( 'Featured Image', 'et_builder' ),
					'type' => 'upload',
					'option_category' => 'basic_option',
					'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
					'choose_text' => esc_attr__( 'Choose a Background Image', 'et_builder' ),
					'update_text' => esc_attr__( 'Set As Background', 'et_builder' ),
					'description' => esc_html__( 'If defined, this image will be used as the background for this location. To remove a background image, simply delete the URL from the settings field.', 'et_builder' ),
					'depends_show_if' => 'on',
					),
					'include_header' => array(
						'label'           => esc_html__( 'Header', 'et_builder' ),
						'type'            => 'yes_no_button',
						'option_category' => 'configuration',
						'options'         => array(
							'off' => esc_html__( 'No', 'et_builder' ),
							'on'  => esc_html__( 'Yes', 'et_builder' ),
						),
						'affects' => array('#et_pb_title',),
					),
			'title' => array(
				'label'           => esc_html__( 'Title','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a title for the card.','et_builder' ),
			),
			'content' => array(
					'label'           => esc_html__( 'Content','et_builder'),
					'type'            => 'tiny_mce',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Here you can create the content that will be used within the card.','et_builder' ),
			),
			'show_button' => array(
					'label'           => esc_html__( 'Button', 'et_builder' ),
					'type'            => 'yes_no_button',
					'option_category' => 'configuration',
					'options'         => array(
						'off' => esc_html__( 'No', 'et_builder' ),
						'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
					'affects' => array('#et_pb_button_text','#et_pb_button_link',),
			),
			'button_text' => array(
					'label'           => esc_html__( 'Button Text','et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Enter text for the button.','et_builder' ),
					'depends_show_if' => 'on',
			),
			'button_link' => array(
					'label'           => esc_html__( 'Card URL','et_builder' ),
					'type'            => 'text',
					'option_category' => 'basic_option',
					'description'     => esc_html__( 'Here you can enter the URL for the location. (http:// must be included)','et_builder' ),
				),
			'include_footer' => array(
						'label'           => esc_html__( 'Footer', 'et_builder' ),
						'type'            => 'yes_no_button',
						'option_category' => 'configuration',
						'options'         => array(
							'off' => esc_html__( 'No', 'et_builder' ),
							'on'  => esc_html__( 'Yes', 'et_builder' ),
						),
						'affects' => array('#et_pb_footer_text',),
			),
			'footer_text' => array(
						'label'           => esc_html__( 'Footer Text','et_builder' ),
						'type'            => 'text',
						'option_category' => 'basic_option',
						'description'     => esc_html__( 'Enter text for the footer.','et_builder' ),
						'depends_show_if' => 'on',
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
					),
					'admin_label' => array(
					  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
					  'type'        => 'text',
					  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
					),
					'module_id' => array(
					  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
					  'type'            => 'text',
					  'option_category' => 'configuration',
					  'tab_slug'        => 'custom_css',
					  'option_class'    => 'et_pb_custom_css_regular',
					),
					'module_class' => array(
					  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
					  'type'            => 'text',
					  'option_category' => 'configuration',
					  'tab_slug'        => 'custom_css',
					  'option_class'    => 'et_pb_custom_css_regular',
					),
				);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$card_layout = $this->shortcode_atts['card_layout'];

		$card_color = $this->shortcode_atts['card_color'];

		$text_color = $this->shortcode_atts['text_color'];

		$show_image               = $this->shortcode_atts['show_image'];

		$featured_image               = $this->shortcode_atts['featured_image'];

		$title               = $this->shortcode_atts['title'];

		$content               = $this->shortcode_atts['content'];

		$show_button              = $this->shortcode_atts['show_button'];

		$button_text               = $this->shortcode_atts['button_text'];

		$button_link    = $this->shortcode_atts['button_link'];

		$include_header              = $this->shortcode_atts['include_header'];

		$include_footer               = $this->shortcode_atts['include_footer'];

		$footer_text    = $this->shortcode_atts['footer_text'];

		$class = " et_pb_ca_card et_pb_module ";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
		  $max_width_values = array(
		    'desktop' => $max_width,
		    'tablet'  => $max_width_tablet,
		    'phone'   => $max_width_phone,
		  );

		  et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}
		$card_layout = ("custom" == $card_layout ? 'default'  : $card_layout);

		$card_color = ("" != $card_color ? sprintf('background-color: %1$s; ', $card_color) : "" );

		$text_color = ("" != $text_color ? sprintf('color: %1$s; ', $text_color) : "" );

		$card_style = sprintf('style="%1$s%2$s" ', $card_color, $text_color);

		$display_image = ("on" == $show_image ?
					sprintf('<img class="card-img-top img-responsive" src="%1$s" alt="Card image cap">', $featured_image) : '') ;

		$display_header = ("on" == $include_header ?
					sprintf('<div class="card-header"><h4 class="card-title">%1$s</h4></div>',$title) :
					'' 	);

		$display_button = ("on" == $show_button ?
		sprintf('<a href="%1$s" class="btn btn-default">%2$s</a>', $button_link, $button_text) : '');

		$display_footer = ("on" == $include_footer ?
		sprintf('<div class="card-footer">%1$s</div>', $footer_text) : '' ) ;

		$output = sprintf('<div%1$s class="card card-%2$s%9$s" %3$s>
									%4$s%5$s<div class="card-block">
									%6$s%7$s</div>%8$s</div>',
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
					$card_layout . $class, $card_style, $display_image, $display_header,$this->shortcode_content,
				$display_button, $display_footer,( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
 		);

		return $output;

	}
}
new ET_Builder_CA_Card;

class ET_Builder_CA_Location extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Location', 'et_builder' );

		$this->slug = 'et_pb_ca_location_widget';

		$this->whitelisted_fields = array(
			'location_layout', 'show_button','featured_image',
			 'addr','city',  'zip', 'show_icon',
			'state', 'location_link','icon', 'show_contact',
			'name','desc', 'phone', 'fax', 'max_width', 'max_width_tablet',
			 'max_width_phone', 'module_class', 'module_id', 'admin_label',
		);

		$this->fields_defaults = array(
			'icon' => array('%-1%','add_default_setting'),
			'button_link' => array( 'http://','add_default_setting'),
		);

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields() {
		$fields = array(
			'location_layout' => array(
				'label'             => esc_html__( 'Style','et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'contact' => esc_html__( 'Contact','et_builder'),
					'mini' => esc_html__( 'Mini','et_builder'),
					'banner'  => esc_html__( 'Banner','et_builder'),
				),
				'description'       => esc_html__( 'Here you can choose the style in which to display the location','et_builder' ),
				'affects' => array('#et_pb_featured_image','#et_pb_show_button','#et_pb_desc', '#et_pb_show_icon'),
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
					),
			'name' => array(
				'label'           => esc_html__( 'Location Name','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a name for the location.','et_builder' ),
			),
			'desc' => array(
				'label'           => esc_html__( 'Location Description','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter a description of the location.','et_builder' ),
				'depends_show_if' => 'banner',
				),
			'addr' => array(
				'label'           => esc_html__( 'Address','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an address.','et_builder' ),
			),
			'city' => array(
				'label'           => esc_html__( 'City','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a city.','et_builder' ),
			),
			'state' => array(
				'label'           => esc_html__( 'State','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a state.','et_builder' ),
			),
			'zip' => array(
				'label'           => esc_html__( 'Zip','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an zip.','et_builder' ),
			),
			'show_contact' => array(
				'label'           => esc_html__( 'Contact information', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_phone', '#et_pb_fax',),
			),
				'phone' => array(
				'label'           => esc_html__( 'Phone Number','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a phone number.','et_builder' ),
				'depends_show_if' => "on",
			),
			'fax' => array(
			'label'           => esc_html__( 'Fax Number','et_builder' ),
			'type'            => 'text',
			'option_category' => 'basic_option',
			'description'     => esc_html__( 'Enter a fax number.','et_builder' ),
			'depends_show_if' => "on",
		),
			'show_icon' => array(
				'label'           => esc_html__( 'Icon', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_icon',),
				'depends_show_if_not' => 'banner',
			),
				'icon' => array(
				'label'           => esc_html__( 'Icon','et_builder' ),
				'type'            => 'text',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
			'renderer_with_field' => true,
				'description'     => esc_html__( 'Select an icon.','et_builder' ),
				'depends_show_if' => 'on',
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
				'affects' => array('#et_pb_location_link',),
			),

			'location_link' => array(
				'label'           => esc_html__( 'Location URL','et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Here you can enter the URL for the location. (http:// must be included)','et_builder' ),
				'depends_show_if' => 'on',
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
		),
		'admin_label' => array(
		  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
		  'type'        => 'text',
		  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
		),
		'module_id' => array(
		  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
		  'type'            => 'text',
		  'option_category' => 'configuration',
		  'tab_slug'        => 'custom_css',
		  'option_class'    => 'et_pb_custom_css_regular',
		),
		'module_class' => array(
		  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
		  'type'            => 'text',
		  'option_category' => 'configuration',
		  'tab_slug'        => 'custom_css',
		  'option_class'    => 'et_pb_custom_css_regular',
		),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$location_layout = $this->shortcode_atts['location_layout'];

		$featured_image               = $this->shortcode_atts['featured_image'];

		$name               = $this->shortcode_atts['name'];

		$desc               = $this->shortcode_atts['desc'];

		$addr               = $this->shortcode_atts['addr'];

		$city              = $this->shortcode_atts['city'];

		$state               = $this->shortcode_atts['state'];

		$zip    = $this->shortcode_atts['zip'];

		$show_contact    = $this->shortcode_atts['show_contact'];

		$phone    = $this->shortcode_atts['phone'];

		$fax    = $this->shortcode_atts['fax'];

		$show_icon    = $this->shortcode_atts['show_icon'];

		$icon    = $this->shortcode_atts['icon'];

		$show_button    = $this->shortcode_atts['show_button'];

		$location_link    = $this->shortcode_atts['location_link'];

		$class = "et_pb_ca_location_widget et_pb_module location";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
		  $max_width_values = array(
		    'desktop' => $max_width,
		    'tablet'  => $max_width_tablet,
		    'phone'   => $max_width_phone,
		  );

		  et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}
		$display_icon = ("on" == $show_icon ? get_icon_span($icon) : '');

		$address = sprintf('%1$s, %2$s, %3$s, %4$s', $addr, $city, $state, $zip);

		if("contact" == 	$location_layout ){
				$display_other = ("on" == $show_contact ?
				sprintf('<p class="other">%1$s%2$s</p>',
				("" != $phone ? "General Information: {$phone}<br />" : ''),
				("" != $fax ?  "FAX: {$fax}" : '')	 ) : '');

			$display_button = ("on" == $show_button && "" != $location_link ? sprintf('<a href="%1$s" class="btn">View Contact</a>',$location_link) : '' );
			$address = ("" != $name ? sprintf('%1$s<br />%2$s', $name, $address) : $address);


				$output =sprintf('<div%1$s class="%2$s%3$s contact">
			    %4$s  <div class="contact">
				        <p class="address">%5$s</p>%6$s%7$s</div></div>',
								( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
								esc_attr( $class ), ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
								$display_icon, $address, $display_other, $display_button );

		}elseif("mini" == 	$location_layout ){
			$output = sprintf('<div%1$s class="%2$s%3$s mini">
				%4$s<div class="contact"><div class="title"><a href="%5$s">%6$s</a></div>
				<div class="address">%7$s</div></div></div>',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
				("on" == $show_icon ? sprintf('<div>%1$s</div>', $display_icon ) : ''), $location_link, $name, $address);

		}else{
			$display_button = ("on" == $show_button && "" != $location_link ? sprintf('<a href="%1$s" class="btn">View More Details</a>',$location_link) : '' );

			$output = sprintf('<div%1$s class="%2$s%3$s banner">
						<div class="thumbnail"><img src="%4$s"></div>
						<div class="contact">
							<div class="title">%5$s</div>
							<div class="address">	<span class="ca-gov-icon-road-pin"></span><a href="%6$s">%7$s</a></div>
						</div>
						<div class="summary">%8$s%9$s</div>
					</div>',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			$featured_image, $name , $location_link, $address , (!empty($desc) ? sprintf('<div class="title">Description</div><div class="description">%1$s</div>', $desc) : '') , $display_button);

		}
		return $output;

	}
}
new ET_Builder_CA_Location;

class ET_Builder_Module_CA_Section_Primary extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Section - Primary', 'et_builder' );

		$this->slug = 'et_pb_ca_section_primary';

		$this->whitelisted_fields = array(
			'section_image','section_heading','section_content',
			'section_link',  'show_more_button' ,'featured_image_button',
			'left_right_button','slide_image_button','section_background_color',
			'heading_align', 'heading_text_color', 'max_width', 'max_width_tablet',
			'max_width_phone','module_class', 'module_id', 'admin_label',
		);

		$this->fields_defaults = array(
			'section_link' => array( 'http://','add_default_setting'),
			'show_more_button' => array('no'),
			'featured_image_button' => array('true'),
		);

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields() {
		$fields = array(
		'section_background_color' => array(
				'label'             => esc_html__( 'Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom background color for the section.', 'et_builder' ),
			),
			'section_heading' => array(
				'label' => esc_html__( 'Title', 'et_builder' ),
				'type' => 'text',
				'option_category' => 'basic_option',
				'description' => esc_html__( 'Define the title for the section.', 'et_builder' ),
					),
					'heading_text_color' => array(
						'label'             => esc_html__( 'Text Color', 'et_builder' ),
						'type'              => 'color-alpha',
						'custom_color'      => true,
						'description'       => esc_html__( 'Here you can define a custom heading color for the title.', 'et_builder' ),
					),
					'heading_align' => array(
							'label'           => esc_html__( 'Align Heading', 'et_builder' ),
							'type'            => 'select',
							'option_category' => 'configuration',
							'options'         => array(
								'left' => esc_html__( 'Left', 'et_builder' ),
								'center'  => esc_html__( 'Center', 'et_builder' ),
								'right'  => esc_html__( 'Right', 'et_builder' ),
							),
							'depends_show_if' => 'off',
					),
		'featured_image_button' => array(
				'label'           => esc_html__( 'Featured Image', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'#et_pb_left_right_button','#et_pb_section_image','#et_pb_slide_image_button',
					'#et_pb_heading_align',
				),
		),
		'left_right_button' => array(
				'label'           => esc_html__( 'Image Position', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'Left', 'et_builder' ),
					'on'  => esc_html__( 'Right', 'et_builder' ),
				),
		),
		'section_image' => array(
				'label' => esc_html__( 'Image', 'et_builder' ),
				'type' => 'upload',
				'option_category' => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text' => esc_attr__( 'Choose a Gallery Image', 'et_builder' ),
				'update_text' => esc_attr__( 'Set As Background', 'et_builder' ),
				'description' => esc_html__( 'If defined, this image will be used as the background for this module. To remove a background image, simply delete the URL from the settings field.', 'et_builder' ),
				),
		'slide_image_button' => array(
				'label'           => esc_html__( 'Fade Image from Left', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
			),
		'section_background_color' => array(
				'label'             => esc_html__( 'Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom background color for the section.', 'et_builder' ),
			),
		'show_more_button' => array(
				'label'           => esc_html__( 'More Information Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'#et_pb_section_link',
				),
			),
		'section_link' => array(
			'label' => esc_html__( 'Link URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'URL destination for the button. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
			),
		'section_content' => array(
				'label'           => esc_html__( 'Content','et_builder'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
			'description'     => esc_html__( 'Here you can create the content that will be used within the module.','et_builder' ),
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
		),
		'admin_label' => array(
		  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
		  'type'        => 'text',
		  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
		),
		'module_id' => array(
		  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
		  'type'            => 'text',
		  'option_category' => 'configuration',
		  'tab_slug'        => 'custom_css',
		  'option_class'    => 'et_pb_custom_css_regular',
		),
		'module_class' => array(
		  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
		  'type'            => 'text',
		  'option_category' => 'configuration',
		  'tab_slug'        => 'custom_css',
		  'option_class'    => 'et_pb_custom_css_regular',
		),
			);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$featured_image_button = $this->shortcode_atts['featured_image_button'];

		$heading_align = $this->shortcode_atts['heading_align'];

		$image_pos = $this->shortcode_atts['left_right_button'];

		$section_image = $this->shortcode_atts['section_image'];

		$section_heading = $this->shortcode_atts['section_heading'];

		$section_content = $this->shortcode_atts['section_content'];

		$show_more_button = $this->shortcode_atts['show_more_button'];

		$slide_image_button = $this->shortcode_atts['slide_image_button'];

		$section_link = $this->shortcode_atts['section_link'];

		$section_background_color = $this->shortcode_atts['section_background_color'];

		$heading_text_color = $this->shortcode_atts['heading_text_color'];

		$class = "et_pb_ca_section_primary et_pb_module";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );



		$section_bg_color = ("" !=  $section_background_color ?
		sprintf(' style="background: %1$s;"', $section_background_color ) : '');

		$heading_text_color = ("" != $heading_text_color ? sprintf(' color: %1$s; ', $heading_text_color) : '');

		$heading_float = sprintf(' text-align: %1$s; ', $heading_align) ;

		$display_button = ($show_more_button == "on" && $section_link != "" ?
		sprintf('<div><a href="%1$s" class="btn btn-default">More Information</a></div>', $section_link) : '');

		if("on" == $featured_image_button){
      $img_class = ("on"== $slide_image_button  ? ' animate-fadeInLeft ' : '');
      $img_class .= ("on" == $image_pos ? 'pull-right' : '') ;
     $img_style = ("on" == $image_pos ? 'style="padding-left:15px; padding-right: 0;"' : 'style="padding-left: 0;"');

			$display_image = sprintf('<div class="col-md-4 col-md-offset-0 %1$s" %3$s>
					<img src="%2$s" class="img-responsive"></div>' , $img_class, $section_image, $img_style);

				$heading_style =("" != $heading_text_color ? sprintf(' style="%1$s" ',  $heading_text_color) : '');

				$section = sprintf('<div class="col-md-15"><h2%1$s>%2$s</h2>%3$s%4$s</div>',
					$heading_style, $section_heading, 	$this->shortcode_content, $display_button);

					$body= sprintf('%1$s%2$s', $display_image, $section );



		}else{
				$heading_style = sprintf(' style="%1$s%2$s" ', $heading_float, $heading_text_color);

				$body = sprintf('<div class="col-md-10 col-md-offset-1"><h2%1$s class="text-center">%2$s</h2>
				<div  class="text-center">%3$s</div><div  class="text-center">%4$s</div></div>',
					$heading_style, $section_heading, 	$this->shortcode_content, $display_button);

		}
		$output = sprintf('<div%1$s class="%2$s%3$s section" %4$s>%5$s</div>',
		( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
		esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
		$section_bg_color, $body);

		return $output;

	}
}
new ET_Builder_Module_CA_Section_Primary;

class ET_Builder_Module_Section_Footer extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Section - Footer', 'et_builder' );

		$this->slug = 'et_pb_ca_section_footer';

		$this->child_slug      = 'et_pb_ca_section_footer_group';

		$this->child_item_text = esc_html__( 'Group', 'et_builder' );

		$this->whitelisted_fields = array(
			'section_background_color',
		'max_width', 'max_width_tablet', 'max_width_phone',
		'module_class', 'module_id', 'admin_label',
		);

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields() {
		$fields = array(
		'section_background_color' => array(
				'label'             => esc_html__( 'Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom background color for the section.', 'et_builder' ),
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
			),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
			  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
			  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$section_background_color = $this->shortcode_atts['section_background_color'];

		$class = "et_pb_ca_section_footer section";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
		  $max_width_values = array(
		    'desktop' => $max_width,
		    'tablet'  => $max_width_tablet,
		    'phone'   => $max_width_phone,
		  );

		  et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}
		$section_bg_color = ("" != $section_background_color ?
					sprintf(' style="background: %1$s" ', $section_background_color): '');

		$output = sprintf(
			'<div%1$s class="%2$s%3$s" %4$s>
				<div class="row group">
					%5$s
				</div>
			</div> <!-- .et_pb_ca_section_footer -->',
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			$section_bg_color,	$this->shortcode_content
		);

		return $output;

	}
}
new ET_Builder_Module_Section_Footer;

class ET_Builder_Module_Footer_Group extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Footer Group', 'et_builder' );

		$this->slug = 'et_pb_ca_section_footer_group';

		$this->type = 'child';

		$this->child_title_var = 'heading';

		$this->child_title_fallback_var = 'heading';

		$this->whitelisted_fields = array('heading_color', 'text_color',
			'group_icon', 'group_icon_button', 'group_title',
			'group_url', 'group_show_more_button', 'display_link_as_button',
			'group_link1_show',
			'group_link2_show', 'group_link3_show', 'group_link4_show',
			'group_link5_show', 'group_link6_show', 'group_link7_show',
			'group_link8_show', 'group_link9_show', 'group_link10_show',
		 'group_link_text1', 'group_link_url1','group_link_text2',
		 'group_link_url2', 'group_link_text3', 'group_link_url3',
		 'group_link_text4', 'group_link_url4', 'group_link_text5',
		 'group_link_url5', 'group_link_text6', 'group_link_url6',
		 'group_link_text7', 'group_link_url7', 'group_link_text8',
		 'group_link_url8', 'group_link_text9', 'group_link_url9',
		 'group_link_text10', 'group_link_url10','module_class', 'module_id',
			);

		$this->fields_defaults = array(
			'group_icon' => array('%-1%','add_default_setting'),
			'group_url' => array( 'http://','add_default_setting'),
			'group_link_url1' => array( 'http://','add_default_setting'),
					'group_link_url2' => array( 'http://','add_default_setting'),
					'group_link_url3' => array( 'http://','add_default_setting'),
					'group_link_url4' => array( 'http://','add_default_setting'),
					'group_link_url5' => array( 'http://','add_default_setting'),
					'group_link_url6' => array( 'http://','add_default_setting'),
					'group_link_url7' => array( 'http://','add_default_setting'),
					'group_link_url8' => array( 'http://','add_default_setting'),
					'group_link_url9' => array( 'http://','add_default_setting'),
					'group_link_url10' => array( 'http://','add_default_setting'),
			);

		$this->advanced_setting_title_text = esc_html__( 'New Footer Group', 'et_builder' );

		$this->settings_text = esc_html__( 'Footer Group Settings', 'et_builder' );

		$this->main_css_element = '%%order_class%%';
	}
	function get_fields() {
		$fields = array(
			'heading_color' => array(
				'label'             => esc_html__( 'Heading Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom heading color for the title.', 'et_builder' ),
			),
			'text_color' => array(
				'label'             => esc_html__( 'Text Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom text color for the list items.', 'et_builder' ),
			),
		'group_title' => array(
			'label' => esc_html__( 'Title', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the title for the group section.', 'et_builder' ),
				),
		'group_icon_button' => array(
				'label'           => esc_html__( 'List Icon', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects'     => array(
					'#et_pb_group_icon',
				),
		),
		'group_icon' => array(
			'label' => esc_html__( 'Group Icon', 'et_builder' ),
			'type' => 'text',
  		'option_category'     => 'configuration',
			'class'    => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
			'renderer_with_field' => true,
			'description' => esc_html__( 'Define the icon for the group section.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_show_more_button' => array(
				'label'           => esc_html__( 'Read More Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_group_url',),
			),
		'group_url' => array(
			'label' => esc_html__( 'Read More URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the url for the Read More Button. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
		),
		'display_link_as_button' => array(
				'label'           => esc_html__( 'Links as Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
				),
				'group_link1_show' => array(
				'label'           => esc_html__( 'Link 1', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text1','#et_pb_group_link_url1',
						),
			),
		'group_link_text1' => array(
			'label' => esc_html__( 'Link 1 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
			),
		'group_link_url1' => array(
			'label' => esc_html__( 'Link 1 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link2_show' => array(
				'label'           => esc_html__( 'Link 2', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text2','#et_pb_group_link_url2',
						),
			),
			'group_link_text2' => array(
			'label' => esc_html__( 'Link 2 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url2' => array(
			'label' => esc_html__( 'Link 2 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link3_show' => array(
				'label'           => esc_html__( 'Link 3', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text3','#et_pb_group_link_url3',
						),
			),
		'group_link_text3' => array(
			'label' => esc_html__( 'Link 3 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url3' => array(
			'label' => esc_html__( 'Link 3 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link4_show' => array(
				'label'           => esc_html__( 'Link 4', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text4','#et_pb_group_link_url4',
						),
			),
		'group_link_text4' => array(
			'label' => esc_html__( 'Link 4 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url4' => array(
			'label' => esc_html__( 'Link 4 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link5_show' => array(
				'label'           => esc_html__( 'Link 5', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text5','#et_pb_group_link_url5',
						),
			),
		'group_link_text5' => array(
			'label' => esc_html__( 'Link 5 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url5' => array(
			'label' => esc_html__( 'Link 5 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link6_show' => array(
				'label'           => esc_html__( 'Link 6', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text6','#et_pb_group_link_url6',
						),
			),
		'group_link_text6' => array(
			'label' => esc_html__( 'Link 6 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
		),
		'group_link_url6' => array(
			'label' => esc_html__( 'Link 6 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link7_show' => array(
				'label'           => esc_html__( 'Link 7', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text7','#et_pb_group_link_url7',
						),
			),
		'group_link_text7' => array(
			'label' => esc_html__( 'Link 7 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url7' => array(
			'label' => esc_html__( 'Link 7 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link8_show' => array(
				'label'           => esc_html__( 'Link 8', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text8','#et_pb_group_link_url8',
						),
			),
		'group_link_text8' => array(
			'label' => esc_html__( 'Link 8 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url8' => array(
			'label' => esc_html__( 'Link 8 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link9_show' => array(
				'label'           => esc_html__( 'Link 9', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text9','#et_pb_group_link_url9',
						),
			),
		'group_link_text9' => array(
			'label' => esc_html__( 'Link 9 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url9' => array(
			'label' => esc_html__( 'Link 9 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link10_show' => array(
				'label'           => esc_html__( 'Link 10', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					),
		'affects' => array(
					'#et_pb_group_link_text10','#et_pb_group_link_url10',
						),
			),
		'group_link_text10' => array(
			'label' => esc_html__( 'Link 10 Text', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the text for the link.', 'et_builder' ),
			'depends_show_if' => 'on',
				),
		'group_link_url10' => array(
			'label' => esc_html__( 'Link 10 URL', 'et_builder' ),
			'type' => 'text',
			'option_category' => 'basic_option',
			'description' => esc_html__( 'Define the URL for the destination. (http:// must be included)', 'et_builder' ),
			'depends_show_if' => 'on',
				),
				'module_id' => array(
				  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
				  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$heading_color = $this->shortcode_atts['heading_color'];

		$text_color= $this->shortcode_atts['text_color'];

		$group_icon = $this->shortcode_atts['group_icon'];

		$group_title = $this->shortcode_atts['group_title'];

		$group_url = $this->shortcode_atts['group_url'];

		$group_icon_button = $this->shortcode_atts['group_icon_button'];

		$group_show_more_button = $this->shortcode_atts['group_show_more_button'];

		$display_link_as_button= $this->shortcode_atts['display_link_as_button'];

		$group_link1_show = $this->shortcode_atts['group_link1_show'];

		$group_link_text1 = $this->shortcode_atts['group_link_text1'];

		$group_link_url1 = $this->shortcode_atts['group_link_url1'];

		$group_link2_show = $this->shortcode_atts['group_link2_show'];

		$group_link_text2 = $this->shortcode_atts['group_link_text2'];

		$group_link_url2 = $this->shortcode_atts['group_link_url2'];

		$group_link3_show = $this->shortcode_atts['group_link3_show'];

		$group_link_text3 = $this->shortcode_atts['group_link_text3'];

		$group_link_url3 = $this->shortcode_atts['group_link_url3'];

		$group_link4_show = $this->shortcode_atts['group_link4_show'];

		$group_link_text4 = $this->shortcode_atts['group_link_text4'];

		$group_link_url4 = $this->shortcode_atts['group_link_url4'];

		$group_link5_show = $this->shortcode_atts['group_link5_show'];

		$group_link_text5 = $this->shortcode_atts['group_link_text5'];

		$group_link_url5 = $this->shortcode_atts['group_link_url5'];

		$group_link6_show = $this->shortcode_atts['group_link6_show'];

		$group_link_text6 = $this->shortcode_atts['group_link_text6'];

		$group_link_url6 = $this->shortcode_atts['group_link_url6'];

		$group_link7_show = $this->shortcode_atts['group_link7_show'];

		$group_link_text7 = $this->shortcode_atts['group_link_text7'];

		$group_link_url7 = $this->shortcode_atts['group_link_url7'];

		$group_link8_show = $this->shortcode_atts['group_link8_show'];

		$group_link_text8 = $this->shortcode_atts['group_link_text8'];

		$group_link_url8 = $this->shortcode_atts['group_link_url8'];

		$group_link9_show = $this->shortcode_atts['group_link9_show'];

		$group_link_text9 = $this->shortcode_atts['group_link_text9'];

		$group_link_url9 = $this->shortcode_atts['group_link_url9'];

		$group_link10_show = $this->shortcode_atts['group_link10_show'];

		$group_link_text10 = $this->shortcode_atts['group_link_text10'];

		$group_link_url10 = $this->shortcode_atts['group_link_url10'];

		$class = "quarter";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		$heading_color = ("" != $heading_color ?
		sprintf(' style="color: %1$s" ', $heading_color) : '');

		$text_color = ("" != $text_color ?
		sprintf(' style="color: %1$s" ', $text_color) : '');

		$icon = ("on" == $group_icon_button ? get_icon_span($group_icon, sprintf('color: %1$s;' , $text_color)) : '');

		$link_as_button = ("on" == $display_link_as_button ? ' class="btn btn-default btn-xs" ' : '');

		$no_pad = ("on" != $group_icon_button ? 'padding-left: 0 !important;' : '');

		$display_more_button = ("on" == $group_show_more_button ?
		sprintf('<a href="%1$s" class="btn btn-primary">Read More</a>',$group_url) : '');

		$group_links = '';

		$group_links .= ("on" == $group_link1_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url1, $link_as_button, $text_color, $icon, $group_link_text1 ) : '');

		$group_links .= ("on" == $group_link2_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url2, $link_as_button, $text_color, $icon, $group_link_text2 ) : '');

		$group_links .= ("on" == $group_link3_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url3, $link_as_button, $text_color, $icon, $group_link_text3 ) : '');

		$group_links .= ("on" == $group_link4_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url4, $link_as_button, $text_color, $icon, $group_link_text4 ) : '');

		$group_links .= ("on" == $group_link5_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url5, $link_as_button, $text_color, $icon, $group_link_text5 ) : '');

		$group_links .= ("on" == $group_link6_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url6, $link_as_button, $text_color, $icon, $group_link_text6 ) : '');

		$group_links .= ("on" == $group_link7_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url7, $link_as_button, $text_color, $icon, $group_link_text7 ) : '');

		$group_links .= ("on" == $group_link8_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url8, $link_as_button, $text_color, $icon, $group_link_text8 ) : '');

		$group_links .= ("on" == $group_link9_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url9, $link_as_button, $text_color, $icon, $group_link_text9 ) : '');

		$group_links .= ("on" == $group_link10_show ?
		sprintf('<li><a href="%1$s"%2$s%3$s>%4$s%5$s</a></li>' ,
		$group_link_url10, $link_as_button, $text_color, $icon, $group_link_text10 ) : '');

		$output = sprintf('<div%1$s class="%2$s%3$s">
				<h4 %4$s>%5$s</h4>
				<ul class="list-unstyled" style="list-style-type: none; %6$s">
				%7$s</ul></div>' ,
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
				esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
				 $heading_color, $group_title, $no_pad, $group_links);

		return $output;

	}
}
new ET_Builder_Module_Footer_Group;

class ET_Builder_Module_CA_Section_Carousel extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Section - Carousel', 'et_builder' );

		$this->slug = 'et_pb_ca_section_carousel';

		$this->child_slug      = 'et_pb_ca_section_carousel_slide';

		$this->child_item_text = esc_html__( 'Slide', 'et_builder' );

		$this->whitelisted_fields = array('carousel_style',
																			'section_background_color',
																			'max_width',
																			'max_width_tablet',
																			'max_width_phone',
																			'module_class',
																			'module_id',
																			'admin_label',);

		$this->fields_defaults = array();

		$this->main_css_element = '%%order_class%%';

	}


	function get_fields() {
		$fields = array(
			'carousel_style' => array(
							'label'           => esc_html__( 'Style', 'et_builder' ),
							'type'            => 'select',
							'option_category' => 'configuration',
							'options'         => array(
								'content_fit' => esc_html__( 'Content Fit', 'et_builder' ),
								'image_fit'  => esc_html__( 'Image Fit', 'et_builder' ),
							),
				),
		'section_background_color' => array(
				'label'             => esc_html__( 'Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'description'       => esc_html__( 'Here you can define a custom background color for the section.', 'et_builder' ),
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
			),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
			  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
			  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
			  'type'            => 'text',
			  'option_category' => 'configuration',
			  'tab_slug'        => 'custom_css',
			  'option_class'    => 'et_pb_custom_css_regular',
			),
		);

		return $fields;

	}

	function pre_shortcode_content() {
		global $et_pb_ca_section_carousel_style;

		$et_pb_ca_section_carousel_style = $this->shortcode_atts['carousel_style'];

	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		$carousel_style            = $this->shortcode_atts['carousel_style'];
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$section_background_color = $this->shortcode_atts['section_background_color'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		$class = "et_pb_ca_section_carousel et_pb_module  " . $carousel_style;

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
		  $max_width_values = array(
		    'desktop' => $max_width,
		    'tablet'  => $max_width_tablet,
		    'phone'   => $max_width_phone,
		  );

		  et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}
		$section_background_color = ("" != $section_background_color ?
		sprintf(' style="background: %1$s;" ', $section_background_color) : '');

		$output = sprintf('<div%1$s class="%2$s%3$s section"%4$s>
				<div class="container">
				<div class="group">
				<div class="col-md-10 col-md-offset-1 ">
				<div class="carousel owl-carousel carousel-content">
				%5$s </div>
				</div>
				</div>
				</div>
			</div> <!-- et_pb_ca_section_carousel -->',
		( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
		esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
		$section_background_color, $this->shortcode_content);

		return $output;

	}
}
new ET_Builder_Module_CA_Section_Carousel;

class ET_Builder_Module_CA_Section_Carousel_Slide extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Carousel Slide', 'et_builder' );

		$this->slug = 'et_pb_ca_section_carousel_slide';

		$this->type = 'child';

		$this->child_title_var = 'slide_title';

		$this->child_title_fallback_var = 'slide_title';

		$this->whitelisted_fields = array(
			'slide_image', 'slide_title',
			 'slide_desc',	'slide_url',
			'slide_show_more_button','module_class', 'module_id',
			);

		$this->fields_defaults = array(
			'slide_url' => array( 'http://','add_default_setting'),
			);

		$this->advanced_setting_title_text = esc_html__( 'New Carousel Slide', 'et_builder' );

		$this->settings_text = esc_html__( 'Carousel Slide Settings', 'et_builder' );

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields(){
		$fields = array(
			'slide_image' => array(
				'label' => esc_html__( 'Image', 'et_builder' ),
				'type' => 'upload',
				'option_category' => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text' => esc_attr__( 'Choose a Background Image', 'et_builder' ),
				'update_text' => esc_attr__( 'Set As Background', 'et_builder' ),
				'description' => esc_html__( 'If defined, this image will be used as the background for this slide. To remove a background image, simply delete the URL from the settings field.', 'et_builder' ),
				),
		'slide_title' => array(
				'label' => esc_html__( 'Title', 'et_builder' ),
				'type'=> 'text',
				'option_category' => 'basic_option',
				'description' => esc_html__( 'Define the title for the slide', 'et_builder' ),
				),
		'slide_show_more_button' => array(
				'label'           => esc_html__( 'More Information Button', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'affects' => array('#et_pb_slide_url',),
			),
		'slide_url' => array(
				'label' => esc_html__( 'Slide URL', 'et_builder' ),
				'type'=> 'text',
				'option_category' => 'basic_option',
				'description' => esc_html__( 'Define the url for the slide. (http:// must be included)', 'et_builder' ),
				'depends_show_if' => 'on',
				),
		'slide_desc' => array(
				'label' => esc_html__( 'Description', 'et_builder' ),
				'type'=> 'textarea',
				'option_category' => 'basic_option',
				'description' => esc_html__( 'Define the text for the slide content', 'et_builder' ),
				),
				'module_id' => array(
				  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
				  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
			);

			return $fields;

		}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$slide_image = $this->shortcode_atts['slide_image'];

		$slide_title = $this->shortcode_atts['slide_title'];

		$slide_desc = $this->shortcode_atts['slide_desc'];

		$slide_url = $this->shortcode_atts['slide_url'];

		$slide_show_more_button = $this->shortcode_atts['slide_show_more_button'];

			//$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		global $et_pb_slider_item_num;
		global $et_pb_ca_section_carousel_style;

		$et_pb_slider_item_num++;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$class = $et_pb_ca_section_carousel_style . ' et_pb_module ';

		$display_button = ("on" == $slide_show_more_button ?
		sprintf('<br><button class="btn btn-primary">
					<a href="%1$s"><strong>More Information</strong></a></button>', $slide_url) : '');

		$slide_title = ("" != $slide_title ? sprintf('<h2>%1$s</h2>', $slide_title) : '');

			$output = sprintf('<div%1$s class="%2$s%3$s item backdrop" %4$s>
													%5$s
													<div class="content-container">
														<div class="content">
														%6$s%7$s%8$s
														</div>
													</div>
												</div>',
		( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
		esc_attr( $class ),( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			("content_fit" == $et_pb_ca_section_carousel_style ? sprintf('style="background-image: url(%1$s);"', $slide_image) : ''),
			( "image_fit" == $et_pb_ca_section_carousel_style ? sprintf( '<img src="%1$s" />', $slide_image ) : '' ),
			$slide_title, $slide_desc, $display_button );

			return $output;

	}
}
new ET_Builder_Module_CA_Section_Carousel_Slide;

class ET_Builder_Module_CA_Post_List extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Post List', 'et_builder' );

		$this->slug = 'et_pb_ca_post_list';

		$this->whitelisted_fields = array('style', 'title',
			'all_categories_button','include_categories', 'faq_style',
			'all_tags_button','include_tags', 'view_featured_image',
			'posts_number', 'module_class', 'module_id',
			'orderby', 'admin_label', 'title_size',
		);

		$this->fields_defaults = array(
			'orderby'  => array( 'date_desc' ),
		);

		$this->main_css_element = '%%order_class%%';

	}
	function get_fields() {
		$fields = array(
			'title' => array(
				'label'       => esc_html__( 'Title', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'Enter a title for the Post List.', 'et_builder' ),
			),
			'title_size' => array(
				'label'       => esc_html__( 'Title Size', 'et_builder' ),
				'type'        => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'h-1' => esc_html__('H1 - Large', 'et_builder' ),
					'h-2' => esc_html__('H2 - Medium', 'et_builder' ),
					'h-3' => esc_html__('H3 - Small', 'et_builder' ),
				),
				'description' => esc_html__( 'Select the size for the title of this module.', 'et_builder' ),
			),
			'style' => array(
				'label'             => esc_html__( 'Content Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'course-list' => esc_html__( 'Course List', 'et_builder'),
					'events-list'  => esc_html__( 'Event List', 'et_builder' ),
					'exams-list'  => esc_html__( 'Exam List', 'et_builder' ),
					'faqs-list'  => esc_html__( 'FAQs List', 'et_builder' ),
					'general-list'  => esc_html__( 'General List', 'et_builder' ),
					'jobs-list'  => esc_html__( 'Jobs List', 'et_builder' ),
					'news-list'  => esc_html__( 'News List', 'et_builder' ),
					'profile-list'  => esc_html__( 'Profile List', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can select the various list styles.', 'et_builder' ),
				'affects' => array('#et_pb_all_categories_button', '#et_pb_faq_style', '#et_pb_view_featured_image'),
			),
			'faq_style' => array(
				'label'             => esc_html__( 'Accordion Style', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'accordion' => esc_html__( 'Accordion', 'et_builder'),
					'toggle'  => esc_html__( 'Toggle', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can select the various list styles.', 'et_builder' ),
				'depends_show_if' => 'faqs-list',
			),
			'posts_number' => array(
				'label'             => esc_html__( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how many posts you would like to display in the list. Default is all.', 'et_builder' ),
			),
			'view_featured_image' => array(
				'label'           => esc_html__( 'Featured Image', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if_not' => 'faqs-list',
			),
				'all_categories_button' => array(
				'label'           => esc_html__( 'Include All Categories', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'affects' => array(
							'#et_pb_include_categories',
				),
				'depends_show_if' => 'general-list',
			),
			'include_categories' => array(
				'label'            => esc_html__( 'Select Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_categories_option',
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the list.', 'et_builder' ),
				'depends_show_if' => 'off',
			),
			'all_tags_button' => array(
				'label'           => esc_html__( 'Include All Tags', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
					),
				'affects' => array('#et_pb_include_tags',
				),
			),
			'include_tags' => array(
				'label'            => esc_html__( 'Tags', 'et_builder' ),
				'renderer'         => 'et_builder_include_tags_option',
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which tags you would like to include in the list.', 'et_builder' ),
				'depends_show_if' => 'off',
			),
			'orderby' => array(
				'label'             => esc_html__( 'Order By', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'date_desc'  => esc_html__( 'Date: new to old', 'et_builder' ),
					'date_asc'   => esc_html__( 'Date: old to new', 'et_builder' ),
					'title_asc'  => esc_html__( 'Title: a-z', 'et_builder' ),
					'title_desc' => esc_html__( 'Title: z-a', 'et_builder' ),
					'rand'       => esc_html__( 'Random', 'et_builder' ),
				),
				'description'       => esc_html__( 'Here you can adjust the order in which posts are displayed.', 'et_builder' ),
			),
			'module_id' => array(
				  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
				  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$list_title            = $this->shortcode_atts['title'];

		$title_size    = $this->shortcode_atts['title_size'];

		$style            = $this->shortcode_atts['style'];

		$faq_style            = $this->shortcode_atts['faq_style'];

		$posts_number            = $this->shortcode_atts['posts_number'];

		$view_featured_image            = $this->shortcode_atts['view_featured_image'];

		$all_categories_button            = $this->shortcode_atts['all_categories_button'];

		$include_categories      = $this->shortcode_atts['include_categories'];

		$all_tags_button            = $this->shortcode_atts['all_tags_button'];

		$include_tags      = $this->shortcode_atts['include_tags'];

		$orderby                 = $this->shortcode_atts['orderby'];

		$order = '';

		$cat_array = array();

		$tag_array = array();

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );


		switch( $orderby ) {
			case 'date_desc':
					$orderby = 'date';
					$order = 'DESC';
					break;
			case 'date_asc' :
					$orderby = 'date';

					$order = 'ASC';

					break;

			case 'title_asc' :
					$orderby = 'title';

					$order = 'ASC';

					break;

			case 'title_desc' :
					$orderby = 'title';

					$order = 'DESC';

					break;

			case 'rand' :
					$orderby = 'rand';

					break;

		}


			if("on" == $all_categories_button ){
				$cat_array = get_terms( 'category', array('orderby' => $orderby, 'hide_empty' => 0, 'fields' => 'ids'));

			}elseif ( "" !== $include_categories) {
				$cat_array = $include_categories;
			}

			if("on" == $all_tags_button){
				$tag_array = array();
				//$tag_array = get_tags( array( 'fields' => 'names' ) );
			}elseif("" !== $include_tags){
				$tag_array =	$include_tags;
			}


			$posts_number = ( !empty($posts_number) ? $posts_number : -1);

			$all_posts = return_posts($cat_array ,$tag_array, -1, $orderby, $order );

			setlocale(LC_MONETARY, 'en_US.UTF-8');

			if (!empty($list_title)){
				if ('h-1' == $title_size){
					$list_title = sprintf('<h1>%1$s</h1>', $list_title);
				}
				elseif ('h-2' == $title_size){
					$list_title = sprintf('<h2>%1$s</h2>', $list_title);
				}
				elseif ('h-3' == $title_size) {
					$list_title = sprintf('<h3>%1$s</h3>', $list_title);
				}
			}

			$faqs = '';
			$output = '';
			global $faq_accordion_count;
		//global $faq_count;

			foreach ($all_posts as $a=>$p){
				if( $posts_number !== -1 && 0 == $posts_number )
				  break;

				// Get the CAWeb Post Handler
				$post_id = $all_posts[$a]->ID;
				$title = $all_posts[$a]->post_title;
				$url = get_permalink($all_posts[$a]->ID);
				$content = $all_posts[$a]->post_content;

				$post_content_handler = caweb_get_shortcode_from_content($content, 'et_pb_ca_post_handler');

				// if the hanlder is an object, construct the appropriate list item
				if ( is_object($post_content_handler) ){
					// List Style
					switch($style){
						// News List
						case "news-list":
								// if post contains a CAWeb News Post Handler
								if ( "news" == $post_content_handler->post_type_layout ){
									$news_title = sprintf('<div class="headline"><a href="%1$s">%2$s</a></div>', $url, $title);

                  $image= ( "on" == $view_featured_image ?
                  				sprintf('<div class="thumbnail" style="">%1$s</div>', get_the_post_thumbnail($post_id,null,array( 'style'=>'width: 150px; height: 100px;') ))  : '' );


									$excerpt = caweb_get_excerpt($post_content_handler->content, 30);
									$excerpt = ( !empty($excerpt) ?
															sprintf('<div class="description"><p>%1$s</p></div>', $excerpt ) : '' );

									$author = (!empty($post_content_handler->news_author) ?
															sprintf('Author: %1$s', $post_content_handler->news_author) : '');


                   $date =( !empty($post_content_handler->news_publish_date) ? gmdate( 'M j, Y', strtotime( $post_content_handler->news_publish_date ) ) : '');

                  $date = ( !empty($date) ? sprintf('Published: <time>%1$s</time>',$date) : '');


									$element = (!empty($author) || !empty($date) ?
															sprintf('<div class="published">%1$s</div>', implode('<br />', array_filter( array($author, $date) ) ) ) : '');

									$output .=	sprintf('<article class="news-item">%1$s<div class="info" %5$s>%2$s%3$s%4$s</div></article>',
														$image, $news_title , $excerpt, $element , ( "on" == $view_featured_image ? 'style="padding-left: 175px;"' : '') );

									$posts_number--;
								}
								break;

						// Profile List
						case "profile-list":
						// if post contains a CAWeb Profile Post Handler
							if ( "profile" == $post_content_handler->post_type_layout ){
                $image= (  "on" == $view_featured_image ?
                         sprintf('<div class="thumbnail" >%1$s</div>', get_the_post_thumbnail($post_id, null, array('style'=>'width: 70px; height: 93px;') )) : '' );
                $no_img = ( empty($image) ? ' style="margin-left: 0px;" ': '');

								$t = sprintf('%1$s%2$s%3$s',
                             (!empty($post_content_handler->profile_name_prefix) ? sprintf('%1$s ',$post_content_handler->profile_name_prefix) : ''),
                             (!empty($post_content_handler->profile_name) ? $post_content_handler->profile_name : ''),
                             ( !empty($post_content_handler->profile_career_title) ? sprintf(', %1$s' , $post_content_handler->profile_career_title) : '') );

								$profile_title = sprintf('<div class="header" %3$s><div class="title" %4$s><a href="%1$s">%2$s</a></div></div>',
                                         $url, $t, $no_img, ( !empty($image) ? ' style="min-height: 20px;" ': '')  );

								$position = ( !empty($post_content_handler->profile_career_position) ?
												sprintf('%1$s',$post_content_handler->profile_career_position  )  : '' );
								$line1 = ( !empty($post_content_handler->profile_career_line_1) ?
												sprintf('%1$s', $post_content_handler->profile_career_line_1 )  : '' );
								$line2 = ( !empty($post_content_handler->profile_career_line_2) ?
												sprintf('%1$s',$post_content_handler->profile_career_line_2  )  : '' );
								$line3 = ( !empty($post_content_handler->profile_career_line_3) ?
												sprintf('%1$s', $post_content_handler->profile_career_line_3 )  : '' );

								$fields = array_filter(array($position, $line1, $line2, $line3 ));


								$output .=	sprintf('<article class="profile-item">%1$s%2$s<div class="body" %5$s><p>%3$s</p></div>
																		<div class="footer"><a href="%4$s" class="btn btn-default">View More Details</a></div></article>',
																		$image, $profile_title,  (!empty($fields) ? implode( '<br />', $fields ) : '<br />'), $url,  $no_img);

								$posts_number--;
							}

							break;
						// Job List
						case "jobs-list":
								// if post contains a CAWeb Job Post Handler
								if ( "jobs" == $post_content_handler->post_type_layout ){
									$job_title = sprintf('<div class="title"><a href="%1$s">%2$s</a></div>', $url, $title);

									$addr = ( !empty($post_content_handler->job_agency_address) ? $post_content_handler->job_agency_address : '');
									$city = ( !empty($post_content_handler->job_agency_city) ? $post_content_handler->job_agency_city : '');
									$state = ( !empty($post_content_handler->job_agency_state) ? $post_content_handler->job_agency_state : '');
									$zip = ( !empty($post_content_handler->job_agency_zip) ? $post_content_handler->job_agency_zip : '');

									$location = array_filter( array($addr, $city, $state , $zip) );

									$location = ( !empty($location) ? sprintf('<div class="location">Location: %1$s</div>', implode(", ", $location) ) : '' );

                  if(!empty($post_content_handler->job_final_filing_date_chooser) && "on" == $post_content_handler->job_final_filing_date_chooser){
                      $job_final_filing_date_picker = gmdate( 'n/j/Y', strtotime( $post_content_handler->job_final_filing_date_picker ) );
                      $filing_date = sprintf('Final Filing Date:<time>%1$s</time><br />', $job_final_filing_date_picker);

                   }else{
                      $filing_date = sprintf('Final Filing Date: %1$s<br />',
                                     (!empty($post_content_handler->job_final_filing_date) ? $post_content_handler->job_final_filing_date : 'Until Filled') );

                   }


									$job_hours =   ( !empty( $post_content_handler->job_hours ) ? sprintf('<div class="schedule">%1$s</div>', $post_content_handler->job_hours) : '' );

									$job_salary_min    = (!empty($post_content_handler->job_salary_min) ? is_money($post_content_handler->job_salary_min,"$0.00") : "$0.00" );
									$job_salary_max    = (!empty($post_content_handler->job_salary_max) ? is_money($post_content_handler->job_salary_max,"$0.00") : "$0.00" );

                  $job_salary_max = sprintf('  &mdash; %1$s', $job_salary_max );

                  $job_salary = '';
									$job_salary    = ( "on" == $post_content_handler->show_job_salary ?
									sprintf('<div class="salary-range">Salary Range: %1$s%2$s</div>', $job_salary_min, $job_salary_max ) : '' );

                  $job_position = '';
									if( !empty( $post_content_handler->job_position_number ) && !empty( $post_content_handler->job_rpa_number )){
										$job_position    = sprintf('Position Number: %1$s, RPA #%2$s', $post_content_handler->job_position_number, $post_content_handler->job_rpa_number) ;
									}elseif( !empty( $post_content_handler->job_position_number ) ){
										$job_position    = sprintf('Position Number: %1$s', $post_content_handler->job_position_number) ;
									}elseif( !empty( $post_content_handler->job_rpa_number ) ){
										$job_position    = sprintf('RPA #%1$s', $post_content_handler->job_rpa_number) ;
									}

									$position_type= ( !empty($job_position) ? sprintf('<div class="position-number">%1$s</div>', $job_position) : '' );

									$output .= sprintf('<article class="job-item">
															<div class="header">%1$s%2$s</div>
															<div class="body">%3$s%4$s%5$s%6$s</div>
															<div class="footer"><a href="%7$s" class="btn btn-default">View More Details</a></div></article>',
																		$job_title, $filing_date , $position_type, $job_hours, $job_salary, $location, $url );
									$posts_number--;
								}
								break;
						// Event List
						case "events-list":
							// if post contains a CAWeb Event Post Handler
								if ( "event" == $post_content_handler->post_type_layout ){
									$event_title = sprintf('<h5 style="padding-bottom: 0!important;"><a href="%1$s" class="title" style="color: #428bca;">%2$s</a></h5>', $url, $title);

									$excerpt = caweb_get_excerpt($post_content_handler->content, 15);
									$excerpt = ( !empty($excerpt) ?
															sprintf('<div class="description">%1$s</div>', $excerpt ) : '' );

                   $date = (!empty($post_content_handler->event_start_date) ?
                          sprintf('<div class="start-date"><time>%1$s</time></div>', gmdate( 'D, n/j/Y g:i a', strtotime($post_content_handler->event_start_date ) ) ) : '');


									$output .= sprintf('<article class="event-item">%1$s%2$s%3$s</article>', $event_title, $excerpt, $date );

									$posts_number--;
								}
								break;
						// Course List
						case "course-list":
							// if post contains a CAWeb Course Post Handler
								if ( "course" == $post_content_handler->post_type_layout ){
									$course_title = sprintf('<div class="title"><a href="%1$s">%2$s</a></div>', $url, $title);

									$image= ( "on" == $view_featured_image ?
													sprintf('<div class="thumbnail" >%1$s</div>', get_the_post_thumbnail($post_id, array(70, 70))) : '' );

									$excerpt = caweb_get_excerpt($post_content_handler->content, 20);
									$excerpt = ( !empty($excerpt) ?
															sprintf('<div class="description">%1$s</div>', $excerpt ) : '' );

									$tmp = array((!empty($post_content_handler->course_address) ? $post_content_handler->course_address: ''),
															(!empty($post_content_handler->course_city) ? $post_content_handler->course_city: ''),
															(!empty($post_content_handler->course_state) ? $post_content_handler->course_state: ''),
															(!empty($post_content_handler->course_zip) ? $post_content_handler->course_zip: ''));

									$location = array_filter($tmp );

									$location = ( !empty($location) ?
											sprintf('<div class="location">Location: <a href="https://www.google.com/maps/place/%1$s">%1$s</a></div>', implode(", ", $location) ) : '' );


									$course_date = sprintf('<div class="datetime">%1$s - %2$s</div>',
																				(!empty($post_content_handler->course_start_date) ? gmdate( 'M j, Y g:i a', strtotime($post_content_handler->course_start_date ) ) : ''),
																				( !empty($post_content_handler->course_end_date)? gmdate( 'M j, Y g:i a', strtotime($post_content_handler->course_end_date ) ) :'') );

									$output .= sprintf('<article class="course-item">
															%1$s<div class="header">%2$s%3$s</div>
															<div class="body">%4$s%5$s</div>
															<div class="footer"><a href="%6$s" class="btn btn-default">View More Details</a></div></article>',
																		$image, $course_title, $course_date, $excerpt, $location, $url );

									$posts_number--;
								}
								break;
						// Exam List
						case "exams-list":
							// if post contains a CAWeb Course Post Handler
								if ( "exam" == $post_content_handler->post_type_layout ){
									$exam_title = sprintf('<div class="title"><a href="%1$s">%2$s</a></div>', $url, $title);

                  $pub = (!empty($post_content_handler->exam_published_date) ?
                          sprintf('<div class="published">Published: <time>%1$s</time></div>', gmdate( 'M j, Y', strtotime($post_content_handler->exam_published_date ) ) ) : '');

									$filing_date = (!empty($post_content_handler->exam_final_filing_date_chooser) && "on" == $post_content_handler->exam_final_filing_date_chooser ?
                            sprintf('<div class="filing-date">Final Filing Date: <time>%1$s</time></div>', gmdate( 'n/j/Y', strtotime( $post_content_handler->exam_final_filing_date_picker ) )) :
                                  sprintf('<div class="filing-date">Final Filing Date: <time>%1$s</time></div>',
                                          (!empty($post_content_handler->exam_final_filing_date) ? $post_content_handler->exam_final_filing_date : 'Until Filled') ) );

									$id = (!empty($post_content_handler->exam_id) ? sprintf('<div class="id">ID: %1$s</div>', $post_content_handler->exam_id) : '');
									$status = (!empty($post_content_handler->exam_status) ?  sprintf('<div class="base">Status: %1$s</div>', $post_content_handler->exam_status) : '');

									$output .= sprintf('<article class="exam-item">
															<div class="header">%1$s%2$s</div>
															<div class="body">%3$s%4$s</div>
															<div class="footer">%5$s<a href="%6$s" class="btn btn-default">View More Details</a></div></article>',
																		$exam_title, $filing_date , $id, $status, $pub, $url );
									$posts_number--;
								}
								break;

						// FAQs List
						case "faqs-list":

							if ( "faqs" == $post_content_handler->post_type_layout ){
									if("toggle" == $faq_style)
											$faqs .= sprintf('<li><a class="toggle">%1$s</a><div class="description">%2$s</div></li>', $title, $post_content_handler->content );

									if("accordion" == $faq_style){
										$open_faq = empty($faq_accordion_count) || 0 === $faq_accordion_count;

										$faqs .= sprintf('<div class="panel panel-default et_pb_toggle et_pb_accordion_item_%3$s %4$s">
																	<div class="et_pb_toggle_title panel-heading"><h4 class="panel-title"><a>%2$s</a></h4></div>',
																					$posts_number, $title, (!empty($faq_accordion_count) ? $faq_accordion_count : 0), ($open_faq ? ' et_pb_toggle_open' : ' et_pb_toggle_close'));

										$faqs .= sprintf('<div class="et_pb_toggle_content clearfix panel-body">
											%1$s</div></div>',$post_content_handler->content	);
										$faq_accordion_count++;
										//$faq_count++;
									}


								$posts_number--;
							}
							break;

						// General List
						case "general-list":
								// if post contains a CAWeb News Post Handler
								$list_types = array('news', 'profile', 'jobs', 'event', 'course', 'exam', 'general', 'faqs');
								if ( in_array( $post_content_handler->post_type_layout, $list_types )){

									$image= ( "on" == $view_featured_image ?
													sprintf('<div class="thumbnail" style="width: 150px; height: 100px; margin-right:15px; float:left;">%1$s</div>',
																	get_the_post_thumbnail($post_id,null,array( 'style'=>'width: 150px; height: 100px;') ))  : '' );

									$general_title = sprintf('<h5 style="padding-bottom: 0!important; %1$s">
																		<a href="%2$s" class="title" style="color: #428bca; background: url();">%3$s</a></h5>',
																			( "on" == $view_featured_image ? '' : '') ,	$url, $title);

									$excerpt = caweb_get_excerpt($post_content_handler->content, 45);
									$excerpt = sprintf('<div class="description" %2$s>%1$s</div>', $excerpt,
																			( "on" == $view_featured_image ? '' : '')  );


									$output .= sprintf('<article class="event-item" style="padding-left: 0px;">%1$s%2$s%3$s</article>', $image, $general_title, $excerpt );

									$posts_number--;
								}
								break;

					} // end of list type switch statement
				} // end of if is_object check
			}

		global $faq_list_count;

			$class = sprintf('et_pb_module et_pb_ca_post_list panel-group et_pb_accordion et_pb_accordion_%1$s %2$s', (!empty($faq_list_count) ? $faq_list_count : 0), (!empty($style) ? $style : ''));

		$class = esc_attr( $class );
		$class .= ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' );

			if ( "faqs-list" == $style){

				if("toggle" == $faq_style)
					$output .= sprintf('<ul class="list-overstated accordion-list" style="list-style-type:none;">%1$s</ul>', $faqs);

				if("accordion" == $faq_style){
					$output .=  $faqs;
					$faq_list_count++;
				}
			}


			$output = sprintf('<div class="%1$s">%2$s%3$s</div> <!-- .et_pb_ca_post_list -->', $class,( !empty($list_title) ? $list_title : '' ), $output );

			$faq_accordion_count = 0;
			return $output;

	}
}
new ET_Builder_Module_CA_Post_List;

class ET_Builder_Module_Profile_Banner extends ET_Builder_Module {
	function init() {
		$this->name = esc_html__( 'Profile Banner', 'et_builder' );

		$this->slug = 'et_pb_profile_banner';

		$this->whitelisted_fields = array(
			'name', 'max_width', 'max_width_tablet', 'max_width_phone',
			'job_title', 'admin_label',
			'url', 'disabled_on', 'module_class', 'module_id',
			'portrait_url', 'profile_link', 'round_image',
		);

		$this->fields_defaults = array(
			'url'       => array( 'http://','add_default_setting' ),
		);

		$this->main_css_element = '%%order_class%%.et_pb_profile_banner';

	}
	function get_fields() {
		$fields = array(
			'name' => array(
				'label'           => esc_html__( 'Profile Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the name of the profile.', 'et_builder' ),
			),
			'job_title' => array(
				'label'           => esc_html__( 'Job Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the job title.', 'et_builder' ),
			),
			'profile_link' => array(
				'label'           => esc_html__( 'Profile Link', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the text for the profile link.', 'et_builder' ),
			),
			'url' => array(
				'label'           => esc_html__( 'Profile URL', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input the website of the profile or leave blank for no link.', 'et_builder' ),
			),
			'portrait_url' => array(
				'label'              => esc_html__( 'Portrait Image URL', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display. (http:// must be included)', 'et_builder' ),
			),
			'round_image' => array(
				'label'              => esc_html__( 'Round Image', 'et_builder' ),
				'type'               => 'yes_no_button',
				'option_category'    => 'configuration',
				'options'        => array(
				  'off' => esc_html__( 'No', 'et_builder' ),
				  'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
			  'description' => esc_html__('Switch to yes if you want round images in the profile banner.'),
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
			),
				'module_id' => array(
				  'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
				  'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'tab_slug'        => 'custom_css',
				  'option_class'    => 'et_pb_custom_css_regular',
				),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
		);

		return $fields;

	}
	function shortcode_callback( $atts, $content = null, $function_name ) {
		$module_id            = $this->shortcode_atts['module_id'];

		$module_class         = $this->shortcode_atts['module_class'];

		$name                 = $this->shortcode_atts['name'];

		$job_title              = $this->shortcode_atts['job_title'];

		$profile_link              = $this->shortcode_atts['profile_link'];

		$portrait_url           = $this->shortcode_atts['portrait_url'];

		$round                = $this->shortcode_atts['round_image'];

		$url                    = $this->shortcode_atts['url'];

		$max_width            = $this->shortcode_atts['max_width'];

		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];

		$max_width_phone      = $this->shortcode_atts['max_width_phone'];

		$class = "et_pb_profile_banner et_pb_module";

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_tablet,
				'phone'   => $max_width_phone,
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );

		}

		$banner_style = 'style="background:url('.get_stylesheet_directory_uri().'/images/banner/banner-blank.png' . ') no-repeat; background-size: 100% 100%;"';

		$image = ('on' !== $round ?
						sprintf('<img src="%1$s" style="width: 90px; min-height: 90px;float: right;"/>', $portrait_url) :
						sprintf('<div class="profile-banner-img-wrapper">
							<img src="%1$s" style="width: 90px; min-height: 90px;float: right;"/>
						</div>', $portrait_url)
				  );

		$output = sprintf('<div id="profile-banner-wrapper" class="%8$s%9$s"><a href="%5$s"><div class="profile-banner%7$s" %1$s>
											%2$s
											<div class="banner-subtitle">%3$s</div>
											<div class="banner-title">%4$s</div>
											<div class="banner-link"><p>%6$s</p>
						          </div></div></a></div>',
					($round == 'off' ? $banner_style : ''),  $image, $job_title, $name, $url,
					$profile_link, ('on' !== $round ? '' : ' round-image'),  esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ) );

		return $output;

	}
}
new ET_Builder_Module_Profile_Banner;

?>
