<?php
/*
Divi Icon Field Names
When using the et_pb_get_font_icon_list to render the icon picker,
make sure the field name is one of the following:
'font_icon', 'button_one_icon', 'button_two_icon',  'button_icon'
*/

class ET_Builder_Module_CAWeb_Post_Handler extends ET_Builder_CAWeb_Module{
	function init() {
		$this->name = esc_html__( 'Post Detail', 'et_builder' );

		$this->slug = 'et_pb_ca_post_handler';
		$this->post_types = array('post');

		$this->whitelisted_fields = array(
			'post_type_layout',
			'show_tags_button',
			'show_categories_button',
			'content_new',
			'max_width',
			'max_width_tablet',
			'max_width_phone',
			'max_width_last_edited',
			'disabled_on',
			'module_class',
			'module_id',
			'admin_label',
			'news_author',
			'news_publish_date',
			'news_publish_date_format',
			'news_publish_date_custom_format',
			'news_city',
			'profile_name_prefix',
			'profile_name',
			'profile_image_align',
			'profile_additional_fields',
			'profile_career',
			'profile_career_title',
			'profile_career_position',
			'profile_career_line_1',
			'profile_career_line_2',
			'profile_career_line_3',
			'show_about_agency',
			'job_agency_name',
			'job_agency_address',
			'job_agency_city',
			'job_final_filing_date_chooser',
			'job_final_filing_date',
			'job_final_filing_date_picker',
			'job_final_filing_date_format',
			'job_final_filing_date_custom_format',
			'job_agency_state',
			'job_agency_zip',
			'job_agency_about',
			'job_hours',
			'show_job_salary',
			'job_salary_min',
			'job_salary_max',
			'job_posted_date',
			'job_posted_date_format',
			'job_posted_date_custom_format',
			'job_position_number',
			'job_rpa_number',
			'job_ds_url',
			'show_job_apply_to',
			'job_apply_to_dept',
			'job_apply_to_name',
			'job_apply_to_address',
			'job_apply_to_city',
			'job_apply_to_state',
			'job_apply_to_zip',
			'job_questions_email',
			'show_job_questions',
			'job_questions_name',
			'job_questions_phone',
			'job_qualifications',
			'job_skills',
			'show_event_presenter',
			'event_presenter_image',
			'event_presenter_name',
			'event_presenter_bio',
			'event_start_date',
			'event_start_date_format',
			'event_start_date_custom_format',
			'event_end_date',
			'event_end_date_format',
			'event_end_date_custom_format',
			'show_event_address',
			'event_address',
			'event_city',
			'event_organizer',
			'event_state',
			'event_zip',
			'event_cost',
			'event_registration_type',
			'exam_id',
			'exam_class',
			'exam_status',
			'exam_published_date',
			'exam_published_date_format',
			'exam_published_date_custom_format',
			'exam_final_filing_date_chooser',
			'exam_final_filing_date',
			'exam_final_filing_date_picker',
			'exam_final_filing_date_format',
			'exam_final_filing_date_custom_format',
			'exam_type',
			'exam_url',
			'exam_address',
			'exam_city',
			'exam_state',
			'exam_zip',
			'show_course_presenter',
			'course_presenter_image',
			'course_presenter_name',
			'course_presenter_bio',
			'course_start_date',
			'course_start_date_format',
			'course_start_date_custom_format',
			'course_end_date',
			'course_end_date_format',
			'course_end_date_custom_format',
			'show_course_address',
			'course_address',
			'course_city',
			'course_state',
			'course_zip',
			'course_cost',
			'course_registration_type',
			'show_course_map',
		);

		$this->fields_defaults = array(
			'news_publish_date_format' => array('off','add_default_setting'),
			'news_publish_date_custom_format' => array('M d, Y','add_default_setting'),
			'exam_published_date_format' => array('off','add_default_setting'),
      'exam_published_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
      'exam_final_filing_date' => array('Until Filled','add_default_setting'),
			'exam_final_filing_date_format' => array('off','add_default_setting'),
      'exam_final_filing_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
			'course_start_date' => date('D, n/j/Y'),
			'course_start_date_format' => array('off','add_default_setting'),
      'course_start_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
			'course_end_date_format' => array('off','add_default_setting'),
      'course_end_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
			'event_start_date' => date('D, n/j/Y'),
			'event_start_date_format' => array('off','add_default_setting'),
      'event_start_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
			'event_end_date_format' => array('off','add_default_setting'),
      'event_end_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
			'job_posted_date_format' => array('off','add_default_setting'),
      'job_posted_date_custom_format' => array('M d, Y','add_default_setting'),
      'job_final_filing_date' => array('Until Filled','add_default_setting'),
			'job_final_filing_date_format' => array('off','add_default_setting'),
      'job_final_filing_date_custom_format' => array('D, n/j/Y g:i a','add_default_setting'),
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

		// Custom handler: Output JS for editor preview in page footer.
		//add_action( 'wp_footer', array( $this, 'remove_general_detail' ) );
	}

	function get_fields() {
		$fields = array(
			'post_type_layout' => array(
				'label'             => esc_html__( 'Content Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'class'               => array('caweb_post_handler_style_selector'),
				'options'           => array(
					'general' => esc_html__( 'General', 'et_builder'),
					'course'  => esc_html__( 'Courses', 'et_builder'),
					'event'  => esc_html__( 'Events', 'et_builder'),
					'exam'  => esc_html__( 'Exams', 'et_builder'),
					'faqs'  => esc_html__( 'FAQs', 'et_builder'),
					'jobs'  => esc_html__( 'Jobs', 'et_builder'),
					'news' => esc_html__( 'News', 'et_builder'),
					'profile'  => esc_html__( 'Profile', 'et_builder'),
				),
				'description'       => esc_html__( 'This is the layout style', 'et_builder' ),
				'affects'           => array('news_author', 'news_publish_date','news_publish_date_format', 'news_city', 'profile_name_prefix', 'profile_name',
											'profile_title', 'profile_image_align',	'profile_career','profile_additional_fields',
											'show_about_agency','job_title', 'job_hours', 'event_organizer',
											'show_job_salary', 'job_posted_date','job_posted_date_format', 'job_position_number', 'job_rpa_number', 'job_ds_url',
											'job_final_filing_date_chooser', 'show_job_apply_to','show_job_questions',
											 'show_event_presenter', 'event_start_date', 'event_end_date', 'event_start_date_format', 'event_end_date_format',
											 'show_event_address', 'event_registration_type', 'event_cost', 'exam_id', 'exam_status', 'exam_class',
											 'exam_published_date', 'exam_published_date_format', 'exam_final_filing_date_chooser',
                       'exam_type', 'show_course_presenter', 'course_start_date', 'course_end_date', 'course_start_date_format', 'course_end_date_format',
											 'course_duration',	'show_course_address', 'course_registration_type', 'course_cost', 'show_course_map'
				 ),
				 'toggle_slug'  => 'style',
			),

		);

		$news_fields = array(
			'news_author' => array(
				'label'           => esc_html__( 'Author', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an Author for this news item.', 'et_builder' ),
				'depends_show_if' => 'news',
				'toggle_slug'			=> 'body',
			),
			'news_publish_date' => array(
				'label'           => esc_html__( 'Publish Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a Publish Date for this news item.', 'et_builder' ),
				'depends_show_if' => 'news',
				'toggle_slug'			=> 'body',
			),
			'news_publish_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'news',
				'affects' => array('news_publish_date_custom_format'),
				'toggle_slug'			=> 'body',
    	),
			'news_publish_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'news_city' => array(
				'label'           => esc_html__( 'News Location', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a Location for this news item.', 'et_builder' ),
				'depends_show_if' => 'news',
				'toggle_slug'			=> 'body',
			),
		);

		$profile_fields = array(
			'profile_name_prefix' => array(
				'label'           => esc_html__( 'Name Prefix', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a prefix for this profile item.', 'et_builder' ),
				'depends_show_if' => 'profile',
				'toggle_slug'			=> 'body',
			),
			'profile_name' => array(
				'label'           => esc_html__( 'Profile Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a profile name for this profile item.', 'et_builder' ),
				'depends_show_if' => 'profile',
				'toggle_slug'			=> 'header',
			),
			'profile_image_align' => array(
				'label'             => esc_html__( 'Image Alignment', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Left", 'et_builder' ),
					'on'  => esc_html__( 'Right', 'et_builder' ),
				),
				'depends_show_if' => 'profile',
				'description' => 'Alignment for the featured profile image',
				'toggle_slug'			=> 'style',
			),
			'profile_career' => array(
				'label'             => esc_html__( 'Career', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'profile',
				'description' => 'Job related fields',
				'affects' => array('profile_career_title', 'profile_career_position'),
				'toggle_slug'			=> 'body',
			),
			'profile_career_title' => array(
				'label'           => esc_html__( 'Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'profile_career_position' => array(
				'label'           => esc_html__( 'Position', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'profile_additional_fields' => array(
				'label'             => esc_html__( 'Additional List Fields', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'profile',
				'description' => 'Additional information for the Post List.',
				'affects' => array('profile_career_line_1', 'profile_career_line_2', 'profile_career_line_3'),
				'toggle_slug'			=> 'body',
			),
			'profile_career_line_1' => array(
				'label'           => esc_html__( 'Line 1', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'profile_career_line_2' => array(
				'label'           => esc_html__( 'Line 2', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'profile_career_line_3' => array(
				'label'           => esc_html__( 'Line 3', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
		);

		$exam_fields = array(
			'exam_id' => array(
				'label'           => esc_html__( 'Exam Code', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an Exam Code for this exam item.', 'et_builder' ),
				'depends_show_if' => 'exam',
				'toggle_slug'			=> 'header',
			),
			'exam_class' => array(
				'label'           => esc_html__( 'Class Code', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an Class Code for this exam item.', 'et_builder' ),
				'depends_show_if' => 'exam',
				'toggle_slug'			=> 'body',
			),
			'exam_status' => array(
				'label'             => esc_html__( 'Status', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'open' => esc_html__( 'Open', 'et_builder'),
					'closed'  => esc_html__( 'Closed', 'et_builder'),
				),
				'depends_show_if' => 'exam',
				'description'       => esc_html__( 'Select the status for this exam item.', 'et_builder' ),
				'toggle_slug'			=> 'body',
			),
			'exam_published_date' => array(
				'label'           => esc_html__( 'Publish Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the Publish Date for this exam item.', 'et_builder' ),
				'depends_show_if' => 'exam',
				'toggle_slug'			=> 'body',
			),
			'exam_published_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'exam',
				'affects' => array('exam_published_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'exam_published_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
				),
      'exam_final_filing_date_chooser' => array(
				'label'           => esc_html__( 'Use Date Picker for Final Filing Date', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'exam',
				'affects' => array('exam_final_filing_date', 'exam_final_filing_date_picker', 'exam_final_filing_date_format'),
				'toggle_slug'			=> 'body',
				),
			'exam_final_filing_date' => array(
				'label'           => esc_html__( 'Final Filing Date', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the Final Filing Date for this exam item.', 'et_builder' ),
				'depends_show_if' => 'off',
				'toggle_slug'			=> 'body',
			),
      'exam_final_filing_date_picker' => array(
				'label'           => esc_html__( 'Final Filing Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the Final Filing Date for this exam item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
      'exam_final_filing_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'on',
				'affects' => array('exam_final_filing_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'exam_final_filing_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
        'depends_show_if' => 'exam',
        'depends_show_if_not' => 'off',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'exam_type' => array(
				'label'             => esc_html__( 'Exam Type', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'web' => esc_html__( 'Web', 'et_builder'),
					'location'  => esc_html__( 'Classroom', 'et_builder'),
				),
				'depends_show_if' => 'exam',
				'affects' => array('exam_url', 'exam_address', 'exam_city',  'exam_state', 'exam_zip'),
				'toggle_slug'			=> 'body',
			),
			'exam_url' => array(
				'label'           => esc_html__( 'URL', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the URL for this exam item. (http:// must be included)', 'et_builder' ),
				'depends_show_if' => 'exam',
				'depends_show_if_not' => 'location',
				'toggle_slug'			=> 'body',
			),
			'exam_address' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter address for this job item.', 'et_builder' ),
				'depends_show_if' => 'location',
				'toggle_slug'			=> 'body',
			),
			'exam_city' => array(
				'label'           => esc_html__( 'City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter city for this job item.', 'et_builder' ),
				'depends_show_if' => 'location',
				'toggle_slug'			=> 'body',
			),
			'exam_state' => array(
				'label'           => esc_html__( 'State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter state for this job item.', 'et_builder' ),
				'depends_show_if' => 'location',
				'toggle_slug'			=> 'body',
			),
			'exam_zip' => array(
				'label'           => esc_html__( 'Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter zip code for this job item.', 'et_builder' ),
				'depends_show_if' => 'location',
				'toggle_slug'			=> 'body',
			),
		);

		$course_fields = array(
			'show_course_presenter' => array(
				'label'             => esc_html__( 'Presenter', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'course',
				'affects' => array('course_presenter_name', 'course_presenter_image', 'course_presenter_bio'),
				'toggle_slug'			=> 'body',
			),
			'course_presenter_name' => array(
				'label'           => esc_html__( 'Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_presenter_image' => array(
				'label'              => esc_html__( 'Image', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_presenter_bio' => array(
				'label'           => esc_html__( 'Short Bio', 'et_builder' ),
				'type'            => 'textarea',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_start_date' => array(
				'label'           => esc_html__( 'Start Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter start date for this course item.', 'et_builder' ),
				'depends_show_if' => 'course',
				'toggle_slug'			=> 'body',
			),
			'course_start_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'course',
				'affects' => array('course_start_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'course_start_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'course_end_date' => array(
				'label'           => esc_html__( 'End Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter end date for this course item.', 'et_builder' ),
				'depends_show_if' => 'course',
				'toggle_slug'			=> 'body',
			),
      'course_end_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'course',
				'affects' => array('course_end_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'course_end_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'show_course_address' => array(
				'label'             => esc_html__( 'Course Location', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'course',
				'affects' => array('course_address', 'course_city',  'course_state', 'course_zip'),
				'toggle_slug'			=> 'body',
			),
			'course_address' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Course address for this course item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_city' => array(
				'label'           => esc_html__( 'City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Course city for this course item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_state' => array(
				'label'           => esc_html__( 'State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Course state for this course item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_zip' => array(
				'label'           => esc_html__( 'Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Course zip code for this course item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'course_registration_type' => array(
				'label'             => esc_html__( 'Registration Type', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'description'       => esc_html__( 'Enter a registration type for this course item.', 'et_builder' ),
				'depends_show_if' => 'course',
				'toggle_slug'			=> 'body',
				),
			'course_cost' => array(
				'label'           => esc_html__( 'Cost', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Course Cost for this course item.', 'et_builder' ),
				'depends_show_if' => 'course',
				'toggle_slug'			=> 'body',
			),
			'show_course_map' => array(
				'label'             => esc_html__( 'Course Map', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'course',
				'toggle_slug'			=> 'body',
			),
		);

		$event_fields = array(
			'event_organizer' => array(
				'label'           => esc_html__( 'Organizer', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'event',
				'description'     => esc_html__( 'Enter the name of the organizer.', 'et_builder' ),
				'toggle_slug'			=> 'body',
			),
			'show_event_presenter' => array(
				'label'             => esc_html__( 'Presenter', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'event',
				'affects' => array('event_presenter_name', 'event_presenter_image', 'event_presenter_bio'),
				'toggle_slug'			=> 'body',
			),
			'event_presenter_name' => array(
				'label'           => esc_html__( 'Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
				'event_presenter_image' => array(
				'label'              => esc_html__( 'Image', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Image', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_presenter_bio' => array(
				'label'           => esc_html__( 'Short Bio', 'et_builder' ),
				'type'            => 'textarea',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_start_date' => array(
				'label'           => esc_html__( 'Start Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter start date for this event item.', 'et_builder' ),
				'depends_show_if' => 'event',
				'toggle_slug'			=> 'body',
			),
      'event_start_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'event',
				'affects' => array('event_start_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'event_start_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'event_end_date' => array(
				'label'           => esc_html__( 'End Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter end date for this event item.', 'et_builder' ),
				'depends_show_if' => 'event',
				'toggle_slug'			=> 'body',
			),
      'event_end_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'event',
				'affects' => array('event_end_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'event_end_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'show_event_address' => array(
				'label'             => esc_html__( 'Event Location', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'event',
				'affects' => array('event_address', 'event_city',  'event_state', 'event_zip'),
				'toggle_slug'			=> 'body',
			),
			'event_address' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Event address for this event item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_city' => array(
				'label'           => esc_html__( 'City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Event city for this event item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_state' => array(
				'label'           => esc_html__( 'State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Event state for this event item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_zip' => array(
				'label'           => esc_html__( 'Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Event zip code for this event item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'event_registration_type' => array(
				'label'             => esc_html__( 'Registration Type', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'basic_option',
				'description'       => esc_html__( 'Enter a registration type for this event item.', 'et_builder' ),
				'depends_show_if' => 'event',
				'toggle_slug'			=> 'body',
				),
			'event_cost' => array(
				'label'           => esc_html__( 'Cost', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Event Cost for this event item.', 'et_builder' ),
				'depends_show_if' => 'event',
				'toggle_slug'			=> 'body',
			),
		);

		$job_fields = array(
			'show_about_agency' => array(
				'label'             => esc_html__( 'Agency', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_agency_name', 'job_agency_address', 'job_agency_city',
													'job_agency_state', 'job_agency_zip', 'job_agency_about',),
				'toggle_slug'			=> 'body',
			),
			'job_agency_name' => array(
				'label'           => esc_html__( 'Agency Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter an Agency Name for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_agency_address' => array(
				'label'           => esc_html__( 'Agency Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Agency address for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_agency_city' => array(
				'label'           => esc_html__( 'Agency City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Agency city for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_agency_state' => array(
				'label'           => esc_html__( 'Agency State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Agency state for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_agency_zip' => array(
				'label'           => esc_html__( 'Agency Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Agency zip code for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_agency_about' => array(
				'label'           => esc_html__( 'About Agency', 'et_builder' ),
				'type'            => 'textarea',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter information about the Agency for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_hours' => array(
				'label'           => esc_html__( 'Job Hours', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter job hours for this job item.', 'et_builder' ),
				'depends_show_if' => 'jobs',
				'toggle_slug'			=> 'body',
			),
			'show_job_salary' => array(
				'label'             => esc_html__( 'Salary', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_salary_min', 'job_salary_max', ),
				'toggle_slug'			=> 'body',
			),
			'job_salary_min' => array(
				'label'           => esc_html__( 'Minimum Salary', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_salary_max' => array(
				'label'           => esc_html__( 'Maximum Salary', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_posted_date' => array(
				'label'           => esc_html__( 'Date Posted', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter posted date for this job item.', 'et_builder' ),
				'depends_show_if' => 'jobs',
				'toggle_slug'			=> 'body',
			),
      'job_posted_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_posted_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'job_posted_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'job_position_number' => array(
				'label'           => esc_html__( 'Position Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a position number for this job item.', 'et_builder' ),
				'depends_show_if' => 'jobs',
				'toggle_slug'			=> 'body',
			),
			'job_rpa_number' => array(
				'label'           => esc_html__( 'RPA Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a rpa number for this job item.', 'et_builder' ),
				'depends_show_if' => 'jobs',
				'toggle_slug'			=> 'body',
			),
			'job_ds_url' => array(
				'label'           => esc_html__( 'Duty Statement (URL)', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the duty statement\'s url link for this job item. (http:// must be included)', 'et_builder' ),
				'depends_show_if' => 'jobs',
				'toggle_slug'			=> 'body',
			),
      'job_final_filing_date_chooser' => array(
				'label'           => esc_html__( 'Use Date Picker for Final Filing Date', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_final_filing_date', 'job_final_filing_date_picker', 'job_final_filing_date_format'),
				'toggle_slug'			=> 'body',
				),
			'job_final_filing_date' => array(
				'label'           => esc_html__( 'Final Filing Date', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the final filing date for this job item.', 'et_builder' ),
				'depends_show_if' => 'off',
				'toggle_slug'			=> 'body',
			),
      'job_final_filing_date_picker' => array(
				'label'           => esc_html__( 'Final Filing Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter the Final Filing Date for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
      'job_final_filing_date_format' => array(
				'label'           => esc_html__( 'Custom Date Format', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options' => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'depends_show_if' => 'on',
				'affects' => array('job_final_filing_date_custom_format'),
				'toggle_slug'			=> 'body',
			),
			'job_final_filing_date_custom_format' => array(
				'label'           => esc_html__( 'Pattern', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
        'depends_show_if' => 'on',
				'description'     => et_get_safe_localization(
																		sprintf( __( 'For formatting help visit <a href="%1$s" target="_blank" title="Formatting Date and Time">Formatting Date and Time</a>', 'et_builder' ),
																						esc_url( 'https://codex.wordpress.org/Formatting_Date_and_Time' ) ) ),
				'toggle_slug'			=> 'body',
			),
			'show_job_apply_to' => array(
				'label'             => esc_html__( 'Apply to', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_apply_to_dept','job_apply_to_name','job_apply_to_address', 'job_apply_to_city',
													'job_apply_to_state','job_apply_to_zip'),
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_dept' => array(
				'label'           => esc_html__( 'Department', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Department Name for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_name' => array(
				'label'           => esc_html__( 'Contact Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact Name for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_address' => array(
				'label'           => esc_html__( 'Address', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact address for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_city' => array(
				'label'           => esc_html__( 'City', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact city for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_state' => array(
				'label'           => esc_html__( 'State', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact state for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_apply_to_zip' => array(
				'label'           => esc_html__( 'Zip', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact zip code for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'show_job_questions' => array(
				'label'             => esc_html__( 'Questions', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( "Hide", 'et_builder' ),
					'on'  => esc_html__( 'Show', 'et_builder' ),
				),
				'depends_show_if' => 'jobs',
				'affects' => array('job_questions_name', 'job_questions_phone', 'job_questions_email'),
				'toggle_slug'			=> 'body',
			),
			'job_questions_name' => array(
				'label'           => esc_html__( 'Name', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact Name for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_questions_phone' => array(
				'label'           => esc_html__( 'Phone Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact Phone Number for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
			'job_questions_email' => array(
				'label'           => esc_html__( 'Email', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter Contact Email for this job item.', 'et_builder' ),
				'depends_show_if' => 'on',
				'toggle_slug'			=> 'body',
			),
		);

		$ending_fields = array(
			'content_new' => array(
				'label'           => esc_html__( 'Content', 'et_builder'),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter additional content for this item.', 'et_builder' ),
				'toggle_slug'			=> 'body',
			),
			'show_tags_button' => array(
				'label'           => esc_html__( 'Tags', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'toggle_slug'			=> 'body',
			),
			'show_categories_button' => array(
				'label'           => esc_html__( 'Categories', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'toggle_slug'			=> 'body',
			),
			'admin_label' => array(
			  'label'       => esc_html__( 'Admin Label', 'et_builder' ),
			  'type'        => 'text',
			  'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
				'toggle_slug'			=> 'admin_label',
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
		);

		return array_merge($fields, $event_fields, $exam_fields, $job_fields, $news_fields, $profile_fields, $course_fields, $ending_fields);

	}

	function shortcode_callback($atts, $content = null, $function_name) {
		global $post;

		$post_type_layout    = $this->shortcode_atts['post_type_layout'];

		// Course Attributes
		$show_course_presenter = $this->shortcode_atts['show_course_presenter'];

		$course_presenter_name = $this->shortcode_atts['course_presenter_name'];

		$course_presenter_image = $this->shortcode_atts['course_presenter_image'];

		$course_presenter_bio = $this->shortcode_atts['course_presenter_bio'];

		$course_start_date = $this->shortcode_atts['course_start_date'];

		$course_start_date_format = $this->shortcode_atts['course_start_date_format'];

		$course_start_date_custom_format = $this->shortcode_atts['course_start_date_custom_format'];

		$course_end_date = $this->shortcode_atts['course_end_date'];

		$course_end_date_format = $this->shortcode_atts['course_end_date_format'];

		$course_end_date_custom_format = $this->shortcode_atts['course_end_date_custom_format'];

		$show_course_address = $this->shortcode_atts['show_course_address'];

		$course_address = $this->shortcode_atts['course_address'];

		$course_city = $this->shortcode_atts['course_city'];

		$course_state = $this->shortcode_atts['course_state'];

		$course_zip = $this->shortcode_atts['course_zip'];

		$course_registration_type = $this->shortcode_atts['course_registration_type'];

		$course_cost = $this->shortcode_atts['course_cost'];

		$show_course_map = $this->shortcode_atts['show_course_map'];

		// Event Attributes
		$event_organizer = $this->shortcode_atts['event_organizer'];

		$show_event_presenter = $this->shortcode_atts['show_event_presenter'];

		$event_presenter_name = $this->shortcode_atts['event_presenter_name'];

		$event_presenter_image = $this->shortcode_atts['event_presenter_image'];

		$event_presenter_bio = $this->shortcode_atts['event_presenter_bio'];

		$event_start_date = $this->shortcode_atts['event_start_date'];

		$event_start_date_format = $this->shortcode_atts['event_start_date_format'];

		$event_start_date_custom_format = $this->shortcode_atts['event_start_date_custom_format'];

    $event_end_date = $this->shortcode_atts['event_end_date'];

		$event_end_date_format = $this->shortcode_atts['event_end_date_format'];

		$event_end_date_custom_format = $this->shortcode_atts['event_end_date_custom_format'];

		$show_event_address = $this->shortcode_atts['show_event_address'];

		$event_address = $this->shortcode_atts['event_address'];

		$event_city = $this->shortcode_atts['event_city'];

		$event_state = $this->shortcode_atts['event_state'];

		$event_zip = $this->shortcode_atts['event_zip'];

		$event_registration_type = $this->shortcode_atts['event_registration_type'];

		$event_cost = $this->shortcode_atts['event_cost'];

		// Exam Attributes
		$exam_id = $this->shortcode_atts['exam_id'];

  	$exam_class = $this->shortcode_atts['exam_class'];

		$exam_status = $this->shortcode_atts['exam_status'];

		$exam_published_date = $this->shortcode_atts['exam_published_date'];

		$exam_published_date_format = $this->shortcode_atts['exam_published_date_format'];

		$exam_published_date_custom_format = $this->shortcode_atts['exam_published_date_custom_format'];

		$exam_final_filing_date_chooser = $this->shortcode_atts['exam_final_filing_date_chooser'];

		$exam_final_filing_date = $this->shortcode_atts['exam_final_filing_date'];

		$exam_final_filing_date_picker = $this->shortcode_atts['exam_final_filing_date_picker'];

		$exam_final_filing_date_format = $this->shortcode_atts['exam_final_filing_date_format'];

		$exam_final_filing_date_custom_format = $this->shortcode_atts['exam_final_filing_date_custom_format'];

    $exam_type = $this->shortcode_atts['exam_type'];

		$exam_url = $this->shortcode_atts['exam_url'];

		$exam_address = $this->shortcode_atts['exam_address'];

		$exam_city = $this->shortcode_atts['exam_city'];

		$exam_state = $this->shortcode_atts['exam_state'];

		$exam_zip = $this->shortcode_atts['exam_zip'];

		// Job Attributes

		$show_about_agency    = $this->shortcode_atts['show_about_agency'];

		$job_agency_name    = $this->shortcode_atts['job_agency_name'];

		$job_agency_address    = $this->shortcode_atts['job_agency_address'];

		$job_agency_city    = $this->shortcode_atts['job_agency_city'];

		$job_agency_state    = $this->shortcode_atts['job_agency_state'];

		$job_agency_zip    = $this->shortcode_atts['job_agency_zip'];

		$job_agency_about    = $this->shortcode_atts['job_agency_about'];

		$job_posted_date    = $this->shortcode_atts['job_posted_date'];

		$job_posted_date_format = $this->shortcode_atts['job_posted_date_format'];

		$job_posted_date_custom_format = $this->shortcode_atts['job_posted_date_custom_format'];

		$job_hours    = $this->shortcode_atts['job_hours'];

		$show_job_salary    = $this->shortcode_atts['show_job_salary'];

		$job_salary_min    = $this->shortcode_atts['job_salary_min'];

		$job_salary_max    = $this->shortcode_atts['job_salary_max'];

		$job_position_number    = $this->shortcode_atts['job_position_number'];

		$job_rpa_number    = $this->shortcode_atts['job_rpa_number'];

		$job_ds_url    = $this->shortcode_atts['job_ds_url'];

		$job_final_filing_date_chooser = $this->shortcode_atts['job_final_filing_date_chooser'];

		$job_final_filing_date    = $this->shortcode_atts['job_final_filing_date'];

		$job_final_filing_date_picker = $this->shortcode_atts['job_final_filing_date_picker'];

		$job_final_filing_date_format = $this->shortcode_atts['job_final_filing_date_format'];

		$job_final_filing_date_custom_format = $this->shortcode_atts['job_final_filing_date_custom_format'];

		$show_job_apply_to = $this->shortcode_atts['show_job_apply_to'];

		$job_apply_to_dept = $this->shortcode_atts['job_apply_to_dept'];

		$job_apply_to_name = $this->shortcode_atts['job_apply_to_name'];

		$job_apply_to_address = $this->shortcode_atts['job_apply_to_address'];

		$job_apply_to_city = $this->shortcode_atts['job_apply_to_city'];

		$job_apply_to_state = $this->shortcode_atts['job_apply_to_state'];

		$job_apply_to_zip = $this->shortcode_atts['job_apply_to_zip'];

		$show_job_questions = $this->shortcode_atts['show_job_questions'];

		$job_questions_name = $this->shortcode_atts['job_questions_name'];

		$job_questions_phone = $this->shortcode_atts['job_questions_phone'];

		$job_questions_email = $this->shortcode_atts['job_questions_email'];

		// News Attributes
		$news_author               = $this->shortcode_atts['news_author'];

		$news_publish_date               = $this->shortcode_atts['news_publish_date'];

    $news_publish_date_format               = $this->shortcode_atts['news_publish_date_format'];

		$news_publish_date_custom_format               = $this->shortcode_atts['news_publish_date_custom_format'];

		$news_city    = $this->shortcode_atts['news_city'];

		// Profile Attributes

		$profile_name_prefix               = $this->shortcode_atts['profile_name_prefix'];

		$profile_name               = $this->shortcode_atts['profile_name'];

		$profile_career_title    = $this->shortcode_atts['profile_career_title'];

		$profile_image_align    = $this->shortcode_atts['profile_image_align'];

		// General Attributes
		$max_width            = $this->shortcode_atts['max_width'];
		$max_width_tablet     = $this->shortcode_atts['max_width_tablet'];
		$max_width_phone      = $this->shortcode_atts['max_width_phone'];
		$max_width_last_edited = $this->shortcode_atts['max_width_last_edited'];
		$show_tags_button    = $this->shortcode_atts['show_tags_button'];
		$show_categories_button    = $this->shortcode_atts['show_categories_button'];
		$module_id            = $this->shortcode_atts['module_id'];
		$module_class         = $this->shortcode_atts['module_class'];

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );
		$class = "et_pb_ca_post_handler et_pb_module";
		$this->shortcode_content = et_builder_replace_code_content_entities( $this->shortcode_content );

		if ( '' !== $max_width_tablet || '' !== $max_width_phone || '' !== $max_width ) {
			$max_width_responsive_active = et_pb_get_responsive_status( $max_width_last_edited );

			$max_width_values = array(
				'desktop' => $max_width,
				'tablet'  => $max_width_responsive_active ? $max_width_tablet : '',
				'phone'   => $max_width_responsive_active ? $max_width_phone : '',
			);

			et_pb_generate_responsive_css( $max_width_values, '%%order_class%%', 'max-width', $function_name );
		}

		setlocale(LC_MONETARY, get_locale());

		//return posts tags
		$tag_names = wp_get_post_tags( $post->ID, array('fields' => 'names') );
		$tag_list = '';
		if ( ! empty($tag_names) && "on" ==  $show_tags_button ) {
			$tag_list = '<div style="float:left; margin-right: 25px;">Tags or Keywords<ul>';
			foreach($tag_names as $n){
				$tag_list .= sprintf('<li>%1$s</li>', $n);
			}
			$tag_list .= '</ul></div>';
		}

		// return posts categories
		$cat_obj = get_the_category( $post->ID  );
		$cat_list = '';
		if ( ! empty($cat_obj) && "on" ==  $show_categories_button) {
			$cat_list = 'Categories<ul>';
			foreach($cat_obj as $n){
				$cat_list .= sprintf('<li>%1$s</li>', $n->name);
			}
			$cat_list .= '</ul>';
		}

		$output = '';

		// List Style Type
		switch($post_type_layout){
			// Course
			case 'course':
      	$presenter_image = ( ! empty($course_presenter_image) ? sprintf('<img src="%1$s" class="img-left" style="height: 75px; width: 75px;">', $course_presenter_image) : '');
      //"
				$presenter = ("on" == $show_course_presenter ?
											sprintf('<div class="presenter" style="display: inline-block;margin-bottom: 5px;"><p>
												<strong>Presenter:</strong><br><strong class="presenter-name">%1$s</strong></p><p>%2$s%3$s</p></div>',
                              $course_presenter_name, $presenter_image, $course_presenter_bio) : '' );

				$course_addr = implode(', ', array_filter(array($course_address,$course_city,$course_state,$course_zip) ) );

				$location = ( "on" == $show_course_address ?
						sprintf('<span class="ca-gov-icon-road-pin"></span>
									<a href="https://www.google.com/maps/place/%1$s">%1$s</a>', $course_addr) : '');

      	$course_start_date = gmdate( $course_start_date_custom_format, strtotime( $course_start_date ) );

      	$course_end_date =  !empty($course_end_date) ? gmdate( $course_end_date_custom_format, strtotime( $course_end_date ) ) : '';

				$organizer = sprintf('<strong>Organizer</strong><br /><p class="date-time">%1$s%2$s<br />%3$s</p>', $course_start_date, ! empty($course_end_date) ? sprintf(' - %1$s', $course_end_date) : '', $location);

				$course_registration_type =  ( ! empty($course_registration_type)  ?
                                      sprintf('Registration Type: %1$s', $course_registration_type) : '');
      	$course_cost = ( ! empty($course_cost)  ?
                                      sprintf('Registration Cost: %1$s', $course_cost) : '');

      	$reg = array_filter(array($course_registration_type , $course_cost));
      	$reg = ( ! empty($reg) ? sprintf('<p>%1$s</p>', implode('<br />', $reg  ) ) : '');

				if("on" == $show_course_map){
					$map_url = sprintf('https:////www.google.com/maps/embed/v1/place?q=%1$s&zoom=10&key=AIzaSyCtq3i8ME-Ab_slI2D8te0Uh2PuAQVqZuE', $course_addr);
					$course_map = sprintf('<div class="third"><iframe src="%1$s"></iframe></div>', $map_url );

				}else{
					$course_map = '';
				}

      	$output = sprintf('<article%7$s class="course-detail %8$s%9$s"><div class="description">%1$s</div>%2$s<div class="group">
								<div class="two-thirds">%3$s%4$s</div>%5$s</div>%6$s</article>',
								 $this->shortcode_content, $presenter, $organizer, $reg, $course_map,
								sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
                   ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ) );
				break;
			// Event
			case 'event':
				$presenter_image = ( ! empty($event_presenter_image) ? sprintf('<img src="%1$s" class="img-left" style="height: 75px; width: 75px;">', $event_presenter_image) : '');

				$presenter = ("on" == $show_event_presenter ?
				sprintf('<div class="presenter"><p><strong>Presenter:</strong><br><strong class="presenter-name">%1$s</strong></p>%2$s<p>%3$s</p></div>',
					$event_presenter_name, $presenter_image, $event_presenter_bio) : '' );

				$event_addr = array_filter(array($event_address,$event_city,$event_state,$event_zip));
				$event_addr = sprintf('%1$s', implode(', ', $event_addr) );

				$location = ( "on" == $show_event_address ? sprintf('<span class="ca-gov-icon-road-pin"></span><a href="https://www.google.com/maps/place/%1$s">%1$s</a>', $event_addr) : '');

			 	$event_start_date = gmdate( $event_start_date_custom_format, strtotime( $event_start_date ) );

      	$event_end_date = ! empty( $event_end_date ) ? gmdate(  $event_end_date_custom_format, strtotime( $event_end_date ) ) : '';

				$organizer = sprintf('%1$s<p class="date-time">%2$s%3$s<br />%4$s</p>',
														( ! empty($event_organizer) ? sprintf('<strong>%1$s</strong><br />', $event_organizer) : ''),
														$event_start_date, ( ! empty($event_end_date) ? sprintf(' - %1$s', $event_end_date) : '' ), $location);

      	$event_registration_type =  ( ! empty($event_registration_type)  ?
                                      sprintf('Registration Type: %1$s', $event_registration_type) : '');
      	$event_cost = ( ! empty($event_cost)  ?
                                      sprintf('Registration Cost: %1$s', $event_cost) : '');

      	$reg = array_filter(array($event_registration_type , $event_cost));
      	$reg = ( ! empty($reg) ? sprintf('<p>%1$s</p>', implode('<br />', $reg  ) ) : '');

				$output = sprintf('<article%7$s class="event-detail %8$s%9$s">%1$s<div class="description">%2$s</div>%3$s%4$s%5$s%6$s</article>',
													(has_post_thumbnail() ? get_the_post_thumbnail(null, 'thumbnail', array('class'=>'img-left','style'=>'padding-right:15px;') ) : ''), $this->shortcode_content, $presenter, $organizer, $reg,
						sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
                     ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )    );

					break;

			// Exams
			case 'exam':
				if("web" == $exam_type){
					$exam_location = sprintf('Exam Url: <a href="%1$s">%1$s</a><br />', $exam_url);
				}else{
					$exam_addr = array_filter(array($exam_address, $exam_city, $exam_state , $exam_zip));
					$exam_location = ( ! empty($exam_addr) ? implode(', ', $exam_addr) : '');
					$exam_location = sprintf('Exam Address: <a href="https://google.com/maps/place/%1$s">%1$s</a><br />', $exam_location);
				}

				$exam_class = ( ! empty($exam_class) ? sprintf('Class Code: %1$s', $exam_class) : '');
				$exam_id = ( ! empty($exam_id) ? sprintf('Exam Code: %1$s', $exam_id) : '');
				$exam_course = array_filter(array($exam_class, $exam_id));
				$exam_course = ( ! empty($exam_course) ? implode(' - ', $exam_course) . '<br />' : '');

				$pub_date = gmdate( $exam_published_date_custom_format, strtotime( $exam_published_date ) );

				$pub_date = ( ! empty($exam_published_date) ? sprintf('Published Date: %1$s<br />', $pub_date ) : '');

        if("on" == $exam_final_filing_date_chooser){
          $exam_final_filing_date_picker = gmdate($exam_final_filing_date_custom_format, strtotime( $exam_final_filing_date_picker ) );
          $exam_final_filing_date = sprintf('Final Filing Date: %1$s<br />', $exam_final_filing_date_picker);

        }else{
          $exam_final_filing_date = sprintf('Final Filing Date: %1$s<br />', $exam_final_filing_date);

        }

				$exam_info = sprintf('<p>%1$s%2$s%3$s%4$s</p>', sprintf('%1$s', $exam_course), $pub_date, $exam_final_filing_date, $exam_location);

				$output = sprintf('<div%5$s class="exam-detail %6$s%7$s"><div class="header">%1$s%2$s</div>%3$s%4$s</div>',
				(has_post_thumbnail() ? get_the_post_thumbnail(null, 'medium', array('style'=>'display: block;margin-bottom: 25px;')): ''),
							$exam_info, $this->shortcode_content, sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
                         ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ));

				break;
			// Jobs
			case 'jobs':
				$agency_addr = array_filter( array($job_agency_address, $job_agency_city, $job_agency_state, $job_agency_zip) );
				$agency_addr = ( ! empty($agency_addr) ? implode(", ", $agency_addr) : '' );

				$agency_info = ( "on" == $show_about_agency ?
					sprintf('<div class="entity"><strong>%1$s</strong> %2$s</div>', $job_agency_name,
                  ( ! empty($agency_addr) ? sprintf('<span class="ca-gov-icon-road-pin"></span><a href="https://google.com/maps/place/%1$s">%1$s</a>', $agency_addr) : '')) : '' );

				$job_posted_date = gmdate( $job_posted_date_custom_format, strtotime( $job_posted_date ) );

        $d1 = date_create( gmdate( 'm/d/Y', strtotime($job_posted_date) ) );
	      $d2 = date_create_from_format('m/d/Y', (new DateTime('NOW'))->format('m/d/Y') );
      	$tmp = $d1->diff($d2)->format('%a');
      	$days_passed = (0 !== (int) $tmp ? sprintf('&mdash;<span class="fuzzy-date"> %1$s days ago</span>', $tmp) :'');

      	$job_posted_date = ( ! empty($job_posted_date) ?
                          sprintf('<div class="published">Published: <time>%1$s</time>%2$s</div>',
                                  $job_posted_date, $days_passed )  : '' );

				$job_hours    = ( ! empty( $job_hours ) ? sprintf('%1$s<br />', $job_hours) : '' );

				$job_salary_min    = caweb_is_money($job_salary_min, '$0.00');

				$job_salary_max    = caweb_is_money($job_salary_max, '$0.00');

      	$job_salary    = ( "on" == $show_job_salary ? sprintf('Salary Range: %1$s - %2$s<br />', $job_salary_min, $job_salary_max ) : '');

				$job_position	= '';
				if( ! empty( $job_position_number ) && ! empty( $job_rpa_number )){
					$job_position    = sprintf('Position Number: %1$s, RPA #%2$s<br />', $job_position_number, $job_rpa_number);
				}elseif( ! empty( $job_position_number ) ){
					$job_position    = sprintf('Position Number: %1$s<br />', $job_position_number);
				}elseif( ! empty( $job_rpa_number ) ){
					$job_position    = sprintf('RPA #%1$s<br />', $job_rpa_number);
				}

				$job_ds_url    = ( ! empty($job_ds_url) ? sprintf('Duty Statement (<a href="%1$s">PDF</a>)<br />', $job_ds_url) : '');

			 if("on" == $job_final_filing_date_chooser){
         	$job_final_filing_date_picker = gmdate( $job_final_filing_date_custom_format, strtotime( $job_final_filing_date_picker ) );
          $job_final_filing_date = sprintf('Final Filing Date:<time>%1$s</time><br />', $job_final_filing_date_picker);

        }else{
          $job_final_filing_date = sprintf('Final Filing Date: %1$s<br />', $job_final_filing_date);

        }

				$job_info = sprintf('<div class="half">
										<div class="well">
										<div class="well-body"><p>%1$s%2$s%3$s%4$s%5$s</p>
										</div></div></div>',
										$job_hours, $job_salary, $job_position, $job_ds_url, $job_final_filing_date);

				if( "on" == $show_job_apply_to){
					$location = array_filter( array($job_apply_to_address, $job_apply_to_city, $job_apply_to_state, $job_apply_to_zip) );
					$location = ( ! empty($location) ? implode(", ", $location) : '' );

					$job_apply_to_info = sprintf('<strong>Apply To:</strong><br />%1$s%2$s%3$s',
                                ( ! empty($job_apply_to_dept) ? sprintf('%1$s<br />', $job_apply_to_dept) : ''),
                                       ( ! empty($job_apply_to_name) ? sprintf(' Attn: %1$s<br />', $job_apply_to_name ) : ''), $location );

				}
				if( "on" == $show_job_questions){
					$jInfo =  ( ! empty($job_questions_phone)  && ! empty($job_questions_email) ?
                     sprintf('%1$s, or <a href="mailto:%2$s">%2$s</a>', $job_questions_phone, $job_questions_email) : '');
					$jInfo =  ( empty($jInfo) && ! empty($job_questions_phone)  ? $job_questions_phone : $jInfo);
					$jInfo =  ( empty($jInfo) && ! empty($job_questions_email) ? sprintf('<a href="mailto:%1$s">%1$s</a>', $job_questions_email) : $jInfo);

          $job_questions_info = sprintf('<strong>Questions</strong><br />%1$s%2$s', ( ! empty($job_questions_name) ? sprintf('%1$s at ', $job_questions_name)  : 'Contact ' ), $jInfo  );

				}

				$job_apply_info = ( ! empty($job_apply_to_info) || ! empty($job_questions_info) ?
													sprintf('<div class="half"><div class="well"><div class="well-body">%1$s%2$s</div></div></div>',
																	( ! empty($job_apply_to_info) ? sprintf('<p>%1$s</p>', $job_apply_to_info) : '' ), ( ! empty($job_questions_info) ? sprintf('<p>%1$s</p>', $job_questions_info) : '' )) : '');

				$job_agency_about = ("on" == $show_about_agency && ! empty($job_agency_about) ?
														sprintf('<div class="panel panel-understated about-department">
							<div class="panel-heading">
									<h4>About this Department</h4>
							</div>
							<div class="panel-body">
									<p>%1$s</p>
							</div>
					</div> ', $job_agency_about) : '');

				$output = sprintf('<article%8$s class="job-detail %9$s%10$s">
								<div class="sub-header">%1$s%2$s</div><div class="group">%3$s%4$s</div>%5$s%6$s%7$s
								</article>',
								( ! empty($agency_info) ? $agency_info : ''), $job_posted_date, $job_info, $job_apply_info,
								$job_agency_about,  $this->shortcode_content, sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ), ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ) );

					break;
			// News
			case 'news':
			$news_publish_date = gmdate(  $news_publish_date_custom_format, strtotime( $news_publish_date ) );

			$news_publish_date = ( ! empty($news_publish_date) ? sprintf('Published: %1$s<br />', $news_publish_date) : '');

			$date_city =sprintf('<p>%1$s%2$s%3$s</p>',
													( ! empty($news_author) ? sprintf('Author: %1$s<br />', $news_author)  : ''), $news_publish_date,
													( ! empty($news_city)  ? sprintf('%1$s', $news_city) : '') );

     		$output = sprintf('<article%5$s class="news-detail %6$s%7$s">
					%1$s%2$s%3$s%4$s</article>',
				( ! empty($date_city) ? sprintf('<header><div class="published">%1$s</div></header>', $date_city) : '') ,
				( has_post_thumbnail() ? get_the_post_thumbnail(null, array(75,75), array('class' => 'img-left') ) : ''),
				$this->shortcode_content, sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
            ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ));

				break;
			// Profile
			case 'profile':
				$title = sprintf('%1$s%2$s%3$s', ( ! empty($profile_name_prefix) ? $profile_name_prefix . ' ' : '') , $profile_name,
				( ! empty($profile_career_title) ? ', ' . $profile_career_title: '') );

				$img_align = ("on" ==  $profile_image_align ? "img-right" : "img-left");

				$image = ( has_post_thumbnail() ?
								get_the_post_thumbnail(null, null,
										array('class' => $img_align , 'alt' =>  $profile_name,
													'style' => 'width: 150px; height: 200px; padding-right: 15px;') ) : '');

				$output = sprintf('<article%5$s class="profile-detail %6$s%7$s">%1$s%2$s%3$s%4$s</article>',
							( ! empty($title) ? sprintf('<h1>%1$s</h1>', $title) : ''),$image,
						$this->shortcode_content, sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
                         ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ));

				break;

			case 'faqs':
				$output = sprintf('<article%3$s class="%4$s%5$s">%1$s%2$s</article>',
													$this->shortcode_content, sprintf('<footer class="keywords">%1$s%2$s</footer>', $tag_list, $cat_list ),
                         ( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),	esc_attr( $class ),
    	    ( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ));
				break;

			case 'general':
				$output = '<article id="general_post_detail"></article>';
				break;
		}
		return $output;

	}
		// This is a non-standard function. It outputs JS code to render the
		// module preview in the new Divi 3 frontend editor.
		// Return value of the JS function must be full HTML code to display.

		function remove_general_detail() {
			global $post;

			$con = (is_object($post) ? $post->post_content : $post['post_content'] );
			$module = caweb_get_shortcode_from_content($con, 'et_pb_ca_post_handler');

			if( empty($module) || "general" !== $module->post_type_layout ){
				return;
			}
			?>
           <script>
		   	var detail = document.getElementById('general_post_detail').parentNode;

			if(1 == detail.childElementCount){
				var row = detail.parentNode;
				row.removeChild(detail);
				if(0 == row.childElementCount){
					if(1 == row.parentNode.childElementCount ){
						row.parentNode.remove();
					}else{
						row.parentNode.removeChild(row);
					}
				}
			}else{
				detail.removeChild(document.getElementById('general_post_detail'));
			}
			</script>
            <?php

	}

}
new ET_Builder_Module_CAWeb_Post_Handler;

?>