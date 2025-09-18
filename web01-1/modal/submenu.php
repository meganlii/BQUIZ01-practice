<!-- 步驟0
1. 第六個欄位有 按鈕-編輯次選單 到title.php 複製onclick()
onclick="op('#cover','#cvr','./modal/update.php?id=< ?= $row['id']; ?>&table=< ?= $do; ?> ')">
2. 更名為 編輯次選單
3. 編輯功能/彈出視窗 獨立給一個檔案 submenu.php - 老師花半天說明原理
複製./modal/update.php 更名為 ./modal/submenu.php 

4. 編輯功能update.php 套用三個選單更新/更換功能 
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
<!-- 步驟4：修改表單格式 改用div寫  也可用table
1. 共3列 沒有label 最後列div不動  之前div用不到重寫 
2. 第一列：1個div包3個div 外層容器flex
3. 不是<table> <div width="45%">寫法失效 要改成
  <div style="width:45%">
4. 第二列：複製第一列  <div>裡面再包<input> input:btn/submit/reset三按鈕 出現value= 
input:text/checkbox 出現name= id=
-->
<form action="./api/submenu.php" method="post" enctype="multipart/form-data">
  
  <!-- 第一列
  1. 容器<div>設display:flex
  2. 盒子<div>設寬度與間距
  -->
  <div style="display:flex; margin:auto; width:70%" class="cent" >
    <div style="width:45%; margin:5px 0.5%" >次選單名稱</div>
    <div style="width:45%; margin:5px 0.5%" >次選單連結網址</div>
    <div style="width:10%; margin:5px 0.5%" >刪除</div>
  </div>

  <!-- 第二列 
  1. 盒子<div>裡面放<input>
  2. <input tyle="width:95%"> 塞滿整個div
  -->
  <div style="display:flex; margin:auto; width:70%" class="cent" >
    <div style="width:45%; margin:5px 0.5%" >
      <input type="text" value="" style="width:95%">
    </div>
    <div style="width:45%; margin:5px 0.5%"  >
      <input type="text" value="" style="width:95%">
    </div>
    <div style="width:10%; margin:5px 0.5%" >
      <input type="checkbox" value="" >
    </div>
  </div>  

  <!-- 第三列
  1. 盒子<div> 設定置中 class="cent"
  2. 修改按鈕名稱
  3. 新增按鈕 更多次選單
  -->
  <div class="cent">
    <input type="hidden" name="id" value="">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="修改確定">
    <input type="reset" value="重置">
    <input type="button" value="更多次選單">
  </div>
</form>

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

