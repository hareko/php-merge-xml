<?php

/**
 * PHP MergeXML usage sample
 * merge selected local xml files
 * 
 * @package     MergeXML
 * @author      Vallo Reima
 * @copyright   (C)2014
 */
date_default_timezone_set('UTC');
ini_set('display_errors', true);
ini_set('log_errors', false);

include 'mergexml.php';    /* load the class */
$oMX = new MergeXML(['updn'=>true]);

if ($oMX->error->code == '') {
  $rsp = FileMerge($oMX);
} else {
  $rsp = $oMX->error->text; /* missing feature */
}

echo $rsp;

/**
 * merge uploaded files
 * @param object $xml -- class instance
 * @return string
 */
function FileMerge(MergeXML $xml) {
  $files = !empty($_FILES) ? $_FILES : array('file0' => array('name' => ''));
  reset($files);
  $key = key($files); /* independently from attribute names */

  if (is_array($files[$key]['name'])) { /* multiselect */
    for ($i = 0; $i < count($files[$key]['name']); $i++) {
      $name = $files[$key]['name'][$i];
      if (!empty($name) && !$xml->AddFile($files[$key]['tmp_name'][$i])) {
        break;
      }
    }
  } else {
    foreach ($files as $file) {
      $name = $file['name'];
      if (!empty($name) && !$xml->AddFile($file['tmp_name'])) {
        break;
      }
    }
  }

  if ($xml->error->code != '') {
    $rtn = $xml->error->text . ': ' . $name;
  } else if ($xml->count < 2) {
    $rtn = 'Minimum 2 files are required';
  } else {
    $rtn = $xml->Get(1);
    header("Content-Type: text/plain; charset={$xml->dom->encoding}");
   }
  return $rtn;
}

function Debug($data = array())
/*
 *  save debug data
 */ {
  $level = 0;
  $date = date('d.m.Y/H:i:s');
  $trace = debug_backtrace();
  $file = basename($trace[$level]['file'], '.php');
  $line = $trace[$level]['line'];
  $text = "$date $file $line\n";
  foreach ($data as $key => $value) {
    $val = var_export($value, true);
    $text .= "$key=$val\n";
  }
  $text .= "\n";
  $fp = fopen('debug.txt', 'a');
  fwrite($fp, $text);
  fclose($fp);
}
