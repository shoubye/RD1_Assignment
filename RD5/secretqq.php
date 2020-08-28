<?php 

session_start();

// 未登入時，跳回登入畫面
if (!isset($_SESSION["account"]))
{  
	$_SESSION ["lastPage"]= "secretqq.php";
  header("Location: login.php");
  exit();
	
}

//回首頁
if (isset($_POST["okbutton"]))
  {
    header("Location: index.php");
  }


//確認
if (isset($_POST["hehe"]))
{
    // 連線資料庫
    $link = @mysqli_connect("localhost", "root", "root", "bank", 8889) or die(mysqli_connect_error());
    $result = mysqli_query($link, "set names utf8");  

    $account = $_SESSION["account"];

    $Text6 =<<<SqlQuery
    SELECT balance FROM member where account = '$account';
    SqlQuery;        
    $result = mysqli_query ($link, $Text6); 
    // var_dump($result);
  

    $balance["balance"] = mysqli_fetch_assoc($result);  
    // var_dump($balance["balance"]);
    
    $r = implode("",$balance["balance"]);//轉成數字串

    
    if($r - $_POST["text"] >= 0)
    {
    $r = $r - $_POST["text"];    
    echo "<script>alert('目前餘額為：$r');</script>";
    }
    else
    echo "<script>alert('您的餘額不足');</script>";


    $Text7 =<<<SqlQuery
    update member set balance = $r where account = $account;
    SqlQuery;        
    $result = mysqli_query ($link, $Text7); 



    $trade = $_POST["text"]; 
    $date = date('Y-m-d H:i:s');

    $Text9 =<<<SqlQuery
    insert into transaction (account, transtype ,trade , transdate) 
    values ('$account','withdraw' ,'$trade', '$date');
    SqlQuery;        
    $result = mysqli_query ($link, $Text9);


}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lag - Member Page</title>
</head>
<body>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form method = "post" action = "secretqq.php">

      <div >
          <label style="font-size:15px;" for="fname">請輸入金額:</label>
          <input type="text" id="text" name="text" style="font-size:20px"><br>
      </div>  

    
      <div >
            <input name="hehe" type="submit" class="btn btn-success" value ="確認"/>
            <input name="okbutton" type="submit" class="btn btn-info" value ="回首頁"/>
      </div>


</form>
</body>
</html>