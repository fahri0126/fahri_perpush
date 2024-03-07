<?php
require_once "connection.php";

Class Auth extends Connection{

    public function do_login($data){
        $user = strtolower($data['user']);
        $pass = $data['pass'];

        $sql = "SELECT * FROM user WHERE Username=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();

        // ambil data tabelnya
        $result = $stmt->get_result();

        if($result->num_rows > 0){

            // ambil data user
            $getData = $result->fetch_assoc();
            $stmt->close();

            // verifikasi password
            $cekPass = password_verify($pass, $getData["Password"]);
            
            // cek password sama
            if($cekPass){
                $_SESSION['login'] = $getData;
                
                // menyimpan info login
                $user_id = $_SESSION['login']['UserID'];
                $login = date("Y-m-d H:i:s");
                $sql = "INSERT INTO log_login (UserID, LoginDate) VALUES(?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("is", $user_id, $login);
                $stmt->execute();

                return true;
            }

        }

        exit(header("location:login.php"));
    }

    public function do_register($data){
        $user = strtolower($data['user']);
        $nama = $data['nama'];
        $email = $data['email'];
        $alamat = $data['alamat'];
        $pass = $data['pass'];
        $level = $data['Level'];


        $query = mysqli_query($this->conn, "SELECT * FROM user WHERE Email='$email'");
        if(mysqli_num_rows($query)){
            exit(header("location:registrasi.php?err=1"));
        }

        // Hash password (mengubah password menjadi karakter string acak)
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // insert data ke database
        $sql = "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Level) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $user ,$pass, $email, $nama, $alamat, $level);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function petugas_edit($data){
        $user = $data["user"];
        $pass = $data["pass"];
        $email = $data["email"];
        $nama = $data["nama"];
        $alamat = $data["alamat"];
        $id = $data["id_user"];

        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET Username=?, Password=?, Email=?, NamaLengkap=?, Alamat=? WHERE UserID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $user, $pass_hash, $email, $nama, $alamat, $id);
        $stmt->execute();

        exit(header("location:../dashboard/registrasi-petugas.php"));
    }
}