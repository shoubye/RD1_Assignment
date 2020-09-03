<?php


session_start();

if(isset($_POST["okbutton3"]))
{
$_SESSION["123"] = $_POST["city"];

}
// echo $_POST["city"];

$url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-0EF10C78-E76B-49E3-BD74-05B21416C3F5&format=JSON&locationName=".urlencode($_POST["city"])."&sort=time";
$data = file_get_contents($url);  // PHP get data from url
$json = json_decode($data, true);  // Decode json data  
// var_dump($json);


        $weatherElement = $json["records"]["location"][0]["weatherElement"];
        $elementname = $json["records"]["location"][0]["weatherElement"][0]["elementName"];
        $time = $json["records"]["location"][0]["weatherElement"][0]["time"];
        $starttime = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["startTime"];
        $endtime = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["endTime"];
        $parameter = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"];
        $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"]["parameterName"];
        $parametervalue = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"]["parameterValue"];
        
   

        $city = $_POST["city"];

        $link = @mysqli_connect("localhost", "root", "root", "meteorological", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");    


        for($i = 0 ; $i <count($weatherElement) ; $i++)
        {
            echo "<br>";
            echo $city;
            echo "<br>";
            echo $elementname = $json["records"]["location"][0]["weatherElement"][$i]["elementName"];
            echo "<br>";

            for($x = 0 ; $x <count($time) ; $x++)
            {
                
                echo $starttime = $json["records"]["location"][0]["weatherElement"][$i]["time"][$x]["startTime"];
                echo "<br>";
                echo $endtime = $json["records"]["location"][0]["weatherElement"][$i]["time"][$x]["endTime"];
                echo "<br>";    
                echo $parametername = $json["records"]["location"][0]["weatherElement"][$i]["time"][$x]["parameter"]["parameterName"];                  
                echo "<br>";
                

                    $Text2 =<<<SqlQuery
                    INSERT INTO current ( cityname , elementname, startTime, endTime ,parametername) VALUES 
                    ('$city ' ,'$elementname','$starttime' , '$endtime' ,  '$parametername');
                    SqlQuery;      
                    $result = mysqli_query ($link, $Text2); 

                
            }      

        }

?>
