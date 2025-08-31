<?php
// 錄音檔 0624-8 完成網站標題管理修改資料功能(D)
// 收後台 .\backend\title.php 表單 編輯/顯示/刪除
// <form method="post" action="./api/edit_title.php">
// 之前有加hidden id，辨識異動項目  api就可編輯
// F12預覽畫面 網址輸入 api/edit_title.php

// 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
// api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台
// to("../backend.php?do=title");

include_once './db.php';

// dd陣列  印出 表單收到資料
dd($_POST);

// 步驟1：foreach、if + isset()網頁傳值先判斷預設值
// 關聯陣列/變數 $_POST['id']  取出 $key 跟 $id  陣列要用胖箭頭=>
// 索引值$key[0 1 2 3] => 對應$id[1 2 3 4] 參考截圖
foreach ($_POST['id'] as $key => $id) {

  // 步驟2：處理刪除
  // * isset()確認 刪除是否存在 if如果有存在  else如果不存在刪除，就可編輯
  // in_array() 確認迴圈['id'] 是否在 $_POST['del']陣列裡面

  // * isset()跟in_array() 搭配使用 
  // 先判斷是否存在 再確認 是否在陣列裡面 ~ 先後順序 不可顛倒
  // * edit_ad.php有同樣用法
  // $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0; 

  // * 不寫第二個foreach ($_POST['del'] as $id)  
  // (1)程式碼只需跑4次不用跑6次  (2)可能誤刪之前編輯的資料
  if(isset($_POST['del']) && in_array($id,$_POST['del'])) {

  $Title->del($id);

  }else{

  // 步驟3：處理編輯  取出資料查詢符合id的"單筆資料"  回傳資料表 指定id資料
  $row=$Title->find($id);
  
  // 印出 從資料表拿出的$row
  dd($row);

  // 步驟4：$row['text']是資料庫的替代文字  對應  $_POST表單送來的資料  對照截圖看
  // $row要變更的內容 來自 (如果foreach $id=1對應索引[0]) $_POST['text']的[$key][0]對應的替代文字 就是$row要變更的內容
  // 留意$key是變數，不用再加單引號
  $row['text']=$_POST['text'][$key];


  // 步驟5：三元運算式  條件式用兩個等號=
  // 如果 $_POST['sh'] 等於這個 id，就設為 1 (顯示)，否則設為 0 (不顯示)
  // paylosd ['sh']= $id  會有1 2 3 4  第1 2 3 4  筆資料的意思
  // 印出陣列['sh']= 只會有1跟0
  $row['sh']=($_POST['sh']==$id)?1:0;

  // 步驟6：如何知道新增或更新？因為有id
  $Title->save($row);

  // 印出 存到資料表的$row
  dd($row);

  }

}

// 步驟7：手動資料庫將其中一筆改為顯示 ['sh']=1
to("../backend.php?do=title");

?>

<script>
/** 
1. 出現意外狀況 程式寫完後，要先執行刪除 再點選單選框就正常
剛寫完測試 點選單選框後，按下"修改確定"後，單選框顯示會消失不見
(有可能 同時選到顯示跟刪除)

2. 檢定與實務差異：檢定寫法是全部跑一次 全部處理
實務上要多寫很多檢查程式 自動判斷資料有無如何處理 或定位有變更才處理
規模不同 解決問題步驟有差異

*/
</script>