<?php

function config(string $file, string $value = ''): mixed
{
	$path = CONFIG . '/' . $file . '.php';

	if (file_exists($path)) {
		$file = include $path;
		if (!$value) return $file;
		return $file[$value] ?? null;
	}
	return null;
}


function dotNotation(string $path): string
{
	return str_replace('.', '/', $path) . '.php';
}