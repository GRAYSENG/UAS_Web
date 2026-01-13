<?php
class Barang {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../auth/login");
            exit;
        }
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        // Logic Search
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $searchQuery = " WHERE nama_barang LIKE :keyword ";
        
        // Logic Pagination
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page > 1) ? ($page * $limit) - $limit : 0;

        // Hitung Total Data
        $stmtCount = $this->db->prepare("SELECT count(*) as total FROM barang" . ($keyword ? $searchQuery : ""));
        if($keyword) $stmtCount->bindValue(':keyword', "%$keyword%");
        $stmtCount->execute();
        $totalData = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($totalData / $limit);

        // Ambil Data Barang
        $sql = "SELECT * FROM barang" . ($keyword ? $searchQuery : "") . " LIMIT :start, :limit";
        $stmt = $this->db->prepare($sql);
        if($keyword) $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'views/dashboard.php';
    }

    // CREATE (Hanya Admin)
    public function create() {
        if ($_SESSION['role'] !== 'admin') { die("Akses Ditolak"); }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama_barang'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            $stmt = $this->db->prepare("INSERT INTO barang (nama_barang, harga, stok) VALUES (:nama, :harga, :stok)");
            $stmt->execute(['nama' => $nama, 'harga' => $harga, 'stok' => $stok]);
            header("Location: ../barang/index");
        } else {
            require_once 'views/form_barang.php';
        }
    }

    // UPDATE (Hanya Admin)
    public function edit($id) {
        if ($_SESSION['role'] !== 'admin') { die("Akses Ditolak"); }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nama = $_POST['nama_barang'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];

            $stmt = $this->db->prepare("UPDATE barang SET nama_barang=:nama, harga=:harga, stok=:stok WHERE id=:id");
            $stmt->execute(['nama' => $nama, 'harga' => $harga, 'stok' => $stok, 'id' => $id]);
            header("Location: ../../barang/index");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM barang WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            require_once 'views/form_barang.php';
        }
    }

    // DELETE (Hanya Admin)
    public function delete($id) {
        if ($_SESSION['role'] !== 'admin') { die("Akses Ditolak"); }
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: ../../barang/index");
    }
}
?>