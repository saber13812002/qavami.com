<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://t.me/manzoorwanijk
 * @since      1.0.0
 *
 * @package    WPTelegram
 * @subpackage WPTelegram/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WPTelegram
 * @subpackage WPTelegram/admin
 * @author     Manzoor Wani <@manzoorwanijk>
 */
class WPTelegram_Admin extends WPTelegram_Core_Base {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param 	string    $plugin_title	Title of the plugin
	 * @param	string    $plugin_name	The name of the plugin.
	 * @param	string    $version		The version of this plugin.
	 */
	public function __construct( $plugin_title, $plugin_name, $version ) {

		parent::__construct( $plugin_title, $plugin_name, $version );

        $this->sub_dir = 'admin';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook_suffix ) {

		parent::enqueue_style( $this->plugin_name, $this->sub_dir );

		parent::enqueue_style( $this->plugin_name.'-emojicss', 'emojionearea', 'emojionearea' );

		// load only on plugin pages
		if ( WPTG()->helpers->is_settings_page() ) {

			parent::enqueue_style( $this->plugin_name . '-cmb2-grid-view', 'bootstrap', 'bootstrap' );

			parent::enqueue_style( $this->plugin_name.'-select2', 'select2', 'select2' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		parent::enqueue_script( $this->plugin_name, $this->sub_dir, 'js', array( 'jquery' ) );

		parent::enqueue_script( $this->plugin_name.'-emojijs', 'emojionearea', 'emojionearea' );

		if ( WPTG()->helpers->is_settings_page() ) {

			parent::enqueue_script( $this->plugin_name.'-select2', 'select2', 'select2' );
		}

		// script localization
		$translation_array = array(
			'title'		=> $this->plugin_title,
			'name'		=> $this->plugin_name,
			'version'	=> $this->version,
			'bot_token'	=> current_user_can( 'manage_options' ) ? WPTG()->options()->get( 'bot_token' ) : '', // do not expose the bot token to non-admins
			'ajax'		=> array(
				'use'	=> 'server', // or 'browser'
				'url'	=> admin_url( 'admin-ajax.php' ),
				'nonce'	=> wp_create_nonce( 'wptelegram' ),
			),
			'l10n'		=> array(
				'could_not_connect'	=> __( 'Could not connect', 'wptelegram' ),
				'empty_bot_token'	=> __( 'Bot Token is empty', 'wptelegram' ),
				'empty_channels'	=> __( 'Username is empty', 'wptelegram' ),
				'empty_chat_ids'	=> __( 'Chat ID is empty', 'wptelegram' ),
				'invalid_bot_token'	=> __( 'Invalid Bot Token', 'wptelegram' ),
				'send_test_prompt'	=> __( 'A message will be sent to the Channel/Chat. You can modify the text below', 'wptelegram' ),
				'send_test_text'	=> __( 'This is a test message', 'wptelegram' ),
				'please_wait'		=> __( 'Please wait...', 'wptelegram' ),
				'choose'			=> __( 'Choose', 'wptelegram' ),
				'success'			=> __( 'Success', 'wptelegram' ),
				'failure'			=> __( 'Failure', 'wptelegram' ),
				'error'				=> __( 'Error:', 'wptelegram' ),
			),
		);
		wp_localize_script(
			$this->plugin_name,
			'wptelegram',
			$translation_array
		);
	}

    /**
     * Add action links to the plugin page
     *
     * @since  1.6.1
     */
    public function plugin_action_links( $links ) {
    	$settings_link = '<a href="' . menu_page_url( $this->plugin_name, false ) . '">' . esc_html( __( 'Settings', 'wptelegram' ) ) . '</a>';
		array_unshift( $links, $settings_link );

		return $links;
    }

	/**
	 * Initialize CMB2 Conditionals
	 *
	 * @since    1.0.0
	 */
	public function load_cmb2_addons() {

		if ( defined( 'CMB2_LOADED' ) ) {

			/**
			 * The class responsible for CMB2 select2
			 */
			require_once WPTELEGRAM_DIR . '/includes/cmb2-select2/cmb2-select2.php';

			/**
			 * The class responsible for CMB2 select_plus
			 */
			require_once WPTELEGRAM_DIR . '/includes/cmb2-select-plus/cmb2-select-plus.php';

			/**
			 * The class responsible for CMB2 switch
			 */
			require_once WPTELEGRAM_DIR . '/includes/CMB2-Switch-Button/cmb2-switch-button.php';

			new PW_CMB2_Field_Select2();
			new Select_Plus_CMB2_Field();
			new CMB2_Switch_Button();
		}
	}

	/**
	 * Initiate logger
	 *
	 * @since    1.0.0
	 */
	public function initiate_logger() {

		$active_logs = WPTG()->options()->get( 'enable_logs', array() );

		$logger = new WPTelegram_Logger( $active_logs );
		$logger->hookup();
	}

	/**
	 * Build Options page
	 *
	 * @since    1.0.0
	 */
	public function create_options_pages() {

		$box = array(
			'id'			=> $this->plugin_name,
			'title'			=> $this->plugin_title,
			'object_types'	=> array( 'options-page' ),
			'option_key'	=> $this->plugin_name,
			'icon_url'		=> WPTELEGRAM_URL . '/admin/icons/icon-16x16-white.svg',
			'capability'	=> 'manage_options',
			'message_cb'	=> array( $this, 'custom_settings_messages' ),
            'classes'       => 'wptelegram-box',
            'display_cb'	=> array( WPTG()->helpers, 'render_cmb2_options_page' ),
            'desc'			=> __( 'With this plugin, you can send posts to Telegram and receive notifications and do lot more :)', 'wptelegram' ),
		);
		$cmb2 = new_cmb2_box( $box );

		$cmb2->add_field( array(
			'name' 		=> __( 'INSTRUCTIONS!','wptelegram' ),
			'type' 		=> 'title',
			'id'   		=> 'instructions_title',
			'classes'	=> 'highlight',
		) );

		$cmb2->add_field( array(
			'name'			=> '',
			'type'			=> 'text', // fake
			'show_names'	=> false,
			'save_field'	=> false,
			'id'			=> 'telegram_guide',
			'render_row_cb'	=> array( __CLASS__, 'render_telegram_guide' ),
		) );

		$cmb2->add_field( array(
			'name'			=> __( 'Telegram Options', 'wptelegram' ),
			'type'			=> 'title',
			'id'			=> 'tg_title',
		) );
		
		$cmb2->add_field( array(
			'name'				=> __( 'Bot Token', 'wptelegram' ),
			'desc'				=> WPTG()->helpers->get_test_button_html( __( 'Test Token', 'wptelegram' ), 'bot_token' ),
			'id'				=> 'bot_token',
			'type'				=> 'text_medium',
            'before_row'        => WPTG()->helpers->open_grid_row_with_col( 7 ),
            'after_row'         => WPTG()->helpers->close_grid_col(),
			'sanitization_cb'	=> array( $this, 'sanitize_values' ),
			'after_field'		=> array( __CLASS__, 'render_after_field' ),
            'attributes'        => array(
                'required'          => 'required',
                'data-validation'   => 'bot_token',
            ),
            'classes'           => 'medium-width bot_token large-font',
		) );
		
		$cmb2->add_field( array(
			'name'				=> __( 'Bot Username', 'wptelegram' ),
			'desc'				=> '<br>' . sprintf( __( 'Telegram Bot username (without %s).', 'wptelegram' ), '<code>@</code>' ),
			'id'				=> 'bot_username',
			'after'				=> sprintf( __( 'Use %s to set automatically.', 'wptelegram' ), '<b>' . __( 'Test Token', 'wptelegram' ) . '</b>' ),
			'type'				=> 'text_medium',
            'before_row'        => WPTG()->helpers->add_grid_col_to_row( 5 ),
            'after_row'         => WPTG()->helpers->close_grid_col_and_row(),
			'sanitization_cb'	=> array( $this, 'sanitize_values' ),
			'before_field'		=> '<code>@</code>',
			'after_field'		=> array( __CLASS__, 'render_after_field' ),
            'attributes'        => array(
                'data-validation'   => 'bot_username',
            ),
            'classes'			=> 'readonly bot_username large-font',
		) );

		$cmb2->add_field( array(
			'type'	=> 'title',
			'id'	=> 'modules_title',
			'name'	=> __( 'Modules', 'wptelegram' ),
		) );

		$group_field_id = $cmb2->add_field( array(
			'id'          => 'modules',
			'type'        => 'group',
			'repeatable'  => false,
			'options'     => array(
				'group_title'	=> '',
			),
		) );

		// add a fake field to allow disabling of all modules
		$cmb2->add_group_field( $group_field_id, array(
			'type'		=> 'hidden',
			'id'		=> 'fake',
			'default'	=> 'on',
		) );

		$modules = WPTelegram_Modules::get_all_modules();

		foreach ( $modules as $id => $details ) {

			$file_path = WPTELEGRAM_MODULES_DIR . '/' . $id . '/class-wptelegram-' . $id . '.php';

			if ( ! file_exists( $file_path ) ) {
				continue;
			}

			$args = array(
				'id'			=> $id,
				'name'			=> $details['title'],
				'desc2'			=> $details['desc'],
				'type'			=> 'switch',
				'after_field'	=> array( __CLASS__, 'render_after_module' ),
			);

			$cmb2->add_group_field( $group_field_id, $args );
		}

		// Advanced settings
		$fields = array(
			array(
				'name'	=> __( 'Advanced settings', 'wptelegram' ),
				'type'	=> 'title',
				'id'	=> 'advanced_settings_title',
				'desc'	=> __( 'Settings in this section should not be changed unless recommended by WP Telegram Support.', 'wptelegram' ),
			),
			array(
				'name'				=> __( 'Send files by URL', 'wptelegram' ),
				'desc'				=> __( 'Turn off to upload the files/images instead of passing the url.', 'wptelegram' ),
				'after'				=> '<p class="description">' . __( 'Google Script proxy does not support file upload.', 'wptelegram' ) . '</p>',
				'id'				=> 'send_files_by_url',
				'type'				=> 'switch',
				'default'			=> 'on',
				'sanitization_cb'	=> array( $this, 'sanitize_checkbox' ),
			),
			array(
				'name'              => __( 'Enable logs for', 'wptelegram' ),
				'id'                => 'enable_logs',
				'type'              => 'multicheck',
				'select_all_button' => false,
	            'before_row'        => WPTG()->helpers->open_grid_row_with_col(),
	            'after_row'         => WPTG()->helpers->close_grid_col(),
				'options'           => array(
					'bot_api'	=> __( 'Bot API', 'wptelegram' ),
					'p2tg'		=> __( 'Post to Telegram', 'wptelegram' ),
				),
			),
			array(
				'name'			=> __( 'Debug Info', 'wptelegram' ),
				'id'			=> 'debug_info',
				'type'			=> 'text', // fake
	            'before_row'	=> WPTG()->helpers->add_grid_col_to_row(),
	            'after_row'		=> WPTG()->helpers->close_grid_col_and_row(),
	            'render_row_cb'	=> array( $this, 'render_debug_info' ),
			),
			array(
				'name'				=> __( 'Remove settings on uninstall', 'wptelegram' ),
				'id'				=> 'clean_uninstall',
				'type'				=> 'switch',
				'default'			=> 'on',
				'sanitization_cb'	=> array( $this, 'sanitize_checkbox' ),
			),
		);

		foreach ( $fields as $field ) {
			$cmb2->add_field( $field );
		}
	}

	/**
	 * Handles checkbox sanitization
	 *
	 * @param  mixed      $value      The unsanitized value from the form.
	 * @param  array      $field_args Array of field arguments.
	 * @param  CMB2_Field $field      The field object
	 *
	 * @return mixed                  Sanitized value to be stored.
	 */
	public function sanitize_checkbox( $value, $field_args, $field ) {
		
		return is_null( $value ) ? 0 : $value;
	}

	/**
	 * Handles sanitization for the fields
	 *
	 * @param  mixed      $value      The unsanitized value from the form.
	 * @param  array      $field_args Array of field arguments.
	 * @param  CMB2_Field $field      The field object
	 *
	 * @return mixed                  Sanitized value to be stored.
	 */
	public function sanitize_values( $value, $field_args, $field ) {
		
		$status = '';
		$value = WPTG()->utils->sanitize( $value );
		switch ( $field->id() ) {
			case 'bot_token':
				if ( empty( $value ) ) {
					$status = 'empty';
				} elseif ( ! preg_match( '/\A\d{9}:[\w-]{35}\Z/', $value ) ) {
					$status = 'invalid';
				}
				break;
		}
		if ( ! empty( $status ) ) {
			$value = $field->value();
			$transient = 'wptelegram_cmb2_invalid_fields';
			$invalid_fields = get_transient( $transient );
			/**
			 * avoid E_WARNING in latest PHP versions
			 * for inserting elements into string or boolean as array
			 */
			if ( empty( $invalid_fields ) ) {
				$invalid_fields = array();
			}
			$invalid_fields[ $field->id() ] = $status;
			set_transient( $transient, $invalid_fields, 30 );
		}
		return $value;
	}

	/**
	 * Callback to define the optionss-saved message.
	 *
	 * @param CMB2  $cmb The CMB2 object.
	 * @param array $args {
	 *     An array of message arguments
	 *
	 *     @type bool   $is_options_page Whether current page is this options page.
	 *     @type bool   $should_notify   Whether options were saved and we should be notified.
	 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
	 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
	 *                                   this error applies.
	 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
	 *                                   Used as part of 'id' attribute in HTML output.
	 *     @type string $message         For add_settings_error(), The formatted message text to display
	 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
	 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
	 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
	 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
	 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
	 * }
	 */
	public function custom_settings_messages( $cmb, $args ) {
		if ( ! empty( $args['should_notify'] ) ) {

			if ( $args['is_updated'] ) {

				// Modify the updated message.
				$args['message'] = esc_html__( 'Settings updated', 'wptelegram' );
			}

			$transient = 'wptelegram_cmb2_invalid_fields';
			$invalid_fields = get_transient( $transient );
			if ( ! empty( $invalid_fields ) ) {
				$args['type'] = 'error';
				foreach ( (array) $invalid_fields as $field => $status ) {
					$field_name = $cmb->get_field(
						array(
							'id' => $field,
							'cmb_id' => $cmb->prop( 'id' ),
						)
					)->args( 'name' );

					if ( 'empty' == $status ) {
						$args['message'] = sprintf( esc_html__( '%s is empty', 'wptelegram' ), $field_name );
					} else {
						$args['message'] = sprintf( esc_html__( 'Invalid %s', 'wptelegram' ), $field_name );
					}
					
					add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
				}
			} else {
				add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
			}
			delete_transient( $transient );
		}
	}

	/**
	 * Render the settings page header
	 */
	public function render_plugin_header( $cmb_id, $object_id, $object_type, $cmb2 ) {

		$pattern = '/^wptelegram(?:_(?:p2tg|proxy|notify))?$/';

		if ( 'options-page' === $object_type && preg_match( $pattern, $object_id ) ) {
			
			$header = new WPTelegram_Admin_Header( WPTG() );
			$header->render();

			if ( $desc = $cmb2->prop( 'desc' ) ) {
				echo '<div class="cmb-row wptelegram-header-desc wptelegram-box">';
				echo '<p>', $desc, '</p>';
				echo '</div>';
			}
		}
	}

	/**
	 * Render the settings page sidebar
	 */
	public function render_plugin_sidebar( $hookup ) {

		$object_type = $hookup->cmb->object_type();
		$object_id = $hookup->cmb->object_id();

		$pattern = '/^wptelegram(?:_(?:p2tg|proxy|notify))?$/';
		if ( 'options-page' !== $object_type || ! preg_match( $pattern, $object_id ) ) {
			return;
		}
		?>
		<div class="wptelegram-box wptelegram-column-2">
			<div class="inner">
				<div class="cell">
					<h2><?php echo WPTG()->get_plugin_title(); ?></h2>
				</div>
				<div class="cell">
					<p><?php _e( 'Integrate your WordPress website perfectly with Telegram.', 'wptelegram' ); ?></p>
				</div>
				<div class="cell">
					<p>
						<?php printf( __( 'Do you like %s?', 'wptelegram' ), WPTG()->get_plugin_title() ); ?>
						<br>
						<a href="https://wordpress.org/suppor