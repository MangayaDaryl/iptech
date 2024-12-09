<?php
class HomeController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        // Fetch the 4 most recently added products
        $stmt = $this->pdo->prepare('SELECT * FROM products_tbl ORDER BY created_at DESC LIMIT 4');
        $stmt->execute();
        $recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch the cart count from the session
        $num_items_in_cart = isset($_SESSION['shopping_cart_tbl']) ? count($_SESSION['shopping_cart_tbl']) : 0;

        // Pass data to the view
        include 'views/home.php';
    }
}
