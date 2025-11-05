@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Perkara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Perkara</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <form action="/action/updatePerkara/{{ $perkara->id }}" method="post" id="quickForm" enctype="multipart/form-data" id="form">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mt-3" for="namaPihak">Nama Pihak :</label>
                                    <input class="form-control" required type="text" name="namaPihak" id="namaPihak" value="{{ $perkara->namaPihak }}">

                                    <label for="tampilkan_nama" class="mt-3">Tampilkan Nama</label>
                                    <select required id="tampilkan_nama" name="tampilkan_nama" class="form-input w-100">
                                        <option value="{{ $perkara->tampilkan_nama }}">{{ $perkara->tampilkan_nama }}</option>
                                        <option value="Tampilkan">Tampilkan</option>
                                        <option value="Tidak tampilkan">Tidak tampilkan</option>
                                    </select>

                                    <label class="mt-3" for="tanggal_sidang">Tanggal Sidang :</label>
                                    <input class="form-control" required type="date" name="tanggal_sidang" id="tanggal_sidang" value="{{ $perkara->tanggal_sidang->format('Y-m-d') }}">

                                    <label class="mt-3" for="noPerkara">Nomor Perkara :</label>
                                    <input class="form-control" required type="text" name="noPerkara" id="noPerkara" value="{{ $perkara->noPerkara }}">

                                    <label for="jenisPerkara" class="mt-3">Jenis Perkara</label>
                                    <select required id="jenisPerkara" name="jenisPerkara" class="form-input w-100">
                                        <option selected value="{{ $perkara->jenisPerkara }}">{{ $perkara->jenisPerkara }}</option>
                                        <option value="Gugatan">Gugatan</option>
                                        <option value="Permohonan">Permohonan</option>
                                    </select>

                                    <label for="sidang_Keliling" class="mt-3">Sidang Keliling</label>
                                    <select required id="sidang_Keliling" name="sidang_Keliling" class="form-input w-100">
                                        <option selected value="{{ $perkara->sidang_Keliling }}">{{ $perkara->sidang_Keliling }}</option>
                                        <option value="YA">YA</option>
                                        <option value="TIDAK">TIDAK</option>
                                    </select>

                                    <label for="ruangan_sidang" class="mt-3">Sidang Keliling</label>
                                    <select required id="ruangan_sidang" name="ruangan_sidang" class="form-input w-100">
                                        <option selected value="{{ $perkara->ruangan_sidang }}">{{ $perkara->ruangan_sidang }}</option>
                                        <option value="Ruang Sidang 1 Kartika">Ruang Sidang 1 Kartika</option>
                                        <option value="Ruang Sidang 2 Cakra">Ruang Sidang 2 Cakra</option>
                                        <option value="Ruang Sidang 3 Candra">Ruang Sidang 3 Candra</option>
                                        <option value="Ruang Sidang Keliling">Ruang Sidang Keliling</option>
                                    </select>

                                    <label class="mt-3" for="agenda">Agenda :</label>
                                    <textarea class="form-control" required type="text" name="agenda" id="agenda">{{ $perkara->agenda }}</textarea>

                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary" id="create">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@push('script')
@if (session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif
@endpush