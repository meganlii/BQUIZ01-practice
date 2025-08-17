<!-- 此功能搭配筆記 11401-FILE-mynote\upload\01-upload.php -->
<!-- 步驟1 新增 資料夾madal跟title.php ./madal/title.php -->
<!-- ./view2 <h3><form> 移到此頁 -->
<h3 style='text-align:center'>新增標題區</h3>
<hr>

<!-- 步驟2 補足 <form> 參數  表單資料post送到api處理 ./api/insert_title.php -->
<!-- 路徑不是../api  因為彈出視窗點開網址在 backend.php -->
<!-- 使用ajax另外取得  傳到後端title.php  title.php再被引入到backend.php -->
<!-- "multipart/form-data" 多媒體格式/表單資料 配合type="file"才會用編碼方式傳送file 一般表單不用加 -->
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