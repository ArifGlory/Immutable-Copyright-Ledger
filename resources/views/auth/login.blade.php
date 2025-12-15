@extends('layouts.guest')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h4>Selamat Datang di</h4>
                                    <h3 class="font-weight-bolder text-info text-gradient"> {{getSetting('app_name')}} </h3>
                                    <p class="mb-0"> {{getSetting('app_slogan')}} </p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <label>Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="Email" value="{{old('email')}}" aria-label="Email"
                                                   aria-describedby="email-addon" required autocomplete="email"
                                                   autofocus>
                                            @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                   placeholder="Password" value="" aria-label="Password"
                                                   aria-describedby="password-addon" required
                                                   autocomplete="current-password">
                                            @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            {{--<label class="form-check-label" for="remember">Remember me</label>--}}
                                            {{-- <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>--}}
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-primary text-white w-100 mt-4 mb-0">Sign in
                                            </button>
                                            <br>
                                            <br>
                                            <p class="text-sm mt-3 mb-0">Belum punya akun ? <a href="{{route('register')}}" class="text-dark font-weight-bolder">Daftar</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div
                                    class="oblique-image bg-cover position-absolute fixed-top ms-auto min-vh-100 z-index-0 ms-n6"
                                    style="background-image:url('../assets/img/curved-images/curved14.jpg')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
