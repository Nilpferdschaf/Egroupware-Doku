<?php 
$back_link="../";
$forw_link="../";
$back_text="";
$forw_text="";
$title="";
?>

<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>Writing Apps for EGroupware: <?php echo $title;?></title>
</head>
<body id="top">
	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
	<a class="back" href="index.php">Back to Index</a>



	<a class="back" href="#top">^ Back to top</a>
	
	<div class="navigation">
		<a class="prev" href="<?php echo $back_link;?>">&lt; <?php echo $back_text;?></a><a
			class="next" href="<?php echo $forw_link;?>"><?php echo $forw_text;?> &gt;</a>
	</div>
</body>
</html>