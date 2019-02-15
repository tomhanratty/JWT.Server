<?php

require_once 'JWT_class.php';
require 'database.php';
require 'loi_db.php';
require 'users_db.php';

$secret = "Tom's key";
$api_key = filter_input(INPUT_GET, 'api_key');
$Service = filter_input(INPUT_GET, 'Service');

if ($api_key == Null) {
    if ($Service != "Request_key") {
        $response = "Sorry incorrect format";
        echo json_encode($response);
        exit;
    }
}

switch ($Service) {



    case'Request_key':
        $token = array();
        $token['userName'] = filter_input(INPUT_GET, 'userName');
        $token['memType'] = filter_input(INPUT_GET, 'memType');
        $jwt = JWT::encode($token, $secret);
        echo $jwt;
        break;



    case'Register':
        $userName = filter_input(INPUT_GET, 'userName');
        $password = filter_input(INPUT_GET, 'password');
        $memType = filter_input(INPUT_GET, 'memType');
        addUser($userName,$password,$memType);
        break;



    case'Service2':
        $api_key = filter_input(INPUT_GET, 'api_key');
        try {
            $token = JWT::decode($api_key, $secret);
        } catch (Exception $ex) {
            return -1;
        }

        $result = getTeams();
        echo $result;

        break;

    case'Single_team':
        $api_key = filter_input(INPUT_GET, 'api_key');
        try {
            $token = JWT::decode($api_key, $secret);
        } catch (Exception $ex) {
            return -1;
        }

        $homeTeam = filter_input(INPUT_GET, 'homeTeam');


        $word = $token->memType;
        if ($word == "premium") {

            $result = getSingleResults($homeTeam);
            echo $result;
        } else {
            $result = "you must be a premium member";
            echo json_encode($result, TRUE);
        }




        break;

    case'Two_team':
        $api_key = filter_input(INPUT_GET, 'api_key');
        try {
            $token = JWT::decode($api_key, $secret);
        } catch (Exception $ex) {
            return -1;
        }
        $homeTeam = filter_input(INPUT_GET, 'homeTeam');
        $awayTeam = filter_input(INPUT_GET, 'awayTeam');

        $word = $token->memType;
        if ($word == "premium") {

            $result = getDoubleResults($homeTeam, $awayTeam);
            echo $result;
        } else {
            $result = "you must be a premium member";
            echo json_encode($result, TRUE);
        }
        break;
}    