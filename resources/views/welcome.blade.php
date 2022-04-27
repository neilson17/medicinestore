@extends('layout.conquer')

@section('content')
<h3 class="page-title">
Welcome <small>Selamat Datang!</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Welcome</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li >
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="showInfo()">
            <i class="icon-bulb"></a></i>
        </li>
    </ul>
    <div class="page-toolbar">
        <!-- tempat action button -->
        <button class="btn btn-warning" href="#disclaimer" data-toggle="modal">Dislaimer</button>
        <button class="btn btn-info">Help</button>
    </div>
</div>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div id="div_showinfo"></div>

        <div class="title m-b-md">
            Toko Obat
        </div>

        <div class="links">
            <a href="/categories">Kategori</a>
            <a href="/medicines">Obat</a>
        </div>
    </div>
</div>

<div class="modal fade" id="disclaimer" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">DISCLAIMER</h4>
            </div>
            <div class="modal-body">
                Pictures shown are for illustration purpose only.Actual product may vary due to product enhancement.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')
<script>
    function showInfo(){
        $.ajax({
            type: 'POST',
            url:'{{route("medicines.showInfo")}}',
            data:'_token=<?php echo csrf_token() ?>',
            success: function(data){
            $('#div_showinfo').html(data.msg)
            }
        });
    }
</script>
@endsection