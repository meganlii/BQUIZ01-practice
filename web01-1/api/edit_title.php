<?php
// F12預覽畫面 網址輸入 api/edit_title.php

include_once './db.php';

dd($_POST);




?>

<script>
/** 
* 步驟1：先dd陣列
* 步驟2：foreach、if + isset()網頁傳值先判斷預設值
['id']=$id   foreach $_POST關聯陣列/變數 當中['id']位置
['del']      isset() ['del'] 是否存在  確認是否刪除必要性
in_array()
(1)要確認迴圈的['id']有沒有在['del']陣列裡面
(2)isset()跟in_array()先後順序 不可顛倒
* 
*/

</script>