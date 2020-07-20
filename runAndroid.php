<?php
/**
 * Created by PhpStorm.
 * User: argo.triwidodo
 * Date: 08-Nov-19
 * Time: 08:49
 */



runEmulator();
var_dump(getDevices());

//echo $listDevices;

function runEmulator(){
    execInBackground("emulator @Pixel_3a_XL_API_28");
    sleep(3);
}

function getDevices(){
    $listDevices = null;
    $deviceOnline=false;
    $iter = 0;
    $maxRetry = 10;
    while (!$deviceOnline) {
        ob_start();
        passthru("adb devices");
        //List of devices attached emulator-5554 device << Ketika Online
        //List of devices attached emulator-5554 offline << Ketika Offline
        $listDevices = ob_get_contents();
        ob_end_clean();
        ++$iter;
        $deviceOnline = !contains($listDevices, 'offline');
        if($iter > $maxRetry){
            exceptions("Retrying " . $maxRetry . " But device seems not online ");
        }
        if(!$deviceOnline){
            sleep(3);
        }
    }
    return splitDevices($listDevices);
}

function execInBackground($cmd)
{
    if (substr(php_uname(), 0, 7) == "Windows") {
        return pclose(popen("start /B " . $cmd, "r"));
    } else {
        return exec($cmd . " > /dev/null &");
    }
}

function contains($fullString , $yangDicari){
    return strpos($fullString, $yangDicari) !== false;
}

function exceptions($errorMessage){
    throw new Exception($errorMessage);
}

function splitDevices($raw){
    $devices  =explode("\n" , $raw);
    array_shift($devices);
    return array_filter(
        $devices,
        function ($value) {
            return strlen($value) >= 5;
        }
    );
}

function runAppium(){

}