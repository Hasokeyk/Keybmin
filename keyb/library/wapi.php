<?php 

    global $myfone,$testfone,$token,$loginRequestID;
    $myfone = '905418460009';
    $testfone = '905414233558';
    $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IjkwNTQxODQ2MDAwOSJ9.R5xWA714f--InwOE-PIP4-LsP4CcHfavzDDGSc6wkoc';
    //$loginRequestID = 'OcDEzCplFmJESfrNinYHcpLyzFCCZwdC';

    function curl($url='https://in.wapi.xyz/sendTextMessage',$val=[]){
        global $myfone,$testfone,$token;

        $data_string = json_encode($val);                                                                                   
                                                                                                                            
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(isset($val['requestType']) and $val['requestType'] == 'GET'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        }else{
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $headers = array();
        $headers[] = 'Accept: application/json';
        if(isset($val['token'])){
            $headers[] = 'Authorization: '.$val['token'];
        }
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        if($val['output'] == 'json'){
            return json_decode($result);
        }else{
            return $result;
        }
        
    }

    function sendMessage($message = 'Test',$phone = null,$token=null,$output = 'json'){
        global $myfone,$testfone;

        $message = base64_encode($message);
        return curl('https://in.wapi.xyz/sendTextMessage',[
            'username' => $myfone,
            'jid' => ($phone??$testfone).'@s.whatsapp.net',
            'message' => $message,
            'token' => $token,
            'output' => $output,
        ]);

    }

    function getAllMessage($output = 'json'){
        
        global $myfone,$testfone;
        return curl('https://in.wapi.xyz/messages/'.$myfone,['output' => $output]);

    }

    function getUserMessage($phone = null,$output = 'json'){
        
        global $myfone,$testfone;
        return curl('https://in.wapi.xyz/messages/'.$myfone,[
            'jid' => ($phone??$testfone).'@s.whatsapp.net',
            'lastMessageTime' => time(),
            'output' => $output,
        ]);

    }

    function userCheck($phone = null,$output = 'json'){

        global $myfone,$testfone;
        return curl('https://in.wapi.xyz/checkWAuser',[
            'username' => $myfone,
            'jid' => ($phone??$testfone).'@s.whatsapp.net',
            'output' => $output,
        ]);

    }

    function getUserProfilPic($phone = null,$output = 'json'){

        global $myfone,$testfone;
        return curl('https://in.wapi.xyz/getProfilePic',[
            'username' => $myfone,
            'jid' => ($phone??$testfone).'@s.whatsapp.net',
            'output' => $output,
        ]);

    }

    function getLoginControl($output = 'json'){

        global $myfone,$testfone,$loginRequestID;
        return curl('https://in.wapi.xyz/online/'.$myfone,[
            'output' => $output,
            'requestType' => 'GET'
        ]);

    }

    function getLoginQR($output = 'json'){

        global $myfone,$testfone,$loginRequestID;
        return curl('https://in.wapi.xyz/loginQR/json',[
            'output' => $output,
            'requestType' => 'GET'
        ]);

    }

    function getLoginQRControl($loginRequestID,$output = 'json'){
        global $myfone,$testfone;
        return curl('https://in.wapi.xyz/loginQR/'.$loginRequestID,[
            'output' => $output,
            'requestType' => 'GET'
        ]);

    }