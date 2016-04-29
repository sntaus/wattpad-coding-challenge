<?php
$hrPhrasesFile = "low_risk_phrases.txt";
$lrPhrasesFile = "high_risk_phrases.txt";
$inputFiles = glob("input??.txt");
$outputFile = "output.txt";

$highRiskPhrases = file_get_contents($hrPhrasesFile);
$lowRiskPhrases = file_get_contents($lrPhrasesFile);
$hrp = explode("\n", $highRiskPhrases);
$lrp = explode("\n", $lowRiskPhrases);

$outputStr = "";

foreach($inputFiles as $inputFile) {

	$score = 0;
	$curInput = file_get_contents($inputFile);

	foreach ($hrp as $hr) {
		if(strpos($curInput, $hr) !== false){
			$score += 2;
		}	
	}

	foreach ($lrp as $lr) {
		if(strpos($curInput, $lr) !== false) {
			$score++;
		}	
	}

	$outputStr .= $inputFile . ":" . $score . "\n";
}

file_put_contents($outputFile, $outputStr);
echo $outputStr;

