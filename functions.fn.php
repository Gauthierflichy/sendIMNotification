<?php

/* Login in Rocket Chat using unsername and password*/

function RocketChatLogin($CHATHOSTNAME, $user, $mdp){
    $postData = '';
    $url = $CHATHOSTNAME.'/login';
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

function RocketChatListRooms($CHATHOSTNAME, $authToken, $userId){
    $postData = '';
    $url = $CHATHOSTNAME.'/publicRooms';
    var_dump($url);
    $curl = curl_init($url);

    /*$curl_post_data = array(
        '{}'
    );

    foreach($curl_post_data as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }

    $postData = rtrim($postData, '&');*/

    curl_setopt($curl, CURLOPT_POST, false);
    /*curl_setopt($curl, CURLOPT_POSTFIELDS);*/
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);
    var_dump($curl_response);
    if($curl_response->status === "success"){
        echo "\n".'Join successful !';
        return $curl_response; // Return success or error
    } else {
        echo "\n"."Join failed !";
    }
}

/* Join a specefic room */

function RocketChatJoinChannel($CHATHOSTNAME, $channel, $authToken, $userId){
    $postData = '';
    $url = $CHATHOSTNAME.'/rooms/'.$channel.'/join';
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

function RocketChatSendMessage($CHATHOSTNAME, $msg, $channel, $authToken, $userId){
    $postData = '';
    $url = $CHATHOSTNAME.'/rooms/'.$channel.'/send';
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
