<?php 



require_once '../../../../wp-load.php';




			$array_with_parameters = array (
                '$type' => 'Request',
                'body' => 
                array (
                  '$type' => 'SendMessage',
                  'randomId' => '138551629214203874',
                  'peer' => 
                  array (
                    '$type' => 'User',
                    'accessHash' => '0011833586646883380',
                    'id' => '485750575',
                  ),
                  'message' => 
                  array (
                    '$type' => 'Text',
                    'text' => '*saber*',
                  ),
                  'quotedMessage' => NULL,
                ),
                'service' => 'messaging',
                'id' => '3453435',
              );
				
				/*'{
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
			*/
				
			$url2 = "https://apitest.bale.ai/v1/bots/http/7623d87e31f12011528abc290609c87d591f7bf8";
			$data = wp_remote_post($url2, array(
				'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
				'body'        => json_encode($array_with_parameters),
				'method'      => 'POST',
				'data_format' => 'body',
			));
			