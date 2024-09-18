<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="author" content="Aris Hadisopiyan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container pt-4">
            <div class="d-flex flex-column flex-md-row px-4 py-3 mb-4 bg-white rounded-2 shadow-sm">
                <!-- judul halaman -->
                <div class="d-flex align-items-center me-md-auto">
                    <i class="bi-mic-fill text-success me-3 fs-3"></i>
                    <h1 class="h5 pt-2">Panggilan Antrian</h1>
                </div>
                <!-- breadcrumbs -->
                <div class="ms-5 ms-md-0 pt-md-3 pb-md-0">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bi-house-fill text-success"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            <li class="breadcrumb-item" aria-current="page">Antrian</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <!-- menampilkan informasi jumlah antrian -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-start">
                                <div class="feature-icon-3 me-4">
                                    <i class="bi-people text-warning"></i>
                                </div>
                                <div>
                                    <p id="jumlah-antrian" class="fs-3 text-warning mb-1">{{ $jumlah_antrian }}</p>
                                    <p class="mb-0">Jumlah Antrian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- menampilkan informasi nomor antrian yang sedang dipanggil -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-start">
                                <div class="feature-icon-3 me-4">
                                    <i class="bi-person-check text-success"></i>
                                </div>
                                <div>
                                    <p id="antrian-sekarang" class="fs-3 text-success mb-1">{{ $antrian_sekarang }}</p>
                                    <p class="mb-0">Antrian Sekarang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- menampilkan informasi nomor antrian yang akan dipanggil selanjutnya -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-start">
                                <div class="feature-icon-3 me-4">
                                    <i class="bi-person-plus text-info"></i>
                                </div>
                                <div>
                                    <p id="antrian-selanjutnya" class="fs-3 text-info mb-1">{{ $antrian_selanjutnya }}
                                    </p>
                                    <p class="mb-0">Antrian Selanjutnya</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- menampilkan informasi jumlah antrian yang belum dipanggil -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-start">
                                <div class="feature-icon-3 me-4">
                                    <i class="bi-person text-danger"></i>
                                </div>
                                <div>
                                    <p id="sisa-antrian" class="fs-3 text-danger mb-1">{{ $sisa_antrian }}</p>
                                    <p class="mb-0">Sisa Antrian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="tabel-antrian" class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Nomor Antrian</th>
                                    <th>Status</th>
                                    <th>Panggil</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <hr class="my-4">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                &copy; {{ date('Y') }} - <a href="{{ route('dashboard') }}" target="_blank"
                    class="text-danger text-decoration-none">omeans-team.github.io</a>. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- load file audio bell antrian -->
    <audio id="tingtung" src="{{ asset('assets/audio/tingtung.mp3') }}"></audio>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>

    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>

    <!-- Responsivevoice -->
    <!-- Get API Key -> https://responsivevoice.org/ -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // tampilkan informasi antrian
            async function loadData() {
                try {
                    const response = await $.ajax({
                        type: "GET",
                        url: "{{ route('get_antrian') }}",
                    });
                    const jumlahAntrian = response.jumlah_antrian;
                    const antrianSekarang = response.antrian_sekarang;
                    const antrianSelanjutnya = response.antrian_selanjutnya;
                    const sisaAntrian = response.sisa_antrian;

                    // Update the HTML elements with the new values
                    $('#jumlah-antrian').text(jumlahAntrian);
                    $('#antrian-sekarang').text(antrianSekarang);
                    $('#antrian-selanjutnya').text(antrianSelanjutnya);
                    $('#sisa-antrian').text(sisaAntrian);
                } catch (error) {
                    console.error(error);
                }
            }

            loadData();

            // menampilkan data antrian menggunakan DataTables
            var table = $('#tabel-antrian').DataTable({
                "lengthChange": false, // non-aktifkan fitur "lengthChange"
                "searching": false, // non-aktifkan fitur "Search"
                "ajax": {
                    "url": "{{ route('get_antrian') }}",
                    "dataSrc": function(json) {
                        return json;
                    },
                    "error": function(xhr, error, thrown) {
                        console.log(xhr);
                        console.log(error);
                        console.log(thrown);
                    }
                },
                // menampilkan data
                "columns": [{
                        "data": "no_antrian",
                        "width": '250px',
                        "className": 'text-center'
                    },
                    {
                        "data": "status",
                        "visible": false
                    },
                    {
                        "data": "id",
                        "width": '100px',
                        "className": 'text-center',
                        "render": function(data, type, row) {
                            // jika tidak ada data "status"
                            if (row.status === 0) {
                                // tampilkan button panggil
                                var btn =
                                    "<button class=\"btn btn-success btn-sm rounded-circle\"><i class=\"bi-mic-fill\"></i></button>";
                            }
                            // jika data "status = 1"
                            else if (row.status === 1) {
                                // tampilkan button ulangi panggilan
                                if (row.jumlah_dipanggil < 3) {
                                    var btn =
                                        "<button class=\"btn btn-secondary btn-sm rounded-circle position-relative\"><i class=\"bi-mic-fill\"></i><span class=\"badge badge-light position-absolute top-0 end-0 p-1\">" +
                                        row.jumlah_dipanggil + "</span></button>";
                                } else {
                                    var btn =
                                        "<button class=\"btn btn-danger btn-sm rounded-circle position-relative\" disabled><i class=\"bi-mic-fill\"></i><span class=\"badge badge-light position-absolute top-0 end-0 p-1\">" +
                                        row.jumlah_dipanggil + "</span></button>";
                                }
                            };
                            return btn;
                        }
                    },
                ],
                "order": [
                    [0, "desc"] // urutkan data berdasarkan "no_antrian" secara descending
                ],
                "iDisplayLength": 10, // tampilkan 10 data per halaman
            });

            // panggilan antrian dan update data
            $('#tabel-antrian tbody').on('click', 'button', function() {
                // ambil data dari datatables
                var data = table.row($(this).parents('tr')).data();
                // buat variabel untuk menampilkan data "id"
                var id = data["id"];
                // buat variabel untuk menampilkan audio bell antrian
                var bell = document.getElementById('tingtung');

                // mainkan suara bell antrian
                bell.pause();
                bell.currentTime = 0;
                bell.play();

                // set delay antara suara bell dengan suara nomor antrian
                durasi_bell = bell.duration * 770;

                // mainkan suara nomor antrian
                setTimeout(function() {
                    responsiveVoice.speak("Nomor Antrian, " + data["no_antrian"] +
                        ", menuju, loket, 1", "Indonesian Male", {
                            rate: 0.9,
                            pitch: 1,
                            volume: 1
                        });
                }, durasi_bell);

                // proses update data
                $.ajax({
                    type: 'POST',
                    url: '{{ route('update_antrian') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                        // other data...
                    },
                    success: function(data) {
                        // Reload DataTable
                        table.ajax.reload();

                        // handle success response
                    },
                    error: function(xhr, status, error) {
                        // handle error response
                    }
                });

                // Tambahkan kode ini untuk memperbarui nilai
                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_jumlah_antrian') }}',
                    success: function(data) {
                        $('#jumlah-antrian').text(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_antrian_sekarang') }}',
                    success: function(data) {
                        $('#antrian-sekarang').text(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_antrian_selanjutnya') }}',
                    success: function(data) {
                        $('#antrian-selanjutnya').text(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: '{{ route('get_sisa_antrian') }}',
                    success: function(data) {
                        $('#sisa-antrian').text(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
