@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>
    <h3>Pending Doctor Requests</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendingDoctors as $doctor)
            <tr>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->user->email }}</td>
                <td>
                    <a href="{{ route('admin.view-doctor', $doctor->id) }}" class="btn btn-info">View</a>
                    <form action="{{ route('admin.approve-doctor', $doctor->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.reject-doctor', $doctor->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

