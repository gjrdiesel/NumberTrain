@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <add-account-button>
                    {{ csrf_field() }}
                </add-account-button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>Last checked, 5 mins ago, you are up</p>
                <h1>+51 Followers</h1>
                <div class="row">
                    <div class="col-md-4">
                        Twitter
                    </div>
                    <div class="col-md-4">
                        Youtube
                    </div>
                    <div class="col-md-4">
                        Instagram
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        Twitter
                    </div>
                    <div class="col-md-4">
                        Youtube
                    </div>
                    <div class="col-md-4">
                        Instagram
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        Total progress the last 7 days:
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
