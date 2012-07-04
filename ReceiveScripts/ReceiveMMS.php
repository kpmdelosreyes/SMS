<?php

//NOTES:
//You must create a folder called C:\MMSFiles
//You must also make sure that PHP scripts have permission to write to this folder


$Username = "MyUsername";
$Password = "MyPassword";

$MMSFileStorageDir = "C:\\MMSFiles\\";

$From = $_REQUEST['from'];
$Text = $_REQUEST['text'];
$MsgId = $_REQUEST['msgid'];
$FileList = $_REQUEST['filelist'];

$FileListArray = explode ( ",", $FileList );

foreach ( $FileListArray as $MMSFilePart )
{
	echo "Retrieving file $MMSFilePart...<br>";
	
	$URL = "http://www.intellisoftware.co.uk/smsgateway/retrievemms.aspx?";
	$URL .= "username=" . urlencode($Username) . "&";
	$URL .= "password=" . urlencode($Password) . "&";
	$URL .= "msgid=" . urlencode($MsgId) . "&";
	$URL .= "msgpart=" . urlencode($MMSFilePart);

	copy($URL, $MMSFileStorageDir . $MsgId . "_" . $MMSFilePart  );
}
echo "MMS Retrieval Complete.";
?>