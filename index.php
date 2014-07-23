<!DOCTYPE html>
<meta charset="utf-8"/>
<head>
	<title>天气预报预定</title>
</head>
<body>
	<?php
	if (isset($_GET['city']) && isset($_GET['mobile'])) {
		if (!isset($_GET['nick']) || $_GET['nick'] != '') {
			$nick = $_GET['nick'];
		} else {
			$nick = '亲';
		}

		$city = $_GET['city'];
		$mobile = $_GET['mobile'];
		$type = $_GET['type'];

		$mysql = new SaeMysql();
		$sql = "select `cityId` from `city` where `city` = '{$city}'";
		$data = $mysql -> getData($sql);
		if (!$data) {
			echo('没有找到城市<br/>');
		} else {
			$cityId = $data[0]['cityId'];
			$mysql = new SaeMysql();
			$sql = "select `unsub` from `reg` where `cityId` = '{$cityId}' and `mobile` = '{$mobile}' and `type` = '{$type}'";
			$vali = $mysql -> getData($sql);
			if ($vali[0]['unsub']==1) {
                          	$sql = "update `reg` set `unsub` = 0 where `cityId` = '{$cityId}' and `mobile` = '{$mobile}' and `type` = '{$type}'";
				$datacxdy = $mysql -> runSql($sql);
				echo('已经重新订阅<br/>');
			} elseif ($vali[0]['unsub']==0) {
				echo('已经订阅过<br/>');
			} else{
				$sql = "insert into `reg`(`nick`,`cityId`,`mobile`,`type`) values ('{$nick}','{$cityId}','{$mobile}','{$type}')";
				$mysql -> runSql($sql);
				echo '注册成功<br/>';
			}
		}
		$mysql -> closeDb();
	}
?>
	<form action="index.php">
		昵称：
		<input type="text" name="nick"/>
		<br/>
		城市：
		<input type="text" name="city"/>
		<br/>
		手机：
		<input type="text" name="mobile"/>
		<br/>
		<select name="type">
			<option value="2" selected>雨雪提醒</option>
			<option value="1">每天一条</option>
		</select>
		<input type="submit" />
	</form>
  <br/>
  每天一条：每天傍晚收到明天的天气预报<br/>
  雨雪提醒：如果明天下雨或下雪，当天傍晚收到短信提醒携带雨具
  <br/>
  <br/>
  <a href="http://php4me.sinaapp.com/tq/unsub.php">退订</a>
</body>
</html> 
