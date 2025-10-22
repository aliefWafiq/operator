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
                        </div>
                        <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Pihak</th>
                                        <th>Jenis Perkara</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Agenda</th>
                                        <th>Sidang Keliling</th>
                                        <th>Ruang Sidang</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-perkara">
                                    @foreach ($data as $x)
                                    <tr id="antrean-{{ $x->id }}" data-tanggal="{{ \Carbon\Carbon::parse($x->tanggal_sidang)->format('Y-m-d') }}">
                                        <td class="text-center py-3">{{ $loop->iteration }}</td>
                                        <td class="py-3">{{ $x->namaPihak }}</td>
                                        <td class="py-3">{{ $x->jenisPerkara }}</td>
                                        <td class="py-3">{{ \Carbon\Carbon::parse($x->tanggal_sidang)->format('d F Y') }}</td>
                                        <td class="py-3">{{ $x->agenda }}</td>
                                        <td class="py-3">{{ $x->sidang_Keliling }}</td>
                                        <td class="py-3">{{ $x->ruangan_sidang }}</td>
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
    const dateInput = document.getElementById('filterTanggal');
    const resetButton = document.getElementById('resetFilter');
    const tableBody = document.getElementById('tabel-perkara');
    const allRows = tableBody.getElementsByTagName('tr');

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
</script>
@endpush
@endsection