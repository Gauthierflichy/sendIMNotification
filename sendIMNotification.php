<?php

require 'functions.fn.php';

$user = 'Flichy';
$mdp = '%9T1B3$oqv4e';
$channel = 'GENERAL'; // default channel

$connection = RocketChatLogin($user, $mdp);                                                         // Login function with user and password as parameters


// Uncomment to use the function (it takes a while to list all rooms)

    /*$publicRoomsList = RocketChatListRooms($connection->data->authToken, $connection->data->userId);    // Returns an object containing all public rooms and their infos

    var_dump($publicRoomsList->rooms);*/

$join = RocketChatJoinChannel($channel, $connection->data->authToken, $connection->data->userId);
