@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            {{ __('List') }} {{ request('type') == 'lost' ? 'Kehilangan' : 'Penemuan' }}
                            <a href="{{ route('item.create', ['type' => request('type')]) }}"
                                class="btn btn-sm btn-info">Tambah</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">Belum
                                    Terselesaikan
                                    @if (count($notResolvedYet) > 0)
                                        <span class="badge bg-danger">{{ count($notResolvedYet) }}</span>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">Menunggu
                                    Konfirmasi
                                    @if (count($waitingConfirmation) > 0)
                                        <span class="badge bg-danger">{{ count($waitingConfirmation) }}</span>
                                    @endif
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    Selesai
                                    @if (count($done) > 0)
                                        <span class="badge bg-danger">{{ count($done) }}</span>
                                    @endif
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                @include('item.table', ['items' => $notResolvedYet])
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @include('item.table', ['items' => $waitingConfirmation])
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                @include('item.table', ['items' => $done])
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
