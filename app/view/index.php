
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>

<body>
	<p></p>
	<div style="text-align: center;"><?=$suc;?></div>
	<div style="text-align: center;">
	<?php foreach ($list as $row):?>
	<font style="color: olive;"><?php echo $row?></font>
	<?php endforeach;?>
	</div>
</body>

</html>