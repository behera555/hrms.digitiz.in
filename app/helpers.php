<?php 

    function generateUniqueAccountNumber(){
        do {
            $code = random_int(1000, 9999);
        } while (\App\Models\Recruitments::where("id", "=", $code)->first());

        return $code;
    }

  function d_m_y_conversion($getdate){
    return date("d-m-Y", strtotime($getdate));
    }
    function y_m_d_conversion($getdate){
    return date("Y-m-d", strtotime($getdate));
    }
    function y_m_d_hisconversion($getdate){
    return date("Y-m-d H:i:s", strtotime($getdate));
    }

    function random_number($size = 6)
    {
        $random_number='';
        $count=0;
        while ($count < $size ) 
            {
                $random_digit = mt_rand(0, 9);
                $random_number .= $random_digit;
                $count++;
            }
        return $random_number;  
    }

    function Dateconversion($getdate){
        if(trim($getdate)!='0000-00-00'){
        return date('d-M-Y', strtotime($getdate));
        }else{
        return '';
        }
        }
    
        function Timeconversion($getdate){
            if(trim($getdate)!='00:00:00' && trim($getdate)!=''){
            return date('h:i A', strtotime($getdate));
            }else{
            return '';
            }
            }

            function Datebreakconversion($getdate){
            if(trim($getdate)!='0000-00-00 00:00:00'){
            return date('d-m-Y', strtotime($getdate)).'<br>'.date('(h:i A)', strtotime($getdate));
            }else{
            return '';
            }
            }
    
            function getDaysAgo($lastloginTime){
                $estimate_time = time() - strtotime($lastloginTime);
            
                if( $estimate_time < 1 )
                {
                    return 'less than 1 second ago';
                }
            
                $condition = array(
                            12 * 30 * 24 * 60 * 60  =>  'year',
                            30 * 24 * 60 * 60       =>  'month',
                            24 * 60 * 60            =>  'day',
                            60 * 60                 =>  'hour',
                            60                      =>  'minute',
                            1                       =>  'second'
                );
            
                foreach( $condition as $secs => $str )
                {
                    $d = $estimate_time / $secs;
            
                    if( $d >= 1 )
                    {
                        $r = round( $d );
                        return  $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
                    }
                }
                
            }
            function dateDiffInDays($date1, $date2)  
            {
                $diff = strtotime($date2) - strtotime($date1);
                return abs(round($diff / 86400)); 
            }

            
            function getTimeInSec($t1, $t2)
            {
                $timeFirst  = strtotime($t1);
                $timeSecond = strtotime($t2);
                $differenceInSeconds = $timeSecond - $timeFirst;
                return $differenceInSeconds;
            }

        function encrypt_decrypt($string, $action = 'encrypt')
        {
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
            $secret_iv = '5fgf5HJ5g27'; // user define secret key
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
            if ($action == 'encrypt') {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            } else if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
            return $output;
        }

        function generateSalt_e($length) {
            $random = "";
            srand((double) microtime() * 1000000);
            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";
            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }
            return $random;
        }
    
 function numberFormat($number, $decimals=0)
    {

        // $number = 555;
        // $decimals=0;
        // $number = 555.000;
        // $number = 555.123456;

        if (strpos($number,'.')!=null)
        {
            $decimalNumbers = substr($number, strpos($number,'.'));
            $decimalNumbers = substr($decimalNumbers, 1, $decimals);
        }
        else
        {
            $decimalNumbers = 0;
            for ($i = 2; $i <=$decimals ; $i++)
            {
                $decimalNumbers = $decimalNumbers.'0';
            }
        }
        // return $decimalNumbers;



        $number = (int) $number;
        // reverse
        $number = strrev($number);

        $n = '';
        $stringlength = strlen($number);

        for ($i = 0; $i < $stringlength; $i++)
        {
            if ($i%2==0 && $i!=$stringlength-1 && $i>1)
            {
                $n = $n.$number[$i].',';
            }
            else
            {
                $n = $n.$number[$i];
            }
        }

        $number = $n;
        // reverse
        $number = strrev($number);

        ($decimals!=0)? $number=$number.'.'.$decimalNumbers : $number ;

        return $number;
    }
        

        if (!function_exists('apiRequest')) {
            /**
             * Make a Guzzle (CURL) request to remote server for the resource.
             *
             * @return response
             */
            function apiRequest($url, $method = 'GET', $post_params)
            {
                $response = [];
                $client = new \GuzzleHttp\Client();
                try {
                    if ($method == 'POST') {
                        $response = $client->request('POST', $url, $post_params);
                        $response = $response->getBody()->getContents();
                    } else if ($method == 'POST_RETRUN_JSON') {
                        $response = $client->request('POST', $url, $post_params);
                        $response = $response->getBody();
                    } else if ($method == 'GET') {
                        $response = $client->request('GET', $url, $post_params);
                        $response = $response->getBody()->getContents();
                    } else if($method == 'PUT') {
                        $response = $client->request('PUT', $url, $post_params);
                     }
                } catch (\Exception $exception) {
                    if ($method == 'POST_RETRUN_JSON') {
                        return $exception->getResponse()->getBody(true);
                    } else {
                        // dd($exception->getCode());
                        return $exception->getMessage();
                    }
                }
                return $response;
            }
        }
        
?>