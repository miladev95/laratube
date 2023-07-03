here
@if($user->hasRole('admin'))
    here2
    @extends('admin.base')

@elseif($user->hasRole('user'))
    here3
    @extends('base')
@endif

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Welcome {{ $user->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
