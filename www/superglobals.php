<?php
/*
Script to print the all the PHP superglobal variables:
     $_SERVER
     $_REQUEST
     $_POST
     $_GET
     $_FILES
     $_ENV
     $_COOKIE
     $_SESSION
*/

echo <<<END
<!DOCTYPE html>
<html>
  <Head>
    <title>PHP Variables</title>
    <meta name="ROBOTS" content="NOINDEX,NOFOLLOW,NOARCHIVE" />
    <style type="text/css">
      body {background-color: #fff; color: #222; font-family: sans-serif;}
      pre {margin: 0; font-family: monospace;}
      a:link {color: #009; text-decoration: none; background-color: #fff;}
      a:hover {text-decoration: underline;}
      table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
      .center {text-align: center;}
      .center table {margin: 1em auto; text-align: left;}
      .center th {text-align: center !important;}
      td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
      th {position: sticky; top: 0; background: inherit;}
      h1 {font-size: 150%;}
      h2 {font-size: 125%;}
      .p {text-align: left;}
      .e {background-color: #ccf; width: 300px; font-weight: bold;}
      .h {background-color: #99c; font-weight: bold;}
      .v {background-color: #ddd; max-width: 300px; overflow-x: auto; word-wrap: break-word;}
      .v i {color: #999;}
      img {float: right; border: 0;}
      hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
    </style>
  </head>

  <body><div class="center">
END;

function printVar($fname, $str_fname) {
	if (is_null($fname)) {
		return;
	}
	echo "<table>";
	echo "<tr class=\"h\"><th>Key ($str_fname)</th><th>Value ($str_fname)</th></tr>\r\n";
	if (count($fname) > 0) {
		foreach ($fname as $k => $v) {
			$key = htmlentities($k);
			$value = htmlentities($v);
			echo "<tr><td class=\"e\">$key</td><td class=\"v\">$value</td></tr>\r\n";
		}
	} else {
		echo "<tr><td class=\"e\">NULL</td><td class=\"v\">NULL</td></tr>\r\n";
	}
	echo "</table>\r\n";
}

echo '<h1>PHP ' . phpversion() . ' - Global Variables</h1>';

// Prints $_SERVER array
printVar($_SERVER, "_SERVER");

// Prints $_COOKIE array
printVar($_COOKIE, "_COOKIE");

// Prints $_GET array
printVar($_GET, "_GET");

// Prints $_POST array
printVar($_POST, "_POST");

//// Prints $_FILES array
printVar($_FILES, "_FILES");

// Prints $_SESSION array (this one can be NULL)
printVar($_SESSION, "_SESSION");

// Prints $_ENV array
printVar($_ENV, "_ENV");

// Prints $_REQUEST array
printVar($_REQUEST, "_REQUEST");

echo "</body>";
echo "</html>";
?>
