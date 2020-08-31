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
        
        // var_dump($elementname);
        // var_dump($starttime);
        // var_dump($endtime );
        // var_dump($parameter);
        // var_dump($parametername);
        // var_dump($parametervalue);
        
        // echo count($time);

        $city = $_POST["city"];


        $link = @mysqli_connect("localhost", "root", "root", "meteorological", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");    


        // echo count($time);
        for($i = 0 ; $i <count($weatherElement) ; $i++)
        {
            echo "<br>";
            echo $city;
            echo "<br>";
            echo $elementname = $json["records"]["location"][0]["weatherElement"][$i]["elementName"];
            echo "<br>";

            for($x = 0 ; $x <count($time) ; $x++)
            {
                
                echo $starttime = $json["records"]["location"][0]["weatherElement"][0]["time"][$x]["startTime"];
                echo "<br>";
                echo $endtime = $json["records"]["location"][0]["weatherElement"][0]["time"][$x]["endTime"];
                echo "<br>";    
                echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][$x]["parameter"]["parameterName"];
                // switch($elementname)
                // {
                //     case 'Wx':        
                //         echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"]["parameterName"];
                //     break;
    
                //     case 'PoP':  
                //         echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][1]["parameter"]["parameterName"];
                //     break;
                    
                //     case 'MinT':  
                //         echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][2]["parameter"]["parameterName"];
                //     break;
    
                //     case 'CI':  
                //         echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][3]["parameter"]["parameterName"];
                //     break;    
    
                //     case 'MaxT': 
                //         echo $parametername = $json["records"]["location"][0]["weatherElement"][0]["time"][4]["parameter"]["parameterName"];
                //     break; 
    
                // }            
    
                echo "<br>";
                
                    // $Text1 =<<<SqlQuery
                    // INSERT INTO weathertwo ( cityname , startTime, endTime , elementname, parametername) VALUES 
                    // ('$city ' ,'$startime' , '$endtime' , '$elementname', '$parametername');
                    // SqlQuery;      
                    // $result = mysqli_query ($link, $Text1); 
                
            }

        


        }


?>
