<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Seo_Assistant
 * @subpackage Seo_Assistant/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Seo_Assistant
 * @subpackage Seo_Assistant/admin
 * @author     cs_army <cs.army021@gmail.com>
 */
class Seo_Assistant_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private$seo_assistant_setting_google_webmaster;
	private$seo_assistant_setting_google_analytical;
	private$seo_assistant_setting_google_tag_manager;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->seo_assistant_setting_google_webmaster = get_option('seo_assistant_google_webmaster');
		$this->seo_assistant_setting_google_analytical = get_option('seo_assistant_google_analytical');
		$this->seo_assistant_setting_google_tag_manager = get_option('seo_assistant_google_tag_manager');

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_Assistant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_Assistant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/seo-assistant-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_Assistant_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_Assistant_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/seo-assistant-admin.js', array( 'jquery' ), $this->version,true );

	}

	public function admin_settings_setup() {
		add_menu_page(
			esc_html__('Seo Assistant', 'seo-assistant'), // page title
			esc_html__('Seo Assistant', 'seo-assistant'), // menu title
			'manage_options', // capability
			'seo-assistant', // menu slug
			array( $this, 'admin_settings_page'), // callback
			'', // icon url
			85
		);
	}



	/**
	 * Add a new settings tab to the settings tabs array.
	 * 
	 */
	public function admin_settings_page() {
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/seo-assistant-admin-display.php';
	}


	public function admin_tabs($current = 'intro') {
	
		$tabs = $this->setting_tabs(array());

		echo '<h2 class="nav-tab-wrapper">';
		foreach ($tabs as $tab => $name) {
			$class = ( $tab == $current) ? 'nav-tab-active' : '';
			$url = esc_url(add_query_arg(array('tab' => $tab),  admin_url('admin.php?page=seo-assistant')));
			echo "<a class='nav-tab {$class}' href='{$url}'>{$name}</a>";
		}
		echo '</h2>';
	}



	public function setting_tabs($settings_tabs) {
		$settings_tabs = wp_parse_args(
			$settings_tabs,
			array(
				'intro' 				=> 'Dashboard',
				'google-webmaster' 		=> 'Google Webmaster',
				'google-analytics' 		=> 'Google Analytics',
				'google-tag-manager'	=> 'Google Tag Manager'
			)
		);
		return $settings_tabs;
	}

	public function setttings_section(){
		/**
		 * google webmaster settings
		 */
		register_setting(
			'seo_assistant_google_webmaster', // Option group
			'seo_assistant_google_webmaster', // Option name
			array($this, 'sanitize') // Sanitize
		);

		add_settings_section(
			'all_in_once_setting_google-webmaster_section', // ID
			'', // Title
			array($this, 'print_section_info'), // Callback
			'seo-assistant-webmaster' // Page
		);
		add_settings_field(
			'google-webmaster',  // id
			esc_html__( 'Enable Google Webmaster', 'seo-assistant'), // title
			array($this, 'google_webmaster_callback'), // callback		
			'seo-assistant-webmaster', // page
			'all_in_once_setting_google-webmaster_section' // section name
		);
		
		add_settings_field(
			'google-webmaster-code',  // id
			esc_html__( 'Google Webmaster ID', 'seo-assistant'), // title
			array($this, 'google_webmaster_code_callback'), // callback		
			'seo-assistant-webmaster', // page
			'all_in_once_setting_google-webmaster_section' // section name
		);

		/**
		 * google analytics settings
		 */
		register_setting(
			'seo_assistant_google_analytical', // Option group
			'seo_assistant_google_analytical', // Option name
			array($this, 'sanitize') // Sanitize
		);
		add_settings_section(
			'all_in_once_setting_google-analytics-section', // ID
			'', // Title
			array($this, 'print_section_info'), // Callback
			'easy-tag-and-tracking-id-inserter_section' // Page
		);
		
		add_settings_field(
			'google-analytics-enable', // id
			esc_html__('Enable Google Analytics', 'seo-assistant'), // title
			array($this, 'google_analytics_enable_callback'), //callback
			'easy-tag-and-tracking-id-inserter_section', // page
			'all_in_once_setting_google-analytics-section' // section name
		);

		add_settings_field(
			'google-analytics', // id
			esc_html__('Google Analytics ID', 'seo-assistant'), // title
			array($this, 'google_analytics_callback'), //callback
			'easy-tag-and-tracking-id-inserter_section', // page
			'all_in_once_setting_google-analytics-section' // section name
		);

		/**
		 * google tag manager settings
		 */

		register_setting(
			'seo_assistant_google_tag_manager', // Option group
			'seo_assistant_google_tag_manager', // Option name
			array($this, 'sanitize') // Sanitize
		);
		add_settings_section(
			'all_in_once_setting_google-tag-manager-section-id', // ID
			'', // Title
			array($this, 'print_section_info'), // Callback
			'seo-assistant-google-tag-manager_section' // Page
		);

		add_settings_field(
			'google-tag-manager-enable', // ID	
			esc_html__('Enable Google Tag Manager', 'seo-assistant'), //title
			array($this, 'google_tag_manager_enable_callback'), // callback
			'seo-assistant-google-tag-manager_section', // page
			'all_in_once_setting_google-tag-manager-section-id' // section
		);

		add_settings_field(
			'google-tag-manager-head', // ID	
			esc_html__('Google Tag Manager ID', 'seo-assistant'), //title
			array($this, 'google_tag_manager_callback'), // callback
			'seo-assistant-google-tag-manager_section', // page
			'all_in_once_setting_google-tag-manager-section-id' // section
		);
		
		
		
	}

	public function print_section_info() {
		//your code...
	}



	public function sanitize($input) {
		
		$new_input = array();
		if (isset($input['google-webmaster'])){
			$new_input['google-webmaster'] = sanitize_text_field($input['google-webmaster'] );			
		}
		
		if (isset($input['google-webmaster-code'])){
			$new_input['google-webmaster-code'] = sanitize_text_field($input['google-webmaster-code'] );			
		}
		
		if (isset($input['google-analytics-enable'])){
			$new_input['google-analytics-enable'] = sanitize_text_field($input['google-analytics-enable']);			
		}

		if (isset($input['google-analytics'])) {
			$new_input['google-analytics'] = sanitize_text_field($input['google-analytics']);
		}
		
		if (isset($input['google-tag-manager-enable'])){
			$new_input['google-tag-manager-enable'] = sanitize_text_field($input['google-tag-manager-enable']);			
		}

		if (isset($input['google-tag-manager'])) {
			$new_input['google-tag-manager'] = sanitize_text_field($input['google-tag-manager']);
		}	

		
		return $new_input;
	}

	
	public function google_webmaster_callback() {
		
		printf(
			'<input type="checkbox"  name="seo_assistant_google_webmaster[google-webmaster]"  id="google-webmaster-text" value="yes" %s />', 
			(( isset($this->seo_assistant_setting_google_webmaster['google-webmaster']) &&  "yes" == $this->seo_assistant_setting_google_webmaster['google-webmaster'] ) ? "checked='checked'" : "" )
			
		);
	}
			

	public function google_webmaster_code_callback() {
		
		printf(
			'<input type="text"  name="seo_assistant_google_webmaster[google-webmaster-code]"  id="google-webmaster-code" value="%s" />', 
			( isset($this->seo_assistant_setting_google_webmaster['google-webmaster-code'])  ? esc_attr($this->seo_assistant_setting_google_webmaster['google-webmaster-code']) : "" )
					);
			
	}

	public function google_analytics_enable_callback(){

		printf(
			'<input type="checkbox"  name="seo_assistant_google_analytical[google-analytics-enable]"  id="google-webmaster-enable" value="yes" %s />',
			((isset($this->seo_assistant_setting_google_analytical['google-analytics-enable']) &&  "yes" == $this->seo_assistant_setting_google_analytical['google-analytics-enable']) ? "checked='checked'" : "")

		);
	}

	public function google_analytics_callback() {
		printf(
			'<input type="text" name="seo_assistant_google_analytical[google-analytics]" id="google-analytics-text" value="%s">',
			(isset($this->seo_assistant_setting_google_analytical['google-analytics']) ? esc_attr($this->seo_assistant_setting_google_analytical['google-analytics']) : "" )
		);
			
	}


	public function google_tag_manager_enable_callback(){

		printf(
			'<input type="checkbox"  name="seo_assistant_google_tag_manager[google-tag-manager-enable]"  id="google-webmaster-enable" value="yes" %s />',
			((isset($this->seo_assistant_setting_google_tag_manager['google-tag-manager-enable']) &&  "yes" == $this->seo_assistant_setting_google_tag_manager['google-tag-manager-enable']) ? "checked='checked'" : "")

		);
	}

	public function google_tag_manager_callback() {
		printf(
			'<input type="text" name="seo_assistant_google_tag_manager[google-tag-manager]" id="google-tag-manager-text"  value="%s">',
			 (isset($this->seo_assistant_setting_google_tag_manager['google-tag-manager']) ? esc_attr($this->seo_assistant_setting_google_tag_manager['google-tag-manager']) : "" )
		);
			
	}


}
