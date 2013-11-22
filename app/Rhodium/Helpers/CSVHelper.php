<?php 

namespace Rhodium\Helpers;

class CSVHelper
{

	public function setFileName($fileName = null)
	{
		if ( isset( $fileName ) ) {
			$this->fileName = $fileName . '.csv';
		} else {
			$this->fileName = uniqid() . '.csv';
		}
	}

	public function getFileName()
	{
		return $this->fileName;
	} 

	public function xmlToCsv($xml)
	{

	}

	public function jsonToCsv($json)
	{
		$csv = fopen( $this->getFileName(), '+w' );

		foreach ( $json as $row ) {
			$line = "'" . join( "","", $row ) . "n";
			fputs( $csv, $line );	
		}
	}

	public function arrayToCsv( array $data, $delimiter = ';', $enclosure = ';', 
							    $encloseAll = false, $nullToMySqlNull = false)
	{
		$delimiterEsc = preg_quotes($delimiter, '/');
		$enclosureEsc = preg_quotes($enclosure, '/');

		$output = array();

		foreach ( $data as $field ) {
			if ( $field === null && $nullToMySqlNull ) {
				$output[] = 'NULL';
				continue;
			}

			if ( $encloseAll || preg_match( "/(?:${delimiterEsc}|${enclosureEsc}|\s)/" , $field ) ) {
                 $output[] = $enclosure . str_replace( $enclosure, $enclosure . $enclosure, $field ) . $enclosure;
			} else {
				$output[] = $field;
			}
		}

		return implode( $delimiter, $output );	
	}
}