@extends('layouts.app')

@section('content')

@if(!@$my_business)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <span style="padding-top: 4px;">Meu negócio</span>

                                <a class="btn btn-outline-primary2 btn2" href="#" data-toggle="tooltip" title="Editar anúncio" style="float: right;">Editar</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <span style="padding-top: 4px;">Meu negócio</span>

                            @if(@$business) {{dd($business)}}
                                <a class="btn btn-outline-primary2 btn2" href="{{ route('business.edit', $business->id)  }}" data-toggle="tooltip" title="Editar anúncio" style="float: right;">Editar</a>
                            @endif

                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="col-md-14">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="title" class="form-label"><strong>{{$business->name}}</strong></label>
                                <!--<input type="text" class="form-control" id="title" name="title" value="{{$business->title}}" disabled style="background: white;">-->
                            </div>
                            <div class="col-md-6">
                                <!--<label for="description" class="form-label">Imagens</label>-->
                                <div id="carouselExample" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                   
                                        @forelse($business->businessImage as $i => $image)
                                        @if(!$i)
                                        <div class="carousel-item active" style="min-width: 56% !important; max-width: 100% !important;">
                                            <img src="/{{$image->path}}" class="img-thumbnail" width="800px" height="600px" alt="..." style="border-radius: 10px;border: none; width:550px; height:300px;">
                                        </div>
                                        @else
                                        <div class="carousel-item" style="min-width: 56% !important; max-width: 100% !important;">
                                            <img src="/{{$image->path}}" class="img-thumbnail" width="800px" height="600px" alt="..." style="border-radius: 10px;border: none; width:550px; height:300px;">
                                        </div>
                                        @endif
                                        @empty
                                        <div class="carousel-item active" style="min-width: 56% !important; max-width: 100% !important;">
                                            <img src="/img/image.jpg" class="img-thumbnail" alt="..." width="800px" height="600px" style="border-radius: 10px;border: none; width:550px; height:300px;">
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            
                            <div class="col-md-6 d-none d-md-block">
                                <!--<label for="description" class="form-label">Descrição</label>-->
                                <textarea class="form-control" id="description" name="description" rows="12" disabled style="background: white; resize: none; min-height: 297px; border: none;">{{$business->description}}</textarea>
                            </div>
                            <!--mobile-->
                            <div class="col-md-6 d-md-none">
                                <!--<label for="description" class="form-label">Descrição</label>-->
                                <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                    <label for="category" class="form-label">{{$business->description}}</label>
                                </div>
                            </div>
                            <!--mobile end-->
                            <div class="col-md-6">
                                <label for="category" class="form-label">Categoria</label>
                                <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                    <label for="category" class="form-label"><strong>{{$business->service->category->name}}</strong></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="id_service" class="form-label">Serviço</label>
                                <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                    <label for="id_service" class="form-label"><strong>{{$business->service->name}}</strong></label>
                                </div>
                            </div>
                            <fieldset class="d-none d-md-block" style="margin-top: 10px; margin-left:9px; margin-right: 9px; width: -webkit-fill-available; padding-bottom: 10px; padding-top: 5px; border: 1px solid #CCC; width: -webkit-fill-available;">
                                <legend style="float: none;width: 94px; padding: 0 0 4px 6px;margin-bottom: -5px; font-size: 16px;">Localização</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="_zipcode" class="form-label">CEP</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="_zipcode" class="form-label"><strong>{{$business->zipcode}}</strong></label>
                                        </div>
                                    </div>
                                                                   
                                    <div class="col-md-6">
                                        <label for="street" class="form-label">Logradouro</label>
                                        <div id="street"></div>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="street" class="form-label"><strong>{{$business->street}}</strong></label>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3" style="margin-top: initial;">
                                        <label for="state" class="form-label">Estado</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="state" class="form-label"><strong>{{$business->city->state->name}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-top: initial;">
                                        <label for="city" class="form-label">Município</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="city" class="form-label"><strong>{{$business->city->name}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-top: initial;">
                                        <label for="district" class="form-label">Bairro</label>
                                        <div id="district"></div>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="district" class="form-label"><strong>{{$business->district}}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--mobile-->
                            <fieldset class="d-md-none" style="margin-top: 10px; margin-left: 10px; margin-right: 10px; padding-bottom: 10px; padding-top: 5px; border: 1px solid #CCC; width: -webkit-fill-available;">
                                <legend style="float: none;width: 94px; padding: 0 0 4px 6px;margin-bottom: -5px; font-size: 16px;">Localização</legend>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="_zipcode" class="form-label">CEP</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="_zipcode" class="form-label"><strong>{{$business->zipcode}}</strong></label>
                                        </div>
                                    </div>                             
                                    <div class="col" style="margin-top: initial;">
                                        <label for="state" class="form-label">Estado</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="state" class="form-label"><strong>{{$business->city->state->name}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col" style="margin-top: initial;">
                                        <label for="city" class="form-label">Município</label>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="city" class="form-label"><strong>{{$business->city->name}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-top: initial;">
                                        <label for="street" class="form-label">Logradouro</label>
                                        <div id="street"></div>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="street" class="form-label"><strong>{{$business->street}}</strong></label>
                                        </div>
                                    </div> 
                                    <div class="col-md-6" style="margin-top: initial;">
                                        <label for="district" class="form-label">Bairro</label>
                                        <div id="district"></div>
                                        <div class="col-md-12" style="padding: initial; margin-top: -10px;">
                                            <label for="district" class="form-label"><strong>{{$business->district}}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--mobile end-->
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
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