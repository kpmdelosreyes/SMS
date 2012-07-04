<?php

include 'IntelliSMS.php';


//Required php.ini settings:
// allow_url_fopen = On
// track_errors = On
//
//NOTE: To use https you will need the OpenSSL extension module



$sendresult_detailed = "";
$sendresult_summary = "";


if ( isset($_POST['recipients']) && strlen($_POST['recipients'])!=0 && isset($_POST['udhex']) )
{
	$objIntelliSMS = new IntelliSMS();


	//Set you account login details below:
	$objIntelliSMS->Username = 'MyUsername';
	$objIntelliSMS->Password = 'MyPassword';



	//Send message

	$SendStatusCollection = $objIntelliSMS->SendBinaryMessage ( $_POST['recipients'], $_POST['udhhex'], $_POST['udhex'], $_POST['from'] );


	//Generate result summaries for display in browser

	$sendresult_detailed = "<b>Result Details:</b><br>";

	$sendcount = 0;
	foreach ( $SendStatusCollection as $SendStatus )
	{
		$sendresult_detailed = $sendresult_detailed . $SendStatus["To"] . "  " . $SendStatus["MessageId"] . "  " . $SendStatus["Result"] . "<BR>";
	
		if ( $SendStatus["Result"] == "OK" ) $sendcount++;
	}

	$sendresult_summary = $sendcount . " out of " . count($SendStatusCollection) . " messages have been sent ok";
}


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Send Binary</title>
</head>
<body>
<h1>Send Binary</h1>
<form method="post">
<table border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>Recipient(s):</td>
    <td><input name="recipients" type="text" value="" size="30"></td>
  </tr>
  <tr>
    <td>Sender's Id:</td>
    <td><input name="from" type="text" value="" size="30"></td>
  </tr>
  <tr>
    <td valign="top">User Data Header (Hex):</td>
    <td><input name="udhhex" type="text" value="06050415820000" size="30"></td>
  </tr>
  <tr>
    <td valign="top">User Data (Hex):</td>
    <td><textarea name="udhex" cols="40" rows="10">32F40100480E01000000000000000000000000000000000000000000000000000000000001247803000000E0080120CC0640000040080120CC06C00000479E7124F0EFFADCF64448892479B6DAC6CD4448F9241DB6DACECF44488124CDB6CD96CC44488924CDB6CD96CDE446712478E66D9EC6000000000000000000000000000000000000</textarea></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" value="Send message"></td>
  </tr>
</table>
<br>
<br>
<b><?php echo $sendresult_summary; ?></b>
<br>
<br>
<?php echo $sendresult_detailed; ?>
</form>
</body>
</html>

