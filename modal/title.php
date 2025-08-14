<!-- 步驟1 新增 資料夾madal跟title.php ./madal/title.php -->
<!-- ./view2 <h3><form> 移到此頁 -->
<h3 style='text-align:center'>新增標題區</h3>
<hr>
<form action="">
 <div>
  <label>標題區圖片</label>
  <input type="file" name="img">
 </div>

 <div>
  <label>標題區替代文字</label>
  <input type="text" name="text">
 </div>

 <!-- 按鈕區 沒用button-->
 <!-- input:submit+input:reset -->
 <div>
  <input type="submit" value="新增">
  <input type="reset" value="重置">
 </div>
</form>