<?php

require 'functions.fn.php';

$user = 'Flichy';
$mdp = '%9T1B3$oqv4e';

$connection = RocketChatLogin($user, $mdp);                                                         // Login function with user and password as parameters

echo "\n\nAuthtoken: ".$connection->data->authToken."\n";
echo "userId: ".$connection->data->userId."\n";


// Uncomment to use it - (it takes a while to list all rooms)

    //$publicRoomsList = RocketChatListRooms($connection->data->authToken, $connection->data->userId);    // Returns an object containing all public rooms and their infos

    //var_dump($publicRoomsList);


