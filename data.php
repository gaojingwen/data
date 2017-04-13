<?php 
	//获取参数中传入的当前页的索引
	$pageIndex = $_GET["pageIndex"];
	//获取参数中传入的每页显示多少条
	$pageCount = $_GET["pageCount"];


	//模拟的数据的路径
	$file_path = "data.json";
	//判断数据文件是否存在
	if(file_exists($file_path)){
		//打开数据文件
		$fp = fopen($file_path,"r");
		//读取文件内容（读到的是json格式的字符串）
		$str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
		//把json格式的字符串转成php的数组
		$arr = json_decode($str);
		//获取数据总条数
		$count = count($arr);

		//根据页数和每页显示的数量算出来起始位置
		$start = ($pageIndex - 1) * $pageCount;
		// $end = $pageIndex * $pageCount >$count ? $count : $pageIndex * $pageCount;

		//截取数组中，从$start开始，长度为每页显示的数量
		$arr = array_slice($arr, $start, $pageCount);
		
		//设置返回的数据的格式
		header("Content-Type:text/json");

		//把截取到的数组封装到一个通用的对象中
		$result = array("code"=>200, "total"=>$count, "result"=>$arr);

		//返回数据
		echo json_encode($result);
	}

	// echo $pageIndex."==".$pageCount."==".$count;
 ?>