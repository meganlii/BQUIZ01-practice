<?php
session_start();

date_default_timezone_set('Asia/Taipei');

function dd($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

// 等號打錯 utf8拼錯 句尾忘記分號
// function q($sql)
// {
//   $dsn = 'mysql:host=localhost;dbname=db02;charset=utf8';
//   $pdo = new PDO($dsn, 'root', '');
//   return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// }

function q($sql){
  $dsn='mysql:host=localhost;dbname=db02'
}