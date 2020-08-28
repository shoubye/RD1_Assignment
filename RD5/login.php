<?php 

session_start();

    if (isset($_GET["logout"]))
    {
      $_SESSION["account"]= $account;

      unset($_SESSION["account"]);
      header("Location: index.php");   //跳轉到首頁
      exit();
    }

    //重設
    if (isset($_POST["btnHome"]))
    {
      header("Location: index.php");//跳轉到首頁
      exit();
    }
    
    //登入
    if (isset($_POST["btnOK"]))
    {
        $link = @mysqli_connect("localhost", "root", "root", "bank", 8889) or die(mysqli_connect_error());
        $result = mysqli_query($link, "set names utf8");          
            

        $account = $_POST["txtUserName"];       
        $password =$_POST["txtPassword"];

        //執行SQL敘述   
        $Text2 =<<<SqlQuery
        SELECT account, password FROM member where account = '$account' and password= '$password';
        SqlQuery;            
        $result = mysqli_query($link, $Text2);
        // var_dump($result);
   
        while($row = mysqli_fetch_assoc($result))
        {     
          // var_dump($row);

          //判斷帳號密碼符合
          if($account!=null && $password !=null && $row["account"]==$account && $row["password"]==$password )
          {    
            $_SESSION["account"] = $account ;
            unset($_SESSION["lastPage"]);
            if (isset($_SESSION["lastPage"]))
              header(sprintf("Location: %s", $_SESSION["lastPage"]));
            else
            // echo "沒有此帳號";
              header("Location: index.php");//跳轉到首頁
            exit();
          }           
        }        
    }


?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Lab - Login</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="login.php">
  <table style="border:8px #FFD382 groove;" cellpadding="10" border='0' align="center">

    <tr>
      <td colspan="2" align="center" bgcolor="#A6D989"><font face="link" color="#4766FC" size="5">會  員  登  入</font></td>
    </tr> 

    <tr>
      <td width="100" align="center" valign="baseline" ><font face="link" color="#D14571" size="4">帳 號：</font></td>
      <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
    </tr>

    <tr>
      <td width="100" align="center" valign="baseline"><font face="link" color="#D14571" size="4">密 碼：</font></td>
      <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
    </tr>

    <tr>
      <td colspan="2" align="center" bgcolor="#A6D989">
      <input type="submit" name="btnOK" id="btnOK" class="btn-success" value="登入" />
      <input type="reset" name="btnReset" id="btnReset" value="清除" />
      <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
      </td>
    </tr>

  </table>
</form>
</body>
</html>