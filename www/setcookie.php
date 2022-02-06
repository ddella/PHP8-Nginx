<!DOCTYPE html>
<?php
$cookie_name = "ServerAddr";
$cookie_value = $_SERVER['REMOTE_ADDR'];
setcookie($cookie_name, $cookie_value, time() + (300), "/"); // 5 minutes

echo <<<END
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Nginx and PHP8</title>
   <link rel="icon" type="image/x-icon" href="/images/load-balancer-favicon.jpg">
   <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
   <style type="text/css">
     body {background-color: #282828; color: #F5F5F5; font-family: sans-serif;}
     pre {margin: 0; font-family: monospace;}

     a:link {
       color: #c2c2c2;
       background-color: transparent;
       text-decoration: none;
     }

     a:visited {
       color: #c2c2c2;
       background-color: transparent;
       text-decoration: none;
     }

     a:hover {
       color: #ebebeb;
       background-color: transparent;
       text-decoration: none;
     }

     table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
     .center {text-align: center;}
     .center table {margin: 1em auto; text-align: left;}
     .center th {text-align: center !important;}
     td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
     th {position: sticky; top: 0; background: inherit;}
     h1 {
        font-size: 150%;
        color: #ebebeb;
     }
     h2 {
        font-size: 125%;
        color: #ebebeb;
     }
     .p {text-align: left;}
     /* Left column */
     .e {font-size: 100%;background-color: #ccf; color: #282828; width: 200px; font-weight: bold;}
     /* Header */
     .h {font-size: 125%;background-color: #99c; color: #282828;font-weight: bold; text-align: left;}
     /* Right column */
     .v {font-size: 100%;background-color: #ddd; color: #282828; width: 300px; overflow-x: auto; word-wrap: break-word; font-family: consolas;}
     /*.v i {color: #999;}*/
     .bl {background-color: #000000; color: #000000;}
     img {float: right; border: 0;}
     hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
     .extlink  {
      float: none;
      margin: 0 0 0 3px;
      filter: invert(21%) sepia(100%) saturate(2518%) hue-rotate(212deg) brightness(105%) contrast(107%);
      width: 18px;
      height: 18px;
     }

     .extlink:hover  {
      float: none;
      margin: 0 0 0 3px;
      filter: invert(68%) sepia(28%) saturate(2515%) hue-rotate(189deg) brightness(104%) contrast(101%);
     }

   </style></head>
<body>
   <div class="center">
END;

echo "<br><br><br>";
if(!isset($_COOKIE[$cookie_name])) {
   echo "It's you first time visiting server at address: <b>" . $_SERVER['REMOTE_ADDR'] . "</b>!";
} else {
   echo "You already visited me: <b>" . $_SERVER['REMOTE_ADDR'] . "</b>.<br><br>";
   echo "Cookie <b>" . $cookie_name . "</b> is set.<br><br>";
   echo "Value is: <b>" . $_COOKIE[$cookie_name] . "</b>.<br>";
}

$phptz = getenv('TIMEZONE');
date_default_timezone_set($phptz);
//Print the date on timestamp generated by time() function
echo "<p style='font-size:15px; font-family:consolas'><b>".date("l F d, Y", time())."</b> </p>";
//Print the time on timestamp generated by time() function
echo "<p style='font-size:15px; font-family:consolas'>The local time is <b>".date('H:i:s',time())."</b> " . date_default_timezone_get() ." </p>";

echo "</body>";
echo "</html>";
?>
