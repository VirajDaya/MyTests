<?php

//RAPID-1542_2 First Change after 949ca13772b7fb03ac35358b96515e244083590c RAPID-1540_2 : First Commit (Common) & e86aa560e13e2c997eae922c45c32bf8643e0354 (RAPID-1541_2 : First Commit after 949ca13772b7fb03ac35358b96515e244083590c) 

$string = "This is a html string<br />
Hi Mr Albert Lim. This question is a bit old but I<br />Let's look at the marco level. 200 years ago Sing<br />
<br />Then you have factors at the mirco level, locatio<br />Next legislative regulations. Comparing a landed<br />Landed Properties
<br />-Residental Property Act. Only Singaporeans can p<br />";

echo extension_loaded('tidy') ? "LOADED" : "NOT LOADED<br />";
echo "Original => <br />";
echo $string;


echo "<br/> ------------------------------------------------------------ <br />";
echo "Changed => <br />";
echo sanitizeHTMLInput($string);




function sanitizeHTMLInput($text)
{
	// tidy add a new line break after each <br>, we don't want it
	$text = preg_replace('/(<br\ ?\/?>)+/', '{#br-holder#}', $text);
	$tidy = new tidy;
	$tidy->parseString($text, array('show-body-only' => true, 'wrap' => 0, 'indent' => false, 'indent-spaces' => 0), 'utf8');
	$tidy->cleanRepair();
	$text = str_replace('{#br-holder#}', '<br />', $tidy);

	$doc = new DOMDocument();
	$doc->loadHTML('<meta http-equiv="content-type" content="text/html; charset=utf-8">'.$text);

	foreach($doc->getElementsByTagName('*') as $node)
	{
		$node->removeAttribute('style');
	}
	$text = $doc->saveHTML();
	$allowed_user_tags = '<br><a><strong><b><i><u>';
	$text = strip_tags($text, $allowed_user_tags);

	return $text;
}