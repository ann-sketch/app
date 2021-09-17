<?php 

function send_sms() {
    $message = "Works from php";
    $phone = "0207133523";
    $sender_id = "ADONKO LTD";
    
    $key="00c44cf39580579e337c"; //your unique API key;
    $message=urlencode($message); //encode url;
                                                
    /*******************API URL FOR SENDING MESSAGES********/
    $url="http://goldsms.smsalertgh.com/smsapi?key=$key&to=$phone&msg=$message&sender_id=$sender_id";
    
    
    /****************API URL TO CHECK BALANCE****************/
    // $url="http://goldsms.smsalertgh.com/api/smsapibalance?key=$key";
    
    
    $result=file_get_contents($url); //call url and store result;
    
    switch($result){                                           
        case "1000":
        echo "Message sent";
        break;
        case "1002":
        echo "Message not sent";
        break;
        case "1003":
        echo "You don't have enough balance";
        break;
        case "1004":
        echo "Invalid API Key";
        break;
        case "1005":
        echo "Phone number not valid";
        break;
        case "1006":
        echo "Invalid Sender ID";
        break;
        case "1008":
        echo "Empty message";
        break;
    }
}
send_sms()
?>