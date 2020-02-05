<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <table> 
        <tr>
            <td colspan="2">Login form</td>
        </tr>
        <tr>
            <td>UserName</td>
            <td>
                <input type="text" name="username" >
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="password" name="password" >
            </td>
        </tr>
    </table>
    <input type="submit" value="Log in" name="login">
</form>
<?php
    require 'database.php';
    if (!isset($_POST['login'])) return
    $var_arr = [];
    $var_arr["username"]=$_POST['username'];
    $var_arr["password"]=sha1($_POST['password']);
    $check_user_login = "select count(1) as total from abc12users where USERNAME=:username and PASSWORD_HASH=:password";
    $duplicate = $db_query->exec($check_user_login,true,$var_arr)->fetch();
    if (!$duplicate['total']) {
        echo "Error: Invalid username or password";
        return;
    }
    echo "Login successfully";
    header("refresh:2;url=login.php");
?>
</body>
</html>