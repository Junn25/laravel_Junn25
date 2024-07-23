@extends('layouts.app')
@section('head')
<title>Edit Data Hospital</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
@endsection
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Hospital</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('hospitals.update', $hospital->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_rumah_sakit">Nama Rumah Sakit:</label>
            <input type="text" name="nama_rumah_sakit" class="form-control" id="nama_rumah_sakit" value="{{ $hospital->nama_rumah_sakit }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" class="form-control" id="alamat" required>{{ $hospital->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $hospital->email }}" required>
        </div>
        <div class="form-group">
            <label for="telepon">Telepon:</label>
            <input type="text" name="telepon" class="form-control" id="telepon" value="{{ $hospital->telepon }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
@section('script')
@endsection
