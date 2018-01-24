<?php
header("Access-Control-Allow-Origin: *");

function get_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 12);
    $content = curl_exec($ch);
    curl_close($ch);
    return json_decode($content, true);
}

$data = json_decode(file_get_contents("NTU_OBS_DATA.json"), true);

$new_data = get_curl("http://140.112.67.180/getData.php");

if (count($data["press_24"]) >= 24) {
    array_shift($data["press_24"]);
}

if (count($data["temp_24"]) >= 24) {
    array_shift($data["temp_24"]);
}

if (count($data["wind_dir_24"]) >= 24) {
    array_shift($data["wind_dir_24"]);
}

if (count($data["wind_speed_24"]) >= 24) {
    array_shift($data["wind_speed_24"]);
}

if (count($data["rain_24"]) >= 24) {
    array_shift($data["rain_24"]);
}

if (count($data["humd_24"]) >= 24) {
    array_shift($data["humd_24"]);
}

$new_data['press_24'] = $data["press_24"];
$new_data['temp_24'] = $data["temp_24"];
$new_data['wind_dir_24'] = $data["wind_dir_24"];
$new_data['wind_speed_24'] = $data["wind_speed_24"];
$new_data['rain_24'] = $data["rain_24"];
$new_data['humd_24'] = $data["humd_24"];

array_push($new_data["press_24"], $new_data['DD_MMP2']);
array_push($new_data["temp_24"], $new_data['DD_T']);
array_push($new_data["wind_dir_24"], $new_data['DD_10D']);
array_push($new_data["wind_speed_24"], $new_data['DD_F10']);
array_push($new_data["rain_24"], $new_data['DD_R']);
array_push($new_data["humd_24"], $new_data['DD_RH']);

$txt = json_encode($new_data);
echo $txt;
$myfile = fopen("NTU_OBS_DATA.json", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);

?>
