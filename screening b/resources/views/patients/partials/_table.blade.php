                            @foreach($patients as $patient)
                                <tr id="patient-{{ $patient->id }}">
                                    <td>{{ $patient->id }}</td>
                                    <td>{{ $patient->nama_pasien }}</td>
                                    <td>{{ $patient->alamat }}</td>
                                    <td>{{ $patient->telepon }}</td>
                                    <td>{{ $patient->hospital->nama_rumah_sakit }}</td>
                                    <td>
                                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger delete-patient" data-id="{{ $patient->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
