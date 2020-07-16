<?php

// session_start();
print_r($_REQUEST); exit();
if ($_SESSION['uni_redirectTo'] != null) {
	header("Location: ".$_SESSION['uni_redirectTo']."?id=".$_REQUEST['id']);
	unset($_SESSION['uni_redirectTo']);
}

// if the request is not successful
if ($_REQUEST["id"] != "success") {
	return;
}

include("./params.inc.php");
include("./lib/xmlrpc.inc");

//create the request
$c=new xmlrpc_client($uni_url);
$f=new xmlrpcmsg(
	'requester.getDocumentsByTransactionId',
	array(
		new xmlrpcval($_SESSION['uni_id'], "string")		
	)
);

//SSL verification (should be enabled in production)
$c->setSSLVerifyHost(0);
$c->setSSLVerifyPeer(0);

//Debug flag
$c->setDebug(0);


//Send request an analyse response
$r=&$c->send($f);
unset($_SESSION['uni_id']);

if(!$r->faultCode()) {
	$r =  $r->value();
	for ($i = 0; $i < $r->arraySize(); $i++)
	{
		//store the signed documents in the session
		$docs[$i]['name'] = $r->arrayMem($i)->structMem('name')->scalarVal();
		$docs[$i]['content'] = $r->arrayMem($i)->structMem('content')->scalarVal();
		$_SESSION['signed_documents'] = $docs;
	}
} else {
	print "An error occurred: ";
	print "Code: " . $r->faultCode()
		. " Reason: '" . $r->faultString();
}

?>
