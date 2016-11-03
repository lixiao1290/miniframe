<?php
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>hello</title>
<?php $this->head();  ?>
</head>

<body>
	<p></p>
	<div style="text-align: center;"><?=$suc;?></div>
	<div style="text-align: center;">
	<?php foreach ($list as $row):?>
	<font style="color: olive;"><?php echo $row?></font>
	<?php endforeach;?>
	</div>
	
	<div >
	
	<?php    $this->view('layout/left') ?>
	<?php      $this->body(); ?>
</body>

</html>
