<!DOCTYPE html>
<html>
<style>

body {
font-family: helvetica, sans-serif;
}

.center {
margin-left: auto;
margin-right: auto;
width: 800px;
}

span#list {
margin-right: 10px;
padding-right: 10px;
border-right: 1px solid black;
}

div#listGap {
margin-top: 20px;
margin-bottom: 20px;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

</style>
<body>

<div class="center">

<form action="businessSearch.php" method="POST">
<input type="text" name="search" placeholder="search for business"/>
<input type="text" name="searcht" placeholder="search for type"/>
<input type="text" name="searchl" placeholder="search location"/>
<input type="submit" value="Search"/>
</form>



<?php
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 
 define('DBHOST', 'fdb30.awardspace.net');
 define('DBUSER', 'fdb30.awardspace.net');
 define('DBPASS', 'P1ac35Pa55w0rd');
 define('DBNAME', '4209543_test');
 
 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS);
$dbcon = mysqli_select_db($conn,DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysqli_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysqli_error());
 }

if(isset($_POST['search'])) {
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i"," ",$searchq);
	$searcht = $_POST['searcht'];
	$searcht = preg_replace("#[^0-9a-z]#i"," ",$searcht);
	$searchl = $_POST['searchl'];
	$searchl = preg_replace("#[^0-9a-z]#i"," ",$searchl);


	$query = mysqli_query($conn,"SELECT * FROM test_table WHERE firstname LIKE '%$searchq%'") OR die('could not search!');
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'There was no search results!';
	} else {
		while($row = mysqli_fetch_array($query)) {
			$bname = $row['Business_name'];
			$bnumber = $row['Telephone'];
			$blocation = $row['Address'];

		
			$output .= '<div id="listGap"><span id="list">'.$bname.' </span> <span id="list"> '.$bnumber.' </span> <span id="list"> '.$blocation.'</span></div>';}
}
}

print "$output";
?>

</div>

</body>
</html>

