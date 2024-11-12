@extends('layouts.app_modern', ['title' => 'Data Poli ']);

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Data Poli</h3>
        <a href="/poli/create" class="btn btn-primary">Tambah Data</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>BIAYA</th>
                    <th>KETERANGAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($poli as $base)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $base->nama }}</td>
                    <td>{{ $base->biaya }}</td>
                    <td>{{ $base->keterangan }}</td>
                    <td>
                        <a href="/poli/{{ $base->id }}/edit" class="btn btn-warning btn-sm ml-2">Edit</a>
                        <form action="/poli/{{ $base->id }}" method="POST" class="d-inline">
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
        {!! $poli->links() !!}
    </div>
</div>
@endsection