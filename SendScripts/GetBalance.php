<?php

include 'IntelliSMS.php';


//Required php.ini settings:
// allow_url_fopen = On
// track_errors = On
//
//NOTE: To use https you will need the OpenSSL extension module




$objIntelliSMS = new IntelliSMS();


//Set you account login details below:
$objIntelliSMS->Username = 'MyUsername';
$objIntelliSMS->Password = 'MyPassword';



//Get Balance

$Results = $objIntelliSMS->GetBalance ();

$ErrorStatus = $Results["ErrorStatus"];
$Balance = $Results["Balance"];

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Get Balance</title>
</head>
<body>
<h1>Get Balance</h1>
<br>
<b>Error Status: <?php echo $ErrorStatus ?></b>
<br>
<b>Balance: <?php echo $Balance ?></b>
<br>
<br>
</form>
</body>
</html>

