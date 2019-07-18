<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Get Ready for Invision Community 4.4</title>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<style>
			body {
				background: #2c455f;
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				width: 95%;
				margin: 0 auto;
				padding-top: 3%;
			}
			header {
				background: #1f282d;
				font-size: 22px;
				font-weight: 200;
				color: #fff;
				padding: 0 15px;
				line-height: 58px;
			}
			header img {
				display: inline-block;
				width: 26px;
				height: 25px;
				vertical-align: middle;
				margin: -3px 5px 0 0;
			}
			#main {
				background: #fff;
				padding: 30px;
			}
			section {
				margin-bottom: 50px;
			}
			
			h1 {
				font-size: 26px;
				font-weight: 300;
				line-height: 1.2;
				margin: 0;
			}
			h2 {
				font-size: 18px;
				color: #333333;
				line-height: 24px;
				font-weight: 400;
				display: inline-block;
				margin: 0;
			}
			hr {
				margin: 15px 0px;
				height: 0;
				padding: 0;
				border-width: 2px 0 0 0;
				border-style: solid;
				border-color: #ebebeb;
			}
			li {
				list-style: none;
				margin-bottom: 10px;
			}
			li.success {
				color: #4a7c20;
			}
			li.success:before {    
				font-family: 'FontAwesome';
				content: '\f00c';
				margin:0 8px 0 -24px;
			}
			li.fail {
				color: #a52638;
			}
			li.fail:before {    
				font-family: 'FontAwesome';
				content: '\f057';
				margin:0 9px 0 -23px;
			}
			li.advisory {
				/*color: #5e707d;*/
				color: #4a7c20;
			}
			li.advisory:before {    
				font-family: 'FontAwesome';
				content: '\f05a';
				margin:0 9px 0 -23px;
			}
			a.phpinfo {
				float: right;
				color: #868686;
				font-size: 11px;
			}
			p.success, p.fail {
				padding: 15px 15px 15px 45px;
				border-radius: 2px;
				position: relative;
				margin: 25px 0px;
				color: #fff;
				font-size: 14px;
			}
			p.success:before, p.fail:before {
				font-family: 'FontAwesome';
				position: absolute;
				top: 15px;
				left: 15px;
				font-size: 18px;
			}
			p.success a, p.fail a {
				color: #fff;
				border-bottom: 1px dotted #fff;
				text-decoration: none;
			}
			p.fail {
				background: #b52b38;
			}
			p.fail:before {
				content: '\f057';
			}
			p.success {
				background: #62874d;
			}
			p.success:before {
				content: '\f00c';
			}
			p.upgradeInfo {
				color: #868686;
				font-size: 12px;
			}
			p.smaller {
				font-size: 11px;
			}
		</style>
	</head>
	<body>
<?php if ( isset( $_GET['phpinfo'] ) ) { phpinfo(); exit; } ?>
		<header>
			<img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAZCAYAAAAv3j5gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZZJREFUeNq8lr9Lw0AUx2OETAUhIAiZBMFBKLg4+R8IroKbWCgOxY7+GYIiWAKCjl0rZHKJ4CqCg3RyKBWhQqmLgRK/py/hcn13TWzqFz5D837de7xcasdxbP0HtvWraxDPCZE7LfRozU8/uRdEW5ADnsB6yUVeQBVESUcRqIFxiUVErgPKnY5O6B6cl1hI5HpIfynbUQHdeHZ1KdfE1iX6BPUSuqlTrlQ243QHWjMUaVGOjJKtU7UEnoFXsEgPbICharA1AcM/jrDGFTEVEroFNwWKCN9Aa51yR7mgn2PL+uQ79a7b1pzjAzRydNMgX05bckchODGcqG3opm2IO6bcmUJfYE0TsAIGTJEB2biYVTBKCsnLIC7WK037b6DJPG+SjZMPKuoyhNIpjwyj6Eh+HYPfoeQ3MbpEol3PMMJ3QjcyTxlzyN11FrV7aRjhJqEb2QVw876wO2DfcM30NLY9sGu6GSLGdsadzCCXYlRlPnxBgUCdTsEy8zyQt84BPvOuvILFHH+nHPJV3zGfbNrPROn6FmAANAMI1RO30/8AAAAASUVORK5CYII=" />
			Invision Community 4.4
		</header>
		<div id='main'>
