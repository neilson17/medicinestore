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
       <form role="form" method="POST" action="{{url('/medicines')}}" enctype="multipart/form-data">
           @csrf
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
        <div class="form-actions">
         <button type="submit" class="btn btn-info">Submit</button>
         <button type="button" class="btn btn-default">Cancel</button>
        </div>
       </form>
      </div>
    </div>
</div>
@endsection