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
      </tr>
    </thead>
    <tbody>
        <!-- Cara View 1 $data diganti $result  -->  
        @foreach($data as $sup)
        <tr>
            <td>{{$sup->name}}</td>
            <td>{{$sup->address}}</td>
            <td>
                <a href="{{url('suppliers/'.$sup->id.'/edit')}}" class="btn btn-warning">Edit</a>
                <form method="POST" action="{{url('suppliers/'.$sup->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Hapus" onclick="if(!confirm('Apakah anda yakin menghapus data {{$sup->name}}')) return false;">
                </form>
            </td>
        </tr>  
        @endforeach
    </tbody>
  </table>
</div>
@endsection