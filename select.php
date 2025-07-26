
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of user</title>
</head>
<body>
    <a href="insert.php">Add New</a>
    <table border="2" cellpadding="10" cellspacing="5">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
            include ('conn.php');
            $select = "SELECT * FROM patient";
            $stmt = $conn -> query($select);
            
            while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                echo 
                   "
                    <tr>
                       <td>{$row['id']}</td>
                       <td>{$row['name']} </td>
                       <td>{$row['age']} </td>
                       <td><a href='update.php?id={$row['id']}'>Update</a></td>
                       <td><a href='delete.php?id={$row['id']}'>Delete</a></td>
                    </tr>
                   ";
            }
          ?>
    </table>
</body>
</html>