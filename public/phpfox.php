<?php

error_reporting(E_ALL);

$memory = @ini_get('memory_limit');

$requirements = [
	'PHP Version' => [version_compare(PHP_VERSION, '5.4', '>='), 'Your servers PHP version is ' . PHP_VERSION . '. We require 5.4 or higher.'],
	'PHP EXEC Function' => [function_exists('exec'), 'Missing PHP function "exec"'],
	'PHP GD' => [(extension_loaded('gd') && function_exists('gd_info')), 'Missing PHP library GD'],
	'PHP CURL' => [(extension_loaded('curl') && function_exists('curl_init')), 'Missing PHP library CURL'],
	'PHP Multibyte String' => [function_exists('mb_strlen'), 'Missing PHP library Multibyte String'],
	'PHP XML extension' => [extension_loaded('xml'), 'Missing PHP library XML'],
	'PHP memory_limit' => [($memory == '-1' ? true : version_compare($memory, '64', '>=')), 'Your servers memory limit is ' . $memory . '. We require 64MB or higher.']
];

?>
<html>
	<head>
		<title>PHPfox Requirement Check</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<a class="navbar-brand" href="http://www.phpfox.com/">PHPfox</a>
		</div>
	</nav>
		<div class="container">
			<h1>Requirement Check</h1>
			<table class="table">
<?php

foreach ($requirements as $name => $values) {
	$message = '<p class="text-danger">Failed</p><p>' . $values[1] . '</p>';
	$class = 'danger';
	if ($values[0]) {
		$message = '<p class="text-success">Passed</p>';
		$class = '';
	}
	echo '<tr class="' . $class . '">';
	echo '<td>' . $name . '</td><td>' . $message . '</td>';
	echo '</tr>';
}

?>
			</table>
		</div>
	</body>
</html>
