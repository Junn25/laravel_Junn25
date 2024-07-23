@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Patients List') }}
                    <a href="{{ route('patients.create') }}" class="btn btn-success float-right text-end">Add Patient</a>
                </div>

                <div class="card-body">
                    <form id="filter-form">
                        <label for="id_rumah_sakit">Pilih Rumah Sakit:</label>
                        <select name="id_rumah_sakit" id="id_rumah_sakit">
                            <option value="">Semua Rumah Sakit</option>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->nama_rumah_sakit }}</option>
                            @endforeach
                        </select>
                    </form>
                    
                    <table class="table" id="patients-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Nama Rumah Sakit</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchPatients(hospitalId) {
            $.ajax({
                url: "{{ route('patients.index') }}",
                type: 'GET',
                data: { id_rumah_sakit: hospitalId },
                success: function(response) {
                    $('#patients-table tbody').html(response.html);
                }
            });
        }

        $('#id_rumah_sakit').change(function() {
            var hospitalId = $(this).val();
            fetchPatients(hospitalId);
        });

    $(document).on('click', '.delete-patient', function() {
            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            if (confirm("Are you sure you want to delete this patient?")) {
                $.ajax({
                    url: "/patients/" + id,
                    type: 'DELETE',
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                        $('#patient-' + id).remove();
                        alert("Patient deleted successfully.");
                    },
                    error: function(xhr) {
                        alert("An error occurred: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
        });

        fetchPatients($('#id_rumah_sakit').val());
    });
</script>
@endsection