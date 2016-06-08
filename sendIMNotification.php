<?php

require 'functions.fn.php';

$CHATHOSTNAME = 'https://chat.monpotager.com/api'; //chat main url

$user = 'monpotabot';                // Username
$mdp = 'monpotabot';                 // password
$channel = 'new_customers';          // default channel
$msg = "Hello, i'm alive";           // default message

// Login to https://demo.rocket.chat/
$connection = RocketChatLogin($CHATHOSTNAME, $user, $mdp);

//var_dump($connection->data->authToken);

//List all public channels (uncomment to use)
$channelId = RocketChatListRooms($CHATHOSTNAME, $channel, $connection->data->authToken, $connection->data->userId);
//var_dump($channelId);

// Join a specific channel
$join = RocketChatJoinChannel($CHATHOSTNAME, $channelId, $connection->data->authToken, $connection->data->userId);
//var_dump($join);

// Send a message to the specific channel
$sendMsg = RocketChatSendMessage($CHATHOSTNAME, $msg, $channelId, $connection->data->authToken, $connection->data->userId);
