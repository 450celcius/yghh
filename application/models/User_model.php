<?php

class User_model extends CI_model
{

    public $nama_tabel = 'user';
   

    function cek_login($username, $password)
    {
        $md5_password = md5($password);
        $query = $this->db->get_where($this->nama_tabel, array('username' => $username, 'password' => $md5_password));
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $username = $row->username;
                $level = $row->level;
                $id_toko = $row->id_toko;
                $nama_lengkap = $row->nama;
                
            }
            $newdata = array(
                
                'username' => $username,
                'level' => $level,
                'id_toko' => $id_toko,
                'nama_lengkap' => $nama_lengkap
                
            );

            $this->session->set_userdata($newdata);
            return TRUE;
        } else
        {
            return FALSE;
        }
    }

    function cek_username($username){
        $query = $this->db->get_where($this->nama_tabel, array('username' => $username));
        if ($query->num_rows() > 0) return TRUE;
        else return FALSE;
    }

    function register_baru($nama_toko,$nama,$username,$password){
        date_default_timezone_set('Asia/Jakarta'); 
        $tgl_sekarang = date("Y-m-d h:i:sa");
        $md5_password = md5($password);

        $this->db->insert('toko', array('nama_toko' => $nama_toko));
        //$this->db->get("toko");
        $id_toko =  $this->db->insert_id();
        //$this->db->get_where("transaksi", array('id_toko' => 1));
        $url_nama_toko = str_replace(" ", "-", $nama_toko);
        $url_toko = $id_toko."-".$url_nama_toko;
        
        $this->db->update('toko', array('nama_toko_url' => $url_toko), array('id_toko' =>  $id_toko ));


        

        $data = array(
            'username' => $username,
            'password' => $md5_password,
            'nama' => $nama,            
            'tgl_daftar'=>$tgl_sekarang,
            'level' => '1',
            'id_toko' => $id_toko,
            'status' => '1'
            
        );
        
        $data2 = array(
            'tgl_kirim'=>$tgl_sekarang,
            'id_toko' => $id_toko,
            'status' => '1',
            'kategori' => '1',
            'judul' => 'Selamat datang di MOVETO',
            'pesan' => 'Hi,'.$nama.'! Terima kasih telah menggunakan MOVETO. Untuk bantuan silakan kontak kami via email: support@moveto.id. Selamat menggunakan MOVETO semoga bisnis Anda semakin melejit :)',
        );

        $data3 = array(
            'tgl_kirim'=>$tgl_sekarang,
            'id_toko' => $id_toko,
            'status' => '1',
            'kategori' => '1',
            'judul' => 'Lengkapi pengaturan toko dan profil diri',
            'pesan' => 'Segera lengkapi profil diri dan pengaturan toko/usaha Anda. Untuk melengkapi profil diri, masuk ke menu "AKUN > PROFIL". Untuk melengkapi pengaturan toko/usaha, masuk ke menu "AKUN > PENGATURAN". ',
        );

$query = $this->db->insert($this->nama_tabel, $data);        
$query = $this->db->insert('pesan_admin', $data2);        
$query = $this->db->insert('pesan_admin', $data3);        


$newdata = array(
                
                'username' => $username,
                'level' => '1',
                'id_toko' => $id_toko,
                'nama_lengkap' => $nama
                
            );

            $this->session->set_userdata($newdata);


        return $query;

    }
   

}

?>
