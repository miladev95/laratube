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
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->showRoles() as $role)
                                        {{$role}}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $userId = auth()->user()->id;
                                        $userRoles = $user->showRoles();
                                    @endphp

                                    @if($user->id !== $userId )
                                        <button class="btn btn-primary">View</button>
                                        <a href="{{route('superadmin.user.delete' , ['user' => $user->id])}}"
                                           class="btn btn-danger"
                                           onclick="return confirm('Are you sure you want to remove this user and his/her videos?')">Remove</a>
                                        @if(!in_array('Admin',$userRoles))
                                            <a href="{{route('superadmin.user.assign_admin' , ['user' => $user->id])}}"
                                               class="btn btn-primary"
                                               onclick="return confirm('Are you sure you want to assign admin role to this user?')">Assign Admin Role</a>
                                        @endif

                                        @if(!in_array('User',$userRoles))
                                            <a href="{{route('superadmin.user.assign_user' , ['user' => $user->id])}}"
                                               class="btn btn-primary mt-2"
                                               onclick="return confirm('Are you sure you want to assign user role to this user?')">Assign User Role</a>
                                        @endif

                                        @if(!in_array('Super Admin' ,$userRoles))
                                            <a href="{{route('superadmin.user.assign_super_admin' , ['user' => $user->id])}}"
                                               class="btn btn-primary mt-2"
                                               onclick="return confirm('Are you sure you want to assign super admin role to this user?')">Assign Super Admin Role</a>
                                        @endif
                                    @endif
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
