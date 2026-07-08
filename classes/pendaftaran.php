<?php
require_once __DIR__ . "/../database/config.php";

class Pendaftaran extends Database {
    private $tbl = "pendaftaran";

    public function putData($data) {
        $nik_nim  = $data['nik_nim'];
        $id_event = (int)$data['id_event'];

        $tmplq = "INSERT INTO {$this->tbl} (nik_nim, id_event) VALUES (?, ?)";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("si", $nik_nim, $id_event);
        return $stmt->execute();
    }

    public function getAllData() {
        $tmplq = "SELECT pd.*, p.nama_peserta, p.email, p.jenis_identitas, e.nama_event
                  FROM {$this->tbl} pd
                  JOIN peserta p ON pd.nik_nim = p.nik_nim
                  JOIN event e ON pd.id_event = e.id_event
                  ORDER BY pd.tanggal_daftar DESC";
        return $this->cn->query($tmplq);
    }

    public function getDataByEvent($id_event) {
        $tmplq = "SELECT pd.*, p.nama_peserta, p.email, p.jenis_identitas
                  FROM {$this->tbl} pd
                  JOIN peserta p ON pd.nik_nim = p.nik_nim
                  WHERE pd.id_event = ?
                  ORDER BY pd.tanggal_daftar ASC";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_event);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getDataByUser($id_user) {
        $tmplq = "SELECT pd.*, p.nama_peserta, p.email, e.nama_event, e.tanggal_event
                  FROM {$this->tbl} pd
                  JOIN peserta p ON pd.nik_nim = p.nik_nim
                  JOIN event e ON pd.id_event = e.id_event
                  WHERE e.id_user = ?
                  ORDER BY pd.tanggal_daftar DESC";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTotalByUser($id_user) {
        $tmplq = "SELECT COUNT(*) as total FROM {$this->tbl} pd
                  JOIN event e ON pd.id_event = e.id_event
                  WHERE e.id_user = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function updateStatus($id_pendaftaran, $status) {
        $tmplq = "UPDATE {$this->tbl} SET status_kehadiran = ? WHERE id_pendaftaran = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("si", $status, $id_pendaftaran);
        return $stmt->execute();
    }

    public function removeData($id_pendaftaran) {
        $tmplq = "DELETE FROM {$this->tbl} WHERE id_pendaftaran = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_pendaftaran);
        return $stmt->execute();
    }
}
?>
