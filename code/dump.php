<?php

// dump taxa

require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	'root','', 'ibol');

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$count = 0;

$page = 1000;
$offset = 0;

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$mode = 0;

$done = false;

$keys = array('taxonID', 'phylum', 'class', 'order', 'family', 'subfamily', 'genus', 'specificEpithet', 'infraspecificEpithet', 'scientificName', 'taxonRank', 'taxonRemarks' );
echo join("\t", $keys) . "\n";

while (!$done)
{
	$sql = 'SELECT * FROM `bins` ORDER BY bin LIMIT ' . $page . ' OFFSET ' . $offset;

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		if ($result->fields['phylum'] != '')
		{
			$obj = new stdclass;
			$obj->taxonID = $result->fields['bin'];


			$obj->taxonRemarks = array();
			$obj->rank = 'species';
			$obj->scientificName = '';

			
			$taxon_keys = array('phylum', 'class', 'order', 'family', 'subfamily', 'genus', 'species', 'subspecies');
			
			$obj->stop = false;
			
			foreach ($taxon_keys as $key)
			{
				$value = '';
				$dwc_key = $key;
				
				if ($result->fields[$key] != '')
				{
					if (!$obj->stop)
					{
						if (preg_match('/;/', $result->fields[$key]))
						{
							$obj->stop = true;
						}
					}

					if ($obj->stop)
					{
						$obj->taxonRemarks[] = $result->fields[$key];
					}
					else
					{
						$value = $result->fields[$key];
						if ($key == 'species')
						{
							$obj->scientificName = $value;
							$parts = explode(' ', $value);
							$value = $parts[1];
							$dwc_key = 'specificEpithet';
							
							
						}
						if ($key == 'subspecies')
						{
							$obj->scientificName = $value;						
							$parts = explode(' ', $value);
							$value = $parts[2];
							$obj->rank = 'subspecies';
							$dwc_key = 'infraspecificEpithet';

						}
					}
				}
				$obj->{$dwc_key} = $value;
			}

		
			if ($mode == 0)
			{
			/*
				if ($count == 0)
				{
					$headings = array(
						'taxonID', 
						'phylum',
						'class',
						'order',
						'family',
						'subfamily',
						'genus',
						'scientificName',
						'remarks'
					);
					
					echo join ("\t", $headings) . "\n";		
	
				}		
		
				echo join ("\t", $taxon_row) . "\n";
			 */
			 	//print_r($obj);
			 
			
				$row = array();
				foreach ($keys as $k)
				{
					switch ($k)
					{
						case 'taxonRemarks':
							$row[] = join(" | ", $obj->{$k});
							break;
							
						default:
							$row[] = $obj->{$k};
							break;
					}
				}
				echo join("\t", $row) . "\n";
			
			}


		
			$count++;
		}

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
		if ($offset > 1000) { $done = true; }
	}
}

?>