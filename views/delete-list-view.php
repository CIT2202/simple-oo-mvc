<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<ul>
	<li><a href="index.php?action=list">Read</a></li>
	<li><a href="index.php?action=create">Create</a></li>
	<li><a href="index.php?action=edit">Update</a></li>
	<li><a href="index.php?action=delete-list">Delete</a></li>
</ul>
<form action="index.php?action=delete" method="POST">
<?php
foreach ($films as $film) {
     echo "<p>";
    echo "<label>";
    //outputs a checkbox button for each film e.g. <label><input type="checkbox" name="ids[]" value="1" '="">Jaws</label>
    echo "<input type='checkbox' name='ids[]' value='{$film["id"]}''>";
    echo $film["title"];
    echo "</label>";
    echo "</p>";
}

?>
<input type="submit" value="Delete these films">
</form>
</body>
</html>
