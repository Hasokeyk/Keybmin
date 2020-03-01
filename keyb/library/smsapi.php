<?php 

    global $apiKey;
    $apiKey = '2858cce3eee90234d98e79b6271044494b2a4aa3';

    function xmlCurl($url = 'http://sms2.sanalsantral.com.tr/api/smspost/v1',$xml = null){

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        //print_r($info);
        return $output;
    }

    function smsYolla($phone,$message){
        global $apiKey;

        $xml = '<sms>
            <apikey>'.$apiKey.'</apikey>
            <header>SELDOS</header>
            <validity>2880</validity>
            <type>1</type>
            <international></international>
            <message>
            <gsm>
                <no>'.$phone.'</no>
            </gsm>
            <msg><![CDATA['.($message).']]></msg>
            </message>
            </sms>';

        $results = xmlCurl('http://sms2.sanalsantral.com.tr/api/smspost/v1',$xml);
        $results = explode(' ',$results);
        if($results[0] == 00){
            return true;
        }else{
            return false;
        }
    }