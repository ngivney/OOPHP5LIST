<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>OOPHP5 Example</title>
</head>
<body>
<form name='show' action='list.php' method='post'>
<strong>Please Enter Show Data</strong>
<p><div style='width:50px;'>Client: </div><input name='newClient0' type='text' id='newClient0' style='width:150px;'></p>
<p><div style='width:50px;'>Venue: </div><input name='newVenue0' type='text' id='newVenue0' style='width:150px;'></p><br>
<p><input type='submit' value='Add' name='show'></p>
</form>
<?php
session_start();
session_register('$list');
if (isset($_POST['show'])) {
// Create the list
try {
$client0=$_POST['newClient0'];
$venue0=$_POST['newVenue0'];
require('ListItems.php');
$list = new ListItems();
// Create list items
require('item.php');
$item0 = new Item(0, $client0, $venue0);
// Add the items to the list
$list->addItem($item0);
$hold = count($list);
echo "
<table colspan='3' style='width:350px;'><tr><th>Client Name</th><th>Venue</th><td>($hold Item In List)</td></tr>
";
if (!$list->isEmpty()) {
	foreach ($list as $arr) {
		// Get the item object
		$item = $arr['item'];
		// Print the items
echo "<tr><td colspan='1' style='text-align:center;'>";
			printf('<p>%s<p>', $item->get_Person());
echo"</td><td colspan='1' style='text-align:center;'>";
 printf('<p>%s<p>', $item->get_Venue());
echo "</td></tr>";
	}
echo "</table>";
} 
} catch (Exception $e) {
// Handle the exception.
}
}
?>
</body>
</html>
