<?php

// dump taxa

require_once(dirname(__FILE__) . '/adodb5/adodb.inc.php');

//--------------------------------------------------------------------------------------------------
$db = NewADOConnection('mysql');
$db->Connect("localhost", 
	'root','', 'ibol');

// Ensure fields are (only) indexed by column name
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$count = 1;

$page = 1000;
$offset = 0;

$result = $db->Execute('SET max_heap_table_size = 1024 * 1024 * 1024');
$result = $db->Execute('SET tmp_table_size = 1024 * 1024 * 1024');

$done = false;

$keys = array('taxonID', 'acceptedNameUsageID', 'phylum', 'class', 'order', 'family', 'subfamily', 'genus', 
'specificEpithet', 'infraspecificEpithet', 'scientificName', 'taxonRemarks',
'references' );
echo join("\t", $keys) . "\n";

while (!$done)
{
	$sql = 'SELECT * FROM `bins` ORDER BY bin LIMIT ' . $page . ' OFFSET ' . $offset;
	
	// $sql = 'SELECT * FROM `bins` WHERE bin="BOLD:AAC0067"';
	// $sql = 'SELECT * FROM `bins` WHERE genus="Sorex"';

	$result = $db->Execute($sql);
	if ($result == false) die("failed [" . __FILE__ . ":" . __LINE__ . "]: " . $sql);

	while (!$result->EOF && ($result->NumRows() > 0)) 
	{	
		if ($result->fields['phylum'] != '')
		{
			$obj = new stdclass;
			$syn = null;
			
			$taxonID = $result->fields['bin'];
			
			//$obj->taxonID = $result->fields['bin'];
			$obj->taxonID = $count;
			
			$obj->acceptedNameUsageID = '';
			
			$obj->references = 'http://www.boldsystems.org/index.php/Public_BarcodeCluster?clusteruri=' . $result->fields['bin'];

			$obj->taxonRemarks = array();
			$obj->scientificName = '';
			
			$taxon_keys = array('phylum', 'class', 'order', 'family', 'subfamily', 'genus', 'species', 'subspecies');
						
			$obj->stop = false;
			
			foreach ($taxon_keys as $key)
			{
				$value = '';
				$dwc_key = $key;
				
				if ($result->fields[$key] != '')
				{
					// Stopping rules
					if (!$obj->stop)
					{
						// Multiple names associated with BIN
						if (preg_match('/;/', $result->fields[$key]))
						{
							$obj->stop = true;
						}
						
						// Name not Linnean
						switch ($key)
						{
							case 'genus':
								if (preg_match('/^[a-z]/', $result->fields[$key]))
								{
									$obj->stop = true;
								}
								break;

							case 'species':
								if (preg_match('/\d+/', $result->fields[$key]))
								{
									$obj->stop = true;
								}
								break;
								
							default:
								break;
						}						
						
						// we don't have a proper name
						if ($obj->stop)
						{
							$obj->taxonID = $taxonID;
							$obj->scientificName = $obj->taxonID;
							
						}
					}

					if ($obj->stop)
					{
						$obj->taxonRemarks[] = $result->fields[$key];	
					}
					else
					{
						$value = $result->fields[$key];
						
						switch ($key)
						{
							case 'species':
								$obj->scientificName = $value;
								$parts = explode(' ', $value);
								$value = $parts[1];
								$dwc_key = 'specificEpithet';
								break;
						
							case 'subspecies':
								$obj->scientificName = $value;						
								$parts = explode(' ', $value);
								$value = $parts[2];
								$dwc_key = 'infraspecificEpithet';
								break;
								
							default:
								$obj->scientificName = $value;
								break;
						}
						
						
					}
				}
				$obj->{$dwc_key} = $value;
			}
			
			if ($obj->stop)
			{
			}
			else
			{
				// we do have a name
				$syn = new stdclass;
				foreach ($keys  as $k)
				{
					$syn->{$k} = '';
				}
				$syn->taxonID = $taxonID;
				$syn->acceptedNameUsageID = $count;
				$syn->scientificName = $taxonID;
						
				$count++;
			}
		
			// dump data
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

			if ($syn)
			{
				$row = array();
				foreach ($keys as $k)
				{
					$row[] = $syn->{$k};
				}
				echo join("\t", $row) . "\n";
			}			

		
			
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
		//if ($offset > 10) { $done = true; }
	}
}

?>