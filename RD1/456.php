<?php


   if(isset($_POST["okbutton"]))
   {
    //縣市
    $_SESSION["123"] = $_POST["city"];
    echo $_POST["city"] ;
  
   }

   //預報
    // $_SESSION["456"] = $_POST["day"];
    // // echo $_POST["day"] ;

    // //積雨量
    // $_SESSION["789"] = $_POST["hour"];
    // echo $_POST["hour"] ;

   
    // urlencode($_POST["city"]);
    // echo $_POST["city"];


    $url = "https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001?Authorization=CWB-0EF10C78-E76B-49E3-BD74-05B21416C3F5&format=JSON&locationName=".urlencode($_POST["city"])."&sort=time";
    $data = file_get_contents($url);  // PHP get data from url
    $json = json_decode($data, true);  // Decode json data    
    // var_dump($json);
    // var_dump($json['records']['location'][1]['locationName']);// 查詢資料

    
    $datasetDescription = $json["records"]["datasetDescription"];
    $locationName = $json["records"]["location"][0]["locationName"];
    $elementName = $json["records"]["location"][0]["weatherElement"][0]["elementName"];
    $startTime = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["startTime"];
    $endTime = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["endTime"];
    $parameterName = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"]["parameterName"];
    $parameterValue = $json["records"]["location"][0]["weatherElement"][0]["time"][0]["parameter"]["parameterValue"];


    var_dump($datasetDescription);
    var_dump($locationName);
    var_dump($elementName);
    var_dump($startTime);
    var_dump($endTime);
    var_dump($parameterName);
    var_dump($parameterValue);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<form  method = "post">
        <font face="link" color="#FA7A8E" size="6"><u><i>個人氣象站</i></u></font><br>
        <div class="form-group row">
            
            <label for="select" class="custom-control" >請選擇縣/市：</label> 
            <div class="custom-control-inline">            
            <select id="select" name="city" >
                <option></option>
                <option value="基隆市">基隆市</option>
                <option value="臺北市">臺北市</option>
                <option value="新北市">新北市</option>
                <option value="桃園市">桃園市</option>
                <option value="新竹市">新竹市</option>
                <option value="新竹縣">新竹縣</option>
                <option value="苗栗縣">苗栗縣</option>
                <option value="臺中市">臺中市</option>
                <option value="彰化縣">彰化縣</option>
                <option value="南投縣">南投縣</option>
                <option value="雲林縣">雲林縣</option>
                <option value="嘉義市">嘉義市</option>
                <option value="嘉義縣">嘉義縣</option>
                <option value="臺南市">臺南市</option>
                <option value="高雄市">高雄市</option>
                <option value="屏東縣">屏東縣</option>
                <option value="宜蘭縣">宜蘭縣</option>
                <option value="花蓮縣">花蓮縣</option>
                <option value="臺東縣">臺東縣</option>
                <option value="澎湖縣">澎湖縣</option>
                <option value="金門縣">金門縣</option>
                <option value="連江縣">連江縣</option>
            </select>
            </div>



        <div class="custom-control">
            <input name="okbutton" type="submit" class="btn btn-outline-info btn-sm" value ="未來２天天氣："/>
        </div>

        <div class="custom-control">
            <input name="okbutton" type="submit" class="btn btn-outline-info btn-sm" value ="未來一週天氣"/>
        </div>

        <div class="custom-control">
            <input name="okbutton" type="submit" class="btn btn-success btn-sm" value ="查詢"/>
        </div>

</form>

</body>
</html>