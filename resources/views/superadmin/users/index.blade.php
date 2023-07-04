@extends('superadmin.base')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">Users</div>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button class="btn btn-primary">View</button>
                                    <a href="{{route('superadmin.user.delete' , ['user' => $user->id])}}" class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to remove this user and his/her videos?')">Remove</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
