<?php
require_once 'app/init.php';
if (isset ($_GET['q'])) {
   $q = $_GET ['q'];
// Search:
$params = array(
    'index' => 'my_app',
    'type'  => 'blog_post'
);
$params['body']['query']['match']['title'] = 'elasticsearch';
$results = $es->search($params);
?>
<!DOCTYPE php>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Elastic Search</title>

	</head>
	<body>
		<form action="index.php" method= "get" autocomplete="off">
			<Label>
				Search Tweets Timeline 
				<input type="text" name="q">
			</Label>
			<input type="submit" value="Search">
		</form>
	</body>
</html>