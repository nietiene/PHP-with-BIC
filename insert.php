<?php include("conn.php");?>

<form action="" method="post">
    <label for="">Name</label>
    <input type="text" name="name" placeholder="Enter name"> <br>
    <label for="">Age</label>
    <input type="text" name="age" placeholder="Enter Age"> <br>
    
    <button name="save">Add New</button>
</form>

<?php
  
 if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    
    $sql = "INSERT INTO patient(name, age) VALUES(?, ?)";
    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$name, $age]);
    
    if ($stmt) {
        header("Location:select.php");
    };
 };

?>