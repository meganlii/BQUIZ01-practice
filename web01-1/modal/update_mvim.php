<!-- 步驟1
複製 .\modal\update_title.php 更名為 .\modal\update_mvim.php -->


<!-- 更名<h3> -->
<h3 style='text-align:center'>更換動畫圖片</h3>
<hr>

<!-- 步驟2：新增 <form> 參數  表單資料post送到api處理 action="./api/insert_title.php" -->
<!-- 改路徑 ./api/update_mvim.php  複製新檔案到api -->
<!-- 之後另作update功能模組 -->


<form action="./api/update_mvim.php" method="post" enctype="multipart/form-data">
  <div>
    <label>動畫圖片：</label>
    <input type="file" name="img">
  </div>

  <!-- 步驟0：移除替代文字 -->

  <!-- 步驟3：測試功能  新增  顯示/刪除  更換
  1. 顯示/刪除失效  因為.\api\edit.php 還沒設定
  2. 沒有text 只需要處理 顯示與否 -->

  <!-- 步驟4：6/27-5 整併更新圖片api為一支
  1. 新增 <input type="hidden" name="table" value= 
  2. 回到 .\backend\title.php 設定onclick路徑參數 -->

  <div>
    <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="更新">
    <input type="reset" value="重置">
  </div>
</form>

<!-- 加上id -->