<?php
// index.php

class InventoryManagement {
    private $items;

    public function __construct() {
        // For simplicity, we're using a static array. This could be replaced with database queries.
        $this->items = [
            ['id' => 1, 'name' => 'Item 1', 'quantity' => 10],
            ['id' => 2, 'name' => 'Item 2', 'quantity' => 5],
            ['id' => 3, 'name' => 'Item 3', 'quantity' => 15],
        ];
    }

    public function getItems() {
        return $this->items;
    }
}

class Dashboard {
    private $inventory;

    public function __construct() {
        $this->inventory = new InventoryManagement();
    }

    public function getInventoryItems() {
        return $this->inventory->getItems();
    }
}

$dashboard = new Dashboard();
$inventoryItems = $dashboard->getInventoryItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Inventory Management</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventoryItems as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
