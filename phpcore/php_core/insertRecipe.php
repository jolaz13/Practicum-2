<?php
include_once('connects.php');

$uid = "1";
$recipe = $_POST['rname'];
$type = $_POST['type'];
$part = $_POST['part'];
$kg = $_POST['kg'];
$ingr = $_POST['ingr'];
$amt = $_POST['amt'];
$meas = $_POST['meas'];
$ingCounter = $_POST['ingCounter'];
$stepCap = $_POST['stepCap'];
$stepIns = $_POST['stepIns'];
$stepCounter = $_POST['stepCounter'];
$recID;
$stepID;
$kg = $_POST['kg'];
$date = date("Y-m-d");


if (isset($_FILES))
{
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));


		if($fileError === 0)
		{
			if($fileSize < 500000)
			{
				$fileNameNew = uniqid('',true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination);
			}
			else
			{
				echo "Your file is too big!";
			}
		}
		else
		{
			echo "There was an error uploading your file";
		}




$string = "INSERT INTO recipe(recipe_name, main_ingr, type_ingr, user_id, rating, image,kilogram) VALUES ('$recipe','$type','$part','$uid',0,'$fileDestination','$kg')";
echo $string;
mysqli_query($con,$string);

$result = mysqli_query($con,"SELECT recipe_id FROM recipe ORDER BY recipe_id DESC LIMIT 1;");
$row = mysqli_fetch_assoc($result);
$recID = $row['recipe_id'];

$string1 = "INSERT INTO recipe_steps(rec_id, date_created) VALUES ('$recID','$date')";
mysqli_query($con,$string1);

$result = mysqli_query($con,"SELECT steps_id FROM recipe_steps ORDER BY steps_id DESC LIMIT 1;");
$row = mysqli_fetch_assoc($result);
$stepID = $row['steps_id'];

for($i=0;$i<$stepCounter;$i++)
{
	$steps = $i+1;
	$string2 = "INSERT INTO procedure_steps VALUES ('$stepID','$steps','$stepIns[$i]','$stepCap[$i]')";
	mysqli_query($con,$string2);
}

for($i=0;$i<$ingCounter;$i++)
{
	$ingrNum = $i +1;
	$string3 = "INSERT INTO ingredients_steps VALUES ('$stepID','$ingr[$i]','$amt[$i]','$meas[$i]')";
	mysqli_query($con,$string3);
}

echo "<script type='text/javascript'>alert('Recipe Successfully Created');</script>";
}
else
{
	echo "<script type='text/javascript'>alert('No Image Found');</script>";
}
?>

