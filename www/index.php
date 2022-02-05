<?php
/*
Script to print just the PHP[$_SERVER] variables needed to test a web server
behind a load balancer.
*/

echo <<<END
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Nginx and PHP8</title>
   <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
   <style type="text/css">
     body {background-color: #282828; color: #F5F5F5; font-family: sans-serif;}
     pre {margin: 0; font-family: monospace;}

     a:link {
       color: #0066ff;
       background-color: transparent;
       text-decoration: none;
     }

     a:visited {
       color: #0066ff;
       background-color: transparent;
       text-decoration: none;
     }

     a:hover {
       color: #80b3ff;
       background-color: transparent;
       text-decoration: none;
     }

     table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
     .center {text-align: center;}
     .center table {margin: 1em auto; text-align: left;}
     .center th {text-align: center !important;}
     td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
     th {position: sticky; top: 0; background: inherit;}
     h1 {font-size: 150%;}
     h2 {font-size: 125%;}
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

   </style></head>
<body>
   <div class="center">
END;
      echo '<h1>Web server ' . $_SERVER['SERVER_SOFTWARE'] . '</h1>';
      echo '<h1>PHP ' . phpversion() . '</h1>';
echo <<<END
      <h2>Congratulations! Docker container test page</h2><br><br>
      <h2><a href="phpinfo.php" target="_blank">PHP full info page</a></h2>
      <h2><a href="phpvariables.php" target="_blank">PHP variables-only info page </a></h2>
      <h2><a href="superglobals.php" target="_blank">PHP Superglobals variables</a></h2>
<table>
<tr class=h><th>Description</th><th>Value</th></tr>
END;

// Browser section
echo "<tr><td class=\"e\">Client request</td><td class=\"v\">" . $_SERVER['HTTP_REFERER'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Client request URI</td><td class=\"v\">" . $_SERVER['REQUEST_URI'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Client request method</td><td class=\"v\">" . $_SERVER['REQUEST_METHOD'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Client IP address</td><td class=\"v\">" . $_SERVER['HTTP_X_FORWARDED_FOR'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Client TCP port</td><td class=\"v\">" . $_SERVER['HTTP_X_FORWARDED_PORT'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Client protocol</td><td class=\"v\">" . $_SERVER['HTTP_X_FORWARDED_PROTO'] . "</td></tr>\r\n";

// blank line
echo "<tr><td class=\"bl\"></td><td class=\"bl\"></td></tr>\r\n";

// Load balancer section
echo "<tr><td class=\"e\">Load Balancer IP address</td><td class=\"v\">" . $_SERVER['REMOTE_ADDR'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Load Balancer source TCP port</td><td class=\"v\">" . $_SERVER['REMOTE_PORT'] . "</td></tr>\r\n";

// blank line
echo "<tr><td class=\"bl\"></td><td class=\"bl\"></td></tr>\r\n";

// Containers section
echo "<tr><td class=\"e\">Container Hostname</td><td class=\"v\">" . $_SERVER['SERVER_NAME'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Container IP address</td><td class=\"v\">" . $_SERVER['SERVER_ADDR'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Container destination TCP port</td><td class=\"v\">" . $_SERVER['SERVER_PORT'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Container local file</td><td class=\"v\">" . $_SERVER['SCRIPT_FILENAME'] . "</td></tr>\r\n";
echo "<tr><td class=\"e\">Container root directory</td><td class=\"v\">" . $_SERVER['DOCUMENT_ROOT'] . "</td></tr>\r\n";

echo "</table>\r\n";

echo '</body>';
echo '</html>';
?>