<?php
define('APP_ID', basename(__DIR__));

const PROMPTS = [
	'app_name' => 'Enter the name of the app (e.g. "My Nextcloud App"): ',
	'author_name' => 'Enter your full name (or alias): ',
	'author_email' => 'Enter your email: ',
	'orgname' => 'Orgname/alias (used in package name: org/' . APP_ID . '): ',
];

const PROMPT_NAMES = [
	'app_id' => 'App ID (generated from directory name)',
	'namespace' => 'Namespace (camelcase version of app_id)',
	'app_name' => 'App name',
	'author_name' => 'Author name',
	'author_email' => 'Author email',
	'orgname' => 'Organisation/alias',
];

function to_camel_case(string $string): string {
	$bits = explode('_', $string);
	$camelString = '';
	foreach ($bits as $bit) {
		$bit[0] = strtoupper($bit[0]);
		$camelString .= $bit;
	}

	return $camelString;
}

function replace_composer_json() {
	$content = file_get_contents(__DIR__ . '/nc_composer.txt');
	if ($content === false) {
		echo "Error: could not read nc_composer.txt" . PHP_EOL;
		exit();
	}

	$result = file_put_contents(__DIR__ . '/composer.json', $content);
	if ($result === false) {
		echo "Error: could not write to composer.json";
		exit();
	}

	unlink(__DIR__ . '/nc_composer.txt');
}

function get_files_recursive(string $dir): array {
	$children = scandir($dir);
	$files = [];
	$dirs_content = [];
	foreach ($children as $child) {
		if ($child[0] === '.' || $child === 'vendor' || $child === 'node_modules') {
			continue;
		}

		$childPath = "$dir/$child";
		if (is_dir($childPath)) {
			$dirs_content[] = get_files_recursive($childPath);
		}

		$ext = pathinfo($child, PATHINFO_EXTENSION);
		if (is_file($childPath) && in_array($ext, ['php', 'xml', 'json', 'js', 'ts'], true)) {
			$files[] = $childPath;
		}
	}

	return array_merge($files, ...$dirs_content);
}

function prompt_request_details(): array {
	$data = [
		'app_id' => APP_ID,
		'namespace' => to_camel_case(APP_ID)
	];

	foreach (PROMPTS as $key => $prompt) {
		$result = null;

		while (!$result) {
			$result = readline($prompt);
		}

		$data[$key] = $result;
	}
	echo PHP_EOL;

	return $data;
}

function prompt_validate_app_id() {
	echo "Nextcloud will expect the directory name to match the app's ID." . PHP_EOL;
	echo "App ID: " . APP_ID . PHP_EOL;

	preg_match("/[a-z]+[a-z0-9_]*[a-z0-9]+/", APP_ID, $matches);
	if (strlen($matches[0] ?? '') !== strlen(APP_ID)) {
		echo PHP_EOL . "ERROR! \nThe current directory contains some characters that are not be adequate for an ID." . PHP_EOL;
		echo 'Hint: app IDs can only contain alphanumeric characters and underscores, and cannot start with a number.' . PHP_EOL;
		exit();
	}

	echo "If you would like to change the app's ID exit this script and rename the directory." . PHP_EOL;

	$continue = null;
	while ($continue === null) {
		echo PHP_EOL;
		$response = strtolower(readline("Are you happy with the ID: '" . APP_ID . "'? (y/N) "));

		if (($response[0] ?? '') === 'y') {
			$continue = true;
		} elseif (($response[0] ?? '') === 'n') {
			$continue = false;
		}
	}

	if (!$continue) {
		exit();
	}
}


function confirm_details(array $details): bool {
	echo "You have submitted the following details:" . PHP_EOL;
	foreach ($details as $key => $value) {
		echo "  " . PROMPT_NAMES[$key] . " = $value" . PHP_EOL;
	}
	echo PHP_EOL;

	while (true) {
		$input = strtolower(readline('Are the details correct? (y/N) '));
		$input = $input ?: ' ';

		if ($input[0] === 'y') {
			return true;
		}

		if ($input[0] === 'n') {
			$input = strtolower(readline('Do you want to redo the questions? (y/N)'));
			if ($input[0] === 'y') {
				return false;
			}
		}
	}
}

function inflate_details($file, array $details) {
	$contents = file_get_contents($file) ?: null;

	foreach ($details as $key => $detail) {
		$regex = "/\{\{ *$key *}}/";
		$contents = preg_replace($regex, $detail, $contents ?? '');
	}

	if ($contents === null) {
		echo "Error while reading and inflating file: '$file'" . PHP_EOL;
	}

	$result = file_put_contents($file, $contents);
	if ($result === false) {
		echo "Error writing to file: '$file'" . PHP_EOL;
	}
}


/**
 * Initiation script for the Nextcloud APP
 * This script will delete itself after running.
 */

// Replace composer json with template one
replace_composer_json();

// Check app ID
prompt_validate_app_id();

// Get app details from user
$correct = false;
$details = [];
while ($correct !== true) {
	$details = prompt_request_details();
	$correct = confirm_details($details);
}

// Replace values in files
$files = get_files_recursive(__DIR__);
foreach ($files as $file) {
	inflate_details($file, $details);
}

// Delete init.php
echo PHP_EOL . "Project initiated, init.php will now be deleted..." . PHP_EOL . PHP_EOL;
unlink(__FILE__);

echo "All set, happy coding! :)" . PHP_EOL;
