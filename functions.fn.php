<?php

/* Login in Rocket Chat using unsername and password*/

function RocketChatLogin($user, $mdp){
    $postData = '';
    $url = 'https://demo.rocket.chat/api/login';
    $curl = curl_init($url);

    $curl_post_data = array(
        'password' => $mdp,
        'user' => $user
    );

    foreach($curl_post_data as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }

    $postData = rtrim($postData, '&');

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);

    if($curl_response->status === "success"){
        echo 'Login successful !';
        return $curl_response; // The function return authToken and userId
    } else {
        echo "Login failed !";
    }

}


/* Get Public Rooms in RocketChat */

function RocketChatListRooms($authToken, $userId){

    $url = 'https://demo.rocket.chat/api/publicRooms';

    $curl = curl_init();

    $postData = "{}";


    $postData = rtrim($postData, '&');

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    if($curl_response->status === "success"){
        echo "\n".'Request successful !';
        return $curl_response; // The function retrun an object with all public rooms and their infos
    } else {
        echo "\n"."Request failed !";
    }

    curl_close($curl);
}

/* Join a specefic room */

function RocketChatJoinChannel($channel, $authToken, $userId){
    $postData = '';
    $url = 'https://demo.rocket.chat/api/rooms/'.$channel.'/join';
    $curl = curl_init($url);

    $curl_post_data = array(
        '{}'
    );

    foreach($curl_post_data as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }

    $postData = rtrim($postData, '&');

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);

    if($curl_response->status === "success"){
        echo "\n".'Join successful !';
        return $curl_response; // Return success or error
    } else {
        echo "\n"."Join failed !";
    }
}

/* Send a message in a channel */

function RocketChatSendMessage($msg, $channel, $authToken, $userId){
    $postData = '';
    $url = 'https://demo.rocket.chat/api/rooms/'.$channel.'/send';
    $curl = curl_init($url);

    $curl_post_data = array(
        'msg' => $msg
    );

    foreach($curl_post_data as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }

    $postData = rtrim($postData, '&');

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);

    if($curl_response->status === "success"){
        echo "\n".'Message sent !'; // Return success or error
        return $curl_response;
    } else {
        echo "\n"."Failed to send message !";
    }
}
