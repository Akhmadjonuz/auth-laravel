@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('send form') }}</div>

                    <div class="card-body">
                        @if (!empty($error))
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endif
                        <form action="{{ route('send') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="theme">{{ __('theme') }}</label>
                                <input type="text" class="form-control" id="theme" name="theme"
                                    placeholder="{{ __('theme') }}">
                            </div>
                            <div class="form-group">
                                <label for="text">{{ __('text') }}</label>
                                <textarea class="form-control" id="text" name="text" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">{{ __('photo') }}</label>
                                <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('send') }}</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
