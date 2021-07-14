<?php

function getMCPlayerCnt($ip, $port) {
    /*
        GetOnlinePlayers PHP function by Mario Latif.
            Usage:
                GetOnlinePlayers(SERVER_IP, SERVER_PORT[optional])
    */

    // Create a CURL connection to the API.
    $url = 'http://mcapi.us/server/status?ip='.$ip.'&port='.$port;
    $result = file_get_contents($url);
    // Will dump a beauty json :3

    $json = json_decode($result, true);

    // Return the online players
    $onlineplayers = $json['players']['now'];
    return $onlineplayers;
}

function getMCMaxPlayerCnt($ip, $port) {
    /*
        GetOnlinePlayers PHP function by Mario Latif.
            Usage:
                GetOnlinePlayers(SERVER_IP, SERVER_PORT[optional])
    */

    // Create a CURL connection to the API.
    $url = 'http://mcapi.us/server/status?ip='.$ip.'&port='.$port;
    $result = file_get_contents($url);
    // Will dump a beauty json :3

    $json = json_decode($result, true);

    // Return the online players
    $onlineplayers = $json['players']['max'];
    return $onlineplayers;
}

function getMCStatus($ip, $port) {
    /*
        GetOnlinePlayers PHP function by Mario Latif.
            Usage:
                GetOnlinePlayers(SERVER_IP, SERVER_PORT[optional])
    */

    // Create a CURL connection to the API.
    $url = 'http://mcapi.us/server/status?ip='.$ip.'&port='.$port;
    $result = file_get_contents($url);
    // Will dump a beauty json :3

    $json = json_decode($result, true);

    // Return the online players
    $onlineplayers = $json['online'];
    return $onlineplayers;
}


?>
