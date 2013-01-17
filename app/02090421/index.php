<?php
require_once "MyList.class.php";
$mylist=new MyList();
?>
<?php
require "div/head.div.php";
?>
<body>
<div id="container">
	<?php require "div/mainTitle.div.php";?>
	<?php require "div/banner.div.php";?>
	<?php require "div/navigation.div.php";?>
	<div id="content">
		<div id="labels">
			<?php require "div/loginLabel.div.php";?>
			<?php require "div/tinyListLabel.div.php";?>
			<?php require "div/giftLabel.div.php";?>
		</div>
		<!-- end of left panel -->
		
		<div id="articles">
			<?php require "div/welcome.index.div.php";?>
			<div class="articlesBox">
				<h1>这只是简单的许愿</h1>
				<?php echo $mylist->indexList();?><p><a href="list.php">查看所有</a></p></div>
		</div>
		<!-- end of right panel --> 
		
	</div>
	<!-- end of content -->
	<div id="contentBottom"> </div>
	<?php require "div/copyright.div.php";?>
</div>
<!-- end of container -->
</body>
</html>