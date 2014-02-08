<?
	require_once 'src/rude.php';

	$rude = new rude();
	$fb2  = new rude\fb2();
?>
<html>
<head>
	<link href="css/style.css" rel="stylesheet" type="text/css" />

	<script type="text/javascript" src="./js/jquery-1.10.2.min.js"></script>
</head>

<body>
	<div id="container">
		<h2>FB2 parser</h2>

		<div id="options">
			<h3>Total files</h3>
			<?
				$file_list = $fb2->scan();

				foreach ($file_list as $file)
				{
					$rude->debug($file);
				}
			?>

			<h3>Content</h3>
			<?
				foreach ($file_list as $file)
				{
					$fb2->read($file);
					$fb2->parse();

//					$rude->debug($fb2->parse());


					?>
						<label for="content"></label>
<!--						<textarea id="content">--><?//= $fb2->content() ?><!--</textarea>-->
					<?
				}
			?>
		</div>

	</div>
</body>
</html>