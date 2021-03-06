<?php
require_once 'connectDB.php';

$username = $_POST['username'];
$email = trim($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = 'user';

$registerUser = $conn->prepare("INSERT INTO `users` VALUES (?, ?, ?, ?)");
$registerUser->bind_param("ssss", $username, $email, $password, $role);
$registerUser->execute();

$registerUser->close();


$loginCred = bin2hex(random_bytes(20));

$tokenExpiryTime = new DateTime('now');
$tokenExpiryTime->add(new DateInterval('PT30M'));
$tokenExpiryTime = $tokenExpiryTime->format("Y-m-d H:i:s");
$registerCookie = $conn->prepare("INSERT INTO `cookies` VALUES (?, ?, ?)");
$registerCookie->bind_param("sss", $loginCred, $email, $tokenExpiryTime);

$registerCookie->execute();
setcookie('currentUsername', $loginCred, time() + (86400 * 30), '/');

$registerCookie->close();

$_POST = array();
$conn->close();
header('Location: dashboard.php');
?>