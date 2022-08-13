@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('theme') }}</th>
                                    <th scope="col">{{ __('text') }}</th>
                                    <th scope="col">{{ __('photo') }}</th>
                                    <th scope="col">{{ __('date') }}</th>
                                    <th scope="col">{{ __('status') }}</th>
                                    <th scope="col">{{ __('button') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->theme }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td><img style="width:70px;
                                                height:70px;
                                                border-radius:50%;
                                                overflow:hidden;
                                            " src="{{ $message->url_file }}" alt="err"></td>
                                        <td>{{ $message->time }}</td>
                                        <td>
                                            @if ($message->status == 'new')
                                                <span class="btn btn-danger">{{ __('not read') }}</span>
                                            @else
                                                <span class="btn btn-success">{{ __('read') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($message->status == 'new')
                                            <form action="{{ route('change') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <button type="submit" class="btn btn-success">{{ __('success') }}</button>
                                            </form>
                                            @endif
                                        </td>
                                         </tr>
                                    @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
