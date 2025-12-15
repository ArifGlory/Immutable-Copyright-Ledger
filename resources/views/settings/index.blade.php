@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')
@push('css')
    <style>
        .error {
            border-color: red;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
        }
    </style>
@endpush
@section('content')
    @if(session('success') || session('error'))
        <div
            class="toast align-items-center text-white {{session('success') ? "bg-success" : "bg-danger" }} show border-0 top-5 end-3 position-absolute"
            role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 100">
            <div class="d-flex">
                <div class="toast-body">
                    {{session('success')}} {{session('error')}}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Pengaturan Aplikasi
                </h2>
            </div>
            <div class="alert alert-primary text-white" id="alertInformation" role="alert">
                <div id="alertSpinner" class="spinner-border text-light" role="status">
                    <span class="sr-only"></span>
                </div>
                <strong class="m-lg-1">
                    <span id="txtAlert"></span>
                </strong>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="nav-wrapper position-relative end-0 mb-3">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#deskripsi-tabs-icons" role="tab" aria-controls="dashboard" aria-selected="true">
                                    <i class="fas fa-gear text-sm me-2"></i> Deskripsi Aplikasi
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">

                        <!-- Tab 2 Content -->
                        <div class="tab-pane fade show active" id="deskripsi-tabs-icons" role="tabpanel" aria-labelledby="admob-tab">
                            <h5>Deskripsi dan pengaturan dasar aplikasi</h5>
                            <div class="row mt-3">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>App Name</label>
                                        <input id="app_name" class="form-control setting-deskripsi" value="{{$settings['app_name']}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>App Slogan</label>
                                        <input id="app_slogan" class="form-control setting-deskripsi" value="{{$settings['app_slogan']}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram URL</label>
                                        <input id="app_instagram" class="form-control setting-deskripsi" value="{{$settings['app_instagram']}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input id="app_facebook" class="form-control setting-deskripsi" value="{{$settings['app_facebook']}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="app_email" class="form-control setting-deskripsi" value="{{$settings['app_email']}}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <button id="btn-save-setting-deskripsi" class="btn btn-md btn-primary"><i class="fas fa-save text-sm me-2"></i> Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
@push('scripts')
    @include('components.jsDatatable')
    <script type="text/javascript">
        let alertInformation = $("#alertInformation");
        let txtAlert = $("#txtAlert");

        function showLoadingAlert(text) {
            $("#alertSpinner").show();
            txtAlert.text(text);
            alertInformation.show();
        }

        function showInfoAlert(text) {
            $("#alertSpinner").hide();
            txtAlert.text(text);
            alertInformation.show();
        }

        function dismissInfoAlert() {
            alertInformation.hide();
        }

        function validateFormFacebook() {
            let isValid = true;
            $('.setting-fb').each(function () {
                // Cek input dan textarea
                if ($(this).is('input[type="text"], input[type="number"], input[type="date"]') && $(this).val().trim() === '') {
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

        function validateFormDeskripsi() {
            let isValid = true;
            $('.setting-deskripsi').each(function () {
                // Cek input dan textarea
                if ($(this).is('input[type="text"], input[type="number"], input[type="date"]') && $(this).val().trim() === '') {
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

        function saveSetting(formData){
            showLoadingAlert("Menyimpan data..");

            $.ajax({
                url: '{{route('setting.store')}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function (e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function (response) {
                    dismissInfoAlert();

                    if (response.status === false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.msg,
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: response.msg,
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });

                        setTimeout(function() {
                           location.reload();
                        }, 2000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //console.log(xhr);
                    dismissInfoAlert();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                }
            });
        }



        $(document).ready(function () {
            $('.select2').select2();
            dismissInfoAlert();

           /* $("#btn-save-setting-fb").click(function (){
                if(validateFormFacebook() === true){
                    let facebook_page_access_token = $("#facebook_page_access_token").val();
                    let facebook_long_access_token = $("#facebook_long_access_token").val();
                    let facebook_app_id = $("#facebook_app_id").val();
                    let facebook_app_secret = $("#facebook_app_secret").val();
                    let default_graph_api_version = $("#facebook_default_graph_api_version").val();

                    let form_data = new FormData();
                    form_data.append('_token', '{{@csrf_token()}}');
                    form_data.append('facebook_page_access_token', facebook_page_access_token);
                    form_data.append('facebook_long_access_token', facebook_long_access_token);
                    form_data.append('facebook_app_id', facebook_app_id);
                    form_data.append('facebook_app_secret', facebook_app_secret);
                    form_data.append('default_graph_api_version', default_graph_api_version);


                    saveSetting(form_data);
                }
            });*/

            $("#btn-save-setting-deskripsi").click(function (){
                if(validateFormDeskripsi()){
                    let form_data = new FormData();
                    form_data.append('_token', '{{@csrf_token()}}');
                    form_data.append('app_name', $("#app_name").val());
                    form_data.append('app_slogan', $("#app_slogan").val());
                    form_data.append('app_instagram', $("#app_instagram").val());
                    form_data.append('app_facebook', $("#app_facebook").val());
                    form_data.append('app_email', $("#app_email").val());

                    saveSetting(form_data);
                }
            });
        });

    </script>
@endpush
