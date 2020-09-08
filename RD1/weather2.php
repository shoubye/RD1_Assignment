<?php


session_start();

if(isset($_POST["okbutton1"]))
{
$_SESSION["123"] = $_POST["city"];

}

//未來２天天氣
$url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-D0047-089?Authorization=CWB-0EF10C78-E76B-49E3-BD74-05B21416C3F5&format=JSON&locationName=".urlencode($_POST["city"])."&elementName=WeatherDescription&sort=time";
$data = file_get_contents($url);  // PHP get data from url
$json = json_decode($data, true);  // Decode json data  
// var_dump($json);

        $time = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"];
        // $datasetDescription = $json["records"]["locations"][0]["datasetDescription"];
        // $locationname = $json["records"]["locations"][0]["location"][0]["locationName"];
        // $startime = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][0]["startTime"];
        // $endtime = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][0]["endTime"];
        // $description = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["description"];
        // $Value = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][0]["elementValue"][0]["value"];//降雨率
   

        $city = $_POST["city"];

        $link = @mysqli_connect("localhost", "root", "root", "meteorological", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");    

        for($i = 0 ; $i <count($time) ; $i++)
        {
            echo "<br>"; 
            echo $city ;
            echo "<br>";            
            echo $startime = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][$i]["startTime"];
            echo "<br>";
            echo $endtime = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][$i]["endTime"];
            echo "<br>";
            echo $value = $json["records"]["locations"][0]["location"][0]["weatherElement"][0]["time"][$i]["elementValue"][0]["value"];
            echo "<br>";
        
            
            $Text1 =<<<SqlQuery
            INSERT INTO weathertwo ( cityname , startTime, endTime ,value) VALUES 
            ('$city ' ,'$startime' , '$endtime' , '$value');
            SqlQuery;      
            $result = mysqli_query ($link, $Text1); 

        }

?>

