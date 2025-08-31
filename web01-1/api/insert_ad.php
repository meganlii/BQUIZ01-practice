<?php
// 收後台./modal/ad.php 新增動態文字廣告 送來的表單資料  寫到資料庫

// 步驟1
// 複製 .\api\insert_title.php 更名為 .\api\insert_ad.php
// 保留$_POST[sh]=1 先移出if判斷式  預設全部顯示  不要再刪除
// 刪除 上傳圖片if判斷式
// text文字本來就會送過來？？不懂

include_once "./db.php";

// 所有新增文字 預設顯示 之後再手動調整刪除
$_POST['sh']=1;

// 改成$Ad 存入資料庫
// 這邊沒改到$Ad 資料存到選單標題區
$Ad->save($_POST);

// 步驟5 回到後台 ?do=ad 注意?
// 因為後台./madal/ad.php發請求到api 需再將頁面導回後台
to('../backend.php?do=ad');