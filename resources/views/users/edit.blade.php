@extends('layout')

@section('main')
<div id="p-dashboard">
    @if( $user->role == 'admin' )
    <div class="row">
        <div class="col col-12">
            <div class="alert alert-danger">
                    Holy cow you're an admin !
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col col-3">@include('components/user-menu',['active'=>'profile'])</div>
        <div class="col col-1"></div>
        <div class="col col-5">
            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">ID</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $user->id }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $user->username }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">API token</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ $user->api_token }}</p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Full name</label>
                    <div class="col-sm-8">
                        <input type="text" name="fullname" class="form-control" value="{{ $user->fullname }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Picture</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="file" name="picture">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-4 col-form-label">Created at</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">{{ date('Y-m-d H:i:s', strtotime($user->created_at)) }}</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col col-3 text-center">
            @if( $user->picture && strlen($user->picture) )
                <img src="/img/users/{{ $user->picture }}" style="max-width:250px">
            @else
                <img src="/img/users/default.png">
            @endif
        </div>
    </div>
</div>
@endsection
