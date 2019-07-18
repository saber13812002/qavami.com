<?php
	class wpcf7_Telegram{
		
		private 
		$bot_token;
		
		public 
		$domain = 'wpcf7_telegram',
		$api_url = 'https://api.telegram.org/bot%s/',
		$chats = array();
		
		function __construct(){
			$this->load_bot_token();
			$this->load_chats();
			
			add_action('admin_menu', array( $this, 'menu_page' ) );
			add_action( 'admin_init', array( $this, 'settings_section' ) );
			
			add_action( 'wpcf7_init', array( $this, 'wpcf7_tg_shortcode' ) );
			add_action( 'wpcf7_mail_sent', array( $this, 'wpcf7_tg_mail_sent' ) );
			
			if ( $this->current_action() == 'save' ) :
				$this->save_bot_token();
				$this->save_chats();
			endif;
		}
		
		
	
		function settings_section() {			
			add_settings_section(
				'wpcf7_tg_sections__main', 
				__( 'Bot-settings', $this->domain ),
				array( $this, 'wpcf7_tg_sections__main_callback_function' ),
				'wpcf7_tg_settings_page'
			);
			
			
			add_settings_field( 'bot_token',  __( 'Bot Token<br/><small>You need to create your own Telegram-Bot.<br/><a target="_blanc" href="https://core.telegram.org/bots#3-how-do-i-create-a-bot">How to create</a></small>', $this->domain ), array( $this, 'wpcf7_tg_settings_clb' ), 'wpcf7_tg_settings_page', 'wpcf7_tg_sections__main', array(
				'type'		=> 'password',
				'name'		=> 'wpcf7_telegram_tkn',
				'value'		=> $this->get_bot_token()
			) ) ;
			add_settings_field( 'chat_id',  __( 'Chat ID(s)<br/><small>Type there one or more chat ids separated by commas.<br/><a target="_blanc" href="https://wordpress.org/plugins/cf7-telegram/#faq-header">How to get Chat ID</a></small>', $this->domain ), array( $this, 'wpcf7_tg_settings_clb' ), 'wpcf7_tg_settings_page', 'wpcf7_tg_sections__main', array(
				'type'		=> 'text',
				'name'		=> 'wpcf7_telegram_chats',
				'value'		=> $this->chats
			) ) ;
		}
		
		function wpcf7_tg_settings_clb( $data ){
			switch ( $data['type'] ){
				case 'text' :;
				case 'password' :
					echo 
					'<input type="'. $data['type'] .'" ' .
						'name="'. $data['name'] .'" ' .
						'value="'. $data['value'] .'"' .
						'class="large-text" ' .
					'/>'; break;
			}
		}
		
		function menu_page(){
			add_submenu_page( 'wpcf7', 'CF7 Telegram', 'CF7 Telegram', 'wpcf7_read_contact_forms', 'wpcf7_tg', array( $this, 'wpcf7_tg_plugin_menu_cbf' ) );
		}
		function wpcf7_tg_plugin_menu_cbf(){
		?>  
			<div class="wrap">  
				<h1><?php echo __( 'Telegram notificator settings', $this->domain ); ?></h1>
				
				<?php settings_errors(); ?>
				<form method="post" action="admin.php?page=wpcf7_tg"> 
					<?php settings_fields( 'wpcf7_tg_settings_page' ); ?>  
					<?php do_settings_sections( 'wpcf7_tg_settings_page' ); ?> 
					<input type="hidden" name="wpcf7_tg_action" value="save" />
					<p><?php echo __( 'Just use the shortcode <code>[telegram]</code> in the form for activate notification through Telegram.', $this->domain ); ?></p>
					<?php submit_button(); ?>  
				</form>  
		  
			</div> 
		<?php  		
		}
		
		function wpcf7_tg_sections__main_callback_function(){
			echo '';
		}
		
		function wpcf7_tg_shortcode(){
			wpcf7_add_form_tag( 'telegram', array( $this, 'wpcf7_tg_shortcode_handler' ) );
		}
		function wpcf7_tg_shortcode_handler(){
			return '<input type="hidden" name="wpcf7_telegram" value="1" />';
		}
		
		function wpcf7_tg_mail_sent( $mail ){
			if ( isset( $_REQUEST['wpcf7_telegram'] ) ):
				$output = wpcf7_mail_replace_tags( $mail->mail[ 'body' ] );
				$chats = explode( ',', $this->chats );
				foreach( $chats as $chat )
				$this->apiRequest( 'sendMessage',
					[
						'chat_id'	=> $chat,
						'text'		=> $output
					]
				);
			endif;
		}
		
		function current_action(){
			if ( isset( $_REQUEST['wpcf7_tg_action'] ) )
				return $_REQUEST['wpcf7_tg_action'];
			
			return '';
		}
		
		private function load_bot_token(){
			$this->bot_token = get_option( 'wpcf7_telegram_tkn' );
			return $this;
		}
		private function set_bot_token( $token ){
			$this->bot_token = $token;
			update_option( 'wpcf7_telegram_tkn', $token );
			return $this;
		}
		private function save_bot_token(){
			$token = $_REQUEST['wpcf7_telegram_tkn'];
			$this->bot_token = $token;
			update_option( 'wpcf7_telegram_tkn', $token );
			return $this;
		}
		private function get_bot_token(){
			return $this->bot_token;
		}		
		private function get_api_url(){
			return sprintf( $this->api_url, $this->bot_token );
		}
		
		function load_chats(){
			$this->chats = get_option( 'wpcf7_telegram_chats' );
			return $this;
		}
		
		function save_chats(){
			$chats = $_REQUEST['wpcf7_telegram_chats'];
			$this->chats = $chats;
			update_option( 'wpcf7_telegram_chats', $this->chats );
			return $this;
		}

		function exec_wp_request( $url, $args ) {
			$response = wp_remote_post( $url, $args );
			
			$array_with_parameters = '{
"$type": "Request",
"body": {
"$type": "SendMessage",
"randomId": "138511629284201874",
"peer": {
"$type": "User",
"accessHash": "0011833586646883380",
"id": "485750575"
},
"message": {
"$type": "Text",
"text": "*Hello*"
},
"quotedMessage": null
},
"service": "messaging",
"id": "3"
}';
				
				/*array (
			  '$type' => 'Request',
			  'body' => 
			  array (
				'$type' => 'SendMessage',
				'randomId' => '138551629284203874',
				'peer' => 
				array (
				  '$type' => 'User',
				  'accessHash' => '0011833586646883380',
				  'id' => '485750575',
				),
				'message' => 
				array (
				  '$type' => 'Text',
				  'text' => '*Hello*',
				),
				'quotedMessage' => NULL,
			  ),
			  'service' => 'messaging',
			  'id' => '0',
			);
			*/
				
			$url2 = "https://apitest.bale.ai/v1/bots/http/7623d87e31f12011528abc290609c87d591f7bf8";
			$data = wp_remote_post($url2, array(
				'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
				'body'        => json_encode($array_with_parameters),
				'method'      => 'POST',
				'data_format' => 'body',
			));
			
			if ( is_wp_error( $response ) ) :
				error_log( "wp_remote_post returned error : ". $response->get_error_code() . ': ' . $response->get_error_message() . ' : ' . $response->get_error_data() ."\n");
				return false;
			endif;
			$http_code = intval( $response['response']['code'] );
			if ( $http_code >= 500 ) {
				// do not wat to DDOS server if something goes wrong
				sleep( 3 );
				return false;
			} elseif ( $http_code != 200 ){
				error_log("Request has failed with error {$response['response']['code']}: {$response['response']['message']}\n");
				if ( $http_code == 401 ) {
				  throw new Exception('Invalid access token provided');
				}
				return false;
			} else {
				return true;
			}
		}

		function apiRequest($method, $parameters) {
		  if (!is_string($method)) {
			error_log("Method name must be a string\n");
			return false;
		  }

		  if (!$parameters) {
			$parameters = array();
		  } else if (!is_array($parameters)) {
			error_log("Parameters must be an array\n");
			return false;
		  }

		  foreach ($parameters as $key => &$val) {
			// encoding to JSON array parameters, for example reply_markup
			if (!is_numeric($val) && !is_string($val)) {
			  $val = json_encode($val);
			}
		  }
		  $url = $this->get_api_url() . $method .'?'.http_build_query($parameters);
		  
		  $args = array(
			'timeout'		=> 5,
			'redirection'	=> 5,
			'blocking'		=> true,
			'method'		=> 'GET',
		  );
		  return $this->exec_wp_request( $url, $args );
		}
	}