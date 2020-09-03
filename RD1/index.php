<?php

   session_start();

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
        <font face="link" color="#FA7A8E" size="7"><u><i>個人氣象站</i></u></font><br>
        <div class="form-group row">
            <label for="select" class="custom-control" >請選擇縣/市：</label>                  
            <select id="select" name="city" > 
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
           
        <div class="custom-control">
            <input name="okbutton3" type="submit" class="btn btn-outline-info btn-sm" value ="當前天氣"/>  
            <input name="okbutton1" type="submit" class="btn btn-outline-info btn-sm" value ="未來２天天氣："/>
            <input name="okbutton2" type="submit" class="btn btn-outline-info btn-sm" value ="未來一週天氣"/>           
        </div>



        <label for="select" class="custom-control" >積雨量查詢：</label>                        
            <select id="select" name="rain" >   
                <option value="RAIN">過去1小時</option>
                <option value="HOUR_24">過去24小時</option>                
            </select>


        <div class="custom-control">
             <input name="okbutton4" type="submit" class="btn btn-outline-success btn-sm" value ="查詢"/>    
        </div>     

        <hr size="8" align="center" noshade width="100%" color="A702CF">

        
        <div class="custom-control">
        <?php
            if(isset($_POST["okbutton1"]))
             require_once("weather2.php");
            
             else if (isset($_POST["okbutton2"]))
             require_once("weather7.php");

             else if(isset($_POST["okbutton3"]))
             require_once("current.php");

             else if(isset($_POST["okbutton4"]))
             require_once("rain.php");
        ?>   
        </div>

</form>

</body>
</html>