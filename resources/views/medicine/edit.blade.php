@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>Form Tambah Obat </h2>
    <div class="portlet">
      <div class="portlet-title">
       <div class="caption">
        <i class="fa fa-reorder"></i> Tambah Obat
       </div>
       <div class="tools">
        <a href="" class="collapse"></a>
        <a href="#portlet-config" data-toggle="modal" class="config"></a>
        <a href="" class="reload"></a>
        <a href="" class="remove"></a>
       </div>
      </div>
      <div class="portlet-body form">
       <form method="POST" action="{{url('medicines/'.$data->id)}}" enctype="multipart/form-data">
           @csrf
           @method('PUT')
        <div class="form-body">
         <div class="form-group">
          <label for="inpgenericname">Nama Generik</label>
          <input type="text" class="form-control" id="inpgenericname" name="generic_name" placeholder="Nama Generik" value="{{$data->generic_name}}">
         </div>
         <div class="form-group">
          <label for="inpform">Bentuk</label>
          <input type="text" class="form-control" id="inpform" name="form" placeholder="Bentuk" value="{{$data->form}}">
          <span class="help-block">
          Bentuk atau ukuran dari obat </span>
         </div>
         <div class="form-group">
          <label for="inprestrictionformula">Batas Pemakaian</label>
          <input type="text" class="form-control" id="inprestrictionformula" name="restriction_formula" placeholder="Batas Pemakaian" value="{{$data->restriction_formula}}">
          <span class="help-block">
          Batas aman konsumsi obat </span>
         </div>
         <div class="form-group">
          <label>Harga</label>
          <div class="input-group">
           <span class="input-group-addon">
           <i class="fa fa-money"></i>
           </span>
           <input type="number" class="form-control" name="price" placeholder="Harga Obat" value="{{$data->price}}">
          </div>
         </div>
         <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="description" class="form-control" rows="3">{{$data->description}}</textarea>
         </div>
         <div class="form-group">
          <label>Category</label>
          <select name="category" class="form-control">
           <option value="">-- pilih kategori --</option>
           @foreach($categories as $c)
            <option value="{{$c->id}}" @if($c->id == $data->category_id) selected @endif>{{$c->name}}</option>
           @endforeach
          </select>
         </div>
         <div class="form-group">
          <label>Ketersediaan di Faskes</label>
          <div class="checkbox-list">
           <label><input type="checkbox" name="faskes1" @if($data->faskes1 == 1) checked @endif> Faskes 1 </label>
           <label><input type="checkbox" name="faskes2" @if($data->faskes2 == 1) checked @endif> Faskes 2 </label>
           <label><input type="checkbox" name="faskes3" @if($data->faskes3 == 1) checked @endif> Faskes 3 </label>
          </div>
         </div>
         <div class="form-group" style="display:flex; flex-direction:column;">
          <label for="inpimage">Foto</label>
          <img src="{{asset('images/'.$data->image)}}" height="150px" width="150px" alt="">
          <input name="image" accept="image/jpg, image/png, image/jpeg" type="file" id="inpimage">
         </div>
        <div class="form-actions">
         <button type="submit" class="btn btn-info">Submit</button>
         <button type="button" class="btn btn-default">Cancel</button>
        </div>
       </form>
      </div>
    </div>
</div>
@endsection