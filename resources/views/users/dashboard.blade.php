@extends('layout')

@section('main')
<div id="p-dashboard">
    <div class="row">
        <div class="col col-3">@include('components/user-menu',['active'=>'dashboard'])</div>
        <div class="col col-1"></div>
        <div class="col col-8">
            dashboard
        </div>
    </div>
</div>
@endsection
