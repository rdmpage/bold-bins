<?php

require_once (dirname(__FILE__) . '/lib.php');
require_once (dirname(__FILE__) . '/simplehtmldom_1_5/simple_html_dom.php');


function reference_from_meta_tags($html)
{
	$reference = new stdclass;

	$dom = str_get_html($html);
	
	if (!$dom)
	{
		return null;
	}

	$metas = $dom->find('meta');
	
	
	/*
	foreach ($metas as $meta)
	{
		echo $meta->name . " " . $meta->content . "\n";
	}
	*/
	
	
	foreach ($metas as $meta)
	{
		switch ($meta->name)
		{

			// DC

			case 'DC.title':
				$reference->title =  $meta->content;
				$reference->title = preg_replace('/\s\s+/u', ' ', $reference->title);

				break;

			case 'DC.description':
			case 'DC.Description':
				$reference->abstract =  $meta->content;
				$reference->abstract = str_replace("\n", "", $reference->abstract);
				$reference->abstract = str_replace("&amp;", "&", $reference->abstract);
				$reference->abstract = preg_replace('/\s\s+/u', ' ', $reference->abstract);			
				break;

			// eprints

			case 'eprints.creators_name':
				$author = $meta->content;

				// clean
				if (preg_match('/^(?<lastname>.*),\s+(?<firstname>[A-Z][A-Z]+)$/u', $author, $m))
				{
					$parts = str_split($m['firstname']);
					$author = $m['lastname'] . ', ' . join(". ", $parts) . '.';
				}

				$reference->authors[] =  $author;
				break;

			case 'eprints.publication':
				$reference->journal =  $meta->content;
				break;

			case 'eprints.issn':
				$reference->issn[] =  $meta->content;
				break;


			case 'eprints.volume':
				$reference->volume =  $meta->content;
				break;

			case 'eprints.pagerange':
				$pages =  $meta->content;
				$parts = explode("-", $pages);
				if (count($parts) > 1)
				{
					$reference->spage = $parts[0];
					$reference->epage = $parts[1];
				}
				else
				{
					$reference->spage = $pages;
				}
				break;

			case 'eprints.date':
				if (preg_match('/^[0-9]{4}$/', $meta->content))
				{
					$reference->year = $meta->content;
				}

				if (preg_match('/^(?<year>[0-9]{4})\//', $meta->content, $m))
				{
					$reference->year = $m['year'];
				}
				break;

			case 'eprints.document_url':
				$reference->pdf =  urldecode($meta->content);
				break;

			// Google	
			case 'citation_author':
				//$reference->authors[] =  mb_convert_case($meta->content, MB_CASE_TITLE);
				$reference->authors[] =  $meta->content;
				break;

			case 'citation_title':
				$reference->title = trim($meta->content);
				$reference->title = preg_replace('/\s\s+/u', ' ', $reference->title);
				break;

			case 'citation_doi':
				$reference->doi =  $meta->content;
				$reference->doi = preg_replace('/^doi:\s*/', '', $reference->doi);
				break;

			case 'citation_journal_title':
				$reference->journal =  $meta->content;
				$reference->genre = 'article';
				break;

			case 'citation_issn':
				$reference->issn[] = $meta->content;
				break;

			case 'citation_volume':
				$reference->volume =  $meta->content;
				break;

			case 'citation_issue':
				$reference->issue =  $meta->content;
				break;

			case 'citation_firstpage':
				$reference->spage =  $meta->content;
				
				if (preg_match('/(?<spage>\d+)[-|-](?<epage>\d+)/u', $meta->content, $m))
				{
					$reference->spage =  $m['spage'];
					$reference->epage =  $m['epage'];
				}
				break;

			case 'citation_lastpage':
				$reference->epage =  $meta->content;
				break;

			case 'citation_abstract_html_url':
				$reference->url =  $meta->content;
				break;

			case 'citation_pdf_url':
				$reference->pdf =  $meta->content;
				break;

			case 'citation_date':
				if (preg_match('/^[0-9]{4}$/', $meta->content))
				{
					$reference->year = $meta->content;
				}

				if (preg_match('/^(?<year>[0-9]{4})\//', $meta->content, $m))
				{
					$reference->year = $m['year'];
				}
				break;

			case 'DC.Date':
				$reference->date = $meta->content;
				break;


			default:
				break;
		}
	}		
	//print_r($reference);
	
	return $reference;
}