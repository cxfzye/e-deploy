<?php
return [
	'APP_DEBUG' => env('APP_DEBUG', true), //直接受ENV文件控制

	'database' => require __DIR__ . '/database.php',
];
