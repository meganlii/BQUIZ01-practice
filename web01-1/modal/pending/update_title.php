<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->

<!-- 步驟1：新增 資料夾modal跟title.php ./madal/title.php -->
<!-- ./view2 <h3><form> 移到此頁 -->

<!-- 步驟3：複製 .\modal\title.php 更名為 .\modal\update_title.php -->
<!-- 利用原本新增網站標題圖片的彈出視窗功能，改成 更新圖片 -->
<!-- 更名<h3> -->
<h3 style='text-align:center'>更新標題區圖片</h3>
<hr>

<!-- 步驟2：新增 <form> 參數  表單資料post送到api處理 action="./api/insert_title.php" -->
<!-- 路徑不是../api  因為彈出視窗點開網址在 backend.php -->
<!-- 使用ajax另外取得  傳到後端title.php  title.php再被引入到backend.php -->
<!-- "multipart/form-data" 多媒體格式/表單資料 配合type="file"才會用編碼方式傳送file 一般表單不用加 -->

<!-- 步驟7：action=路徑改成 ./api/update_title.php -->
<!-- 回到.\backend\title.php 第34行 路徑檔名改成./modal/update_title.php -->

<!-- 步驟9：action=路徑改成 ./api/update.php -->
<form action="./api/update.php" method="post" enctype="multipart/form-data">
  <div>
    <label>標題區圖片：</label>
    <input type="file" name="img">
  </div>

  <!-- 步驟4：移除替代文字 -->
  <!-- <div>
    <label>標題區替代文字</label>
    <input type="text" name="text">
</div> -->

  <!-- 步驟5：value="新增" 改成 更新 -->

  <!-- 步驟8：6/27-5 整併更新圖片update功能為一支api檔案
  1. 新增 <input type="hidden" name="table" value= 
  2. 回到 .\backend\title.php 設定onclick路徑參數
  -->
  <div>
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="更新">
    <input type="reset" value="重置">
  </div>
</form>

<!-- 加上id -->

<!-- 步驟8：6/27-6 整併更換圖片update功能為一支彈出視窗modal檔案
1. 複製本頁 改為.\modal\update.php
2. 整合 選單4：新增校園映像圖片的更換圖片 也是類似項目modal
3. 兩個頁面差異 只有<h3跟<label>標題文字不同
使用switch case 切換文字

-->