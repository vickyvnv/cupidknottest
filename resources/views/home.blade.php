@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} <br>
                    {{ __('Youu Match Preference') }}
                    <table>
                        <thead>
                            <tr>
                                <th> id</th>
                                <th> First name</th>
                                <th> last name  </th>
                                <th> Occupation </th>
                                <th> Annual income</th>
                                <th> Family type </th>
                                <th> Email </th>
                                @if(auth()->user()->is_admin == 0)<th> Match calculate </th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @if(auth()->user()->is_admin == 0)
                                @foreach($matchList as $match)
                                    <tr>
                                        <td> {{$match->id}} </td>
                                        <td> {{$match->first_name}} </td>
                                        <td> {{$match->last_name}} </td>
                                        <td> {{$match->occupation}} </td>
                                        <td> {{$match->annual_income}} </td>
                                        <td> {{$match->family_type}} </td>
                                        <td> {{$match->email}} </td>
                                        <td>  
                                            @if($match->occupation == auth()->user()->occupation && $match->family_type == auth()->user()->family_type)
                                                100%
                                            @elseif($match->occupation == auth()->user()->occupation || $match->family_type == auth()->user()->family_type)
                                                50%
                                            @else
                                                30%
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(auth()->user()->is_admin == 1)
                                @foreach($allUser as $user)
                                    <tr>
                                        <td> {{$user->id}} </td>
                                        <td> {{$user->first_name}} </td>
                                        <td> {{$user->last_name}} </td>
                                        <td> {{$user->occupation}} </td>
                                        <td> {{$user->annual_income}} </td>
                                        <td> {{$user->family_type}} </td>
                                        <td> {{$user->email}} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
