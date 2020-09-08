<?php
echo '
<head>
<title>Tobacco?</title>
<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>';
$xml = new DOMDocument;
$xml->load('../resource/tobacco.xml');

$xslt = new DOMDocument;
$xslt->load('../resource/tobacco.xslt');

$proc = new XSLTProcessor();
$proc->importStyleSheet($xslt);

$newXml = $proc->transformToXML($xml);
echo $newXml;
echo '</body>
</html>';



