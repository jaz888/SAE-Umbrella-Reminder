<?php
//重置客户数据，每天凌晨运行一次
$mysql = new SaeMysql();
$sql = "update `reg` set `today`=0";
$data = $mysql->runSql($sql);
$mysql->closeDb();
echo '重置成功';
?>
