<?php

function sendmail($fromName, $from, $to, $subject, $body, $returnPath = null)
{

  if (preg_match('/[\r\n]/', $fromName) !== 0
      || preg_match('/[\r\n]/', $from) !== 0
      || preg_match('/[\r\n]/', $to) !== 0
      || preg_match('/[\r\n]/', $subject) !== 0) {
    die('不正な入力が検出されました。');
  }

  if (is_null($returnPath)) {
    $returnPath = $from;
  }


  $header = 'From: ' . mb_encode_mimeheader($fromName) . ' <' . $from . '>';


  if (ini_get('safe_mode')) {
    $result = mb_send_mail($to, $subject, $body, $header);
  } else {
    $result = mb_send_mail($to, $subject, $body, $header, '-f' . $returnPath);
  }
  return $result;
}
