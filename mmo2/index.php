<?php	

	function getReceiptData($receipt, $isSandbox = false)

    {

        // determine which endpoint to use for verifying the receipt

        if ($isSandbox) {

            $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';

        }

        else {

            $endpoint = 'https://buy.itunes.apple.com/verifyReceipt';

        }



        // build the post data

        $postData = json_encode(

            array('receipt-data' => $receipt)

        );



        // create the cURL request

        $ch = curl_init($endpoint);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);



        // execute the cURL request and fetch response data

        $response = curl_exec($ch);

        $errno    = curl_errno($ch);

        $errmsg   = curl_error($ch);

        curl_close($ch);



        // ensure the request succeeded

        if ($errno != 0) {

            throw new Exception($errmsg, $errno);

        }



        // parse the response data

		return $response;

	}



	$value = $_GET['value'];

	$code = $_GET['code'];

	

	if ($code == '1'){

		$resp = getReceiptData( $value, true );

	}elseif ($code == '0'){

		$resp = getReceiptData( $value, false );

	}

	print $resp;

?>

