<?php
// produk.php
header('Content-Type: application/json');
require_once 'koneksi2.php';

// ==========================================================
// LAYER KEAMANAN: Middleware Pengecekan API KEY
// ==========================================================
$headers = apache_request_headers();
$api_key_input = isset($headers['X-API-KEY']) ? mysqli_real_escape_string($conn, $headers['X-API-KEY']) : (isset($headers['x-api-key']) ? mysqli_real_escape_string($conn, $headers['x-api-key']) : '');

if (empty($api_key_input)) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "API KEY diperlukan!"]);
    exit;
}

// Validasi API KEY ke database
$sql_user = "SELECT * FROM users WHERE api_key = '$api_key_input' AND api_key IS NOT NULL";
$cek_user = mysqli_query($conn, $sql_user);

if (mysqli_num_rows($cek_user) == 0) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "API KEY tidak valid!"]);
    exit;
}

// ==========================================================
// CORE CRUD: Penanganan Method Request
// ==========================================================
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    
    // 1. READ (GET DATA)
    case 'GET':
        // Jika ada parameter id di URL (Contoh: produk.php?id=1)
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT p.*, k.nama_kategori FROM produk p JOIN kategori k ON p.id_kategori = k.id WHERE p.id = '$id'";
            $query = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($query);
            
            if ($data) {
                echo json_encode(["status" => "success", "data" => $data]);
            } else {
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "Produk tidak ditemukan"]);
            }
        } else {
            // Ambil semua data produk
            $sql = "SELECT p.*, k.nama_kategori FROM produk p JOIN kategori k ON p.id_kategori = k.id";
            $query = mysqli_query($conn, $sql);
            $data_produk = [];
            while ($row = mysqli_fetch_assoc($query)) {
                $data_produk[] = $row;
            }
            echo json_encode(["status" => "success", "data" => $data_produk]);
        }
        break;

    // 2. CREATE (POST TAMBAH DATA)
    case 'POST':
        // Menangkap data input dari raw JSON Body
        $input = json_decode(file_get_contents('php://input'), true);
        
        $id_kategori  = isset($input['id_kategori']) ? mysqli_real_escape_string($conn, $input['id_kategori']) : '';
        $nama_produk  = isset($input['nama_produk']) ? mysqli_real_escape_string($conn, $input['nama_produk']) : '';
        $harga        = isset($input['harga']) ? mysqli_real_escape_string($conn, $input['harga']) : '';
        $stok         = isset($input['stok']) ? mysqli_real_escape_string($conn, $input['stok']) : '';

        // Validasi Request
        if (empty($id_kategori) || empty($nama_produk) || empty($harga) || empty($stok)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Semua data produk wajib diisi!"]);
            exit;
        }

        $sql = "INSERT INTO produk (id_kategori, nama_produk, harga, stok) VALUES ('$id_kategori', '$nama_produk', '$harga', '$stok')";
        if (mysqli_query($conn, $sql)) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Produk roti berhasil ditambahkan!"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan data"]);
        }
        break;

    // 3. UPDATE (PUT UBAH DATA)
    case 'PUT':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID produk yang akan diupdate wajib disertakan di URL!"]);
            exit;
        }
        
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $input = json_decode(file_get_contents('php://input'), true);

        $id_kategori  = isset($input['id_kategori']) ? mysqli_real_escape_string($conn, $input['id_kategori']) : '';
        $nama_produk  = isset($input['nama_produk']) ? mysqli_real_escape_string($conn, $input['nama_produk']) : '';
        $harga        = isset($input['harga']) ? mysqli_real_escape_string($conn, $input['harga']) : '';
        $stok         = isset($input['stok']) ? mysqli_real_escape_string($conn, $input['stok']) : '';

        if (empty($id_kategori) || empty($nama_produk) || empty($harga) || empty($stok)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Semua kolom data harus diisi untuk update!"]);
            exit;
        }

        $sql = "UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "Data produk berhasil diperbarui!"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui data"]);
        }
        break;

    // 4. DELETE (DELETE HAPUS DATA)
    case 'DELETE':
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID produk yang akan dihapus wajib disertakan di URL!"]);
            exit;
        }

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        $sql = "DELETE FROM produk WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "message" => "Produk roti berhasil dihapus!"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal menghapus data"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Method tidak diizinkan"]);
        break;
}
?>