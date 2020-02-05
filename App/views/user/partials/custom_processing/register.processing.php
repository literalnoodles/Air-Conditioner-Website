<?php
use App\Models\user;
$username = filter_input(INPUT_POST,"username");
$user = new user();
echo $user->check_exists_username($username);
?>