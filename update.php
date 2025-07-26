<?php
 include ('conn.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM patient WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$id]);
    $user = $stmt -> fetch();
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update User</title>
</head>
<body>
    <form action="" method="post">
        <h1>Update: <?php echo $user['name']?></h1>
        <label for="">Id</label>
        <input type="text" name="id" value="<?php echo $user['id'];?>" readonly> <br>
        <label for="">Name</label>
        <input type="text" name="name" value="<?php echo $user['name'];?>"> <br>
        <label for="">Age</label>
        <input type="text" name="age" value="<?php echo $user['age'];?>"> <br>

        <button name="update">Update</button>
    </form>

    <?php
      if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];

        $sql = "UPDATE patient SET name = ?, age = ? WHERE id = ?";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([$name, $age, $id]);
        
        if ($stmt) {
            header("Location:select.php");
        } else {
             echo "Patient not updated";
        }
      }


   ?>
</body>
</html>