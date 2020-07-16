<?php
session_start();

$doc = $_SESSION['signed_documents'][0];

//Retrieve the document
header("Pragma: no-cache");
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=" . $doc['name']);
header("Content-Length: " . strlen($doc['content']));
ob_clean();
flush();
print $doc['content'];
?>
