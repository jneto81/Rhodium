<?php 

namespace Rhodium\Helpers;

/**
 * Contacts
 *
 * Basic interface between
 * the core code and the
 * address book json config.
 *
 * Uses rummage to filter
 * through address.book.json.
 *
 * @author    Ewan Valentine <ewan@pushon.co.uk>
 * @copyright PushOn 2013
 */
class Contacts
{	

	protected $path;

	/**
	 * __construct
	 *
	 * Instantiates Rummage,
	 * the JSON and XML
	 * helper.
	 */
	public function __construct( $path )
	{
		$this->initJSON( $path );
	}

	/**
	 * initJSON
	 *
	 * Instantiates the JSON
	 * parser. Sets the file
	 * location for Rummage.
	 * 
	 * @return string Filepath.
	 */
	public function initJSON( $path )
	{
		$this->json = new Rummage;

		$this->json->setFileLocation( $path, 'address.book', 'json' );
	}

	/**
	 * getAllContacts
	 *
	 * Gets all contacts from
	 * the address book, via
	 * rummage.
	 * 
	 * @return object Object of contacts.
	 */
	public function getAllContacts()
	{
		$contacts = $this->json->parseJSON();

		return $contacts;
	}

	/**
	 * getAllAdminContacts
	 *
	 * Gets all admin contacts 
	 * from the address book, via
	 * rummage.
	 * 
	 * @return object JSON object of contacts.
	 */
	public function getAllAdminContacts()
	{

		$contacts = $this->json->parseJSONAsArray();

		foreach ( $contacts as $c ) {
			
			if ( $c['role'] == 'admin' ) {
				$filtered[] = $c;
			}
		
		}

		return $filtered;
	}

	public function getAllAdminEmails()
	{
		$contacts = $this->json->parseJSONAsArray();

		foreach ( $contacts as $c ) {

			if ( $c['role'] == 'admin' ) {
				$emails[] = $c->email;
			}
		}

		return $emails;
	}

	/**
	 * getAllDevelopers
	 *
	 * Gets all developers
	 * contacts from the
	 * address book, via
	 * rummage.
	 * 
	 * @return object JSON object of contacts.
	 */
	public function getAllDeveloperContacts()
	{

		return $contacts;
	}

	/**
	 * getContactsByName
	 *
	 * Gets a contact by a 
	 * specific name from the
	 * contacts address book,
	 * via rummage.
	 * 	
	 * @param  string $name Persons name.
	 * @return Object       JSON object of person.
	 */
	public function getContactByName( $name )
	{

		return $contacts;
	}

	/**
	 * getContactByLastName
	 *
	 * Gets contacts from the
	 * json address book by
	 * last name.
	 * 	
	 * @param  string $name Persons last name.
	 * @return object       JSON Object of person.
	 */
	public function getContactByLastName( $name )
	{

		return $contacts;
	}
}