<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- Konten halaman index buku -->
        <div class="table my-5">
            <a href="{{ route('book.create') }}" class="btn btn-primary">Insert Book</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Description</th>
                        <th scope="col">Interest</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Image</th>
                        <th scope="col">Code</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($books as $book)
                        <tr>
                            <th>{{ $book->id }}</th>
                            <td>{{ $book->book_name }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->desc }}</td>
                            <td>{{ $book->interest }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->image }}</td>
                            <td>{!! DNS2D::getBarcodeHTML("$book->book_code", 'QRCODE') !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk pop-up barcode scan -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Barcode Ditemukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Buku dengan ISBN <span id="isbnDisplay"></span> terdeteksi. Apakah Anda ingin menambahkan buku ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="{{ route('book.create') }}" class="btn btn-primary" id="confirmBorrow">Tambah Buku</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Script untuk deteksi barcode scanner -->
    <script>
        let barcode = '';
        let barcodeTimeout;

        // Regex untuk ISBN yang hanya boleh berisi angka (10 atau 13 digit)
        const isbnRegex = /^\d{10}|\d{13}$/;

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                // Periksa apakah barcode hanya terdiri dari angka dan panjangnya 10 atau 13
                if (isbnRegex.test(barcode)) {
                    showScanModal(barcode); // Tampilkan modal jika barcode sesuai ISBN
                }
                barcode = ''; // Reset barcode setelah diproses
            } else {
                // Hanya tambahkan jika input berupa angka
                if (!isNaN(e.key)) {
                    barcode += e.key;
                    clearTimeout(barcodeTimeout);
                    barcodeTimeout = setTimeout(() => {
                        barcode = ''; // Reset barcode jika tidak ada input baru dalam 200ms
                    }, 200);
                }
            }
        });

        function showScanModal(scannedBarcode) {
            document.getElementById('isbnDisplay').textContent = scannedBarcode;
            let scanModal = new bootstrap.Modal(document.getElementById('scanModal'));
            scanModal.show();

            // Simpan barcode ke LocalStorage dan arahkan ke halaman insert book saat tombol "Tambah Buku" ditekan
            document.getElementById('confirmBorrow').onclick = function() {
                localStorage.setItem('scannedISBN', scannedBarcode); // Simpan barcode ke LocalStorage
                window.location.href = "{{ route('book.create') }}"; // Arahkan ke halaman insert book
            };
        }

        // Event listener untuk memastikan modal tidak muncul saat halaman dimuat ulang
        window.addEventListener('pageshow', function() {
            let scanModalElement = document.getElementById('scanModal');
            let modalInstance = bootstrap.Modal.getInstance(scanModalElement);
            if (modalInstance) {
                modalInstance.hide(); // Pastikan modal ditutup
            }
            barcode = ''; // Reset barcode setiap kali halaman dimuat ulang
        });
    </script>

</body>


</html>
