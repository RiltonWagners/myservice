@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="float: left;">
                        @if(Request::is('*my_publication/edit/*'))
                            {{ __('Editar anúncio') }}
                        @else
                            {{ __('Criar anúncio') }}
                        @endif
                    </span>
                    <span style="float: right;font-size: revert; color: #000;">* Campo obrigatório</span>
                </div>
                <div class="card-body">

                    @if(Request::is('*my_publication/edit*'))
                        <form name="publicationForm" id="publicationForm" class="row g-3" method="POST" action="/my_publication/update/{{$publication->id}}" data-services-url="{{ route('loadservices')}}" data-cities-url="{{ route('loadcities')}}" data-district-url="{{ route('loaddistrict')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Título*</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Informe o título do anúncio" value="{{$publication->title}}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Descrição*</label>
                                        <textarea class="form-control" id="description" name="description" rows="7" placeholder="Informe a descrição do anúncio">{{$publication->description}}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple aria-describedby="inputGroupFileAddon04" accept="image/*">
                                    </div>
                                    <div class="col-md-1" style="padding-top: 5px;">

                                        <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <span>- Utilize arquivos de imagem no formato PNG ou JPG;</span>
                                            <span>- Recomendamos que as imagens tenham dimensões mínimas de 800px de largura e 600px de altura;</span>
                                            <span>- É permitido o upload de imagens com o tamanho máximo de 5MB.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Categoria*</label>
                                        <select id="id_category" name="id_category" class="form-select">
                                            <option value="" selected>Selecione a categoria</option>

                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $publication->service->id_category ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_service" class="form-label">Serviço*</label>
                                        <select id="id_service" name="id_service" class="form-select">

                                            @foreach($services as $service)
                                            <option value="{{$service->id}}" {{$service->id == $publication->id_service ? 'selected' : ''}}>{{$service->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-3" id="div_zipcode">
                                        <label for="_zipcode" class="form-label">CEP*</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" onKeyup="loadzipcode(this.value)" placeholder="Informe o CEP" value="{{$publication->zipcode}}">
                                    </div>
                                    <div class="col-md-3" style="display:none;" id="loading">
                                        <div style="display: -webkit-inline-box;position: absolute;">
                                            <span style="display: flex;position: relative;align-items: center; color: darkgray;">Buscando localidade...</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="100px" height="100px" viewBox="10 0 100 100" preserveAspectRatio="xMidYMid">
                                                <circle cx="50" cy="50" r="0" fill="none" stroke="#063680" stroke-width="1">
                                                    <animate attributeName="r" repeatCount="indefinite" dur="0.8695652173913042s" values="0;37" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="0s"></animate>
                                                    <animate attributeName="opacity" repeatCount="indefinite" dur="0.8695652173913042s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="0s"></animate>
                                                </circle>
                                                <circle cx="50" cy="50" r="0" fill="none" stroke="#9dbfd4" stroke-width="1">
                                                    <animate attributeName="r" repeatCount="indefinite" dur="0.8695652173913042s" values="0;37" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="-0.4347826086956521s"></animate>
                                                    <animate attributeName="opacity" repeatCount="indefinite" dur="0.8695652173913042s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="-0.4347826086956521s"></animate>
                                                </circle>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="district"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-outline-primary" href="javascript:void(0)" onClick="history.go(-1); return false;" role="button" style="float: left; margin-right:10px;">Voltar</a>
                                <button type="submit" class="btn btn-primary" style="float: left; padding-top: 5px;">Salvar</button>
                            </div>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                loadzipcode()
                            });
                        </script>
                    
                    @else
                        <form name="publicationForm" id="publicationForm" class="row g-3" method="POST" action="/publication" data-services-url="{{ route('loadservices')}}" data-cities-url="{{ route('loadcities')}}" data-district-url="{{ route('loaddistrict')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Título*</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Informe o título do anúncio">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Descrição*</label>
                                        <textarea class="form-control" id="description" name="description" rows="7" placeholder="Informe a descrição do anúncio"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple aria-describedby="inputGroupFileAddon04" accept="image/*">
                                    </div>
                                    <div class="col-md-1" style="padding-top: 5px;">

                                        <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <span>- Utilize arquivos de imagem no formato PNG ou JPG;</span>
                                            <span>- Recomendamos que as imagens tenham dimensões mínimas de 800px de largura e 600px de altura;</span>
                                            <span>- É permitido o upload de imagens com o tamanho máximo de 5MB.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Categoria*</label>
                                        <select id="id_category" name="id_category" class="form-select">
                                            <option value="" selected>Selecione a categoria</option>

                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_service" class="form-label">Serviço*</label>
                                        <select id="id_service" name="id_service" class="form-select" disabled="disabled">
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-3" id="div_zipcode">
                                        <label for="_zipcode" class="form-label">CEP*</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" onKeyup="loadzipcode(this.value)" placeholder="Informe o CEP">
                                    </div>
                                    <div class="col-md-3" style="display:none;" id="loading">
                                        <div style="display: -webkit-inline-box;position: absolute;">
                                            <span style="display: flex;position: relative;align-items: center; color: darkgray;">Buscando localidade...</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:block;" width="100px" height="100px" viewBox="10 0 100 100" preserveAspectRatio="xMidYMid">
                                                <circle cx="50" cy="50" r="0" fill="none" stroke="#063680" stroke-width="1">
                                                    <animate attributeName="r" repeatCount="indefinite" dur="0.8695652173913042s" values="0;37" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="0s"></animate>
                                                    <animate attributeName="opacity" repeatCount="indefinite" dur="0.8695652173913042s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="0s"></animate>
                                                </circle>
                                                <circle cx="50" cy="50" r="0" fill="none" stroke="#9dbfd4" stroke-width="1">
                                                    <animate attributeName="r" repeatCount="indefinite" dur="0.8695652173913042s" values="0;37" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="-0.4347826086956521s"></animate>
                                                    <animate attributeName="opacity" repeatCount="indefinite" dur="0.8695652173913042s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="-0.4347826086956521s"></animate>
                                                </circle>
                                            </svg>
                                        </div>
                                    </div>
                                    <div id="district"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit" id="btn_create">
                                    <div id="id_btn_create_text">Criar anúncio</div>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {

        $("#btn_create").click(function() {

            $("#id_btn_create_text").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> &nbsp; Aguarde! Estamos validando seu anúncio.&nbsp;");
            $("#btn_create").attr("disabled", "disbled");
            document.getElementById("publicationForm").submit();
        });

        $("#id_category").change(function() {
            $("#id_service").html("");
            $("#id_service").attr("disabled", "disbled");
            const url = $('#publicationForm').attr("data-services-url");
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
            const url = $('#publicationForm').attr("data-cities-url");
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


        const MAX_IMAGES = 3;
        const fileInput = document.querySelector('input[type="file"]');

        fileInput.addEventListener('change', (event) => {
            const files = event.target.files; // obtém os arquivos selecionados
            const numFiles = files.length;

            if (numFiles > MAX_IMAGES) {
                alert(`Você só pode adicionar no máximo ${MAX_IMAGES} imagens.`);
                fileInput.value = "";
            }
        });


    });

</script>

    @include('functions.loadzipcode')
@endsection