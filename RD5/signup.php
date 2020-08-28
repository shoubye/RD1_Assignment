<?php

session_start();


if (isset($_POST["btnOK1"]))
{
  //連線資料庫
  $link = @mysqli_connect("localhost", "root", "root", "bank", 8889) or die(mysqli_connect_error());
  $result = mysqli_query($link, "set names utf8");  

  //執行SQL敘述
  
  // $name = $_POST["qqq"];
  $account = $_POST["txtUserName1"];
  $password =$_POST["txtPassword1"];

  $Text1 =<<<SqlQuery
  INSERT INTO member (name, account ,password) VALUES ('$name','$account','$password');
  SqlQuery;

  $result = mysqli_query ($link, $Text1);

}

 //重設
  if (isset($_POST["btnHome"]))
  {
    header("Location: index.php");//跳轉到首頁
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form id="form1" name="form1" method="post" action="signup.php">
  <table style="border:8px #FFD382 groove;" cellpadding="10" border='0' align="center">


    <tr>
      <td colspan="2" align="center" bgcolor="#A6D989"><font face="link" color="#4766FC" size="5"><i>會  員  註  冊</i></font></td>
    </tr>

    <!-- <tr>
      <td width="80" align="center" valign="baseline"> <font face="link" color="#D14571" size="4">姓名：</font></td>
      <td valign="baseline"><input type="text" name="qqq" id="qqq" /></td>
    </tr> -->

    <tr>
      <td width="100" align="center" valign="baseline"> <font face="link" color="#D14571" size="4">帳 號：</font></td>
      <td valign="baseline"><input type="text" name="txtUserName1" id="txtUserName1" /></td>
    </tr>


    <tr>
      <td width="100" align="center" valign="baseline"> <font face="link" color="#D14571" size="4">密碼：</font></td>
      <td valign="baseline"><input type="password" name="txtPassword1" id="txtPassword1" /></td>
    </tr>


    <tr>
      <td colspan="2" align="center" bgcolor="#A6D989">
      <input type="submit" name="btnOK1" id="btnOK1" value="註冊" />
      <input type="reset" name="btnReset" id="btnReset" value="重填" />
      <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
      </td>
    </tr>
  </table>

</form>


</body>
</html>