@extends('layout.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Operator</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Operator</li>
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
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h3 class="card-title col-7 col-sm-10 py-2">List Operator</h3>
                            <a href="/createOperator" class="btn btn-success col-lg-2 col-5 fileinput-button">
                                <i class="fas fa-plus"></i>
                                <span>Create</span>
                            </a>
                        </div>
                        <div class="card-body" style="overflow-x: scroll;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Id User</th>
                                        <th>Jam Sidang</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $x)
                                    <tr>
                                        <td class="text-center py-3">{{ $loop->iteration }}</td>
                                        <td class="py-3">{{ $x->id_user }}</td>
                                        <td class="py-3">{{ $x->jam_sidang }}</td>
                                        <td class="py-3">
                                            @if ($x->status == 'diterima')
                                            <span class="badge col-6 py-2 badge-success">{{ $x->status }}</span>
                                            @elseif ($x->status == 'ditolak')
                                            <span class="badge col-6 py-2 badge-danger">{{ $x->status }}</span>
                                            @else ($x->status == 'menunggu')
                                            <span class="badge col-6 py-2 badge-warning">{{ $x->status }}</span>
                                            @endif
                                        </td>
                                        @if ($x->status == 'menunggu')
                                        <td class="d-flex" style="gap: 10px;">
                                            <form action="/terimaPengajuanJam/{{ $x->id }}" method="POST" class="col-5">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary col-12" data-id="{{ $x->id }}">
                                                    Terima
                                                </button>
                                            </form>
                                            <form action="/tolakPengajuanJam/{{ $x->id }}" method="POST" class="col-5">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger col-12" data-id="{{ $x->id }}">
                                                    Tolak
                                                </button>
                                            </form>
                                        </td>
                                        @else
                                        <td></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection