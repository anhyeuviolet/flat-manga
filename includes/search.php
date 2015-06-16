<?
include 'config.db.php';
if(isset($_POST['name']))
{
$name=trim($_POST['name']);
$query2=mysql_query("SELECT * FROM search WHERE name LIKE '%$name%' OR slug LIKE '%$name%'");
echo "<ul>";

?>
<?
while($row = mysql_fetch_array($query2))
{
?>
<li onclick='fill("<?php echo $row['name']; ?>")'><a href="truyen-<?=$row[slug]?>.html"><?php echo $row['name']; ?></a></li>
<?
}
}
?>
</ul>
