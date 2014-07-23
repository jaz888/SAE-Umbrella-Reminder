<!DOCTYPE html>
<meta charset="utf-8"/>
<head>
	<title>天气预报退订</title>
</head>
<body>
	<?php
	if (isset($_GET['mobile']) && $_GET['mobile']!='') {
		$mobile = $_GET['mobile'];
		$mysql = new SaeMysql();
		$sql = "update `reg` set `unsub` = 1 where `mobile` = '".$mobile."'";
		$data = $mysql -> runSql($sql);
		$mysql -> closeDb();
                echo '退订成功';
	}
?>
	<form action="unsub.php">
		手机：
		<input type="text" name="mobile"/>
		<br/>
		<input type="submit" />
	</form>
</body>
</html> 
