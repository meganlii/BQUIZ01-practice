<?php
include_once './db.php';

// 架構：共5+1個變數  簡化為 4+1
// 複製貼上三行  再加上unset即可

// dd陣列  印出 表單收到資料
// $_POST=['id'=>1,'total'=>200,'table'=>'total'];
// Array
// (
//     [total] => 100
//     [id] => 1
//     [table] => total
// )
dd($_POST);

// 步驟1
// 來自34行 backend\total.php 隱藏輔助欄位 name="table"
// <input type="hidden" name="table" value="<?= $do; ? >">
$table = $_POST['table'];  //輸出 total
$db = ${ucfirst($table)};  //輸出 物件$Total

// 步驟2
// 只需修改 一筆資料 一個欄位的值  取出34行
// 改成 改成find($_POST['id']) 或 find(1)

// $row = $db->find($_POST['id']);  // 物件找出此筆資料$id(1) 回傳陣列
// dd($row);

// 步驟3
// 只需修改 一個欄位的值  取出34行
// 改為 total 取出$_POST['total']的人數值 物件$db存回陣列$row  沒有[table] => total

// $row['total'] = $_POST['total'];

// $row=['id'=>1,'total'=>200];
// Array
// (
//     [total] => 100
//     [id] => 1
// )
unset($_POST['table']);
$db->save($_POST);

to("../backend.php?do=$table");

// 步驟4
// 刪除 foreach

// 步驟6：簡化程式
// $_POST=['id'=>1,'total'=>200,'table'=>'total'];
// $row=['id'=>1,'total'=>200];
// 42行 $db->save($row); 改存  $db->save($_POST);
// 41行 新增unset($_POST['table']);
// 26行/33行 移除不需要再找出id跟total再重新，只有一筆id 直接存入後更新  前面有設定 不存資料表名稱
// 之前edit.php 要先用find撈出資料 再用switch根據post表單做對應處理

?>

<script>
/*
// 步驟0
// 處理 backend\total.php
<form method="post" action="./api/edit_column.php">
1. 只有一筆資料 獨立寫edit功能：其他都是多筆資料編輯 post送出後生成多維陣列 無法共用 api\edit.php
2. 04行 新增 api\edit_column.php

<form method="post" action="./api/edit_column.php">

// 步驟5：除錯練習
1. 更改人數送出後 修改失敗 資料表出現第二筆資料 id=2
2. id沒有送出來變成新增  回到total.php重新檢查沒問題
3. 開頭 設dd($_POST);
4. 關閉 to() $db->save($row); to("../backend.php?do=$table");
5. 23行 出現錯誤訊息 Undefined variable $id 
find($id)  改成 改成find($_POST['id']) 或 find(1)



--------------------
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