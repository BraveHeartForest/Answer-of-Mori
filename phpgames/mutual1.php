<?php
 
$sxe = simplexml_load_string('<books><book><title>'.
      'Great American Novel</title></book></books>');
//  $exe = simplexml_load_string("./test1.xml")
if ($sxe === false) {
  echo 'Error while parsing the document';
  exit;
}
 
$dom_sxe = dom_import_simplexml($sxe);
if (!$dom_sxe) {
  echo 'Error while converting XML';
  exit;
}
 
$dom = new DOMDocument('1.0');
$dom_sxe = $dom->importNode($dom_sxe, true);
$dom_sxe = $dom->appendChild($dom_sxe);
 
echo $dom->save('test2.xml');
 
?>