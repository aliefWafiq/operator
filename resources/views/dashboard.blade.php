@extends('layout.main')
@section('content')
<div class="content-wrapper">
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
        </div>
    </section>

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
                        <div class="card-header">
                            <div class="row align-items-end mb-3">
                                <div class="col-md-4">
                                    <label for="filterTanggal" class="form-label">Filter Berdasarkan Tanggal Sidang</label>
                                    <input type="date" id="filterTanggal" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <button id="resetFilter" class="btn btn-secondary">Tampilkan Semua</button>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-column flex-lg-row align-items-center">
                                <div class="col-12 col-sm-8 py-2">
                                    <h3 class="card-title">List Antrean Hari Ini</h3>
                                </div>
                                <div class="col-12 col-lg-4 text-lg-right">
                                    <button id="btn-kembali" class="btn btn-warning">
                                        Kembali
                                    </button>
                                    <button id="btn-panggilLagi" class="btn btn-success ml-2">
                                        Panggil Lagi
                                    </button>
                                    <button id="btn-panggil" class="btn btn-primary ml-lg-2 mt-2 mt-lg-0">
                                        Panggil Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Nomor Perkara</th>
                                        <th>Tiket Antrean</th>
                                        <th>Jam Sidang</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-antrean">
                                    @foreach ($data as $x)
                                    <tr id="antrean-{{ $x->id }}" data-tanggal="{{ \Carbon\Carbon::parse($x->tanggal_sidang)->format('Y-m-d') }}">
                                        <td class="text-center py-3">{{ $loop->iteration }}</td>
                                        <td class="py-3">{{ $x->namaLengkap }}</td>
                                        <td class="py-3">{{ $x->noPerkara }}</td>
                                        <td class="py-3">{{ $x->tiketAntrean }}</td>
                                        <td class="py-3">{{ \Carbon\Carbon::parse($x->jam_perkiraan)->format('H i') }}</td>
                                        <td class="py-3">{{ \Carbon\Carbon::parse($x->tanggal_sidang)->format('d F Y') }}</td>
                                        <td>
                                            @if($x->status === 'menunggu' && $x->tanggal_sidang->isToday())
                                            <button class="btn btn-primary col-12 btn-prioritaskan" data-id="{{ $x->id }}">
                                                Naikkan
                                            </button>
                                            @endif
                                        </td>
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
</div>
@push('script')
<script>
    const callButton = document.getElementById('btn-panggil');
    const callAgainButton = document.getElementById('btn-panggilLagi')
    const backButton = document.getElementById('btn-kembali');
    const displayAntrean = document.getElementById('display-antrean-sekarang');
    let barisAntreanSebelumnya = null;

    const priorityButtons = document.querySelectorAll('.btn-prioritaskan');

    const dateInput = document.getElementById('filterTanggal');
    const resetButton = document.getElementById('resetFilter');
    const tableBody = document.getElementById('tabel-antrean');
    const allRows = tableBody.getElementsByTagName('tr');

    function updateTampilan(data) {
        if (!data) {
            displayAntrean.textContent = '---';
            if (barisAntreanSebelumnya) {
                barisAntreanSebelumnya.classList.remove('table-success');
            }
            return;
        }

        const queueNumber = data.tiketAntrean;
        const namaPihak = data.namaLengkap;
        const textToSpeak = `Nomor perkara, di mohon ke ruang sidang`;
        displayAntrean.textContent = nomorPerkara;
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

    callAgainButton.addEventListener('click', function() {
        fetch('/dashboard/panggil-lagi', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                alert('Tidak ada antrean yang sedang dipanggil.');
                throw new Error('Tidak ada antrean aktif');
            }
            return response.json();
        })
        .then(data => {
            updateTampilan(data);
        })
        .catch(error => console.log('Error: ', error));
    })

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

    function filterRowsByDate() {
        const selectedDate = dateInput.value;

        for (const row of allRows) {
            const rowDate = row.getAttribute('data-tanggal');
            if (selectedDate === '' || rowDate === selectedDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    dateInput.addEventListener('change', filterRowsByDate);

    resetButton.addEventListener('click', function() {
        dateInput.value = '';
        filterRowsByDate();
    });

    priorityButtons.forEach(button => {
        button.addEventListener('click', function() {
            const antreanId = this.getAttribute('data-id');

            fetch(`/dashboard/antrean/prioritaskan/${antreanId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    this.disabled = true;
                    this.textContent = 'Prioritas';
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush
@endsection