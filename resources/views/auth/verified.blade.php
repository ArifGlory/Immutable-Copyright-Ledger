@extends('layouts.guest')

@section('content')
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="text-center">
                                           @if($message = session('message'))
                                               <h5 class="mb-0">{{ $message['title'] }}</h5>
                                               <p class="text-muted mt-2">{{ $message['message'] }}</p>
                                           @endif
                                       </div>
                                       <div class="mt-5 text-center">
                                           <p class="text-muted mb-0">Akun anda belum di aktifkan ? <a href="{{url('register')}}"
                                                                                                       class="text-primary fw-semibold">
                                                   Daftar sekarang </a></p>
                                       </div>
                                   </div>
                               </div>
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

        $(document).ready(function () {






        });
    </script>
@endpush
