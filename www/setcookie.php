<!DOCTYPE html>
<?php
$cookie_name = "ServerAddr";
$cookie_value = $_SERVER['REMOTE_ADDR'];
setcookie($cookie_name, $cookie_value, time() + (300), "/"); // 5 minutes
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
   echo "It's you first time visiting server at address: '" . $_SERVER['REMOTE_ADDR'] . "'!";
} else {
   echo "You already visited me: '" . $_SERVER['REMOTE_ADDR'] . "'!<br>";
   echo "Cookie '" . $cookie_name . "' is set!<br>";
   echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html>
