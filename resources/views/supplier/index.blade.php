@extends('layout.conquer')

@section('content')
<h3 class="page-title">
Daftar Supplier <small>daftar semua supplier yang ada di apotik ini</small>
</h3>

<!-- Bebas ditaruh mana -->
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Supplier</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <div class="page-toolbar">
        <!-- tempat action button -->
    </div>
</div>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th><a href="{{route('suppliers.create')}}" class="btn btn-info">Tambah</a></th>
        <th>
            <a href="#modalCreate" data-toggle="modal" class="btn btn-info">Tambah 2</a>
        </th>
      </tr>
    </thead>
    <tbody>
        <!-- Cara View 1 $data diganti $result  -->  
        @foreach($data as $sup)
        <tr id="tr_{{$sup->id}}">
            <td id="td_name_{{$sup->id}}">{{$sup->name}}</td>
            <td id="td_address_{{$sup->id}}">{{$sup->address}}</td>
            <td>
                <a href="{{url('suppliers/'.$sup->id.'/edit')}}" class="btn btn-warning">Edit</a>

                @can('delete-permission')
                <form method="POST" action="{{url('suppliers/'.$sup->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Hapus" onclick="if(!confirm('Apakah anda yakin menghapus data {{$sup->name}}')) return false;">
                </form>
                @endcan
            </td>
            <th>
                <a href="#modalEdit" data-toggle="modal" onclick="getEditForm({{$sup->id}})" class="btn btn-warning">Edit 2</a>
                <a href='#modalEdit' data-toggle='modal' onclick='getEditForm2({{$sup->id}})' class="btn btn-warning">Edit 2B</a>
                <a onclick="if(confirm('Apakah anda yakin menghapus data {{$sup->name}}')) deleteDataRemoveTR({{$sup->id}});" class="btn btn-danger">Delete 2</a>
            </th>
        </tr>  
        @endforeach
    </tbody>
  </table>
</div>
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <form role="form" method="POST" action="{{url('suppliers')}}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Supplier</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input name="name" type="text" class="form-control"  placeholder="isikan nama supplier">
                            <span class="help-block">
                            *tulis nama lengkap perusahaan </span>
                        </div>
                        
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control" rows="3"></textarea>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4>Edit Supplier</h4>
            </div>
            <div class="modal-body">
                <p style="text-align:center;">
                <img src="{{asset('images/preloader.gif')}}" style="width: 300px;" alt="">
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
function getEditForm(id){
  $.ajax({
    type:'POST',
    url:'{{route("supplier.getEditForm")}}',
    data:{'_token':'<?php echo csrf_token() ?>',
          'id':id
         },
    success: function(data){
       $('#modalContent').html(data.msg)
    }
  });
}

function getEditForm2(id){
  $.ajax({
    type:'POST',
    url:'{{route("supplier.getEditForm2")}}',
    data:{'_token':'<?php echo csrf_token() ?>',
          'id':id
         },
    success: function(data){
       $('#modalContent').html(data.msg)
    }
  });
}

function deleteDataRemoveTR(id){
    $.ajax({
        type:'POST',
        url:'{{route("supplier.deleteData")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':id
            },
        success: function(data){
            if (data.status=="ok"){
                alert(data.msg);
                $('#tr_' + id).remove();
            }
            else{
                alert(data.msg);
            }
        }
    });
}

function saveDataUpdateTD(id){
    var eName = $("#eName").val();
    var eAddress = $("#eAddress").val();
    $.ajax({
        type:'POST',
        url:'{{route("supplier.saveData")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':id,
            'name': eName,
            'address': eAddress
            },
        success: function(data){
            if (data.status=="ok"){
                alert(data.msg);
                $('#td_name_' + id).html(eName);
                $('#td_address_' + id).html(eAddress);
            }
            else{
                alert(data.msg);
            }
        }
    });
}
</script>
@endsection