@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            {{ __('List Kehilangan') }}
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-stripped">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $item->item_name }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>{{ $item->category->category_name }}</td>
                                </tr>
                                @if ($item->type == 'lost')
                                    <tr>
                                        <td>Gambar 1</td>
                                        <td><img src="{{ $item->main_picture }}" style="max-width: 600px"></td>
                                    </tr>
                                    <tr>
                                        <td>Gambar 2</td>
                                        <td><img src="{{ $item->second_picture }}" style="max-width: 600px"></td>
                                    </tr>
                                    <tr>
                                        <td>Gambar 3</td>
                                        <td><img src="{{ $item->third_picture }}" style="max-width: 600px"></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kehilangan / Menemukan</td>
                                        <td>{{ $item->lost_found_date?->isoFormat('LLLL') }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Kontak Email</td>
                                        <td>{{ $item->user->email }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
