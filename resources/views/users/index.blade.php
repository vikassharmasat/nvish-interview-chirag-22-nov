@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        @can('force-logout')
                        <th scope="col">Status</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>

                    @forelse($users_list as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>
                            @if((Auth::check() && $user->avatar) && file_exists(public_path('storage/'.$user->avatar)))
                                @php $avatar = asset('storage/'.$user->avatar) @endphp
                            @else
                                @php $avatar = asset('storage/avatar/avatar.png') @endphp
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <img src="{{$avatar}}" alt="Avatar" class="img-thumbnail" width="150px" height="150px">
                                </div>
                            </div>
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @can('force-logout')
                            @if(Cache::has('user-is-online-' . $user->id))
                            <td>
                                <form action="logout/{{$user->id}}" method="get">
                                    @csrf
                                    <button class="btn btn-primary">Online</button>
                                </form>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-danger">Offline</button>
                            </td>
                            @endif
                        @endcan
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No User Available</td>
                    </tr>
                </tbody>
                    @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
