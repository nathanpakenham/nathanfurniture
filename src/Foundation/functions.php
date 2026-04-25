<?php

function e($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function checkEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}

	return false;
}

function sanitize($string)
{
	$string = trim($string ?? '');
	$string = preg_replace('/[\x00-\x1F\x7F<>{}()]/', '', $string);
	$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
	return preg_replace('/\s+/', ' ', $string);
}

function getBaseFileName()
{
	return basename(strtok($_SERVER['REQUEST_URI'], '?'));
}

function savePostToSession($post)
{
	$_SESSION['post'] = ['_uri' => $_SERVER];
	foreach ($post as $key => $value) {
		$_SESSION['post'][$key] = $value;
	}
}
