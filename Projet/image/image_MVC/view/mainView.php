<!DOCTYPE>
<html>
	<head>
		<title>TP 3 IMAGE MVC</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="view/style.css" />
	</head>
	<body>
		<div id="entete">
			<h1>Site SIL3</h1>
		</div>
		<div id="menu">		
			<h3>Menu</h3>
			<ul>
				<?php

					foreach ($data->menu as $item => $act) {
						print "<li><a href=\"$act\">$item</a></li>\n";
					}
					?>
			</ul>
		</div>
		
		<div id="corps">
			<?php
			include $data->content;
			?>
		
		<div id="pied_de_page">
			
		</div>	   	   	
	</body>
</html>