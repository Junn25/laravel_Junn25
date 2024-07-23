@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Patient') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" 
                                   class="form-control @error('nama_pasien') is-invalid @enderror" 
                                   name="nama_pasien" 
                                   id="nama_pasien" 
                                   value="{{ old('nama_pasien', $patient->nama_pasien) }}" 
                                   required>
                            @error('nama_pasien')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" 
                                   class="form-control @error('alamat') is-invalid @enderror" 
                                   name="alamat" 
                                   id="alamat" 
                                   value="{{ old('alamat', $patient->alamat) }}" 
                                   required>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telepon">No Telpon</label>
                            <input type="text" 
                                   class="form-control @error('telepon') is-invalid @enderror" 
                                   name="telepon" 
                                   id="telepon" 
                                   value="{{ old('telepon', $patient->telepon) }}" 
                                   required>
                            @error('telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_rumah_sakit">Rumah Sakit</label>
                            <select class="form-control @error('id_rumah_sakit') is-invalid @enderror" 
                                    name="id_rumah_sakit" 
                                    id="id_rumah_sakit" 
                                    required>
                                <option value="">-- Select Hospital --</option>
                                @foreach ($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}" 
                                            {{ (old('id_rumah_sakit', $patient->id_rumah_sakit) == $hospital->id) ? 'selected' : '' }}>
                                        {{ $hospital->nama_rumah_sakit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_rumah_sakit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-4">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
