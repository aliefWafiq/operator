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
                        <form action="" method="post" id="quickForm" enctype="multipart/form-data" id="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mt-3" for="namaLengkap">Nama Lengkap :</label>
                                    <input class="form-control" type="text" name="namaLengkap" id="namaLengkap">

                                    <label class="mt-3" for="email">Email :</label>
                                    <input class="form-control" type="email" name="email" id="email">

                                    <label class="mt-3" for="nomorHp">Nomor Hp :</label>
                                    <input class="form-control" type="nomorHp" name="nomorHp" id="nomorHp">

                                    <label class="mt-3" for="password">Password :</label>
                                    <input class="form-control" type="password" name="password" id="password">

                                    <label class="mt-3" for="nomorPerkara">Nomor Perkara :</label>
                                    <input class="form-control" type="text" name="nomorPerkara" id="nomorPerkara">

                                    <label for="inputState" class="mt-3">Jenis Perkara</label>
                                    <select id="inputState" name="jenisPerkara" class="form-input w-100">
                                        <option selected>Pilih Jenis Perkara</option>
                                        <option value="Gugatan">Gugatan</option>
                                        <option value="Permohonan">Permohonan</option>
                                    </select>

                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary" disabled id="create">Submit</button>
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