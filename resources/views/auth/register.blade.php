@extends('layouts.guest')

@section('content')
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Selamat Datang</h1>
                            <p class="text-lead text-white">Silahkan isi formulir pendaftaran berikut untuk membuat akun </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="alert alert-primary text-white d-none" id="alertInformation" role="alert">
                            <div id="alertSpinner" class="spinner-border text-light" role="status">
                                <span class="sr-only"></span>
                            </div>
                            <strong class="m-lg-1">
                                <span id="txtAlert">Loading ... </span>
                            </strong>
                        </div>
                        <div class="card z-index-0">
                            <div class="card-body">
                                <form role="form text-left">
                                    <div class="mb-3">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" id="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="phone" class="form-control" placeholder="No. telepon (Whatsapp)" aria-label="phone" aria-describedby="phone">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <input type="password" id="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                    <div class="mb-1 text-center">
                                        <small id="txtRegisterInfo">Kami akan mengirimkan email konfirmasi ke alamat email Anda. Pastikan untuk membuka email tersebut dan mengikuti petunjuknya agar akun Anda aktif.</small>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" id="btnSignUp" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Sudah punya akun ? <a href="{{route('login')}}" class="text-dark font-weight-bolder">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            function showToast(icon,message,title){
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    timerProgressBar: true
                });
            }

            function showLoadingRegister(){
                $("#alertInformation").removeClass('d-none');
            }

            function dismissLoadingRegister(){
                $("#alertInformation").addClass('d-none');
            }

            function checkPasswordConfirmation(){
                let isValid = false;
                let pass = $("#password").val();
                let password_confirm = $("#password_confirmation").val();

                if(pass === password_confirm){
                    isValid = true;
                }

                return isValid;
            }

            function validateForm() {
                let isValid = true;

                // Cek input dan textarea
                $('.form-control').each(function() {
                    if ($(this).is('input[type="text"], input[type="number"], input[type="date"], textarea') && $(this).val().trim() === '') {
                        $(this).addClass('error');
                        if ($(this).next('.error-message').length === 0) {
                            $(this).after('<div class="error-message">Field ini wajib diisi.</div>');
                        }
                        isValid = false;
                    } else {
                        $(this).removeClass('error');
                        $(this).next('.error-message').remove();
                    }
                });

                return isValid;
            }

            function registerUser(){
                console.log("registering...");

                let data = new FormData();
                data.append('name', $("#name").val());
                data.append('email', $("#email").val());
                data.append('phone', $("#phone").val());
                data.append('password', $("#password").val());
                data.append('_token', '{{@csrf_token()}}');

                $.ajax({ //AJAX START
                    url: '{{route('register.store')}}',
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function (e) {
                        if (e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                        showLoadingRegister();
                    },
                    success: function (response) {//SUCCESS
                        dismissLoadingRegister();

                        if (response.status === 'error') {
                            showToast('error',response.message,'Gagal!');
                        } else {
                            showToast('success',response.message,'Sukses!');
                            $("#txtRegisterInfo").text(response.message);

                        }
                    },//END SUCCESS
                    error: function (xhr, ajaxOptions, thrownError) {
                        dismissLoadingRegister();

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            showToast('error', xhr.responseJSON.message);
                        } else {
                            showToast('info', 'terjadi kesalahan coba lagi nanti');
                        }
                    }
                });

            }


            $("#btnSignUp").click(function (){
                if(!checkPasswordConfirmation()){
                    showToast('error','Konfirmasi password tidak valid','Gagal');
                }else if(!validateForm()){
                    showToast('error','Ada data yang belum di-isi','Gagal');
                }else{
                    registerUser();
                }
            });
        });
    </script>
@endpush
