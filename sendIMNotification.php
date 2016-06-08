<?php

require 'functions.fn.php';

$user = 'monpotabot';                // Username
$mdp = 'monpotabot';                 // password
$CHATHOSTNAME = 'https://chat.monpotager.com/api';
$channel = 'new_customers';          // default channel
$msg = "Hello, i'm alive";           // default message

// Login to https://demo.rocket.chat/
$connection = RocketChatLogin($CHATHOSTNAME, $user, $mdp);

var_dump($connection->data->authToken);

//List all public channels (uncomment to use)
$publicRoomsList = RocketChatListRooms($CHATHOSTNAME, $connection->data->authToken, $connection->data->userId);
var_dump($publicRoomsList->rooms);

// Join a specific channel
//$join = RocketChatJoinChannel($CHATHOSTNAME, $channel, $connection->data->authToken, $connection->data->userId);

// Send a message to the specific channel
//$sendMsg = RocketChatSendMessage($CHATHOSTNAME, $msg, $channel, $connection->data->authToken, $connection->data->userId);
