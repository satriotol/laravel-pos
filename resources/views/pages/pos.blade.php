@extends('layouts.default')
@section('content')
<style>
    .header-pos {

        font-family: Helvetica;
        font-weight: 300;
        font-size: 40px;
        margin-top: 68px;
        text-align: center;
        color: #5f6468;

    }

    .kotak {
        text-align: center;
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: #373942;
        border-radius: 5px;
        text-align: center;
        color: #ffff;
    }

    .kotak i {
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 3rem;
    }

    .kotak h4 {
        margin-bottom: 0px;
        font-size: 18px;
    }

    .kotak p {
        margin-bottom: 10px;
        font-size: 14px;
    }

    @media (max-width: 767.98px) {
        .kotak {
            margin-bottom: 0%;
        }
    }

</style>
<section>
    <div class="container">
        <h1 class="header-pos"> Choose Outlet </h1>
        <div class="col-md-6 offset-md-3">
            @foreach ($outlets as $p)
            <a href="/posadd/{{$p->id}}">
                <div class="kotak  mt-4  mr-5 ml-5">
                    <i class="fa fa-building-o"></i>
                    <h4>{{$p->name_outlet}}</h4>
                    <p>{{$p->address_outlet}}</p>
                    <p>{{$p->contact_number}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@stop
