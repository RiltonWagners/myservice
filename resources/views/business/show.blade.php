@extends('layouts.app')

@section('content')

<style lang="scss">
    .ql-align-right {
        text-align: right;
    }
    .ql-align-center {
        text-align: center;
    }
    .ql-align-left {
        text-align: left;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="text-align: -webkit-center;">
                                    <img src="/{{ !empty($business->path) ? $business->path : 'img/image.jpg'; }}" class="img-fluid" alt="..." style="border-radius: 100%;width: 50%;">
                                    <div style="text-align: -webkit-center; padding-top: 15px;">
                                        <span style="font-weight: bold;font-size:20px; color: #4a4a4a;">{{$business->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0px 20px 30px 20px; text-align: -webkit-center;">
                            <span class="mb-2 text" style="font-size: 14px;">
                                <a href="https://www.google.com/maps/search/?api=1&query={{$business->street}},+{{$business->number}},+{{$business->city->name}},+{{$business->city->uf}},+{{$business->zipcode}}" target="_blank" style="text-decoration: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-top: -12px; color: #fe5002">
                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    <span style="color:#fe5002;font-weight: bold;font-size:14px">{{$business->City->name}} - {{$business->City->state->name}}</span>
                                </a>
                            </span>
                        </div>
                        <div class="card-body" style="padding: 0 20px;">
                            <div class="media-body-category-item">
                                <div style="text-align: -webkit-center;">
                                    <span style="font-size: 16px; color: #4a4a4a;" class="mb-0"><strong>{{$business->BusinessService[0]->service[0]->category->name}}</strong></span>
                                </div>
                                @foreach($business->BusinessService as $service)
                                    <div style="padding: 0 10px 5px 10px; line-height: 22px; background-color: #e8e8e8; border-radius: 11px; color: #000; font-size: 14px; margin: 2px; max-width: max-content; border-style: groove;">{{$service->service[0]->name}}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body" style="padding: 10px 20px; margin-top:20px;">
                            <div class="media-body-category-item">
                                <div style="text-align: -webkit-center;">
                                    <span style="font-size: 16px; color: #4a4a4a;" class="mb-0">
                                        <strong>Informações de contato</strong>
                                    </span>
                                </div>
                                <div style="padding: 10px 10px; line-height: 22px;  color: #000; font-size: 14px; margin: 2px; max-width: max-content;">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{$business->street}},+{{$business->number}},+{{$business->city->name}},+{{$business->city->uf}},+{{$business->zipcode}}" target="_blank" style="text-decoration: none; color: #000;">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-top: -12px; color: #fe5002">
                                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            </svg>
                                            <span style="padding-left: 3px;">{{$business->street}} {{ !empty($business->number) ? ', '.$business->number : ''}} - {{$business->district}} - {{$business->city->name}}/{{$business->city->uf}}</span>
                                        </div>
                                    </a>
                                </div>
                                @if(!empty($my_business->phone))
                                    <div style="padding: 10px 10px; line-height: 22px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">
                                        <a href="#" target="_blank" style="text-decoration: none; color: #000;">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16" style="margin-top: -6px; color: #fe5002">>
                                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                                </svg>
                                                <span style="padding-left: 5px;">{{$business->phone}}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if(!empty($my_business->instagram))
                                    <div style="padding: 10px 10px; line-height: 22px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">
                                        <a href="https://www.instagram.com/{{$business->instagram}}" target="_blank" style="text-decoration: none; color: #000;">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16" style="margin-top: -6px; color: #fe5002">
                                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                                </svg>
                                                <span style="padding-left: 5px;">{{__('Instagram')}}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                @if(!empty($my_business->whatsapp))
                                    <div style="padding: 10px 10px; line-height: 22px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">
                                        <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $business->whatsapp) }}" target="_blank" style="text-decoration: none; color: #000;">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16" style="margin-top: -6px; color: #fe5002">
                                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                                </svg>
                                                <span style="padding-left: 5px;">{{$business->whatsapp}}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 mb-9 mb-sm-0">
                        <div class="card-body" style="padding-bottom: 0px;">
                            <span style="color:#fe5002;font-weight: bold;font-size:38px">{{$business->name}}</span>
                        </div>
                        <div class="card-body">
                            {!! $business->description !!}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="col-md-14">
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        $("#id_category").change(function() {
            $("#id_service").html("");
            $("#id_service").attr("disabled", "disbled");
            const url = $('#personForm').attr("data-services-url");
            id_category = $(this).val();

            $.ajax({
                url: url,
                data: {
                    'id_category': id_category,
                },
                success: function(data) {
                    if (data) {
                        $("#id_service").prop("disabled", false);
                        $("#id_service").html(data)
                    };
                }
            })
        });

        $("#uf").change(function() {
            $("#id_city").val("");
            const url = $('#personForm').attr("data-cities-url");
            uf = $(this).val();

            $.ajax({
                url: url,
                data: {
                    'uf': uf,
                },
                success: function(data) {
                    $("#id_city").html(data);
                }
            })
        });

        $("#zipcode2").change(function() {
            $('#loading').css('display', 'block');
            $("#district").val("");
            const url = $('#personForm').attr("data-district-url");
            zipcode = $(this).val();
            console.log(zipcode);
            $.ajax({
                url: url,
                data: {
                    'zipcode': zipcode,
                },
                success: function(data) {
                    $('#loading').css('display', 'none');
                    $("#district").html(data);
                }
            })
        });

    });

    </script>

    @include('functions.loadzipcode')

@endsection