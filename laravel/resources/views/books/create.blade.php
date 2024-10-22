<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card untuk form -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Create Book Entry</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('book.index') }}" class="btn btn-secondary mb-3">Back</a>

                        <!-- Form dengan enctype untuk upload file -->
                        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="book_name"
                                    placeholder="Enter book name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Publisher</label>
                                <input type="text" class="form-control" name="publisher"
                                    placeholder="Enter publisher name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ISBN</label>
                                <!-- Input ISBN -->
                                <input type="text" class="form-control" name="isbn" id="isbn"
                                    placeholder="Enter ISBN">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" class="form-control" name="author"
                                    placeholder="Enter author name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock"
                                    placeholder="Enter stock amount" min="0" step="1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" name="desc"
                                    placeholder="Enter book description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Interest</label>
                                <select class="form-select" name="interest">
                                    <option selected disabled>Select Interest</option>
                                    <!-- Placeholder untuk pilihan -->
                                    <option value="Robotics">Robotics</option>
                                    <option value="Multimedia">Multimedia</option>
                                    <option value="Network">Network</option>
                                    <option value="Web Development">Web Development</option>
                                </select>
                            </div>

                            <!-- Input file dengan preview gambar -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar</label>
                                <!-- Preview gambar -->
                                <img class="mb-2 img-fluid d-flex" id="img-preview"
                                    style="max-width: 200px; display: none;">
                                <input type="file" class="form-control" name="image" id="image"
                                    onchange="previewImage()">
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ambil barcode dari LocalStorage saat halaman dimuat

        window.onload = function() {
            let scannedISBN = localStorage.getItem('scannedISBN');
            if (scannedISBN) {
                document.getElementById('isbn').value = scannedISBN; // Masukkan ke kolom ISBN
                localStorage.removeItem('scannedISBN'); // Hapus dari LocalStorage setelah dimasukkan
            }
        }

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#img-preview');

            const fileReader = new FileReader();
            fileReader.readAsDataURL(image.files[0]);

            fileReader.onload = function(e) {
                imgPreview.style.display = 'block'; // Menampilkan preview
                imgPreview.src = e.target.result; // Menampilkan hasil preview gambar
            };
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // Cegah form reload saat Enter ditekan
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('keydown', function(e) {
                // Cegah reload jika tombol yang ditekan adalah "Enter"
                if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>

</html>
