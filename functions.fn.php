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

function RocketChatListRooms($CHATHOSTNAME, $channel, $authToken, $userId){
    $url = $CHATHOSTNAME.'/publicRooms';
    //var_dump($url);
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);
    //var_dump($curl_response);
    if($curl_response->status === "success"){
        foreach ($curl_response->rooms as $k => $v){
            if($v->name == $channel){
                $channelId = $v->_id;
                echo "\n".'Room id found !';
                return $channelId; // Return success or error
            }
            //var_dump($v->name, $channelId);
        }
    } else {
        echo "\n"."Room id not found !";
    }
}

/* Join a specefic room */

function RocketChatJoinChannel($CHATHOSTNAME, $channelId, $authToken, $userId){
    $postData = '';
    $url = $CHATHOSTNAME.'/rooms/'.$channelId.'/join';
    //var_dump($url);
    $curl = curl_init($url);

    $curl_post_data = array(
        '{}'
    );

    foreach($curl_post_data as $k => $v)
    {
        $postData .= $k . '='.$v.'&';
    }

    $postData = rtrim($postData, '&');

    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl,CURLOPT_HTTPHEADER,array("X-Auth-Token: ".$authToken, "X-User-Id: ".$userId));

    $curl_response = json_decode(curl_exec($curl));

    curl_close($curl);
    //var_dump($curl_response);
    if($curl_response->status === "success"){
        echo "\n".'Join successful !';
        return $curl_response; // Return success or error
    } else {
        echo "\n"."Join failed !";
    }
}

/* Send a message in a channel */

function RocketChatSendMessage($CHATHOSTNAME, $msg, $channelId, $authToken, $userId){
    $postData = '';
    $url = $CHATHOSTNAME.'/rooms/'.$channelId.'/send';
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
