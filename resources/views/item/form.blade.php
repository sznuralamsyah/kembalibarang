@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Form Barang') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <ul class="alert alert-danger list">
                                @foreach ($errors->all() as $error)
                                    <li class="list-item">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('item.' . $type, $item) }}" enctype="multipart/form-data">
                            @csrf @method($type == 'store' ? 'POST' : 'PUT')

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('item_name') is-invalid @enderror" name="item_name"
                                        value="{{ old('item_name', $item->item_name) }}" required autofocus>

                                    @error('item_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Kategori') }}</label>

                                <div class="col-md-6">
                                    <select name="category_id" id="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="type" value="{{ request()->get('type') }}">

                            <div class="row mb-3">
                                <label for="main_picture"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Gambar 1') }}</label>

                                <div class="col-md-6">
                                    <input id="main_picture" type="file" accept="image/*"
                                        class="form-control @error('main_picture') is-invalid @enderror" name="main_picture"
                                        value="{{ old('main_picture', $item->main_picture) }}">

                                    @error('main_picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="second_picture"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Gambar 2') }}</label>

                                <div class="col-md-6">
                                    <input id="second_picture" type="file" accept="image/*"
                                        class="form-control @error('second_picture') is-invalid @enderror" name="second_picture"
                                        value="{{ old('second_picture', $item->second_picture) }}">

                                    @error('second_picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="third_picture"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Gambar 3') }}</label>

                                <div class="col-md-6">
                                    <input id="third_picture" type="file" accept="image/*"
                                        class="form-control @error('third_picture') is-invalid @enderror" name="third_picture"
                                        value="{{ old('third_picture', $item->third_picture) }}">

                                    @error('third_picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lost_found_date"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Kehilangan / Menemukan') }}</label>

                                <div class="col-md-6">
                                    <input id="lost_found_date" type="datetime-local"
                                        class="form-control @error('lost_found_date') is-invalid @enderror" name="lost_found_date"
                                        value="{{ old('lost_found_date', $item->lost_found_date) }}">

                                    @error('lost_found_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
