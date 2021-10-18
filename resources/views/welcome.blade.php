@extends('layouts.front')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SMTP Confiugrations</h1>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Configure SMTP</h6>

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

                    <form class="user" method="POST" action="{{ route('save_smtp_configuration') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Site Name<span class="error">*</span></label>
                            <input type="text" class="form-control" name="site_name"
                                value="{{ old('site_name') ?? ($SmtpConfiguration->site_name ?? '') }}"
                                placeholder="Site Name">
                        </div>

                        <div class="form-group">
                            <label>SMTP Driver<span class="error">*</span></label>
                            <input type="text" class="form-control" name="smtp_driver"
                                value="{{ old('smtp_driver') ?? ($SmtpConfiguration->smtp_driver ?? '') }}"
                                placeholder="SMTP Driver">
                        </div>

                        <div class="form-group">
                            <label>SMTP Host<span class="error">*</span></label>
                            <input type="text" class="form-control" name="smtp_host"
                                value="{{ old('smtp_host') ?? ($SmtpConfiguration->smtp_host ?? '') }}"
                                placeholder="SMTP Host">
                        </div>

                        <div class="form-group">
                            <label>SMTP Port<span class="error">*</span></label>
                            <input type="text" class="form-control" name="smtp_port"
                                value="{{ old('smtp_port') ?? ($SmtpConfiguration->smtp_port ?? '') }}"
                                placeholder="SMTP Port">
                        </div>

                        <div class="form-group">
                            <label>User Name<span class="error">*</span></label>
                            <input type="text" class="form-control" name="user_name"
                                value="{{ old('user_name') ?? ($SmtpConfiguration->user_name ?? '') }}"
                                placeholder="User Name">
                        </div>

                        <div class="form-group">
                            <label>Password<span class="error">*</span></label>
                            <input type="text" class="form-control" name="password"
                                value="{{ old('password') ?? ($SmtpConfiguration->password ?? '') }}"
                                placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>From Name<span class="error">*</span></label>
                            <input type="text" class="form-control" name="from_name"
                                value="{{ old('from_name') ?? ($SmtpConfiguration->from_name ?? '') }}"
                                placeholder="From Name">
                        </div>

                        <div class="form-group">
                            <label>SMTP Encryption<span class="error">*</span></label>

                            <select name="smtp_encryption" class="form-control">
                                <option value="tls" @if (old('smtp_encryption') == 'tls' || (isset($SmtpConfiguration->smtp_encryption) && $SmtpConfiguration->smtp_encryption == 'tls')) selected @endif>TLS</option>
                                <option value="ssl" @if (old('smtp_encryption') == 'ssl' || (isset($SmtpConfiguration->smtp_encryption) && $SmtpConfiguration->smtp_encryption == 'ssl')) selected @endif>SSL</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>From Email<span class="error">*</span></label>
                            <input type="text" class="form-control" name="from_email"
                                value="{{ old('from_email') ?? ($SmtpConfiguration->from_email ?? '') }}"
                                placeholder="From Email">
                        </div>


                        <button class="btn btn-primary btn-user btn-block">
                            Configure
                        </button>
                        <hr>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
