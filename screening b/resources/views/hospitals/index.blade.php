@extends('layouts.app')
@section('head')
    <title>Hospital Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Hospital Management</h2>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <a href="{{ route('hospitals.create') }}" class="btn btn-success mb-2">Add Hospital</a>

    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Nama Rumah Sakit</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th width="170px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hospitals as $hospital)
            <tr id="hospital-{{ $hospital->id }}">
                <td class="text-center">{{ $hospital->id }}</td>
                <td>{{ $hospital->nama_rumah_sakit }}</td>
                <td>{{ $hospital->alamat }}</td>
                <td>{{ $hospital->email }}</td>
                <td>{{ $hospital->telepon }}</td>
                <td class="text-center">
                    <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="POST">
                        <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-primary">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger delete-hospital" data-id="{{ $hospital->id }}">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $hospitals->links() !!}
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.delete-hospital').click(function() {
        var id = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");

        if(confirm("Are you sure you want to delete this hospital?")) {
            $.ajax({
                url: "/hospitals/" + id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (response) {
                    $('#hospital-' + id).remove()
                    alert("Hospital deleted successfully.")
                    window.location.href = "{{ route('hospitals.index') }}";
                },
                error: function (xhr) {
                    alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });
        }
    });
});
</script>
@endsection
