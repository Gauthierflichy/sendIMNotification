<?php

/* Login in Rocket Chat */

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
        return $curl_response;
    } else {
        echo "Login failed !";
    }

}


/* Get Public Rooms in RocketChat */

function RocketChatListRooms($authToken, $userId){

    $url = 'https://demo.rocket.chat/api/publicRooms';

    $curl = curl_init();

    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    //var_dump($curl_response->rooms->_id);

    if($curl_response->status === "success"){
        echo 'Request successful !';
        return $curl_response;
    } else {
        echo "Request failed !";
    }

    curl_close($curl);
}
