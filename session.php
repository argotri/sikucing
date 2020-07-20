<?php
/**
 * Created by PhpStorm.
 * User: argo.triwidodo
 * Date: 08-Nov-19
 * Time: 10:17
 */
header('Content-Type: application/json');
include "runAndroid.php";
$response = null;

function createNewSession(){

}

function getSession(){

}

echo json_encode($response);