@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        @include('administration.users.includes.user_table', compact('users'))
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
