<?php

if ( ! class_exists( 'SKCustomCode' ) ) :

	/**
	 * SKCustomCode class.
	 *
	 * @since 1.4.2
	*/
	class SKCustomCode {

		/**
		 * The single instance of the class.
		 *
		 * @since 1.4.2
		 * @var SKCustomCode
		*/
		protected static $_instance = null;

		/**
		 * SKCustomCode constructor.
		 *
		 * @since 1.4.2
		*/
		public function __construct() {

			add_action('init', array( $this, 'import_options' ));

			$this->customizer_options();

			if( get_option( 'sk_custom_code_header_js', '' ) != '' ) {
				add_action( 'wp_head', function() {
					echo get_option( 'sk_custom_code_header_js', '' );
				});
			}

			if( get_option( 'sk_custom_code_footer_js', '' ) != '' ) {
				add_action( 'wp_footer', function() {
					echo get_option( 'sk_custom_code_footer_js', '' );
				});
			}
		}

		/**
		 * Ensures only one instance of SKCustomCode is loaded or can be loaded.
		 *
		 * @since 1.4.2
		 *
		 * @return SKCustomCode
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Imports custom code content stored as theme mods into the options WP table.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		public function import_options() {

			if( !get_option( 'sk_custom_code_options_import', false ) ) {

				wp_update_custom_css_post( wp_get_custom_css() . ' ' . get_theme_mod( 'custom_css', '' ) );

				$custom_header_js_option = get_theme_mod( 'header_js', '' );
				update_option( 'sk_custom_code_header_js', $custom_header_js_option );

				$custom_footer_js_option = get_theme_mod( 'footer_js', '' );
				update_option( 'sk_custom_code_footer_js', $custom_footer_js_option );

				update_option( 'sk_custom_code_options_import', true );	
			}
		}

		/**
		 * Registers customizer options.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		protected function customizer_options() {
			add_action( 'customize_register', array( $this, 'sk_custom_code_customizer' ) );
		}

		/**
		 * Creates customizer options.
		 *
		 * @since 1.4.2
		 * @return void
		 */
		public function sk_custom_code_customizer( $wp_customize ) {

			// Section
			$wp_customize->add_section( 'sk_custom_code', array(
		 		'title'       => esc_attr__( 'Additional JS', 'shopkeeper-extender' ),
		 		'priority'    => 201,
		 	) );

		 	$wp_customize->add_setting( 'sk_custom_code_header_js', array(
				'type'		 => 'option',
				'capability' => 'manage_options',
				'transport'  => 'refresh',
				'default' 	 => '',
			) );

			$wp_customize->add_control( 
				new WP_Customize_Code_Editor_Control(
					$wp_customize,
					'sk_custom_code_header_js',
					array( 
						'code_type' 	=> 'javascript',
						'label'       	=> esc_attr__( '[DEPRECATED] Header JavaScript Code', 'shopkeeper-extender' ),
						'section'     	=> 'sk_custom_code',
						'priority'    	=> 10,
						'description'	=> '<strong style="color:red">We strongly advise against using this feature as it will be removed in the next update.</strong><br /><br />If you have already added any code here, please make sure to transfer it to a specialized plugin, otherwise it will be lost. <br /><br /><a href="https://www.getbowtied.com/documentation/shopkeeper/important-notice/" target="_blank">Read more</a><br /><br />'
					)
				)
			);

			$wp_customize->add_setting( 'sk_custom_code_footer_js', array(
				'type'		 => 'option',
				'capability' => 'manage_options',
				'transport'  => 'refresh',
				'default' 	 => '',
			) );

			$wp_customize->add_control( 
				new WP_Customize_Code_Editor_Control(
					$wp_customize,
					'sk_custom_code_footer_js',
					array( 
						'code_type' 	=> 'javascript',
						'label'       	=> esc_attr__( '[DEPRECATED] Footer JavaScript Code', 'shopkeeper-extender' ),
						'section'     	=> 'sk_custom_code',
						'priority'    	=> 10,
						'description'	=> '<strong style="color:red">We strongly advise against using this feature as it will be removed in the next update.</strong><br /><br />If you have already added any code here, please make sure to transfer it to a specialized plugin, otherwise it will be lost. <br /><br /><a href="https://www.getbowtied.com/documentation/shopkeeper/important-notice/" target="_blank">Read more</a><br /><br />'
					)
				)
			);
		}
	}

endif;

$sk_custom_code = new SKCustomCode;