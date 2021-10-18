@extends('layouts.front')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Send Email</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Email</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (session()->has('error_message'))
                        <div class="alert alert-danger">
                            {{ session()->get('error_message') }}
                        </div>
                    @endif

                    <form class="user" method="POST" action="{{ route('send_email') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>TO Mail<span class="error">*</span></label>
                            <input type="text" class="form-control" name="to_mail" value="{{ old('to_mail') }}"
                                placeholder="To Email">
                        </div>

                        <div class="form-group">
                            <label>Subject<span class="error">*</span></label>
                            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                placeholder="Subject">
                        </div>

                        <div class="form-group">
                            <label>Content<span class="error">*</span></label>
                            <textarea type="text" class="form-control" name="content">  {{ old('content') }} </textarea>
                        </div>



                        <button class="btn btn-primary btn-user btn-block">
                            Send Email
                        </button>
                        <hr>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
