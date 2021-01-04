<?php
include_once('connects.php');

$name = $_POST['name'];
$date = $_POST['date'];
$sort = $_POST['sort'];
$time=strtotime($date);
$month=date("m",$time);
$year=date("Y",$time);
$main = $_POST['main'];
$userID = "1";


$string = "SELECT recipe.recipe_id as rec_id , recipe.recipe_name as name, recipe.main_ingr as main, recipe.rating as rate, recipe.image as img, recipe_steps.date_created as date_created, recipe_steps.steps_id as step_id FROM recipe INNER JOIN recipe_steps ON recipe.recipe_id = recipe_steps.rec_id WHERE recipe.user_id = '$userID'";
if(!empty($name))
{
	$string .= " AND recipe_name LIKE '%$name%' ";
}
if($main != "ALL")
{
	$string .= "AND main_ingr='$main'";
}

if(!empty($date))
{
	$string .= " AND month(date_created) = '$month' AND year(date_created) = '$year'";
}

if($sort == 'recent')
{
	$string .= " ORDER BY date_created DESC";
}
else
	$string .= " ORDER BY recipe.rating DESC";

$result = mysqli_query($con,$string);
if (mysqli_num_rows($result)==0)
{
 	echo	"No Results Found....";
}
else{
while($extract = mysqli_fetch_array($result))
{
  echo "<div style='width:500px; height:100px; padding:20px;background-color: #32CD32 ; border-radius: 15px; border:10px solid black; border-color: #006400'><tr><td>";
  echo "<form action='recipeProfile.php' method='post'>";	
  echo "<div style='float:left;'><input name='image' type='image' src='" . $extract['img'] . "' width=100 height=80'></div>";
  echo "<div style='float:left;'><input type='submit' name='submit1' value='" . $extract['name'] . "'></div>";
  echo "<br><br> Main Ingredient: " . $extract['main'];
  echo "<br> Rate: " . ltrim($extract['rate'], 'Recommended Crops');
  echo "<br> Date: " . $extract['date_created'];
  echo "<input type='hidden' name='rec_id' value='" . $extract['rec_id'] . "'> ";
  //echo "<input type='hidden' name='steps_id' value='" . $extract['steps_id'] . "'> ";// ETO PINOPOST NYA YUNG PEDO_ID
  echo "</form>";
  echo "</tr></td></div>";
}

}


?>
