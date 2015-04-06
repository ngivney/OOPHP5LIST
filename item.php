<?php
class Item {
	// Protect Item attributes
  protected $id;
	protected $client;
	protected $venue;
	// Constructor populates the attributes
	public function __construct($id, $client, $venue)	{
		$this->id = $id;
		$this->person = $client;
		$this->place = $venue;
	}
	// Returns the Primary Key
	public function getId()	{
		return $this->id;
	}
	// Returns Client Name
	public function get_Person() {
		return $this->person;
	}
	// Returns Client Venue
	public function get_Venue() {
		return $this->place;
	}
} // End of Item class
?>
