function addToCart(id_produk) {
    // Kirim permintaan AJAX untuk menambahkan produk ke keranjang
    // Anda dapat menggunakan XMLHttpRequest atau library seperti jQuery

    // Contoh menggunakan jQuery:
    $.ajax({
        type: "POST",
        url: "add-to-cart.php", // Ganti dengan URL skrip yang menangani penambahan ke keranjang
        data: { id_produk: id_produk },
        success: function(response) {
            alert("Produk ditambahkan ke keranjang!");
            updateCartCount(); 
            // Tambahkan logika lain yang diperlukan setelah produk ditambahkan ke keranjang
        },
        error: function() {
            alert("Terjadi kesalahan. Produk tidak dapat ditambahkan ke keranjang.");
        }
    });
}

    
    function updateCartCount() {
        // Kirim permintaan AJAX untuk mendapatkan jumlah produk di keranjang
        // dan perbarui elemen HTML dengan id "cartCount"
    
        // Contoh menggunakan jQuery:
        $.ajax({
            type: "GET",
            url: "get_cart_count.php", // Ganti dengan URL skrip yang mengambil jumlah produk di keranjang
            success: function(response) {
                $("#cartCount").text(response);
            },
            error: function() {
                console.error("Gagal mengambil jumlah produk di keranjang.");
            }
        });
    }
    
  
