<?php
// Author: Zhengfourth <https://github.com/Zhengfourth>
$user = $_GET['user'];
$badgehd = 'Location:https://img.shields.io/badge/';
set_time_limit(600);
$mainUrl = 'https://ch.tetr.io/api/users/*/summaries';
$ratingr = getData(str_replace('*', $user, $mainUrl));  //获取json数据并转换为数组

// var_dump($ratingr);

$timeo = 1;
$styleraw = '?longCache=true&style=*';

if (isset($_GET['style']))
	//是否使用自定义style
	$style = str_replace('*', $_GET['style'], $styleraw); //替换
else
	$style = '?longCache=true&style=for-the-badge';  //默认是for-the-badge
if (isset($_GET['st'])) //自定义style缩写，不可重用
	$style = array(
		'f1' => '?longCache=true&style=flat',
		'f2' => '?longCache=true&style=flat-square'
	)[$_GET['st']];

function getData($url) {
	$headers = array();
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 600);
	$result = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);
	return $result;
}

$league = $ratingr['data']['league'];
$ratstr = $league['tr'];   //从数组中提取字符串rating
$rating = intval($ratstr);    //转换为数字
if ($rating == -1) { // 特判没打满10场
	$win = $league['gameswon'];
	$play = $league['gamesplayed'];
	$rating = $win . '/' . $play;
}

$name = $league['rank'];
if($name == 'z')
	$name = '%3F';
$rankingColors = array_merge(	//	颜色表
	array(
		$name => 'black'
	), array(
		'x+' => 'a763ea',
		'x' => 'ff45ff',
		'u' => 'ff3813',
		'ss' => 'db8b1f',
		's+' => 'd8af0e',
		's' => 'e0a71b',
		's-' => 'b2972b',
		'a+' => '1fa834',
		'a' => '46ad51',
		'a-' => '3bb687',
		'b+' => '4f99c0',
		'b' => '4f64c9',
		'b-' => '5650c7',
		'c+' => '552883',
		'c' => '733e8f',
		'c-' => '79558c',
		'd+' => '8e6091',
		'd' => '907591',
		'%3F' => '375433'
	)
);
$color = $rankingColors[$name];

$tetrioIcon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB+gKBAQhBH/qxZ8AAADNSURBVEjHY7zvt+o/AwlAcVMYIynqWRhIB4JEqvvDwMDwmRwL+IlU95YsH7CysgoQUvP79+8PDAwMjAxQgoWBgYGXgYGBn5WVVeCW59LzyIrVtkcb4jNMoGfGeXzyTAw0BkPfAoxIfvgJlV8ZdQ8ljDd+Oo4if60ENY7Q42Q0DkYtGIr5gFSg5YNadl0riTaEFnZvGRgYPtPSB4xDPg7+kxUH17bgrx/Qg4gFS01EqLb6CHMdPoOx+eAjkS77QKoP/jAwMLwnIZRIUcsAAJ/BNyyEoc+UAAAAAElFTkSuQmCC';
$style = $style . '&logo=' . $tetrioIcon . '&link=https://ch.tetr.io/u/' . $user;
$rawc1 = str_replace('_', '__', $user);
$rawc2 = str_replace('-', '--', $rawc1);
$name = str_replace('-', '--', $name);
$rawr = $badgehd . $rawc2 . '-' . $name . '  ' . $rating . '-' . $color . $style;
header($rawr); //拼接并输出（修复下划线转义bug）

?>
