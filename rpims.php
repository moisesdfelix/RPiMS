<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$rpimskeys = $redis->keys('*');

foreach ($rpimskeys as $key) {
    $value = $redis->get($key);
    $rpims[$key] = $value;
}

$door_sensors = $redis->smembers('door_sensors');
$motion_sensors = $redis->smembers('motion_sensors');
$DS18B20_sensors = $redis->smembers('DS18B20_sensors');

$rpims_api["hostname"] = $rpims["hostname"];
$rpims_api["location"] = $rpims["location"];

if ($rpims["use_picamera"] == "True"){
    $rpims_api["hostip"] = $rpims["hostip"];
}

if ($rpims["use_CPU_sensor"] == "True"){
    $rpims_api["CPU_Temperature"] = round($rpims["CPU_Temperature"],1);
}

if ($rpims["use_BME280_sensor"] == "True"){
    $rpims_api["BME280_Temperature"] = round($rpims["BME280_Temperature"],1);
    $rpims_api["BME280_Humidity"] = round($rpims["BME280_Humidity"],1);
    $rpims_api["BME280_Pressure"] = round($rpims["BME280_Pressure"],0);
}

if ($rpims["use_DHT_sensor"] == "True"){
    $rpims_api["DHT_Temperature"] = $rpims["DHT_Temperature"];
    $rpims_api["DHT_Humidity"] = $rpims["DHT_Humidity"];
}

if ($rpims["use_weather_station"] == "True"){
    $rpims_api["wind_speed"] = $rpims["wind_speed"];
    $rpims_api["average_wind_speed"] = $rpims["average_wind_speed"];
    $rpims_api["daily_average_wind_speed"] = $rpims["daily_average_wind_speed"];
    $rpims_api["wind_gust"] = $rpims["wind_gust"];
    $rpims_api["daily_wind_gust"] = $rpims["daily_wind_gust"];
    $rpims_api["average_wind_direction"] = $rpims["average_wind_direction"];
    $rpims_api["daily_rainfall"] = $rpims["daily_rainfall"];
}

if ($rpims["use_motion_sensor"] == "True"){
    foreach ($motion_sensors as $key => $value){
	$rpims_api["motion_sensors"]["$value"] = $rpims[$value];
    }
}

if ($rpims["use_door_sensor"] == "True"){
    foreach ($door_sensors as $key => $value){
	$rpims_api["door_sensors"]["$value"] = $rpims[$value];
    }
}

if ($rpims["use_DS18B20_sensor"] == "True"){
    foreach ($DS18B20_sensors as $key => $value){
	$rpims_api["DS18B20_sensors"]["$value"] = $rpims[$value];
	}
    }


Header("Content-type: text/json");
echo json_encode($rpims_api);
