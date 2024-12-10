<h1>Edit Produk</h1>
<form action="/products/update/<?= $product['id']; ?>" method="post" enctype="multipart/form-data">
    <label>Nama:</label>
    <input type="text" name="name" value="<?= $product['name']; ?>">
    
    <label>Deskripsi:</label>
    <textarea name="description"><?= $product['description']; ?></textarea>
    
    <label>Gambar:</label>
    <input type="file" name="image">
    <?php if ($product['image']): ?>
        <img src="/uploads/<?= $product['image']; ?>" width="100">
    <?php endif; ?>
    
    <label>Stock:</label>
    <input type="number" name="stock" value="<?= $product['stock']; ?>">
    
    <label>Harga:</label>
    <input type="text" name="price" id="price" value="<?= number_format($product['price'], 0, ',', '.'); ?>" oninput="formatRupiah(this)" onblur="removeRupiahPrefix(this)">
    
    <button type="submit">Update</button>
</form>

<script>
    // Fungsi untuk memformat harga dalam format rupiah
    function formatRupiah(input) {
        let value = input.value.replace(/[^\d]/g, ''); // Menghapus karakter selain angka
        let formattedValue = '';

        // Format angka dengan titik sebagai pemisah ribuan
        while (value.length > 3) {
            formattedValue = '.' + value.slice(-3) + formattedValue;
            value = value.slice(0, value.length - 3);
        }

        if (value.length > 0) {
            formattedValue = value + formattedValue;
        }

        // Menambahkan 'Rp ' di depan
        input.value = 'Rp ' + formattedValue;
    }

    // Fungsi untuk menghapus 'Rp' dan titik saat formulir disubmit
    function removeRupiahPrefix(input) {
        let value = input.value;
        value = value.replace(/[^\d]/g, ''); // Menghapus 'Rp' dan titik
        input.value = value; // Mengembalikan nilai yang bersih ke input
    }
</script>
