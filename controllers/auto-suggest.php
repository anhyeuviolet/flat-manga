<?
include 'manga-index.php'; 

if(isset($_POST['latestQuery'])){ //if the auto-suggest script receives a query...

	$latestQuery = $_POST['latestQuery']; //save the query in a variable
	$latestQueryLength = strlen($latestQuery); //count the number of characters in that query
	$result = array(); //set up an array that we'll store the matched search terms in (and finally send back to the JavaScript)
	
	foreach($data as $name => $url){ //for each value in the data array...
		if (substr(strtolower($name),0,$latestQueryLength) == strtolower($latestQuery)){ //check to see if the query matches any search terms, if it does...
				$result[$name] = $url; //add the term as a key and the url as it's value. example: ACDC : "?search=ACDC"
		}
	}
	
	echo json_encode($result); //encode the results list as a JavaScript object, and send it back to the JavaScript
}
?>