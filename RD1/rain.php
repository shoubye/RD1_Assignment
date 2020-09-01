<?php


session_start();

if(isset($_POST["okbutton4"]))
{
$cityname = $_POST["city"];
}
// $city = urldecode($_POST["city"]);
// $time = $_POST["time"];

//積雨量
// $url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-0EF10C78-E76B-49E3-BD74-05B21416C3F5&format=JSON&locationName=".urldecode($_POST["city"])."&elementName=".$_POST["time"]."&parameterName=TOWN";
$url ="https://opendata.cwb.gov.tw/api/v1/rest/datastore/O-A0002-001?Authorization=CWB-0EF10C78-E76B-49E3-BD74-05B21416C3F5&format=JSON&elementName=RAIN,HOUR_24&parameterName=CITY,TOWN";
$data = file_get_contents($url);  // PHP get data from url
$json = json_decode($data, true);  // Decode json data  
// var_dump($json);

        $location = $json["records"]["location"];
        $locationname = $json["records"]["location"][0]["locationName"];
        $obsTime = $json["records"]["location"][0]["time"]["obsTime"];
        $hour01 = $json["records"]["location"][0]["weatherElement"][0]["elementName"];
        $hour24 = $json["records"]["location"][0]["weatherElement"][1]["elementName"];
        $city = $json["records"]["location"][0]["parameter"][0]["parameterValue"];
        $town = $json["records"]["location"][0]["parameter"][1]["parameterValue"];

   
        $link = @mysqli_connect("localhost", "root", "root", "meteorological", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");   
        

        if(isset($_POST["okbutton4"]))
        { 
            switch($_POST["rain"])
            {
                //過去１小時
                case 'RAIN':      
                    $Text3 =<<<SqlQuery
                    SELECT * FROM rain01 where cityname = '$cityname' ;
                    SqlQuery;        
                    $result = mysqli_query ($link, $Text3); 
                    $row = mysqli_fetch_assoc($result);             
                    
                    while($row = mysqli_fetch_assoc($result))
                    {                      
                        foreach($row as $x)
                        {
                            echo $x;
                            echo "<br>";                            
                        }                                  
                    }     
                break;

                
                //過去２４小時
                case 'HOUR_24':  
                    $Text3 =<<<SqlQuery
                    SELECT * FROM rain24 where cityname = '$cityname' ;
                    SqlQuery;        
                    $result = mysqli_query ($link, $Text3); 
                    while($row = mysqli_fetch_assoc($result))
                    {
                        foreach($row as $x)
                        {
                            echo $x;
                            echo "<br>";                           
                        }                                               
                    }     
                break;
            }
        }

        // 資料存進資料庫
        // for($i = 0 ; $i <count($location) ; $i++)
        // {
        //     echo "<br>";
        //     echo $city = $json["records"]["location"][$i]["parameter"][0]["parameterValue"];            
        //     echo "<br>";
        //     echo $locationname = $json["records"]["location"][$i]["locationName"];  
        //     echo "<br>";              
        //     echo $town = $json["records"]["location"][$i]["parameter"][1]["parameterValue"];
        //     echo "<br>";
        //     echo $obstime = $json["records"]["location"][$i]["time"]["obsTime"];  
        //     echo "<br>";           
        //     echo $hour01 = $json["records"]["location"][$i]["weatherElement"][0]["elementValue"];
        //     echo "<br>";
        //     echo $hour24 = $json["records"]["location"][$i]["weatherElement"][1]["elementValue"];
        //     echo "<br>";
        
               //過去１小時
        //     $Text1 =<<<SqlQuery
        //     INSERT INTO rain01 ( cityname , locationname, town ,obsTime , hour01 ) VALUES 
        //     ('$city ' ,'$locationname' , '$town' , '$obstime', $hour01 );

               //過去２４小時
        //     $Text1 =<<<SqlQuery
        //     INSERT INTO rain24 ( cityname , locationname, town ,obsTime , hour24 ) VALUES 
        //     ('$city ' ,'$locationname' , '$town' , '$obstime', $hour24 );
        //     SqlQuery;      


        //     $result = mysqli_query ($link, $Text1); 

        // }


?>

