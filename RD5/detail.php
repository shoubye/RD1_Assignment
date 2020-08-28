<?php
    session_start();
    
    $link = @mysqli_connect("localhost", "root", "root", "bank", 8889) or die(mysqli_connect_error());
    $result = mysqli_query($link, "set names utf8");  

    $account = $_SESSION["account"];
    

    $Text3 =<<<SqlQuery
    SELECT account,transtype ,trade , transdate FROM transaction where account = '$account';
    SqlQuery;        
    $result = mysqli_query ($link, $Text3); 
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>

    <div class="container">
        <br><br>
        <h2>明細查詢</h2>        
        <table class="table table-striped">

            <thead>
            <tr>
                <th>使用者</th>
                <th>存款／提款</th>
                <th>日期</th>
                <th>交易金額</th>
            </tr>
            </thead>


            <tbody>


            <?php while($row= mysqli_fetch_assoc($result)) {
            ?>           

            <tr>
                <td>  <?php echo $row["account"];?>  </td>
                <td>  <?php echo $row["transtype"];?>  </td>
                <td>  <?php echo $row["transdate"];?>  </td>
                <td>  <?php echo $row["trade"];?>      </td>              
            </tr>           

            <?php } ?> 
      
            </tbody>
        </table>
        </div>

    
</body>
</html>