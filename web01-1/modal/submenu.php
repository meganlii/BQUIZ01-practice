<!-- 步驟1：移除<h3>上方程式碼 -->

<h3 style='text-align:center'>
  <!-- < ?= $str[$_GET['table']]['header']; ?> -->
  <!-- 步驟2：新增 編輯次選單 -->
  編輯次選單
</h3>

<hr>

<!-- 步驟3：測試是否可打開modal 出現錯誤訊息  移除多於變數15行 -->
<form action="./api/update.php" method="post" enctype="multipart/form-data">
  <div>
    <label>
      <!-- < ?= $str[$_GET['table']]['label']; ?>： -->
    </label>
    <input type="file" name="img">
  </div>

  <div>
    <input type="hidden" name="id" value="">
    <input type="hidden" name="table" value="<?= $_GET['table']; ?>">
    <input type="submit" value="更新">
    <input type="reset" value="重置">
  </div>
</form>

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

<!-- 步驟8
1. 第六個欄位有 按鈕-編輯次選單 到title複製onclick()
onclick="op('#cover','#cvr','./modal/update.php?id=<?= $row['id']; ?>&table=<?= $do; ?> ')">
2. 更名為 編輯次選單
3. 彈出視窗 獨立給一個檔案 submenu.php - 老師花半天說明原理
複製./modal/update.php 更名為 ./modal/submenu.php 
-->