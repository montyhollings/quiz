@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @guest
            @include('layouts.guest_dashboard')
        @endguest
    </div>
</div>
@endsection
