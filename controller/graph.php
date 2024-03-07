<?php
require_once "connection.php";

class Graph extends Connection {

    public function getPeminjam(){

        // Mendapatkan tanggal hari Senin pada minggu ini
        $monday = date('Y-m-d', strtotime('monday this week'));

        // Mendapatkan tanggal Minggu setelah hari Senin pada minggu ini
        $sunday = date('Y-m-d', strtotime('sunday this week'));

        // Variabel untuk menyimpan tanggal mulai dan selesai
        $start_date = $monday;
        $end_date = $sunday;

        // Mengeluarkan tanggal dalam format yang dapat digunakan dalam kueri SQL
        $start_date_sql = mysqli_real_escape_string($this->conn, $start_date);
        $end_date_sql = mysqli_real_escape_string($this->conn, $end_date);

        // Membuat kueri SQL untuk mendapatkan data peminjaman antara tanggal mulai dan selesai
        $query = mysqli_query($this->conn, "SELECT * FROM peminjaman WHERE TanggalPeminjaman BETWEEN '$start_date_sql' AND '$end_date_sql'");

        $row = ['Monday' => 0, 'Tuesday' => 0, 'Wednesday' => 0, 'Thursday' => 0, 'Friday' => 0, 'Saturday' => 0, 'Sunday' => 0];

        // Loop melalui hasil kueri dan menghitung jumlah rekaman untuk setiap hari
        while ($data = mysqli_fetch_assoc($query)) {
            // Mendapatkan hari dari tanggal peminjaman
            $day_of_week = date('l', strtotime($data['TanggalPeminjaman']));
            
            // Menambahkan 1 ke jumlah rekaman untuk hari tersebut
            $row[$day_of_week]++;
        }

        // Mengembalikan data dalam bentuk array
        return $row;
    }
}