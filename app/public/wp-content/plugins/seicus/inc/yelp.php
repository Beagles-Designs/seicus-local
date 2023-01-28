<?php 
        // Enter the path that the oauth library is in relation to the php file
        require_once ('OAuth.php');

        if(isset($_POST['submit'])) :
               
                if($_POST['limit']) :
                        $limit = strip_tags($_POST['limit']);
                else :
                        $limit = 5;
                endif;
                $term = strip_tags($_POST['search-for']);
                $location = strip_tags($_POST['near']);
                $unsigned_url = "http://api.yelp.com/v2/search?term=".$term."&location=".$location."&limit=".$limit;

                // Set your keys here
                $consumer_key = "CwoIG0Gv2g2i8fOthlxUww";
                $consumer_secret = "Tq37yiyT-vnxCFb_PdTkb6aTsJY";
                $token = "4w--Of1rWtO2slxgwfh68Cr7HOwr4nmp";
                $token_secret = "TUthcZCM7JdWcnsdaudcUs8E5OI";

                // Token object built using the OAuth library
                $token = new OAuthToken($token, $token_secret);

                // Consumer object built using the OAuth library
                $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

                // Yelp uses HMAC SHA1 encoding
                $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

                // Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
                $oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);

                // Sign the request
                $oauthrequest->sign_request($signature_method, $consumer, $token);

                // Get the signed URL
                $signed_url = $oauthrequest->to_url();

                // Send Yelp API Call
                $ch = curl_init($signed_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);

                // Yelp response
                $data = curl_exec($ch);
                curl_close($ch);

                // Handle Yelp response data
                $response = json_decode($data);
                $json_string = file_get_contents($signed_url);
                $result = json_decode($json_string);

                //return $result;
                session_start();
                $_SESSION['result'] = $result;
                $_SESSION['search-for'] = $term;
                $_SESSION['near'] = $location;
                header('Location: '.$_POST['submitter']);

        endif;
?>