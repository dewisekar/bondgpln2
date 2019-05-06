@extends('layouts.dashboard')

@section('css-ext')

@endsection
@section('content')
<title>Input | BON DG</title>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Input BON DG</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Input</li>
                            <li class="breadcrumb-item active">BON DG</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Laporan Gangguan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="/input-bondg">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Posko</label>
                                        <select class="form-control select2" style="width: 100%;" name="posko">
                                            <option selected="selected">Panimbang</option>
                                            <option>Labuan</option>
                                            <option>Panimbang</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal lapor</label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Masukkan tanggal..." data-date-format="DD-MM-YYYY" name="tgldg" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nomor DG</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nomor DG..." name="nodg" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama pelapor</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan nama pelapor..." name="namapel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">ID pelanggan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan id pelanggan..." name="idpel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Alamat</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. hp..." name="alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Gardu</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan gardu..." name="gardu" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tarif</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan tarif..." name="tarif" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Daya</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan daya..." name="daya" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">No. HP</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. hp..." name="nohp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">No. meter lama</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. meter lama..." name="nometerlama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Keluhan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. meter lama..." name="keluhan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Perbaikan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Masukkan no. meter lama..." name="perbaikan" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
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
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()
            //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker         : true,
          timePickerIncrement: 30,
          format             : 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges   : {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
          },
          function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )
            //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
            //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
            //Timepicker
        $('.timepicker').timepicker({
          showInputs: false
        })
    })
</script>
@endsection