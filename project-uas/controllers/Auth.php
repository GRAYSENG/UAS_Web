<?php
class Auth {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: ../barang/index");
            exit;
        }
        require_once 'views/login.php';
    }

    public function process_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query cek user (Gunakan Prepared Statement untuk keamanan)
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi Password (di sini kita pakai plain text untuk kemudahan sesuai contoh SQL di atas)
            // Jika pakai hash: if ($user && password_verify($password, $user['password'])) {
            if ($user && $password == '123') { // Hardcode cek password dummy
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../barang/index");
            } else {
                $_SESSION['error'] = "Username atau Password salah!";
                header("Location: login");
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login");
    }
}
?>