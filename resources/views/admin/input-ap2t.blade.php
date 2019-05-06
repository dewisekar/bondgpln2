@extends('layouts.dashboard')

@section('css-ext')

@endsection
@section('content')
<title>Input | AP2T</title>
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
                            <li class="breadcrumb-item active">AP2T</li>
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
                            <h3 class="card-title">Input AP2T</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Masukkan nomor DG</label>
                                            <form method="POST" action="/input-ap2t">
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
                                    @if($norows==1 && $bondg[0]->noagenda == NULL)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width: 25%">Posko:</th>
                                                        <td>{{$bondg[0]->posko}}</td>
                                                    </tr>
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
                                                        <th style="width: 25%">No. HP:</th>
                                                        <td>{{$bondg[0]->nohp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 25%">No. Meter Lama:</th>
                                                        <td>{{$bondg[0]->nometerlama}}</td>
                                                    </tr> 
                                                    <tr>
                                                        <th style="width: 25%">Gardu:</th>
                                                        <td>{{$bondg[0]->gardu}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 25%">Tarif:</th>
                                                        <td>{{$bondg[0]->tarif}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 25%">Daya:</th>
                                                        <td>{{$bondg[0]->daya}}</td>
                                                    </tr>                             
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <form method="POST" action="../tambah-ap2t">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">No. agenda</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. agenda..." name="noagenda" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">No. meter baru</label>
                                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. meter baru..." name="nometerbaru" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="id" value="{{$bondg[0]->nodg}}" hidden>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>  
                                    @elseif($norows==1 && $bondg[0]->noagenda!=NULL)
                                        BON DG dengan Nomor DG tersebut sudah diberi nomor agenda!
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
    var cars = ["hai", "bye"];

 

console.log(cars);
</script>
@endsection