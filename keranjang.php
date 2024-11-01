<?php include 'koneksi.php';

session_start();
include 'navbar.php';

$user_id = $_SESSION['id_user']; // Get the user ID from the session
$sql = "SELECT 
    produk.id_produk,
    produk.nama_produk,
    produk.harga_produk,
    produk.gambar_a,
    keranjang.jumlah_produk
 FROM 
 keranjang
 
 JOIN 
    produk ON keranjang.id_produk = produk.id_produk
WHERE 
keranjang.id_user = '$user_id'";
$query = mysqli_query($db, $sql);

if (!$query) {
    echo "Keranjang Kosong!";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container my-4">
        <div class="card">
            <div class="card-body">
                <?php if (mysqli_num_rows($query) > 0) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total_harga = 0;
                            while ($row = mysqli_fetch_assoc($query)) :
                                $total_harga += $row['harga_produk'] * $row['jumlah_produk'];

                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input me-2 checkbox-item" name='selected_items[<?php echo $row['id_produk']; ?>]' value="<?php echo $row['id_produk']; ?>" type="checkbox" data-price="<?php echo $row['harga_produk']; ?>" data-id="<?php echo $row['id_produk']; ?>">
                                            <img src="admin/image/<?php echo $row['gambar_a']; ?>" alt="Product Image" class="img-thumbnail me-2" style="width: 120px; height: 120px;">
                                            <div>
                                                <div><?php echo $row['nama_produk']; ?></div>
                                                <small class="text-muted">Variasi</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></td>
                                    <td>

                                        <button class="btn-minus">-</button>
                                        <input class="w-25 text-center" name="jumlah_produk" type="number" id="qty<?php echo $row['id_produk']; ?>" value="<?php echo $row['jumlah_produk']; ?>" data-id="<?php echo $row['id_produk']; ?>" data-price="<?php echo $row['harga_produk']; ?>">
                                        <button class="btn-plus">+</button>


                                    </td>
                                    <td id="total-price-<?php echo $row['id_produk']; ?>">
                                        Rp <?php echo number_format($total, 0, ',', '.'); ?>
                                    </td>
                                    <td>
                                        <a href="hapus_cart.php?id_produk=<?php echo $row['id_produk'] ?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                <?php } else {
                    $_SESSION['total_harga'] = 0; ?>
                    <p class="text-center">Keranjang Kosong!</p>
                <?php } ?>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <span>Total (<?php echo $no - 1; ?> Produk): Rp <?php echo isset($_SESSION['total_harga']) ? number_format($_SESSION['total_harga'], 0, ',', '.') : '0'; ?></span>

                <?php

                $sql = "SELECT COUNT(*) AS total FROM customer c
        LEFT JOIN alamat a ON c.id_alamat = a.id_alamat
        WHERE c.id_user = '{$_SESSION['id_user']}' AND (c.nama IS NOT NULL AND a.detail_alamat IS NOT NULL)";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Directly check if the count is greater than 0
                    if ($row['total'] > 0) {
                        $_SESSION['profile_incomplete'] = false; ?>
                        <a href="checkout.php" class="btn btn-primary <?php echo $disableCheckout ? 'disabled' : ''; ?>">Checkout</a>
                    <?php       } else { ?>
                        <p>Anda belum mengisi profil. Silakan isi profil terlebih dahulu.</p>
                        <a href="profile.php" class="btn btn-primary">Isi Profil</a>
                <?php     }
                }

                ?>



            </div>
            <a href="index.php" class="btn btn-info">Kembali</a>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.btn-plus').click(function() {
            var productId = $(this).closest('tr').find('[data-id]').data('id');
            var quantityInput = $(this).closest('tr').find('[name="jumlah_produk"]');
            var quantity = parseInt(quantityInput.val());
            quantity++;
            quantityInput.val(quantity);
            updateCart(productId, quantity);
            updateTotalPrice();
        });

        $('.btn-minus').click(function() {
            var productId = $(this).closest('tr').find('[data-id]').data('id');
            var quantityInput = $(this).closest('tr').find('[name="jumlah_produk"]');
            var quantity = parseInt(quantityInput.val());
            quantity = Math.max(1, quantity - 1);
            quantityInput.val(quantity);
            updateCart(productId, quantity);
            updateTotalPrice();

        });


        function increaseCount(event, id) {
            event.preventDefault();
            var input = document.getElementById('qty' + id);

            if (input) {
                var value = parseInt(input.value, 10);
                value = isNaN(value) ? 0 : value;
                value++;
                input.value = value;
                updateCart(id, value);
                updateTotalPrice();
            } else {
                console.error('Input element not found');
            }
        }

        function decreaseCount(event, id) {
            event.preventDefault();
            var input = document.getElementById('qty' + id);

            if (input) {
                var value = parseInt(input.value, 10);
                value = isNaN(value) ? 0 : value;
                value = Math.max(1, value - 1);
                input.value = value;
                updateCart(id, value);
                updateTotalPrice();
            } else {
                console.error('Input element not found');
            }
        }
        $('.checkbox-item').change(function() {
            console.log('Checkbox changed');
            updateTotalPrice();
        });
        const numberFormat = (number, decimals, dec_point, thousands_sep) => {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = typeof thousands_sep === 'undefined' ? ',' : thousands_sep,
                dec = typeof dec_point === 'undefined' ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        };

        function updateTotalPrice() {
            var total = 0;
            var countChecked = 0;
            $('.checkbox-item:checked').each(function() {
                var quantity = parseInt($(this).closest('tr').find('[name="jumlah_produk"]').val(), 10);
                var price = parseFloat($(this).data('price'));
                total += quantity * price;
                total1 = quantity * price;
                countChecked++;
            });

            $('#total').text('Rp. ' + numberFormat(total, 0, 0, '.'));
            // Update the total price element
            $('#total-harga').text('Rp. ' + total.toFixed(2));

            // Update the total count and price in the footer
            $('.card-footer').find('span').text('Total (' + countChecked + ' Produk): Rp ' + numberFormat(total, 0, 0, '.'));

            // If no items are selected, set the total count and price to 0
            if (countChecked === 0) {
                $('.card-footer').find('span').text('Total (0 Produk): Rp 0');
            }
        }

        function updateProductTotalPrice(productId) {
            var quantityInput = $('#qty' + productId);
            var quantity = parseInt(quantityInput.val(), 10);
            var price = parseFloat(quantityInput.data('price'));
            var totalPrice = quantity * price;
            $('#total-price-' + productId).text('Rp ' + numberFormat(totalPrice, 0, ',', '.'));
        }

        // Event handler for quantity change
        $('.btn-plus, .btn-minus, input[name="jumlah_produk"]').on('click change', function() {
            var productId = $(this).closest('tr').find('input[name="jumlah_produk"]').data('id');
            updateProductTotalPrice(productId);
            // You may also want to update the cart total price here
            updateTotalPrice();
        });
        $(document).ready(function() {
            $('input[name="jumlah_produk"]').each(function() {
                var productId = $(this).data('id');
                updateProductTotalPrice(productId);
            });
            updateTotalPrice(); // Update the cart total price
        });
        $(document).ready(function() {
            updateTotalPrice(); // Call on page load
        });

        $('.checkbox-item').change(function() {
            updateTotalPrice(); // Call when a checkbox changes
        });

        function updateCart(productId, quantity, callback) {
            $.ajax({
                url: 'update_cart.php',
                type: 'POST',
                data: {
                    id_produk: productId,
                    jumlah_produk: quantity
                },

                success: function(result) {
                    console.log(result); // Check the response in the browser console
                    if (callback && typeof callback === 'function') {
                        callback(result);
                    }
                    updateTotalPrice();
                }
            });
        }
    </script>
</body>

</html>