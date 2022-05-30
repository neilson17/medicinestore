@extends('layout.conquer')

@section('content')
<h3 class="page-title">
Daftar Obat <small>daftar semua obat yang ada di apotik ini</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Medicine</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <div class="page-toolbar">
        <!-- tempat action button -->
    </div>
</div>
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
<p style="text-align: right;">
  <a href="{{route('medicines.create')}}" class="btn btn-info">Tambah</a>
  <a href="#modalCreate" data-toggle="modal" class="btn btn-info">Tambah 2</a>
</p>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Bentuk</th>
        <th>Formula</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Deskripsi</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody>
        <!-- Cara View 1 $data diganti $result  -->  
        @foreach($data as $obat)
        <tr id="tr_{{$obat->id}}">
            <td id="td_generic_name_{{$obat->id}}">{{$obat->generic_name}}</td>
            <td id="td_form_{{$obat->id}}">{{$obat->form}}</td>
            <td id="td_restriction_formula_{{$obat->id}}">{{$obat->restriction_formula}}</td>
            <td id="td_category_{{$obat->id}}">{{$obat->category->name}}</td>
            <td>
              <a href="#detail_{{$obat->id}}" data-toggle="modal">
                <img id="td_image_{{$obat->id}}" src="{{asset('images/'.$obat->image)}}" height="100px"/>
              </a>
              <div class="modal fade" id="detail_{{$obat->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="td_generic_name_form_modal_{{$obat->id}}">{{$obat->generic_name}} {{$obat->form}}</h4>
                    </div>
                    <div class="modal-body">
                        <img id="td_image_modal_{{$obat->id}}" src="{{ asset('images/'.$obat->image) }}" style="max-width: 250px;" height="200px" />
                        <br>
                        <p id="td_restriction_formula_modal_{{$obat->id}}">{{$obat->restriction_formula}}</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              <div>
            </td>
            <td id="td_description_{{$obat->id}}">{{$obat->description}}</td>
            <td id="td_price_{{$obat->id}}">Rp{{$obat->price}}</td>
            <td>
              <a class='btn btn-info' href="{{route('medicines.show',$obat->id)}}" data-target="#show{{$obat->id}}" data-toggle='modal'>detail</a>
              <!-- <a class='btn btn-info' href="{{url('medicines/'.$obat->id)}}" data-target="#show{{$obat->id}}" data-toggle='modal'>detail</a> -->
              <div class="modal fade" id="show{{$obat->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <!-- put animated gif here -->
                    <img src="{{asset('assets/img/ajax-modal-loading.gif')}}" class="loading" alt="">
                  </div>
                </div>
              </div>
            </td>
            <td>
                @can('edit-permission')
                <a href="{{url('medicines/'.$obat->id.'/edit')}}" class="btn btn-warning">Edit</a>
                @endcan
                @can('delete-permission')
                <form method="POST" action="{{url('medicines/'.$obat->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Hapus" onclick="if(!confirm('Apakah anda yakin menghapus data {{$obat->generic_name}}')) return false;">
                </form>
                @endcan
            </td>
            <td>
              <a href="#modalEdit" data-toggle="modal" onclick="getEditForm({{$obat->id}})" class="btn btn-warning">Edit 2a</a>
              <a href="#modalEdit" data-toggle="modal" onclick="getEditForm2({{$obat->id}})" class="btn btn-warning">Edit 2b</a>
              <a onclick="if(confirm('Apakah anda yakin menghapus data {{$obat->generic_name}}')) deleteDataRemoveTR({{$obat->id}});" class="btn btn-danger">Delete 2</a>
            </td>
        </tr>  
        @endforeach
    </tbody>
  </table>
  <h2>Daftar Obat</h2>
  <div class="row">
    @foreach($data as $d)
    <div class="col-md-3">
      <a href="/medicines/{{$d->id}}" target="_blank">
        <div style="padding: 10px; margin: 10px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 10px; text-align:center;">
          <img src="{{asset('images/'.$d->image)}}" height="100px"/>
          <p><b>{{$d->generic_name}}</b></p>
          <p>{{$d->form}}</p>
          <p>Rp{{$d->price}}</p>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>

<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <form role="form" method="POST" action="{{url('medicines')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New Medicine</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                      <div class="form-group">
                        <label for="inpgenericname">Nama Generik</label>
                        <input type="text" class="form-control" id="inpgenericname" name="generic_name" placeholder="Nama Generik">
                      </div>
                      <div class="form-group">
                        <label for="inpform">Bentuk</label>
                        <input type="text" class="form-control" id="inpform" name="form" placeholder="Bentuk">
                        <span class="help-block">
                        Bentuk atau ukuran dari obat </span>
                      </div>
                      <div class="form-group">
                        <label for="inprestrictionformula">Batas Pemakaian</label>
                        <input type="text" class="form-control" id="inprestrictionformula" name="restriction_formula" placeholder="Batas Pemakaian">
                        <span class="help-block">
                        Batas aman konsumsi obat </span>
                      </div>
                      <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </span>
                        <input type="number" class="form-control" name="price" placeholder="Harga Obat">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                        <option value="">-- pilih kategori --</option>
                        @foreach($datacategory as $c)
                          <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Ketersediaan di Faskes</label>
                        <div class="checkbox-list">
                        <label><input type="checkbox" name="faskes1"> Faskes 1 </label>
                        <label><input type="checkbox" name="faskes2"> Faskes 2 </label>
                        <label><input type="checkbox" name="faskes3"> Faskes 3 </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inpimage">Foto</label>
                        <input name="image" accept="image/jpg, image/png, image/jpeg" type="file" id="inpimage">
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
                <h4>Edit Medicine</h4>
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
    url:'{{route("medicine.getEditForm")}}',
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
    url:'{{route("medicine.getEditForm2")}}',
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
        url:'{{route("medicine.deleteData")}}',
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
    var eGenericName = $("#eGenericName").val();
    var eForm = $("#eForm").val();
    var eRestriction = $("#eRestriction").val();
    var ePrice = $("#ePrice").val();
    var eDescription = $("#eDescription").val();
    var eCategory = $("#eCategory").val();
    var categoryName = $("#eCategory option:selected").text();
    var eFaskes1 = ($("#eFaskes1").is(':checked') ? 1 : 0);
    var eFaskes2 = ($("#eFaskes2").is(':checked') ? 1 : 0);
    var eFaskes3 = ($("#eFaskes3").is(':checked') ? 1 : 0);

    $.ajax({
        type:'POST',
        url:'{{route("medicine.saveData")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':id,
            'generic_name': eGenericName,
            'form': eForm,
            'restriction_formula': eRestriction,
            'price': ePrice,
            'description': eDescription,
            'category_id': eCategory,
            'faskes1': eFaskes1,
            'faskes2': eFaskes2,
            'faskes3': eFaskes3
            },
        success: function(data){
            if (data.status=="ok"){
                alert(data.msg);
                $('#td_generic_name_' + id).html(eGenericName);
                $('#td_form_' + id).html(eForm);
                $('#td_restriction_formula_' + id).html(eRestriction);
                $('#td_category_' + id).html(categoryName);
                $('#td_generic_name_form_modal_' + id).html(eGenericName + " " + eForm);
                $('#td_restriction_formula_modal_' + id).html(eRestriction);
                $('#td_description_' + id).html(eDescription);
                $('#td_price_' + id).html(ePrice);
            }
            else{
                alert(data.msg);
            }
        },
        error: function(error){
          alert("error");
        }
    });
}
</script>
@endsection