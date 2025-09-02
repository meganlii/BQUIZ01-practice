<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->

<h3 style='text-align:center'>新增動態文字廣告</h3>
<hr>

<!-- 不刪除action 改成 insert_ad.php 不影響功能  考量後面有功能需要上傳圖片 -->
<form action="./api/insert.php" method="post" enctype="multipart/form-data">
  <!-- <div>
    <label>標題區圖片</label>
    <input type="file" name="img">
  </div> -->

  <div>
    <label>動態文字廣告：</label>
    <input type="text" name="text">
  </div>

  <div>
    <input type="hidden" name="table" value="ad">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>

<script>
/*
// 步驟0 
1. 新增 <form> 參數  表單資料post送到api處理 action="./api/insert_ad.php"
2. 路徑不是../api  因為彈出視窗點開  網址在 backend.php  屬於./當前目錄 web01-1目錄
3. 使用ajax另外取得  傳到後端title.php  title.php再被引入到backend.php
4. "multipart/form-data" 多媒體格式/表單資料 配合type="file"才會用編碼方式傳送file 一般表單不用加

// 步驟1：彈出視窗
1. 複製 .\modal\title.php 更名.\modal\adphp
2. <h3>更名 新增動態文字廣告
3. 移除第一欄圖片區
4. <label>改成  動態文字廣告：

// 步驟2：<form>不刪除action 不影響功能  考量後面有功能需要上傳圖片
改成 .\api\insert_ad.php

// 步驟3：
複製 .\api\insert_title.php

*/
</script>