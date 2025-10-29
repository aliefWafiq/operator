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
                        <form action="/action/createPerkara" method="post" id="quickForm" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mt-3" for="namaPihak">Nama Pihak :</label>
                                    <input class="form-control" required type="text" name="namaPihak" id="namaPihak">

                                    <label for="tampilkan_nama" class="mt-3">Tampilkan Nama</label>
                                    <select required id="tampilkan_nama" name="tampilkan_nama" class="form-input w-100">
                                        <option value="Tampilkan">Tampilkan</option>
                                        <option value="Tidak tampilkan">Tidak tampilkan</option>
                                    </select>

                                    <label class="mt-3" for="tanggal_sidang">Tanggal Sidang :</label>
                                    <input class="form-control" required type="date" name="tanggal_sidang" id="tanggal_sidang">

                                    <label class="mt-3" for="noPerkara">Nomor Perkara :</label>
                                    <input class="form-control" required type="text" name="noPerkara" id="noPerkara">

                                    <label for="jenisPerkara" class="mt-3">Jenis Perkara</label>
                                    <select required id="jenisPerkara" name="jenisPerkara" class="form-input w-100">
                                        <option selected disabled>Pilih Jenis Perkara</option>
                                        <option value="Gugatan">Gugatan</option>
                                        <option value="Permohonan">Permohonan</option>
                                    </select>

                                    <label for="sidang_Keliling" class="mt-3">Sidang Keliling</label>
                                    <select required id="sidang_Keliling" name="sidang_Keliling" class="form-input w-100">
                                        <option selected disabled>Pilih Sidang Keliling</option>
                                        <option value="YA">YA</option>
                                        <option value="TIDAK">TIDAK</option>
                                    </select>

                                    <label class="mt-3" for="ruangan_sidang">Ruangan Sidang :</label>
                                    <input class="form-control" required type="text" name="ruangan_sidang" id="ruangan_sidang">

                                    <label class="mt-3" for="agenda">Agenda :</label>
                                    <textarea class="form-control" required type="text" name="agenda" id="agenda"></textarea>

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