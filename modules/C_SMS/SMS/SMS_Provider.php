<?php
if(!defined('dotbEntry'))define('dotbEntry', true);
require_once("include/nusoap/nusoap.php");
class SMS_Provider{

    var $client = null;
    var $username = '';
    var $password = '';
    var $url = '';

    function SMS_Provider($url, $username, $password){

        $this->username = $username;
        $this->password = $password;
        $this->client   = new nusoap_client($url,true);
        $this->url = $url;
    }
    /**
    * function send sms to phone number
    *
    * @param mixed $message
    * @param mixed $phone
    * @param mixed $sender
    * @param mixed $deptId
    * @param mixed $groupId
    * @return mixed
    */

    function send_sms($phone, $text, $from, $supplier, $groupID = ''){
        if(!empty($this->password) && !empty($this->username)){
            if($supplier == 'VHT' || empty($supplier)){
                $params = array(
                    'code'      => $this->password,
                    'account'   => $this->username,
                    'phone'     => $phone,
                    'from'      => $from,
                    'sms'       => $text,
                );
                $login_results = $this->client->call('sendSms',$params);
            }

            elseif($supplier == 'VIETGUYS'){
                $params = array(
                    'account'       => $this->username,
                    'passcode'      => $this->password,
                    'service_id'    => $from,
                    'phone'         => $phone,
                    'sms'           => $text,
                    'transactionid' => '',
                    'json'          => 2
                );
                $login_results = $this->client->call('send',array('sms' => $params) );
            }elseif($supplier == 'GAPIT'){
                $params = array(
                    'dest'         => $phone,
                    'name'         => $from,
                    'msgBody'      => $text,
                    'contentType'  => 'text',
                    'serviceID'    => 'G-API',
                    'mtID'         => '0',
                    'cpID'         => $groupID,
                    'username'     => $this->username,
                    'password'     => $this->password,
                );
                $login_results = $this->client->call('SendMT', $params  );
                if($login_results['SendMTResult'] == '200') $login_results = 1;
                else $login_results = -1;
            }elseif($supplier == '8x77'){
                $this->client->setCredentials($this->username, $this->password);
                $err = $this->client->getError();
                if ($err) $login_results = -1;

                $params = array('string' => $phone,
                    'string0' => base64_encode($text),
                    'string1' => $from, //'SERVICE_ID: neu BrandName thi dien BrandName vao
                    'string2' => $from, // Command_code: neu BrandName thi dien BrandName vao
                    'string3' => 0, //Message_Type
                    'string4' => 0,//Receive_ID
                    'string5' => 1,//Total_MSG
                    'string6' => 1,//Msg_Index
                    'string7' => 0,//IsMore
                    'string8' => 0);//Content_Type

                //                $params = array(
                //                    'User_ID'      => $phone,
                //                    'Message'      => $text,
                //                    'contentType'  => 'text',
                //                    'Service_ID'   => 'BLUESEA',
                //                    'Command_Code' => 'CSKH',
                //                    'Message_Type' => '0',
                //                    'Request_ID'   => $groupID,
                //                    'Total_Message'=> '1',
                //                    'Message_Index'=> '1',
                //                    'IsMore'       => '1',
                //                    'Content_Type' => '0',
                //                );


                $login_results = $this->client->call('sendMT', $params  );
                if($login_results == 0) $login_results = 1;
                else $login_results = -1;
            }
            elseif($supplier == 'VMG'){
                //config WS Account bất kì, WS Password là token
                $params = array(
                    'to' => $phone,
                    'telco' => '',
                    'orderCode' => '',
                    'packageCode' => '',
                    'type' => 1,
                    'from' => $from,
                    'message' => $text,
                    'scheduled' => '',
                    'requestId' => '',
                    'useUnicode' => 1,
                    'maxMt' => 0,
                    'ext' => '',
                );

//                $this->client->setHeaders('token:' + $this->password);
//                $login_results = $this->client->call('BulkSendSms',$params);
//                if($login_results['BulkSendSmsResult']['error_code'] == 0) $login_results = 1;
//                else $login_results = -1;

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($params),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json; charset="UTF-8"',
                        'token: ' . $this->password
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                if ($response != false) {
                    $login_results = 1;
                } else
                    $login_results = -1;
            }
            elseif ($supplier =='VIETTEL'){

                $params = array(
                    "User" => $this->username,
                    "Password" => $this->password,
                    "CPCode" => $from,
                    "RequestID" => "1",
                    "UserID" => $phone,
                    "ReceiverID" => $phone,
                    "ServiceID" => $from,
                    "CommandCode" => "bulksms",
                    "Content" => $text,
                    "ContentType" => "0"
                );

                $login_results = $this->client->call("wsCpMt", array($params));


                if($login_results['return']['result'] == 1) $login_results = 1;
                else $login_results = -1;
            }
            else $login_results = -1;
        }else $login_results = -1;

        return $login_results;
    }
}
?>