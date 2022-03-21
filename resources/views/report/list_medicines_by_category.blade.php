@extends('layout.conquer')

@section('content')
<div class="container">
  <h2>List Medicine By Category</h2>
  <p>Category ID : {{$id_category}} with name : {{$name_cat}}</p>
  <hr>
  <p>Total rows : {{$getTotalData}}</p>
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Bentuk</th>
        <th>Formula</th>
        <th>Foto</th>
        <th>Deskripsi</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody>
        <!-- Cara View 1 $data diganti $result  -->  
        @foreach($result as $obat)
        <tr>
            <td>{{$obat->generic_name}}</td>
            <td>{{$obat->form}}</td>
            <td>{{$obat->restriction_formula}}</td>
            <td><img src="{{asset('images/'.$obat->image)}}" height="100px"/></td>
            <td>{{$obat->description}}</td>
            <td>Rp{{$obat->price}}</td>
        </tr>  
        @endforeach
    </tbody>
  </table>
</div>
@endsection