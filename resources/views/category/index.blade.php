@extends('layout.conquer')

@section('content')
<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Daftar Kategori
    </div>
  </div>
  <div class="portlet-body">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Obat-Obat</th>
        </tr>
      </thead>
      <tbody>
          <!-- Cara View 1 $data diganti $result  -->  
          @foreach($data as $obat)
          <tr>
              <td>{{$obat->name}}</td>
              <td>{{$obat->description}}</td>
          </tr>
          <tr>
              <td colspan="2">
              <div class="row">
                @foreach($obat->medicines as $d)
                <div class="col-md-3">
                  <div  style="padding: 10px; margin: 10px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 10px; text-align:center;">
                    <img src="{{asset('images/'.$d->image)}}" height="100px"/>
                    <p><b>{{$d->generic_name}}</b></p>
                    <p>{{$d->form}}</p>
                    <p>Rp{{$d->price}}</p>
                  </div>
                </div>
                @endforeach
              </div>
            </td>
          </tr>  
          @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection