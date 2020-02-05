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
            <td colspan="2">Registration form</td>
        </tr>
        <tr>
            <td>UserName</td>
            <td>
                <input type="text" name="username" >
            </td>
        </tr>
        <tr>
            <td>PassWord</td>
            <td>
                <input type="password" name="password" >
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input type="tel" name="phone_number">
            </td>
        </tr>
    </table>
    <input type="submit" value="Registration" name="reg_user">
</form>
</body>

<?php require 'database.php';?>
<?php
    if (!isset($_POST['reg_user'])) return
    $var_arr = [];
    $check_user_stm = "select count(1) as total from abc12users where USERNAME=:username";
    $var_arr["username"]=$_POST['username'];
    $duplicate = $db_query->exec($check_user_stm,true,$var_arr)->fetch();
    if ($duplicate['total']) {
        echo "Error: username already exists";
        return;
    }
    $var_arr["password"]=sha1($_POST['password']);
    $var_arr["phone"]=$_POST['phone_number'];
    $add_user_stm = "insert into abc12users values(:username,:password,:phone)";
    $db_query->exec($add_user_stm,false,$var_arr);
    echo "Registerd successfully";
?>
</html>