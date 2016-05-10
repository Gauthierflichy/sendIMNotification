<?php

function RocketChatLogin($user, $mdp){
    $postData = '';
    $url = 'https://demo.rocket.chat/api/login';
    $curl = curl_init($url);

    $curl_post_data = array(
        'password' => '%9T1B3$oqv4e',
        'user' => 'Flichy'
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

    echo 'Login successful !';
    return $curl_response;
}
