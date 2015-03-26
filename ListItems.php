<?php
class ListItems implements Iterator, Countable {
	// Array stores the list items in the list
	protected $items = array();
	// Track position of index
	protected $position = 0;
	// Storing primary keys
	protected $ids = array();
	protected $client = array();
	protected $venue = array();
    // Setup objects in constructor 
    function __construct() {
		$this->items = array();
		$this->ids = array();
		$this->client = array();
                $this->venue = array();
    }
	// Checks if list is empty
	public function isEmpty() {
		return (empty($this->items));
	}
	// Adds a new item to the list
	public function addItem(Item $item) {
		// Get item ID
	$id = $item->get_Person();
		// Exception if ID is null
		if (!$id) throw new Exception('The list requires a client.');
		// Add or update
		if (isset($this->items[$id])) {
			$this->updateItem($item, $this->items[$item]['qty'] + 1);
		} else {
			$this->items[$id] = array('item' => $item, 'qty' => 1);
			$this->clients[] = $id;
		}
	}
	// Update list item
	public function updateItem(Item $item, $qty) {
		// Get primary key
		$id = $item->getId();
		// Delete or update list item
		if ($qty === 0) {
			$this->deleteItem($item);
		} elseif ( ($qty > 0) && ($qty != $this->items[$id]['qty'])) {
			$this->items[$id]['qty'] = $qty;
		}
	}
	// Removes an item from list
	public function deleteItem(Item $item) {
		// Get primary key
		$id = $item->get_Person(); 
		// Remove primary key
		if (isset($this->items[$id])) {
			unset($this->items[$id]);
			$index = array_search($id, $this->clients);
			unset($this->clients[$index]);
			// Recreate that array to prevent holes:
$this->clients = array_values($this->clients);
		}
	}
	// Return value
	public function current() {
		// Get the index for the current position
		$index = $this->clients[$this->position];
		// Return the item:
	    return $this->items[$index];
	}
	// Return index
	public function key() {
	    return $this->position;
	}
	// Increment index
	public function next() {
	    $this->position++;
	}
	// Reset index
	public function rewind() {
	    $this->position = 0;
	}
	// Checks if value is indexed at this position
	public function valid() {
		return (isset($this->clients[$this->position]));
	}
	// Counts items in list
	public function count() {
		return count($this->items);
	}
}
?>
