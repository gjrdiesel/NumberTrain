@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <add-account-button :types="{{ \App\Account::getTypes() }}">
                    {{ csrf_field() }}
                </add-account-button>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="d-none" for="date_range">Change Date Range</label>
                    <select name="date_range" id="date_range" class="form-control">
                        <option>Last 7 days</option>
                        <option>Last 3 months</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center justify-content-center d-flex flex-column">
                <p>Last checked, {{ $user->lastUpdate }}, you have</p>
                <h1 class="mb-5 follow-count">
                    {{ number_format($user->totalFollowers) }}
                    <small>Followers</small>
                </h1>
                <div class="row">
                    @foreach($user->accounts as $account)
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div>
                                        {{ number_format($account->totalFollowers) }}
                                    </div>
                                    <sparkline :data="{{ json_encode($account->last7Days) }}"></sparkline>
                                    <div>
                                        <i class="fab fa-{{ strtolower($account->type) }}"></i> {{ $account->username }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($user->accounts->isEmpty())
                        <div class="col-md-12">
                            This place looks empty. <br/>
                            Add a social media account above.
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <bar-chart :data="{{ json_encode($user->last7Days) }}"></bar-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
