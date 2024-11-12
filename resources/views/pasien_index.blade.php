@extends('layouts.app_modern', ['title' => 'Data Pasien ']);

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Data pasien</h5>
    </div>
    <div class="card-body">
        <a href="/pasien/create" class="btn btn-primary">Tambah Data</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NO PASIEN</th>
                    <th>NAMA</th>
                    <th>UMUR</th>
                    <th>JENIS KELAMIN</th>
                    <th>ALAMAT</th>
                    <th>TANGGAL BUAT</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasien as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->no_pasien }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->alamat}}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="/pasien/{{ $item->id }}/edit" class="btn btn-warning btn-sm ml-2">Edit</a>
                        <form action="/pasien/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-2"
                                onclick="return confirm('Apakan Anda yakin ingin menghapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $pasien->links() !!}
    </div>
</div>
@endsection