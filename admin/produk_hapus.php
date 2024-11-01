<?php 
include("koneksi.php");

if(isset($_GET['id_produk'])){
    $id = $_GET['id_produk'];

    $sql = "DELETE FROM produk WHERE id_produk=$id";
    $query = mysqli_query($koneksi,$sql);

    if($query){
        header('Location: produk.php');
    }else {
        die("gagal menghapus..");
    }

}else{
    die("akses dilarang");
}



?>