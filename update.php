<?php
include 'header.php';
include "config.php";
include "database.php";
?>

<?php
	$id = $_GET['id'];
	$db = new Database();
	$query = "SELECT * FROM tbl_user WHERE id=$id";
	$getData = $db->select($query)->fetch_assoc();



	if (isset($_POST['submit'])) {
		$name = mysqli_real_escape_string($db->link, $_POST['name']);
		$email = mysqli_real_escape_string($db->link, $_POST['email']);
		$skill = mysqli_real_escape_string($db->link,$_POST['skill']);

		if($name == '' || $email == '' || $skill == ''){
			$error = "Field must not be empty";
		}else{
			$query = "UPDATE tbl_user SET name ='$name', email='$email', skill='$skill' WHERE id = '$id'";
			$update = $db->update($query);
		}
	}

?>

<?php
if (isset($_POST['delete'])) {
	$query = "DELETE FROM tbl_user WHERE id=$id";
	$deleteData = $db->delete($query);
}
?>

<?php 
if(isset($error)){
 echo "<span style='color:red'>".$error."</span>";
}
?>

<form action="update.php?id=<?php echo $id; ?>" method="post">
<table>
<tr>
	<td>Name</td>
	<td><input type="text" name="name" value="<?php echo $getData['name'] ?>" /></td>
<tr>	
	<td>Email</td>
	<td><input type="email" name="email" value="<?php echo $getData['email'] ?>" /></td>
</tr>	
<tr>
	<td>Skill</td>
	<td><input type="text" name="skill" value="<?php echo $getData['skill'] ?>" /></td>
</tr>
<tr>
	<td>
		<input type="submit" name="submit" value="Update">
		<input type="reset" name="reset" value="Cancel">
		<input type="submit" name="delete" value="Delete">
	</td>
</tr>
</table>
</form>

<a href="index.php">Go Back</a>


<?php include 'footer.php'; ?>