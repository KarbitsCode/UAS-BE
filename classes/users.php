<?php
require_once __DIR__ . "/../database/config.php";

class Users extends Database {
    private $tbl = "users";

    public function putData($data) {
        $username = $data['username'];
        $pswd = password_hash($data['pswd'], PASSWORD_DEFAULT);
        $nama_organisasi = $data['nama_organisasi'];
        $role = 'penyelenggara'; // Default-nya penyelenggara
        $tmplq = "INSERT INTO $this->tbl (username, password, nama_organisasi, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ssss", $username, $pswd, $nama_organisasi, $role);
        return $stmt->execute();
    }

    public function getAllData() {
        $tmplq = "SELECT * FROM $this->tbl";
        return $this->cn->query($tmplq);
    }

    public function getDataById($data) {
        $id = $data['id_user'];
        $tmplq = "SELECT * FROM $this->tbl WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserByUsn($username) {
        $tmplq = "SELECT * FROM $this->tbl WHERE username = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateData($data) {
        $id = $data['id_user'];
        $username = $data['username'];
        $nama_organisasi = $data['nama_organisasi'];
        $pswd = password_hash($data['pswd'], PASSWORD_DEFAULT);
        $tmplq = "UPDATE $this->tbl SET username = ?, nama_organisasi = ?, password = ? WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("sssi", $username, $nama_organisasi, $pswd, $id);
        return $stmt->execute();
    }

    public function removeData($data) {
        $id = $data['id_user'];
        $tmplq = "DELETE FROM $this->tbl WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function verifyPenyelenggara($id_user) {
        $tmplq = "UPDATE $this->tbl SET aktif = true WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }

    public function updateInfo($data) {
        $id = (int)$data['id_user'];
        $username = $data['username'];
        $nama_organisasi = $data['nama_organisasi'];
        $tmplq = "UPDATE $this->tbl SET username = ?, nama_organisasi = ? WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ssi", $username, $nama_organisasi, $id);
        return $stmt->execute();
    }

    public function updatePassword($id_user, $new_password) {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $tmplq = "UPDATE $this->tbl SET password = ? WHERE id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("si", $hashed, $id_user);
        return $stmt->execute();
    }

    public function getPendingPenyelenggara() {
        $tmplq = "SELECT * FROM $this->tbl WHERE role = 'penyelenggara' AND aktif = false ORDER BY id_user ASC";
        return $this->cn->query($tmplq);
    }

    public function getAllPenyelenggara() {
        $tmplq = "SELECT * FROM $this->tbl WHERE role = 'penyelenggara' ORDER BY id_user ASC";
        return $this->cn->query($tmplq);
    }
}
?>
