{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Organization')

@section('content_header')
    <h1>Organization</h1>
@stop

@section('content')
        <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Welcome to this Medical Admin Panel</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('organization.create') }}"> Create New Organization</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Identifier</th>
            <th>Status</th>
            <th>Domain</th>
            <th>Ports(without SSL/ SSL)</th>
            <th>Instance name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($organizations as $organization)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $organization->name }}</td>
            <td>{{ $organization->identifier }}</td>
            <td>{{ $organization->status }}</td>
            <td>{{ $organization->domain?'http://'.$organization->domain.':'.$organization->port:'' }}</td>
            <td>{{ $organization->port?$organization->port:'' }}/{{ $organization->sslPort?$organization->sslPort:'' }}</td>
            <td>{{ $organization->instance_name?$organization->instance_name:'' }}</td>
            <td>
                <form action="{{ route('organization.destroy',$organization->id) }}" method="post">
                    <a class="btn btn-info" href="{{ route('organization.show',$organization->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('organization.edit',$organization->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>

        </tr>

        @endforeach

    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop