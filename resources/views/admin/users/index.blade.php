@extends('layouts.master')

@section('name')
    Users List
@endsection


@section('form')

  <form method="get" action="{{ route('admin.users.index') }}">
    <div class="input-group no-border">
        <input type="text" value="{{ request()->search }}" class="form-control" placeholder="Search..." name="search">
        <div class="input-group-append">
          <div class="input-group-text">
            <i class="now-ui-icons ui-1_zoom-bold"></i>
          </div>
        </div>
    </div>
  </form>

@endsection

@section('content')
<div class="user">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"> Registered Users</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead class="text-info">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>User Roles</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
              
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->phone }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray() ) }}</td>
                          <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm">EDIT</a>
                          </td>
                          <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                            </form>
                          </td>
                      </tr>

                    @endforeach
                  </tbody>
                </table>
                {{$users->links()}}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection