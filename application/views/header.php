<!--The following is required by bootstrap.-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Bootstrap requires that the encoding be UTF-8-->
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1"
		/>
		
		<title><?php echo $title; ?></title>
		<link
		    rel="stylesheet"
		    type="text/css"
		    href="<?php echo base_url() . 'assets/bootstrap-3.1.1-dist/css/bootstrap.css'; ?>"
		/>
		<!-- We need to add padding to the body. -->
		<style>
			body {
				padding-bottom: 70px;
			}
			label {
				padding: 10px;
			}
		</style>
	</head>
	<body>
