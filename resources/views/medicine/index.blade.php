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
<p style="text-align: right;"><a href="{{route('medicines.create')}}" class="btn btn-info">Tambah</a></p>
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
        <tr>
            <td>{{$obat->generic_name}}</td>
            <td>{{$obat->form}}</td>
            <td>{{$obat->restriction_formula}}</td>
            <td>{{$obat->category->name}}</td>
            <td>
              <a href="#detail_{{$obat->id}}" data-toggle="modal">
                <img src="{{asset('images/'.$obat->image)}}" height="100px"/>
              </a>
              <div class="modal fade" id="detail_{{$obat->id}}" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">{{$obat->generic_name}} {{$obat->form}}</h4>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('images/'.$obat->image) }}" style="max-width: 250px;" height="200px" />
                        <br>{{$obat->restriction_formula}}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              <div>
            </td>
            <td>{{$obat->description}}</td>
            <td>Rp{{$obat->price}}</td>
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
        </tr>  
        @endforeach
    </tbody>
  </table>
  <h2>Daftar Obat</h2>
  <div class="row">
    @foreach($data as $d)
    <div class="col-md-3">
      <a href="/medicines/{{$d->id}}" target="_blank">
        <div  style="padding: 10px; margin: 10px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 10px; text-align:center;">
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
@endsection