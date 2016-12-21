<?php

// dump taxa

require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	'root','', 'ibol');

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$db->EXECUTE("set references_unique 'utf8'"); 


$count = 0;

$page = 1000;
$offset = 0;

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$mode = 0;

$done = false;

$keys = array('taxonID', 'identifier', 'bibliographicCitation' );

echo join("\t", $keys) . "\n";

while (!$done)
{
	$sql = 'SELECT bins.bin, `references_unique`.doi, `references_unique`.reference
FROM bins
INNER JOIN `references` USING(bin)
INNER JOIN `references_unique` USING(guid)
WHERE `references_unique`.doi IS NOT NULL
 LIMIT ' . $page . ' OFFSET ' . $offset;

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		echo $result->fields['bin'] . "\thttp://doi.org/" . $result->fields['doi'] . "\t" .  str_replace("\t", " ", utf8_encode($result->fields['reference'])) . ' doi:' .  $result->fields['doi'] . "\n";
		$result->MoveNext();
	}
	
	//echo "-------\n";
	
	if ($result->NumRows() < $page)
	{
		$done = true;
	}
	else
	{
		$offset += $page;		
		//if ($offset > 1000) { $done = true; }
	}
}

?>