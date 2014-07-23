<?php
//执行短信发送，每运行一次执行一个客户的发送任务，多个客户需要运行多次

header("Content-Type:text/html;charset=utf-8");
$mysql = new SaeMysql();
$sql = "select `nick`,`cityId`,`mobile`,`type` from `reg` where `today`=0 and `unsub`=0 limit 1";
$data = $mysql -> getData($sql);
$mysql -> closeDb();
if (!$data) {
	exit('没有找到待发送的任务<br/>');
}
$cityId = $data[0]['cityId'];
$nick = $data[0]['nick'];
$mobile = $data[0]['mobile'];
$type = $data[0]['type'];

$url = 'http://m.weather.com.cn/data/' . $cityId . '.html';
$json = file_get_contents($url);
$json = get_object_vars(json_decode($json));
$json = get_object_vars($json['weatherinfo']);
$todayWeah = $json['weather1'];
$tomorrowWeah = $json['weather2'];
$tomorrowTemp = $json['temp2'];

if ($type == 1) {
	if (strpos($tomorrowWeah, '雨')) {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，请携带雨具~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	} elseif (strpos($tomorrowWeah, '雪')) {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，请注意保暖~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	} elseif (strpos($tomorrowWeah, '晴')) {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，注意防晒哦~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	} else {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，天气不错哦~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	}
} elseif ($type == 2) {
	if (strpos($todayWeah, '晴') && strpos($tomorrowWeah, '雨')) {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，请携带雨具~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	} elseif (strpos($todayWeah, '晴') && strpos($tomorrowWeah, '雪')) {
		$sms = apibus::init("sms");
		$mobile = $mobile;
		$msg = $nick . '，您好！明天' . $tomorrowWeah . '，温度' . $tomorrowTemp . '，请注意保暖~';
		echo $msg . '<br/>';
		$obj = $sms -> send($mobile, $msg, "UTF-8");
		print_r($obj);

		if ($sms -> isError($obj)) {
			print_r($obj -> ApiBusError -> errcode);
			print_r($obj -> ApiBusError -> errdesc);
		}
	}else {
		echo "没有消息发送";
	}
}

$mysql = new SaeMysql();
$sql = "update `reg` set `today`=1 where `nick`='{$nick}' and `mobile`='{$mobile}' and `cityId`='{$cityId}'";
$data = $mysql -> runSql($sql);
$mysql -> closeDb();
?>
