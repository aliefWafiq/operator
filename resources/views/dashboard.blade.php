@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Antrean</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dahsboard</a></li>
                        <li class="breadcrumb-item active">List Antrean</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Antrean Sedang Dipanggil</h3>
                        </div>
                        <div class="card-body text-center">
                            <h1 id="display-antrean-sekarang" class="display-1 font-weight-bold text-primary">
                                ---
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title col-7 col-sm-8 py-2">List Antrean Hari Ini</h3>
                            <button id="btn-kembali" class="btn btn-warning col-lg-2 col-5">
                                Kembali
                            </button>
                            <button id="btn-panggil" class="btn btn-primary col-lg-2 col-5 ml-2">
                                Panggil Berikutnya
                            </button>
                        </div>
                        <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tiket Antrean</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $x)
                                    <tr id="antrean-{{ $x->id }}">
                                        <td class="text-center py-3">{{ $loop->iteration }}</td>
                                        <td class="py-3">{{ $x->namaLengkap }}</td>
                                        <td class="py-3">{{ $x->tiketAntrean }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@push('script')
<script>
    const callButton = document.getElementById('btn-panggil');
    const backButton = document.getElementById('btn-kembali');
    const displayAntrean = document.getElementById('display-antrean-sekarang');
    let barisAntreanSebelumnya = null;

    function updateTampilan(data) {
        if (!data) {
            displayAntrean.textContent = '---';
            if (barisAntreanSebelumnya) {
                barisAntreanSebelumnya.classList.remove('table-success');
            }
            return; 
        }

        const queueNumber = data.tiketAntrean;
        const textToSpeak = `Nomor antrian, ${queueNumber}, di mohon masuk ke ruang sidang`;

        displayAntrean.textContent = queueNumber;

        generateSound(textToSpeak);

        if (barisAntreanSebelumnya) {
            barisAntreanSebelumnya.classList.remove('table-success');
        }

        const barisAntreanSekarang = document.getElementById('antrean-' + data.id);
        if (barisAntreanSekarang) {
            barisAntreanSekarang.classList.add('table-success');
            barisAntreanSebelumnya = barisAntreanSekarang;
        }
    }

    function generateSound(text) {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 0.9;
        window.speechSynthesis.speak(utterance);
    }

    callButton.addEventListener('click', function() {
        fetch('/dashboard/panggil-berikutnya', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    alert('Semua antrean hari ini sudah selesai.');
                    throw new Error('Antrean habis');
                }
                return response.json();
            })
            .then(data => {
                updateTampilan(data);
            })
            .catch(error => console.error('Error:', error));
    });

    backButton.addEventListener('click', function() {
        fetch('/dashboard/panggil-sebelumnya', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    alert('Tidak ada antrean sebelumnya.');
                    throw new Error('Tidak ada antrean sebelumnya');
                }
                return response.json();
            })
            .then(data => {
                updateTampilan(data);
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endpush
@endsection