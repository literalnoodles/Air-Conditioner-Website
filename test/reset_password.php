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
            <td colspan="2">Reset password form</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>
                <input type="text" name="username" >
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input type="tel" name="phone_number">
            </td>
        </tr>
    </table>
    <input type="submit" value="Reset" name="reset_pw">
</form>
</body>

<?php require 'database.php';?>
<?php
    if (!isset($_POST['reset_pw'])) return
    $var_arr = [];
    $check_user_credential = "select count(1) as total from abc12users where USERNAME=:username and PHONE=:phone";
    $var_arr["username"]=$_POST['username'];
    $var_arr["phone"]=$_POST['phone_number'];
    $duplicate = $db_query->exec($check_user_credential,true,$var_arr)->fetch();
    if (!$duplicate['total']) {
        echo "Error: Fail to reset the password";
        return;
    }
    $new_pw = bin2hex(random_bytes(4));
    $var_arr["password"]=sha1($new_pw);
    $change_pw_stm = "update abc12users set PASSWORD_HASH=:password where USERNAME=:username and PHONE=:phone";
    $db_query->exec($change_pw_stm,false,$var_arr);
    echo "Changed password successfully, the new password is $new_pw";
?>
</html>