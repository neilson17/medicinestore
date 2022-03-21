@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>Daftar Obat</h2>
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
            <td><img src="{{asset('images/'.$obat->image)}}" height="100px"/></td>
            <td>{{$obat->description}}</td>
            <td>Rp{{$obat->price}}</td>
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