<?php $success = TRUE; $installOnly = TRUE; ?>
			<section>
				<a href="?phpinfo" class="phpinfo">phpinfo</a>
				<h2>PHP Requirements</h2>
				<ul>
<?php if ( version_compare( PHP_VERSION, '7.1.0' ) >= 0 ): ?>
					<li class="success">PHP version <?php echo PHP_VERSION; ?>.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You are not running a compatible version of PHP. You need PHP 7.1.0 or above (7.2.0 or above recommended). You should contact your hosting provider or system administrator to ask for an upgrade.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'curl' ) and $version = curl_version() and version_compare( $version['version'], '7.36', '>=' ) ): ?>
					<li class="success">cURL extension loaded</li>
<?php elseif ( ini_get('allow_url_fopen') ): ?>
					<li class="advisory">You do not have the cURL PHP extension loaded or it is running a version less than 7.36. While this is not required, it is recommend to make calls to external API services faster. You may wish to contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the cURL PHP extension loaded (or it is running a version less than 7.36) and the allow_url_fopen PHP setting is disabled. You should contact your hosting provider or system administrator to ask either for cURL version 7.36 or greater to be installed, to be installed or the allow_url_fopen setting enabled. cURL is recommended.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'dom' ) ): ?>
					<li class="success">DOM extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the DOM PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'gd' ) ): ?>
					<li class="success">GD extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the GD PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'mbstring' ) ): ?>
<?php if ( function_exists( 'mb_eregi' ) ): ?>
					<li class="success">Multibyte String extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">The Multibyte String extension has been configured with the --disable-mbregex option. You should contact your hosting provider or system administrator to ask for it to be reconfigured without that option.</li>
<?php if( ini_get('mbstring.func_overload') AND ini_get('mbstring.func_overload') > 0 ): $success = FALSE; ?>
					<li class="fail">The PHP configuration has mbstring.func_overload set with a value higher than 0. You should contact your hosting provider or system administrator to disable Multibyte function overloading.</li>
<?php endif; ?>
<?php endif; ?>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the Multibyte String PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'mysqli' ) ): ?>
					<li class="success">MySQLi extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the MySQLi PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'openssl' ) ): ?>
					<li class="success">OpenSSL extension loaded.</li>
<?php else: ?>
					<li class="advisory">You do not have the OpenSSL PHP extension loaded. You can install IPS Community Suite without it, but it is required to use external login services (Facebook, Google, LinkedIn, Microsoft and Twitter), some share services (Facebook and Twitter), Gravatar, and, if using Commerce some gateways and MaxMind integration. You may wish to contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'session' ) ): ?>
					<li class="success">Session extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the Session PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'simplexml' ) ): ?>
					<li class="success">SimpleXML extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the SimpleXML PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'xml' ) ): ?>
					<li class="success">XML Parser extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the XML Parser PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'xmlreader' ) ): ?>
					<li class="success">XMLReader extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the XMLReader PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'xmlwriter' ) ): ?>
					<li class="success">XMLWriter extension loaded.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">You do not have the XMLWriter PHP extension loaded which is required. You should contact your hosting provider or system administrator to ask for it to be enabled.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'zip' ) ): ?>
					<li class="success">Zip extension loaded.</li>
<?php else: ?>
					<li class="advisory">You do not have the Zip PHP extension loaded. While this is not required, it is recommend. You may wish to contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'exif' ) ): ?>
					<li class="success">Exif extension loaded.</li>
<?php else: ?>
					<li class="advisory">You do not have the Exif PHP extension loaded. While this is not required, it is recommend. You may wish to contact your hosting provider or system administrator to ask for it to be installed.</li>
