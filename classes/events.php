<?php
require_once __DIR__ . "/../database/config.php";

class Events extends Database {
    private $tbl = "event";

    public function putData($data) {
        $id_user      = (int)$data['id_user'];
        $nama_event   = $data['nama_event'];
        $kategori     = $data['kategori'];
        $kuota        = (int)$data['kuota'];
        $tanggal_event = $data['tanggal_event'];
        $deskripsi    = $data['deskripsi'];
        $poster_event = $data['poster_event'] ?? null;

        $tmplq = "INSERT INTO {$this->tbl} (id_user, nama_event, kategori, kuota, tanggal_event, deskripsi, poster_event) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ississs", $id_user, $nama_event, $kategori, $kuota, $tanggal_event, $deskripsi, $poster_event);
        return $stmt->execute();
    }

    public function getAllData() {
        $tmplq = "SELECT e.*, u.nama_organisasi FROM {$this->tbl} e JOIN users u ON e.id_user = u.id_user ORDER BY e.tanggal_event DESC";
        return $this->cn->query($tmplq);
    }

    public function getDataByUser($id_user) {
        $tmplq = "SELECT * FROM {$this->tbl} WHERE id_user = ? ORDER BY tanggal_event DESC";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getDataById($id) {
        $tmplq = "SELECT e.*, u.nama_organisasi FROM {$this->tbl} e JOIN users u ON e.id_user = u.id_user WHERE e.id_event = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateData($data) {
        $id           = (int)$data['id_event'];
        $nama_event   = $data['nama_event'];
        $kategori     = $data['kategori'];
        $kuota        = (int)$data['kuota'];
        $tanggal_event = $data['tanggal_event'];
        $deskripsi    = $data['deskripsi'];

        if (!empty($data['poster_event'])) {
            $poster_event = $data['poster_event'];
            $tmplq = "UPDATE {$this->tbl} SET nama_event=?, kategori=?, kuota=?, tanggal_event=?, deskripsi=?, poster_event=? WHERE id_event=?";
            $stmt = $this->cn->prepare($tmplq);
            $stmt->bind_param("ssisssi", $nama_event, $kategori, $kuota, $tanggal_event, $deskripsi, $poster_event, $id);
        } else {
            $tmplq = "UPDATE {$this->tbl} SET nama_event=?, kategori=?, kuota=?, tanggal_event=?, deskripsi=? WHERE id_event=?";
            $stmt = $this->cn->prepare($tmplq);
            $stmt->bind_param("ssissi", $nama_event, $kategori, $kuota, $tanggal_event, $deskripsi, $id);
        }
        return $stmt->execute();
    }

    public function removeData($id) {
        // Hapus pendaftaran terkait dulu (FK constraint)
        $stmt = $this->cn->prepare("DELETE FROM pendaftaran WHERE id_event = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $tmplq = "DELETE FROM {$this->tbl} WHERE id_event = ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getDashboardStats($id_user) {
        $stats = [];

        $stmt = $this->cn->prepare("SELECT COUNT(*) as total FROM {$this->tbl} WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stats['total_event'] = $stmt->get_result()->fetch_assoc()['total'];

        $stmt = $this->cn->prepare("SELECT COUNT(*) as total FROM {$this->tbl} WHERE id_user = ? AND tanggal_event > NOW()");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stats['event_aktif'] = $stmt->get_result()->fetch_assoc()['total'];

        $stmt = $this->cn->prepare("SELECT COUNT(*) as total FROM {$this->tbl} WHERE id_user = ? AND tanggal_event <= NOW()");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stats['event_selesai'] = $stmt->get_result()->fetch_assoc()['total'];

        return $stats;
    }

    public function getRecentByUser($id_user, $limit = 5) {
        $tmplq = "SELECT * FROM {$this->tbl} WHERE id_user = ? ORDER BY tanggal_event DESC LIMIT ?";
        $stmt = $this->cn->prepare($tmplq);
        $stmt->bind_param("ii", $id_user, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
