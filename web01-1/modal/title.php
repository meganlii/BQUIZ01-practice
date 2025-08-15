<!-- 步驟1 新增 資料夾madal跟title.php ./madal/title.php -->
<!-- ./view2 <h3><form> 移到此頁 -->
<h3 style='text-align:center'>新增標題區</h3>
<hr>

<!-- 步驟2 補足 <form> 參數  post資料送到./api/insert_title.php -->
<!-- 路徑不是../api  因為彈出視窗點開網址在 backend.php -->
<!-- 使用ajax另外取得  傳到後端title.php  title.php再被引入到backend.php -->
<form action="./api/insert_title.php" method="post" enctype="multipart/form-data">
  <div>
    <label>標題區圖片</label>
    <input type="file" name="img">
  </div>

  <div>
    <label>標題區替代文字</label>
    <input type="text" name="text">
  </div>

  <div>
    <input type="submit" value="新增">
    <input type="reset" value="重置">
  </div>
</form>