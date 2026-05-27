<!DOCTYPE html>
<html lang="ro">
<head>
<title>CHANGELOG.md validation</title>
<link rel="stylesheet" href="index.css">
</head>
<body>
<?php
/**
 * Outputs an error to the browser and dies.
 * @param string $description description of the error
 */
function outputError(string $description):void {
	echo '<div id="errorMessage">Error: '
 		.htmlspecialchars($description)
		.'</div><div id="errorFloatingIndicator">Errors detected</div></body></html>';
	die();
}
$content = file_get_contents('../../../CHANGELOG.md');
$featureGroup = [
	'Fixed',
	'Changed',
	'Added',
	'Breaking Changes',
	'Migration',
	'Removed'
];
$previousVersion = NULL;
$previousDate = NULL;
$today = date('Y-m-d');
foreach (explode(PHP_EOL, $content) as $rawLine) {
	echo '<br>'.htmlspecialchars($rawLine);
	$line = trim($rawLine);
	if ($line === '') {
		continue;
	}
	$lineType = 'regular';
	if ($lineType === 'regular') {
		if (substr($line, 0, 4) === '### ') {
			$lineType = 'featureGroup';
		}
	}
	if ($lineType === 'regular') {
		if (substr($line, 0, 3) === '###') {
			outputError('Missing space after ###');
			break;
		}
	}
	if ($lineType === 'regular') {
		if (substr($line, 0, 3) === '## ') {
			$lineType = 'versionData';
		}
	}
	if ($lineType === 'regular') {
		if (substr($line, 0, 2) === '##') {
			outputError('Missing space after ##');
			break;
		}
	}
	switch ($lineType) {
		case 'regular':
			// just a regular line, doing nothing
			break;
		case 'featureGroup':
			if (!in_array(substr($line, 4), $featureGroup)) {
				outputError('Unknown feature '.$line);
			}
			break;
		case 'versionData':
			// ## [M.m.p] - YYYY-MM-DD
			if (substr($line, 0, 4) !== '## [') {
				outputError('Invalid format, expected "## [" ');
			}
			// checking version
			$version = substr($line, 4, strpos($line, ']') - 4);
			if (strlen($version) < 5) {
				outputError('Invalid version: '.$version);
			}
			$versionComponents = explode('.', $version);
			if (count($versionComponents) !== 3) {
				outputError('Invalid version: '.$version);
			}
			foreach ($versionComponents as $component) {
				if (!ctype_digit($component)) {
					outputError('Invalid version: '.$version);
				}
			}
			// checking if this version number is older than the previous newer one
			if ($previousVersion !== NULL) {
				$versionError = false;
				if ($versionComponents[0] > $previousVersion[0]) {
					$versionError = true;
				}
				if ($versionComponents[0] === $previousVersion[0]) {
					if ($versionComponents[1] > $previousVersion[1]) {
						$versionError = true;
					}
					if ($versionComponents[1] === $previousVersion[1]) {
						if ($versionComponents[2] >= $previousVersion[2]) {
							$versionError = true;
						}
					}
				}	
				if ($versionError) {
					outputError('Version number mismatch compared to the one above: '.$version);
				}
			}
			$previousVersion = $versionComponents;
			// checking date
			$date = substr($line, strpos($line, ']') + 4);
			$dateComponents = explode('-', $date);
			if (count($dateComponents) !== 3) {
				outputError('Invalid version date: '.$date);
			}
			foreach ($dateComponents as $component) {
				if (!ctype_digit($component)) {
					outputError('Invalid version date: '.$date);
				}
			}
			$year = (int) $dateComponents[0];
			$month = (int) $dateComponents[1];
			$day = (int) $dateComponents[2];
			
			if (($year < 2025) || ($year > 2099)) {
				outputError('Invalid version year: '.$dateComponents[0]);
			}
			if (($month < 1) || ($month > 12)) {
				outputError('Invalid version month: '.$dateComponents[1]);
			}
			if (($day < 1) || ($day > 31)) {
				outputError('Invalid version day: '.$dateComponents[2]);
			}
			if ($previousDate !== NULL) {
				if ($date >= $previousDate) {
					outputError('Version date mismatch compared to the one above: '.$date);
				}
			}
			if ($date > $today) {
				outputError('Version date in future: '.$date);
			}
			$previousDate = $date;
			break;
		default:
			outputError('Unknown '.$lineType);
	}
}
?>
</body>
</html>
