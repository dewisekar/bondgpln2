@extends('layouts.dashboard')

@section('css-ext')

@endsection
@section('content')
<title>Input | Petugas</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Input</li>
                            <li class="breadcrumb-item active">Petugas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fa fa-ban"></i> Alert!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>                            
                        @endif
                        @include('layouts.alert')
                        <div class="card card-info">
                            <div class="card-header">
                            <h3 class="card-title">Input Petugas</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Masukkan nomor DG</label>
                                            <form method="POST" action="/input-petugas">
                                                @csrf
                                                <div class="input-group">
                                                    <div class="custom-file">                                                        
                                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nomor DG..." name="nodg" required>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>                                       
                                    </div>                                                           
                                </div>   
                                
                                @if($count==1)
                                    @if($norows==1 && $bondg[0]->noagenda == NULL )
                                        Silahkan masukkan nomor agenda dah nomor meter baru di menu input AP2T terlebih dahulu! 
                                    @elseif($norows==1 && $bondg[0]->noagenda!=NULL)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th style="width: 25%">Tanggal laporan:</th>
                                                    <td>{{$bondg[0]->tgldg}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">No. BON DG:</th>
                                                    <td>{{$bondg[0]->nodg}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">Nama Pelapor:</th>
                                                    <td>{{$bondg[0]->namapel}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">ID Pelanggan:</th>
                                                    <td>{{$bondg[0]->idpel}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">No. Meter Lama:</th>
                                                    <td>{{$bondg[0]->nometerlama}}</td>
                                                </tr> 
                                                <tr>
                                                    <th style="width: 25%">No. Meter Baru:</th>
                                                    <td>{{$bondg[0]->nometerbaru}}</td>
                                                </tr> 
                                                <tr>
                                                    <th style="width: 25%">No. Agenda:</th>
                                                    <td>{{$bondg[0]->noagenda}}</td>
                                                </tr> 
                                                <tr>
                                                    <th style="width: 25%">Alamat:</th>
                                                    <td>{{$bondg[0]->alamat}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">Keluhan:</th>
                                                    <td>{{$bondg[0]->keluhan}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%">Perbaikan:</th>
                                                    <td>{{$bondg[0]->perbaikan}}</td>
                                                </tr>                             
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="POST" action="../tambah-petugas">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Pilih petugas lapangan</label>
                                                    <select class="form-control select2" style="width: 100%;" name="petugas">
                                                    @foreach ($petugas as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="id" value="{{$bondg[0]->nodg}}" hidden>
                                                    <button type="submit" class="btn btn-primary">Tambah Petugas</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div> 
                                    @else
                                        Data tidak ditemukan!
                                    @endif
                                @endif                                                    
                            </div>
                            <!-- /.card-body -->                
                            <div class="card-footer">
                                
                            </div>
                        </div>
                        <p id="demo"></p>
                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js-ext')
<script>
    
</script>
@endsection