<!-- 步驟12 增加 api\db.php 
1. 指令裡面先寫 "  "; 
2. 不是在api\submenu.php include
3. 可吃到64行 物件 $Menu
4. 設定次選單 新增 與 編輯 功能，步驟11-13
-->
<?php include_once "../api/db.php"; ?>

<!-- 步驟0
1. 第六個欄位有 按鈕-編輯次選單 到title.php 複製onclick()
onclick="op('#cover','#cvr','./modal/update.php?id=< ?= $row['id']; ?>&table=< ?= $do; ?> ')">
2. 更名為 編輯次選單

3. 編輯功能/彈出視窗 獨立給一個檔案 submenu.php - 老師花半天說明原理
複製./modal/update.php 更名為 ./modal/submenu.php 

4. 編輯功能update.php 套用三個選單更新/更換功能 

5. 本頁實際路徑 /modal/submenu.php?id=4&table=menu
按下按鈕[編輯次選單]出現彈出視窗modal，按F12才會顯示url路徑 瀏覽器網址是後台do=menu
所以86/87行 可用get取得url參數id table
\backend\menu.php 加入url參數
onclick="op('#cover','#cvr','./modal/submenu.php?id=< ?= $row['id']; ?>&table=< ?= $do; ?> ')">
-->


<h3 style='text-align:center'>
  <!-- < ?= $str[$_GET['table']]['header']; ?> -->
  <!-- 步驟2：新增 編輯次選單 -->
  編輯次選單
</h3>

<hr>

<!-- 步驟3
1. 測試是否可打開modal 出現錯誤訊息  移除多於變數15行
2. 表單api單獨處理 同步新增 api/submenu.php 
-->

<!-- 步驟4：
修改表單格式 改用div寫  也可用table
1. 共3列 沒有label 最後列div不動  之前div用不到重寫 
2. 第一列：1個div包3個div 外層容器flex
3. 不是<table> <div width="45%">寫法失效 要改成
  <div style="width:45%">
4. 第二列：複製第一列  <div>裡面再包<input> input:btn/submit/reset三按鈕 出現value= 
input:text/checkbox 出現name= id=
-->
<form action="./api/submenu.php" method="post" enctype="multipart/form-data">
  
  <!-- 第一列：標題
  1. 容器<div>設display:flex
  2. 盒子<div>設寬度與間距
  -->
  <div style="display:flex; margin:auto; width:70%" class="cent" >
    <div style="width:45%; margin:5px 0.5%" >次選單名稱</div>
    <div style="width:45%; margin:5px 0.5%" >次選單連結網址</div>
    <div style="width:10%; margin:5px 0.5%" >刪除</div>
  </div>

  <!-- 步驟11
  1. 取出 次選單所有資料['main_id'] 來自146行 $_GET['id']
  2. foreach 印出每筆資料
  原本{echo}寫法 改成 (1)冒號: (2)在html資料結束處加上endforeach;
  3. 在顯示資料區  value= 加上變數
  -->
  <?php
  $rows=$Menu->all([ 'main_id'=>$_GET['id'] ]);
  foreach ($rows as $row):
  ?>



  <!-- 第二列：內容--預設空白一列  之後當字串模板範本
  1. 盒子<div>裡面放<input>
  2. <input tyle="width:95%"> 塞滿整個div
  3. 加上name=text[]  href[] 欄位名稱同資料表欄位 一次可能送出多筆 加上陣列[]
  -->
  <div style="display:flex; margin:auto; width:70%" class="cent" >
    <div style="width:45%; margin:5px 0.5%" >

      <!-- 步驟12 value= < ?=$row['text'];?> -->
      <input type="text" name="text[]" value="<?=$row['text'];?>" style="width:95%">
    </div>
    <div style="width:45%; margin:5px 0.5%"  >

      <!-- 步驟12-1 value= < ?=$row['href'];?> -->
      <input type="text" name="href[]" value="<?=$row['href'];?>" style="width:95%">
    </div>

    <div style="width:10%; margin:5px 0.5%" >
      <!-- 步驟12-2 value= < ?=$row['id'];?> 
      設定del[]值 = row['id']值
      -->
      <input type="checkbox" name="del[]" value="<?=$row['id'];?>" >
    </div>

    <!-- 步驟12-3 增加隱藏欄位 
    1. 將主選單的id[]加入到隱藏欄位中，區隔步驟12-4name="main_id"
    2. 設定 id[] 、main_id  之後編輯才有依據
    3. 讓後台的api知道這個表單的次選單資料是屬於那個主選單
    4. 至此完成 次選單新增項目 顯示在 彈出視窗上
    5. 回到api\submenu.php  設定 編輯功能
    -->
    <input type="hidden" name="id[]" value="<?=$row['id'];?>">

  </div>

  <!-- 步驟11-1 資料結束處 加上endforeach; -->
  <?php
  endforeach;
  ?>


  <!-- 字串模板插入處 id=""忘記加雙引號"" 輸入id後按tap emmet有預設""-->
  <div id="add" ></div>


  <!-- 第三列：按鈕
  1. 盒子<div> 設定置中 class="cent"
  2. 修改按鈕名稱
  3. 新增按鈕 更多次選單
  
  4. 不小心誤刪 value="< ?= $_GET['id']; ?>"> 測試送出F12沒有顯示id

  5. 此欄位為主選單id  透過$_GET['id']取得url參數
  之後api/submenu.php會將主選單id  [id] => 4  存入資料表'main_id'欄位  兩邊值相同作為主次同組的依據
  透過$main_id = $_POST['id'];  save('main_id' => $main_id) 
  -->
  <div class="cent">
    <!-- 步驟12-4：將name="id" 改為 name="main_id" 更清楚 
    api\submenu.php 修改
    -->
    <input type="hidden" name="main_id" value="<?= $_GET['id']; ?>">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="修改確定">
    <input type="reset" value="重置">

  <!-- 步驟5
  1. 新增JS onclick事件
  使用JQ 將一段html放到網頁某個容器裡面，點下按鈕後 塞入一個input表單  新增資料
  80行 <script>一定要在容器後面執行  寫在</form>之後
  2. 設定 onclick="more()" 直接寫在行內  或另外綁定class

  3. 新增次選單的js函式：共3+1行
  (1)自訂函式 function more(){ }
  (2)字串模板let item=``
  (3)字串模板插入處
  (4)jqappend()：將html字串，添加到列表的最後面

  3. onclick換成行外的獨立寫法：JS原生跟JQ
  -->
    <input type="button" value="更多次選單" onclick="more()" >
    <!-- <input type="button" value="更多次選單" id="moreBtn" > -->

  </div>
</form>

<script>
function more(){

  /*
  // 步驟6：設定 字串模板
  1.範本處 第二列整段<div> 之後 設定 一對<div id=add  >
    上(反)引號``(數字1左邊那顆) 放第二列整段<div> 47行
    對JS，單雙引號斷行內容 視為不同程式碼/變數 會變色(非字串)   要很辛苦湊成一行才有字串效果。
  2. JS 6.0版本之後 推出反引號

  3. 移除checkbox即可 <input type="checkbox" value="" > 保留第三組<div>

  // 步驟7：設定 字串模板 放置處
  1. 第二列整段<div> 之後 設定 一對<div id="add" >
  2. 點下後 字串模板 可接續在 第二列整段<div> 之後
  3. 若沒加 設定append()會失效：只用在容器後，會接在</form>之後 即第三列整段<div> 之後
  */
  let item=`
  <div style="display:flex; margin:auto; width:70%" class="cent" >
    <div style="width:45%; margin:5px 0.5%" >
      <input type="text" name="text2[]" value="" style="width:95%">
    </div>
    <div style="width:45%; margin:5px 0.5%"  >
      <input type="text" name="href2[]" value="" style="width:95%">
    </div>
    <div style="width:10%; margin:5px 0.5%" >
    </div>
  </div>
  `

  // 步驟8：設定 觸發 jqaqqend不只塞一個，用.html每次會洗掉 
  // $("＃add ").append(item)
  // 點選more()，將append(item) 塞到("＃add ")/ html的div裡面
  $("#add").append(item);

  /*
  // 步驟9：確認測試 只有出現第三列<div> name=id table 
  1. 新增第二段<div> name=text[]  href[] del[] 欄位名稱同資料表欄位
  2. 一次可能送出多筆 加上陣列[]
  3. 建立表單時可以先打上
  4. 參考excel筆記截圖

  // 步驟10：區分input編輯(第一列)或新增  項目
  1. let item 字串模板 兩個name 改成 name="text2[]  name="href2[]"
  2. 不同陣列送出的資料 text1[ ] 、 text2[ ]
  3. api可以一次處理兩種不同資料
  */

}

// 新增 步驟11-13

// 補充寫法 onclick行外事件 換成 分離事件：JS原生跟JQ
// 等頁面載入完成後綁定事件
// 要複習之前JS寫法 都忘光了
// 對照excel筆記

// JS原生 寫法
// document.getElementById('moreBtn').addEventListener('click',more);

// jQuery 寫法 先打jqready
// $(document).ready(function () {
//   $('#moreBtn').click(more);
// });

// $(selector).click(function (e) { 
//   // e.preventDefault();
  
// });

</script>


<!-- 之前div用不到 重新寫 -->
<!-- <div>
<label>
  < ?= $str[$_GET['table']]['label']; ?>： 
  </label>
  <input type="file" name="img"> 
</div> -->


<!-- --------------------- -->
<!-- 步驟6
1. 修改 .\backend\mvim.php   33行onclick路徑 改成 './modal/update.php
2. 修改 .\backend\title.php  33行onclick路徑 改成 './modal/update.php
3. 沒有改成$do參數  避免一行程式 重複帶一樣參數
-->

<!-- 步驟7
1. 6/27-7 建立完整需要用到的資料表
選單4-image  資料表-複製選單3-mvim
選單7-news   資料表-複製選單2-ad
選單8-admin  資料表-複製選單1-title
選單9-menu   資料表-複製title 因為欄位最多
選單5 跟 選單6  比較特別，獨立製表 手動放一筆資料進去
-->

