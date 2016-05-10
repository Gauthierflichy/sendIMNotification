<?php

require 'functions.fn.php';

$user = 'Flichy';                      // Username
$mdp = '%9T1B3$oqv4e';                 // password
$channel = 'GENERAL';                  // default channel
$msg = "Je suis un pote à Gé!";        // default message

// Login to https://demo.rocket.chat/
$connection = RocketChatLogin($user, $mdp);

//List all public channels (uncomment to use)
//$publicRoomsList = RocketChatListRooms($connection->data->authToken, $connection->data->userId);
//var_dump($publicRoomsList->rooms);

// Join a specific channel
$join = RocketChatJoinChannel($channel, $connection->data->authToken, $connection->data->userId);

// Send a message to the specific channel
$sendMsg = RocketChatSendMessage($msg, $channel, $connection->data->authToken, $connection->data->userId);
