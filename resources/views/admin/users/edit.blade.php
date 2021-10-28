@extends('layouts.master')

@section('title')
    Edit-Register | reservation system
@endsection

@section('name')
    User Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-group" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select class="form-control roles " multiple="" name="roles[]">
                                        @foreach($roles as $role)
                                    
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-success float-left">Update</button>
                            </form>
                            <form class="form-group" action="{{ route('admin.users.index')}}" method="post">
                                @csrf
                                @method('get')
                                <button type="submit" class="btn btn-danger float-right">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.roles').select2();
        });
    </script>
@endsection