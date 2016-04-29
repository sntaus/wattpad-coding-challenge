<?php
$hrPhrasesFile = "low_risk_phrases.txt"; // Filename of file containing high-risk phrases
$lrPhrasesFile = "high_risk_phrases.txt"; // Filename of file containing low-risk phrases
$inputFiles = glob("input??.txt"); // Getting list of all input files in the directory
$outputFile = "output.txt"; // Output file 

$highRiskPhrases = file_get_contents($hrPhrasesFile); // Get the high-risk phrases as a string
$lowRiskPhrases = file_get_contents($lrPhrasesFile); // Get the low-risk phrases as a string
$hrp = explode("\n", $highRiskPhrases); // Create an array for all high-risk phrases
$lrp = explode("\n", $lowRiskPhrases); // Create an array for all low-risk phrases

$outputStr = ""; // This is the output content to be written into the output file

foreach($inputFiles as $inputFile) {

	$score = 0;
	$curInput = file_get_contents($inputFile);

	// Iterate through all high-risk phrases
	foreach ($hrp as $hr) {
		$count = substr_count($curInput, $hr); // Count the number of occurrences of the phrase
		if($count > 0){
			$score += (2 * $count); // Add 2 to score for every occurrence of the high-risk phrase
		}	
	}

	// Iterate through all low-risk phrases
	foreach ($lrp as $lr) {
		$count = substr_count($curInput, $lr); // Count the number of occurrences of the phrase
		if($count > 0) {
			$score += $count; // Add 1 to score for every occurrence of the low-risk phrase
		}	
	}

	$outputStr .= $inputFile . ":" . $score . "\n"; // Use format <input-file-name>:<score>\n
}

file_put_contents($outputFile, $outputStr); // Write the output content to file
echo $outputStr; // Print output content to screen

