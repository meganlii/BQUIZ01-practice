<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->

<h3 style='text-align:center'>新增管理者帳號</h3>
<hr>

<!-- 不刪除action 改成 insert_ad.php 不影響功能  考量後面有功能需要上傳圖片 -->
<form action="./api/insert.php" method="post" enctype="multipart/form-data">
  <div>
    <label>帳號：</label>
    <input type="text" name="acc">
  </div>
  <div>
    <label>密碼：</label>
    <input type="password" name="pw">
  </div>
  <div>
    <label>確認密碼：</label>
    <input type="password">
  </div>

  <div>
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
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
1. 複製 .\modal\ad.php 更名為 .\modal\admin.php
2. <h3>更名 新增管理者帳號
3. 移除第一欄圖片區
4. 13行 增加三欄  帳號/密碼/確認密碼  修改type、name
4. 確認密碼不用做 移除name="pw" 資料不會送到後端

// 步驟2
F12確認 彈出視窗 新增功能 ./api/insert.php

// 步驟3
1. 因為選單8  資料表沒有sh欄位 但共用insert新增功能，F12會報錯 但不影響功能
參考6/27筆記-550行 截圖
2. 修改 新增功能
./api/insert.php 改成switch  也可用else if/比較麻煩

---------------
// 步驟2：<form>不刪除action 不影響功能  考量後面有功能需要上傳圖片
改成 .\api\insert_ad.php

// 步驟3
複製 .\api\insert_title.php

// 步驟4：第19行
// 修改value="title"
1. 思考：簡化 改成變數寫法 避免複製貼上打錯字
2. 本頁彈出頁面 使用ajax另外取得  傳到後端title.php  要用get收title
value= < ?=$_GET['table']; ?>  不是 value="< ?= $do;?>"

// 步驟5
1. 複製 .\modal\ad.php 更名為 .\modal\admin.php
2. 確認密碼欄位 不用做  但第二題會員註冊有此功能
3. 由上而下修改



*/
</script>