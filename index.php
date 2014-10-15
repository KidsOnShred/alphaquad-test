<?php

/**
 * AlphaQuad programming test
 * 
 * Notes:
 * We have provided skeleton functions to split up the task, but feel free
 * to add additional functions (or classes if you like) if you need to.
 */

/**
 * Stage 1 - displaying the menu
 * Output the menu as a set of nested lists containing links.  This should
 * handle as many menu levels as possible - see data.php for the exact
 * structure of the dataset.  Don't worry about styling the menu - just the
 * plain HTML will do.
 * @param array Menu dataset - see data.php for an example
 */


function display_menu($data) {
	echo '<ul>';
	foreach ($data as $item)
	{
		display_item($item);
	}
	echo '</ul>';
}
function display_item($item)
{
	echo '<li>';
	
	//Add link if there is a url
	if (isset($item['url']))
		$output = create_url($item);
	else
		$output = $item['label'];

	echo $output;

	if (isset($item['url']))
	echo '</a>';

	echo '</li>';
	
	// Recursion - this allows us to nest lists as we please without a maximum number of layers
	if (!empty($item['items']))
		display_menu($item['items']);
}
function create_url(&$item)
{
	$linkOptions = '';

	if (isset($item['linkOptions']))
	{

		foreach ($item['linkOptions'] as $key => $option)
			$linkOptions .= $key.'="'.$option.'" '; 
	}
	return '<a href="'.$item['url'].'" '.$linkOptions.'>'.$item['label'].'</a>';
}

/**
 * Stage 2 - highlight special offers
 * Special offers in the menu need to be more prominent.  All prices in
 * menu labels need to be wrapped in <b> tags, except where a previous
 * price is listed (e.g. 'was £9.95') which should be wrapped in <del> tags.
 * @param array Menu dataset (passed as a reference)
 */
function highlight_labels(&$data) {
	foreach ($data as $key => $item)
	{
		$data[$key] = highlight_label(&$item);
	}
}
function highlight_label(&$item) 
{
	
	//if not enabled
	if (isset($item['enabled']) && !$item['enabled'])
	{
		if (!$item['enabled'])
			$item['label'] = '<del>'.$item['label'].'</del>';
	}
	if (isset($item['htmlOptions']))
	{
		foreach ($item['htmlOptions'] as $option)
		{
			if ($option == 'active')
				$item['label'] = '<b>'.$item['label'].'</b>';
		}			
	}

	// Recursion - this allows us to nest lists as we please without a maximum number of layers
	if (isset($item['items']))
		highlight_labels($item['items']);

	return $item;
}

/**
 * Stage 3 - load data from database
 * Devise a database structure to contain the data as given in data.php.
 * As above this should handle as many nested menu levels as possible.
 * You may wish to use the getDatabase() function to open a database
 * connection, using a library and database of your choice.
 * As this could potentially incur a large number of database queries, you
 * may want to think about how to improve performance, and implement
 * them if you have time.
 * @see getDatabase()
 * @return array Array of menu items
 */
function load_data() {
	return (require dirname(__FILE__).'/data.php');
}

/**
 * Open a new database connection
 * Feel free to alter this if you prefer to use a different library e.g. ADODB.
 * If you modify this to use a different data source e.g. MySQL, be sure to
 * include a database dump, schema or diagram of some sort showing your
 * database structure.
 * @return mixed Database connection handle / instance
 */


// show all errors
error_reporting(-1);

// load the test data
$data = load_data();


// apply highlighting to labels
highlight_labels($data);

// display the menu
?>
<!DOCTYPE HTML>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<title>Menu test</title>
</head>
<body>
<?php display_menu($data); ?>
</body>
</html>
