<h1>Tambah Produk</h1>
<form action="/products/store" method="post" enctype="multipart/form-data">
    <label>Nama:</label>
    <input type="text" name="name">
    
    <label>Deskripsi:</label>
    <textarea name="description"></textarea>
    
    <label>Gambar:</label>
    <input type="file" name="image">
    
    <label>Stock:</label>
    <input type="number" name="stock">
    
    <label>Harga:</label>
    <input type="text" name="price" id="price" oninput="formatRupiah(this)" onblur="removeRupiahPrefix(this)">
    
    <button type="submit">Simpan</button>
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
