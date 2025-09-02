<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->
<!-- 步驟1
1. 新增 資料夾modal跟title.php ./modal/title.php
2. 移植./view2 <h3><form> 到此頁 -->
<h3 style='text-align:center'>新增標題區圖片</h3>
<hr>

<form action="./api/insert.php" method="post" enctype="multipart/form-data">
  <div>
    <label>標題區圖片：</label>
    <input type="file" name="img">
  </div>

  <div>
    <label>標題區替代文字：</label>
    <input type="text" name="text">
  </div>

  <div>
    <input type="hidden" name="table" value="title">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>

<script>
/**

// 步驟2 
1. 新增 <form> 參數  表單資料post送到api處理 action="./api/insert_title.php"
2. 路徑不是../api  因為彈出視窗點開  網址在 backend.php 屬於./當前目錄 web01-1目錄
3. 其他資料夾modal、backend檔案 送到api處理  要以backend.php角度來看跟api關係  屬於./當前目錄  web01-1目錄 
api處理完了，資料夾api內的檔案跟backend.php關係 則是回上一層  用../  回到後台 
4. 使用ajax另外取得  傳到後端title.php  title.php再被引入到backend.php
5. "multipart/form-data" 多媒體格式/表單資料 配合type="file"才會用編碼方式傳送file 一般表單不用加

// 步驟3
1. 更改 action=./api/insert.php
2. 32行 新增input:hidden
3. 複製到 .\modal\ad.php

*/
</script>