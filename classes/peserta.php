<?php
require_once __DIR__ . "/../database/config.php";

class Peserta extends Database {
    private $tbl = "peserta";

    public function putData($data) {
        $nik_nim         = $data['nik_nim'];
        $nama_peserta    = $data['nama_peserta'];
        $email           = $data['email'];
        $jenis_identitas = $data['jenis_identitas'];

        $tmplq = "INSERT INTO {$this->tbl} (nik_nim, nama_peserta, email, jenis_identitas) VALUES (?, ?, ?, ?)";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ssss", $nik_nim, $nama_peserta, $email, $jenis_identitas);
        return $stmt->execute();
    }

    public function getAllData() {
        $tmplq = "SELECT * FROM {$this->tbl} ORDER BY nama_peserta ASC";
        return $this->cn->query($tmplq);
    }

    public function getDataById($nik_nim) {
        $tmplq = "SELECT * FROM {$this->tbl} WHERE nik_nim = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("s", $nik_nim);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateData($data) {
        $nik_nim         = $data['nik_nim'];
        $nama_peserta    = $data['nama_peserta'];
        $email           = $data['email'];
        $jenis_identitas = $data['jenis_identitas'];

        $tmplq = "UPDATE {$this->tbl} SET nama_peserta=?, email=?, jenis_identitas=? WHERE nik_nim=?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ssss", $nama_peserta, $email, $jenis_identitas, $nik_nim);
        return $stmt->execute();
    }

    public function removeData($nik_nim) {
        // Hapus pendaftaran terkait dulu (FK constraint)
        $stmt = $this->cn->prepare("DELETE FROM pendaftaran WHERE nik_nim = ?");
        $stmt->bind_param("s", $nik_nim);
        $stmt->execute();

        $tmplq = "DELETE FROM {$this->tbl} WHERE nik_nim = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("s", $nik_nim);
        return $stmt->execute();
    }
}
?>
