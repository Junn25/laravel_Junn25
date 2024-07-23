@if ($patients->isEmpty())
    <p>No patients found.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Rumah Sakit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patient->nama_pasien }}</td>
                    <td>{{ $patient->alamat }}</td>
                    <td>{{ $patient->telepon }}</td>
                    <td>{{ $patient->hospital->nama_rumah_sakit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $patients->links() }}
@endif