<?php endif; ?>
<?php
	$_memoryLimit = @ini_get('memory_limit');
	$memoryLimit = $_memoryLimit;
	preg_match( "#^(\d+)(\w+)$#", strtolower($memoryLimit), $match );
	if( $match[2] == 'g' )
	{
		$memoryLimit = intval( $memoryLimit ) * 1024 * 1024 * 1024;
	}
	else if ( $match[2] == 'm' )
	{
		$memoryLimit = intval( $memoryLimit ) * 1024 * 1024;
	}
	else if ( $match[2] == 'k' )
	{
		$memoryLimit = intval( $memoryLimit ) * 1024;
	}
	else
	{
		$memoryLimit = intval( $memoryLimit );
	}
?>
<?php if ( $memoryLimit >= 128 * 1024 * 1024 ): ?>
					<li class="success"><?php echo $_memoryLimit; ?> memory limit.</li>
<?php else: $success = FALSE; ?>
					<li class="fail">Your PHP memory limit is too low. It needs to be set to 128M or more. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif; ?>
<?php if ( extension_loaded( 'suhosin' ) ): ?>
<?php if ( ini_get( 'suhosin.max_vars' ) >= 4096 ): ?>
					<li class="success">suhosin.max_vars <?php echo ini_get( 'suhosin.max_vars' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.max_vars is set to <?php echo ini_get( 'suhosin.max_vars' ) ?>. This can cause problems in some areas. We recommended a value of 4096 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php if ( ini_get( 'suhosin.request.max_vars' ) >= 4096 ): ?>
					<li class="success">suhosin.request.max_vars <?php echo ini_get( 'suhosin.request.max_vars' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.request.max_vars is set to <?php echo ini_get( 'suhosin.request.max_vars' ) ?>. This can cause problems in some areas. We recommended a value of 4096 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php if ( ini_get( 'suhosin.get.max_value_length' ) >= 2000 ): ?>
					<li class="success">suhosin.get.max_value_length <?php echo ini_get( 'suhosin.get.max_value_length' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.get.max_value_length is set to <?php echo ini_get( 'suhosin.get.max_value_length' ) ?>. This can cause problems in some areas. We recommended a value of 2000 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php if ( ini_get( 'suhosin.post.max_value_length' ) >= 10000 ): ?>
					<li class="success">suhosin.post.max_value_length <?php echo ini_get( 'suhosin.post.max_value_length' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.post.max_value_length is set to <?php echo ini_get( 'suhosin.post.max_value_length' ) ?>. This can cause problems in some areas. We recommended a value of 10000 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php if ( ini_get( 'suhosin.request.max_value_length' ) >= 10000 ): ?>
					<li class="success">suhosin.request.max_value_length <?php echo ini_get( 'suhosin.request.max_value_length' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.request.max_value_length is set to <?php echo ini_get( 'suhosin.request.max_value_length' ) ?>. This can cause problems in some areas. We recommended a value of 10000 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php if ( ini_get( 'suhosin.request.max_varname_length' ) >= 350 ): ?>
					<li class="success">suhosin.request.max_varname_length <?php echo ini_get( 'suhosin.request.max_varname_length' ) ?></li>
<?php else: ?>
					<li class="advisory">PHP setting suhosin.request.max_varname_length is set to <?php echo ini_get( 'suhosin.request.max_varname_length' ) ?>. This can cause problems in some areas. We recommended a value of 350 or above. You should contact your hosting provider or system administrator to ask for this to be changed.</li>
<?php endif ?>
<?php else: ?>
					<li class="success">No Suhosin restrictions.</li>
<?php endif; ?>
				</ul>
			</section>
<?php if ( extension_loaded( 'mysqli' ) ): ?>
<?php
	class my_mysqli extends mysqli {
		 public function __construct() {
			 parent::init();
			 parent::options( MYSQLI_OPT_CONNECT_TIMEOUT, 5 );
			 return call_user_func_array( 'parent::__construct', func_get_args() );
		 }
	}
?>
				<section>
					<h2>MySQL Requirements</h2>
					<ul>
<?php if ( file_exists( 'conf_global.php' ) ): ?>
<?php
	require 'conf_global.php';
	$mysql = new mysqli( $INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass'], $INFO['sql_database'], isset( $INFO['sql_port'] ) ? intval( $INFO['sql_port'] ) : NULL, isset( $INFO['sql_socket'] ) ? $INFO['sql_socket'] : NULL );
	$installOnly = FALSE;
?>
<?php if ( version_compare( $mysql->server_info, '5.6.2' ) >= 0 ): ?>
						<li class="success">MySQL version <?php echo $mysql->server_info; ?>.</li>
<?php elseif ( version_compare( $mysql->server_info, '5.5.3' ) >= 0 ): ?>
						<li class="advisory">You are running MySQL version <?php echo $mysql->server_info; ?>.<p class='smaller'>While this version is compatible, we recommend version 5.6.2 or above. You may wish to contact your hosting provider or system administrator to ask for an upgrade if you are upgrading to Invision Community 4.</p></li>
<?php else: $success = FALSE; ?>
						<li class="fail">You are not running a compatible version of MySQL. You need MySQL 5.5.3 or above (5.6.2 or above recommended). You should contact your hosting provider or system administrator to ask for an upgrade.</li>
<?php endif; ?>

<?php  else: $mysql = @new my_mysqli( 'localhost' ); if ( $mysql->connect_errno ): ?>
						<li class="advisory">MySQL connection could not be established to perform version check. Make sure your MySQL Server version is 5.5.3 or above (5.6.2 or above recommended).</li>
<?php else: ?>
<?php if ( version_compare( $mysql->server_info, '5.6.2' ) >= 0 ): ?>
						<li class="success">MySQL version <?php echo $mysql->server_info; ?>.</li>
<?php elseif ( version_compare( $mysql->server_info, '5.5.3' ) >= 0 ): ?>
						<li class="advisory">You are running MySQL version <?php echo $mysql->server_info; ?>. While this version is compatible, we recommend version 5.6.2 or above. You may wish to contact your hosting provider or system administrator to ask for an upgrade.</li>
<?php else: $success = FALSE; ?>
						<li class="fail">You are not running a compatible version of MySQL. You need MySQL 5.5.3 or above. You should contact your hosting provider or system administrator to ask for an upgrade.</li>
<?php endif; ?>
<?php endif; endif; ?>
					</ul>
				</section>
<?php endif; ?>
			<section>
				<h2>Additional Requirements</h2>
				<ul>
<?php if ( file_exists( 'conf_global.php' ) and isset( $mysql ) and $licensekey = @$mysql->query("SELECT * FROM core_sys_conf_settings WHERE conf_key='ipb_reg_number';") and $licensekey = @$licensekey->fetch_assoc() and $licensekey and $licensekey['conf_value'] and $lkeyData = @file_get_contents( "http://license.invisionpower.com/?a=info&key={$licensekey['conf_value']}" ) and $lkeyData = json_decode( $lkeyData ) ): ?>
<?php if ( $lkeyData->key->status == 'Ok' ): ?>
					<li class="success">License active.</li>
<?php else: ?>
					<li class="advisory">Your license is currently inactive. You will need to <a href="https://invisioncommunity.com/clientarea" target="_blank">renew</a> before you can upgrade.</li>
<?php endif; ?>
<?php endif; ?>
				</ul>
			</section>
			<hr>
			<section id="summary">
				<h1>Summary</h1>
<?php if ( $success ): ?>
				<p class="success">You are ready to install Invision Community 4.4!</p>
<?php if ( $installOnly ): ?>
				<p class="upgradeInfo">To check if you can upgrade an existing installation of IP.Board 3.x, upload this script to the directory where your community is installed.</p>
<?php endif; ?>
<?php else: ?>
				<p class="fail">You are not ready to upgrade to Invision Community 4.4 yet. See the information above for instructions how to fix or <a href="https://invisioncommunity.com/clientarea" target="_blank">contact technical support</a> for further assistance.</p>
<?php endif; ?>
			</section>
		</div>
	</body>
</html>