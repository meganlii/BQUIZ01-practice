<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->

<h3 style='text-align:center'>新增最新消息</h3>
<hr>

<!-- 不刪除action 改成 insert_ad.php 不影響功能  考量後面有功能需要上傳圖片 -->
<form action="./api/insert.php" method="post" enctype="multipart/form-data">
  <!-- <div>
    <label>標題區圖片</label>
    <input type="file" name="img">
  </div> -->

  <div>
    <label>最新消息：</label>
    <textarea name="text" style=" width:200px;height:100px;vertical-align:middle; "></textarea>
    <!-- <textarea name="" id=""></textarea> -->
    <!-- <input type="text" name="text"> -->
  </div>

  <div>
    <input type="hidden" name="table" value="<?=$_GET['table'];?>">
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

// 步驟1
複製 ./modal/ad.php 更名為 news.php

// 步驟2
由上而下修改 表單 欄位名稱

// 步驟1
15行 <input>改成<textarea></textarea>
1. 不要斷行  不要加字 才不會增加多餘空白
2. 預設格子很小 可加上style="width:200px;height:100px;"
3. 置中 vertical-align:middle

*/
</script>