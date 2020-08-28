<?php 

session_start();

//未登入時，跳回登入畫面
if (!isset($_SESSION["account"]))
{  
	$_SESSION ["lastPage"]= "secret.php";
  header("Location: login.php");
  exit();
}

//回首頁
if (isset($_POST["okbutton"]))
  {
    header("Location: index.php");
  }


//確認
if (isset($_POST["haha"]))
{
    // 連線資料庫
    $link = @mysqli_connect("localhost", "root", "root", "bank", 8889) or die(mysqli_connect_error());
    $result = mysqli_query($link, "set names utf8");  

    $account = $_SESSION["account"];

    $Text3 =<<<SqlQuery
    SELECT balance FROM member where account = '$account';
    SqlQuery;        
    $result = mysqli_query ($link, $Text3); 
    // var_dump($result);
    
    $balance["balance"] = mysqli_fetch_assoc($result);  
    // var_dump($balance["balance"]);
    
    $r = implode("",$balance["balance"]);//轉成數字串
    
    if($_POST["text"] >50000)
    echo "<script>alert('存款上限為５００００，請輸入５００００以下的金額');</script>";
      else
    {
    $r = $r + $_POST["text"]; 
    echo "<script>alert('目前餘額為：$r');</script>";             
    }



    //傳回資料庫
    $Text4 =<<<SqlQuery
    update member set balance = $r where account = $account;
    SqlQuery;        
    $result = mysqli_query ($link, $Text4); 



    //明細
    $trade = $_POST["text"]; 
    $date = date('Y-m-d H:i:s');

    $Text8 =<<<SqlQuery
    insert into transaction (account, transtype ,trade , transdate) 
    values ('$account','deposit' ,'$trade', '$date');
    SqlQuery;        
    $result = mysqli_query ($link, $Text8);
  
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

<form method = "post" action = "secret.php" >


      <div >
          <label style="font-size:15px;" for="fname">請輸入金額:</label>
          <input type="text" id="text" name="text" style="font-size:20px"><br>
      </div>  

    
      <div >
            <input name="haha" type="submit" class="btn btn-success" value ="確認"/>
            <input name="okbutton" type="submit" class="btn btn-info" value ="回首頁"/>
      </div>
      

</form>
</body>
</html>