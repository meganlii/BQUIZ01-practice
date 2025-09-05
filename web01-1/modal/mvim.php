<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->
<!-- 步驟1
1. 新增 資料夾modal跟title.php ./modal/title.php
2. 移植./view2 <h3><form> 到此頁 -->
<!-- 位置 backend\title.php 55行 
<onclick="op('#cover','#cvr','./modal/title.php')" > -->
<!-- 彈出頁面使用ajax另外取得  傳到後端title.php   title.php再被引入到backend.php -->

<h3 style='text-align:center'>新增動畫圖片</h3>
<hr>

<form action="./api/insert.php" method="post" enctype="multipart/form-data">
  <div>
    <label>動畫圖片：</label>
    <input type="file" name="img">
  </div>

  <div>
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>

<script>
/**
// 步驟1
// 套用功能到選單mvim
1. 複製.\modal\title.php 更名為mvim.php
2. 複製 資料表title，更名為mvim
3. 09行 修改表單 欄位名稱
4. 其他不動 action已經統一insert.php

// 步驟2
1. 複製 .\backend\title.php 更名為mvim.php

*/
</script>