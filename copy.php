<?php
// Initialize product inventory data
// Each product has id, name, category, available stock, and store locations
$products = [
    [
        'id' => 1,
        'name' => 'Smartphone XYZ',
        'category' => 'Smartphones',
        'stock' => 50,
        'stores' => ['Downtown', 'Mall']
    ],
    [
        'id' => 2,
        'name' => 'Tablet ABC',
        'category' => 'Tablets',
        'stock' => 30,
        'stores' => ['Uptown']
    ],
    [
        'id' => 3,
        'name' => 'Digital Camera 123',
        'category' => 'Cameras',
        'stock' => 15,
        'stores' => ['Downtown', 'Uptown']
    ],
    // Add more products as needed
];

// Handle form submissions for updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Find product by id
    foreach ($products as &$product) {
        if ($product['id'] === $id) {
            // Update product details
            if (isset($_POST['name'])) {
                $product['name'] = trim($_POST['name']);
            }
            if (isset($_POST['category'])) {
                $product['category'] = trim($_POST['category']);
            }
            if (isset($_POST['stock'])) {
                $product['stock'] = intval($_POST['stock']);
            }
            if (isset($_POST['stores'])) {
                // Expecting comma-separated store names
                $stores = explode(',', $_POST['stores']);
                $product['stores'] = array_map('trim', $stores);
            }
            break;
        }
    }
    // Save the updated array back (in real app, save to session or file)
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>DSG Ltd Inventory Management</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 40px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
    }
    form {
        margin-bottom: 20px;
    }
    input[type=text], input[type=number] {
        width: 200px;
        padding: 5px;
        margin-right: 10px;
    }
    input[type=submit] {
        padding: 6px 12px;
    }
</style>
</head>
<body>

<h1>DSG Ltd Inventory Management System</h1>

<h2>Product List</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Stores</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['id']) ?></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['category']) ?></td>
            <td><?= htmlspecialchars($product['stock']) ?></td>
            <td><?= htmlspecialchars(implode(', ', $product['stores'])) ?></td>
            <td>
                <!-- Link to edit form -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>" />
                    <input type="submit" name="edit" value="Edit" />
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// If editing a product, display update form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])):
    $edit_id = intval($_POST['id']);
    $edit_product = null;
    foreach ($products as $prod) {
        if ($prod['id'] === $edit_id) {
            $edit_product = $prod;
            break;
        }
    }
    if ($edit_product):
?>
<h2>Edit Product ID <?= htmlspecialchars($edit_product['id']) ?></h2>
<form method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($edit_product['id']) ?>" />
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($edit_product['name']) ?>" required /><br/><br/>
    <label>Category:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($edit_product['category']) ?>" required /><br/><br/>
    <label>Stock:</label>
    <input type="number" name="stock" value="<?= htmlspecialchars($edit_product['stock']) ?>" min="0" required /><br/><br/>
    <label>Stores (comma-separated):</label>
    <input type="text" name="stores" value="<?= htmlspecialchars(implode(', ', $edit_product['stores'])) ?>" /><br/><br/>
    <input type="submit" value="Update Product" />
</form>
<?php endif; endif; ?>

</body>
</html>