<?php
// 錄音檔 0624-8 完成網站標題管理修改資料功能(D)
// 處理編輯功能：按鈕/修改確定：修改文字 欄位-顯示/刪除 
// 沒加的話 欄位改文字 點選顯示或刪除  會失效 無法修改存入

// 寄件人/後台 .\backend\title.php 表單  
// <form method="post" action="./api/edit_title.php">
// 後台有加hidden id，辨識異動項目  api就可編輯
// <input type="hidden" name="id[]" value="<?= $row['id']; ? >">
// F12預覽畫面 網址輸入 api/edit_title.php

// 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
// api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台
// to("../backend.php?do=title");


include_once './db.php';

// Array
// (
//     [total] => 100
//     [id] => 1
//     [table] => total
// )
// dd陣列  印出 表單收到資料
// 例如 $_POST=['id'=>1,'total'=>200,'table'=>'total'];
dd($_POST);

// 步驟1
// (1) 先從 .\api\edit_title.php
// (2) 複製 .\api\edit_title.php  更名為 .\api\edit.php

// 步驟2
// 差別在資料表不同 $Title 或 $Ad
// 先將table拿進來 抓到不同資料表 表單頁面要帶value=資料表名稱(title或ad)  參下方180行註解
$table = $_POST['table'];
$db = ${ucfirst($table)};


// 步驟3
// $Title 全部改用$db 代替
// foreach、if + isset()網頁傳值先判斷預設值
foreach ($_POST['id'] as $key => $id) {

  // 3-1 處理編輯功能：刪除
  // * isset()跟in_array() 搭配使用 
  if (isset($_POST['del']) && in_array($id, $_POST['del'])) {

    $db->del($id);

  // 3-2 取出資料查詢符合id的"單筆資料"  回傳資料表 指定id資料
  // 先用find撈出資料 再用switch根據post表單做對應處理
  // 對照api\edit_column.php 不用find跟foreach 跟switch
  } else {
    
    $row = $db->find($id);

    // 印出 從資料表拿出的$row
    dd($row);


    // 步驟4
    // 處理編輯功能：顯示
    // $row['text']  $row['sh']
    // 有的沒有['text']欄位  後面選單['text']是路徑不是文字
    // 同insert.php作法 用判斷式  
    // 較複雜改用switch 拆開有差異的地方 只有第8.9個 管理者/選單管理 不同

    // 步驟5：先列出table  複製7個
    switch ($table) {

      // 步驟5-1：放上此頁title兩行
      case 'title':
        $row['text'] = $_POST['text'][$key];
        $row['sh'] = ($_POST['sh'] == $id) ? 1 : 0;
        break;

      // 步驟5-2：複製ad兩行貼過來
      // api\edit_ad.php


      // 步驟11：併入'mvim'與'image' 再簡化 
      // 7個項目，已有4個合併  62行sh改為二維陣列可再簡化-不太懂？？
      // case 'ad':
      // case 'news':
      // case 'mvim':
      // case 'image':


      // 步驟11-1：加if判斷式 區分是否有text 有就執行 沒有就不做
      // 步驟12：此段再簡化 移到128行default 預設執行 70-73行也不用了

      // if (isset($row['text'])) {
      //   $row['text'] = $_POST['text'][$key];
      // }
      // $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
      // break;

      // 步驟7：新增 .\modal\mvim.php 顯示/刪除 功能--之後簡化併入
      // 1. 顯示/刪除失效  因為.\api\edit.php 還沒設定
      // 2. 沒有text 只需要處理 顯示與否
      // 3. 複製66行
      // 因為每個選單功能些微不同，單獨設定 最後再看異同重複處 再處理

      // ***************再簡化**********
      // case 'mvim':
      // case 'image':
      //   $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
      //   break;
      // ***************再簡化**********

      // 步驟8：新增 .\modal\image.php 顯示/刪除 功能--之後簡化併入
      // 複製case 'mvim'
      // case 'image':
      //   $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
      //   break;

      // 步驟9：新增 .\modal\news.php 顯示/刪除 功能--之後簡化併入
      // 複製case 'ad'
      // case 'news':
      //   $row['text'] = $_POST['text'][$key];
      //   $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
      //   break;

      // 步驟10：思考上面7個異同處 再簡化
      // 相同兩組：'mvim'與'image'。'ad'與'news'
      // 相同case放一起即可 關鍵在break

      // 步驟11：再簡化，回到70行重整


      // 最後兩個選單比較複雜
      case 'admin':
        $row['acc'] = $_POST['acc'][$key];
        $row['pw'] = $_POST['pw'][$key];
        break;

      // 步驟13：複製121/122/140行
      // 改成['text']['href']
      case 'menu':
      $row['text'] = $_POST['text'][$key];
      $row['href'] = $_POST['href'][$key];
      $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
      break;

      // 步驟12：終極簡化，增加default
      // 80-83行 if判斷式 移到預設執行
      // 只有edit需要重構  insert跟update不需要
      default:
        if (isset($row['text'])) {
          $row['text'] = $_POST['text'][$key];
        }

        $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        break;
    }

    // 步驟6
    // 修改 .\backend\title.php  .\backend\ad.php
    // 新增 隱藏欄位輔助 input:hidden
    // 修改 表單路徑
    // <form method="post" action="./api/edit.php">
    // 刪除 兩個頁面 ./api/edit_title.php  ./api/edit_ad.php 


    // 如何知道新增或更新？因為有id
    $db->save($row);

    // Array
    // (
    //     [total] => 100
    //     [id] => 1
    // )
    // 印出 存到資料表的$row
    // $row=['id'=>1,'total'=>200];
    dd($row);
    
  }
}

// 步驟3：回到$table
// 要改成 雙引號 變數才會生效
to("../backend.php?do=$table");

?>

<script>
/*
//  $row['text']=$_POST['text'][$key];
資料庫的替代文字  對應$_POST表單送來的資料  對照截圖看

// $row['sh']=($_POST['sh']==$id)?1:0;
ad複選寫法 二維陣列  $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
title單選寫法 一維陣列只有值  三元運算式  條件式用兩個等號=


// 錄製_2025_06_30_08_47_ 總整理-編輯功能
1. 將不同資料表的編輯功能 整併再一支程式裡面  新增/更新功能 也用同樣方法套用
2. 先設變數 抓到不同資料表 $table = $_POST['table'];
來自.backend\title.php 等7個選單頁面  皆有新增2個隱藏欄位輔助 name="id[] "name="table"
<form method="post" action="./api/edit.php">
<input type="hidden" name="id[]" value="< ?= $row['id']; ? >">
<input type="hidden" name="table" value="< ?= $do; ? >">

3. 再設兩個$ 可變變數  ${ucfirst($table)}
POST收到的table可以變成宣告的DB類別的大寫物件
4. 最後，因應資料表不同欄位(圖片、帳號/密碼)、欄位結構(文字、路徑)、單/多選框
使用switch 拆開有差異的地方 各自可變更資料表不同欄位  後續新增維護更方便

*/
</script>