<?php
session_start();
include 'Services/Twilio.php';
include("config.php");
$client = new Services_Twilio($accountsid, $authtoken);
if (!isset($_REQUEST['called'])) {
$err = urlencode("Must specify your phone number");
header("Location: click-to-call.php?msg=$err");
die;
}
$call = $client->account->calls->create($fromNumber,
$toNumber,
'callback.php?number=' . $_REQUEST['called']);
$msg = urlencode("Connecting... ".$call->sid);
header("Location: click-to-call.php?msg=$msg");
?>
6. Finally, upload a file named callback.php to your website:
<?php
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
<Say>A customer at the number <?php echo
$_REQUEST['number']?>
is calling</Say>
<Dial><?php echo $_REQUEST['number']?></Dial>
</Response>
