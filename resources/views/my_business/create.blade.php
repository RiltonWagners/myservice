@extends('layouts.app'):


<style type="text/css">
    
    #editor {
        max-height: 350px;
    }

    /*Adding the values from the array which has the values as data-values*/
    /*for font-size*/
    .ql-snow .ql-picker.ql-size .ql-picker-label[data-value]::before,
    .ql-snow .ql-picker.ql-size .ql-picker-item[data-value]::before {
    content: attr(data-value) !important;
    }


    /*for font-family*/
    .ql-snow .ql-picker.ql-font .ql-picker-label[data-value]::before,
    .ql-snow .ql-picker.ql-font .ql-picker-item[data-value]::before {
    content: attr(data-value) !important;
    }

    .ql-snow .ql-picker.ql-font {
    width: 150px !important;
    white-space: nowrap;
    }

    .multiselect-native-select {
        display: block;
    }

    .custom-select {
        /*background: #f8fafc url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 -5 4 15'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center !important;*/
        background: #f8fafc url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 0.75rem center !important;
        background-size: 16px 12px !important;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="float: left;">
                        @if(Request::is('*my_business/edit'))
                            {{ __('Editar meu negócio') }}
                        @else
                            {{ __('Meu negócio') }}
                        @endif
                    </span>
                    <span style="float: right;font-size: revert; color: #000;">* Campo obrigatório</span>
                </div>
                <div class="card-body">

                    @if(Request::is('*my_business/edit'))
                        <form name="businessForm" id="businessForm" class="row g-3" method="POST" action="/my_business/update" data-services-url="{{ route('loadservices')}}" data-cities-url="{{ route('loadcities')}}" data-district-url="{{ route('loaddistrict')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <div style="width: 100%;">
                                            <img src="/{{ !empty($my_business->path) ? $my_business->path : 'img/image.jpg'; }}" class="img-fluid" alt="..." style="border-radius: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="align-self: center;">
                                        <label for="name" class="form-label">Alterar foto do perfil</label>
                                        <div class="col-md-12" style="display:flex;">
                                            <input type="file" class="form-control" id="images" name="images[]" aria-describedby="inputGroupFileAddon04" accept="image/*" style="margin: 0 10px 0 -15px;">
                                            <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="align-self: center;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <span>- Utilize arquivo de imagem no formato PNG ou JPG;</span>
                                            <span>- Recomendamos que a imagem tenha dimensão mínima de 800px de largura e 600px de altura;</span>
                                            <span>- É permitido o upload de imagem com o tamanho máximo de 5MB.</span>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch" style="margin-top: 10px; margin-bottom: -25px; text-align: -webkit-right;">
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" style="margin-top: 7px;" {{ $my_business->status == 'published' ? 'checked' : '' }}>
                                        <label class="form-check-label"><span style="font-size:18px; font-weight: bold;">Publicado</span></label>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do negócio" value="{{$my_business->name}}">
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: auto; display: inline-grid;">
                                        <label class="form-label">Descrição*</label>
                                        <div id="editor" class="form-control col-md-12">{!! $my_business->description !!}</div>
                                        <label class="form-label" id="caracteres-restantes" style="float: right;"></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Categoria*</label>
                                        <select id="id_category" name="id_category" class="form-select">
                                            <option value="" selected>Selecione a categoria</option>

                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $my_business->BusinessService[0]->service[0]->id_category ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_service" class="form-label">Serviço*</label>
                                        <select id="id_service" name="id_service[]" multiple="multiple" class="form-select">

                                            @foreach($services as $service_1)
                                                @if($my_business->BusinessService[0]->service[0]->id_category == $service_1->id_category)
                                                    <option value="{{$service_1->id}}" 
                                                        @foreach($my_business->BusinessService as $service_2)
                                                            {{$service_1->id == $service_2->id_service ? 'selected' : ''}}
                                                        @endforeach>
                                                        {{ $service_1->name }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="form-label">Contato</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="(xx) xxxxx-xxxx" value="{{$my_business->phone}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="whatsapp" class="form-label">WhatsApp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="(xx) xxxxx-xxxx" value="{{$my_business->whatsapp}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="instagram" class="form-label">Perfil do instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Informe o link do instagram" value="{{$my_business->instagram}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-3" id="div_zipcode">
                                        <label for="_zipcode" class="form-label">CEP*</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" onKeyup="loadzipcode(this.value)" placeholder="Informe o CEP" value="{{$my_business->zipcode}}">
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
                    <form name="businessForm" id="businessForm" class="row g-3" method="POST" action="/my_business" data-services-url="{{ route('loadservices')}}" data-cities-url="{{ route('loadcities')}}" data-district-url="{{ route('loaddistrict')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-2">
                                        <div style="width: 100%;">
                                            <img src="/img/image.jpg" class="img-fluid" alt="..." style="border-radius: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="align-self: center;">
                                        <label for="name" class="form-label">Inserir foto do perfil</label>
                                        <div class="col-md-12" style="display:flex;">
                                            <input type="file" class="form-control" id="images" name="images[]" aria-describedby="inputGroupFileAddon04" accept="image/*" style="margin: 0 10px 0 -15px;">
                                            <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="align-self: center;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <span>- Utilize arquivo de imagem no formato PNG ou JPG;</span>
                                            <span>- Recomendamos que a imagem tenha dimensão mínima de 800px de largura e 600px de altura;</span>
                                            <span>- É permitido o upload de imagem com o tamanho máximo de 5MB.</span>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch" style="margin-top: 10px; margin-bottom: -25px; text-align: -webkit-right;">
                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" style="margin-top: 7px;">
                                        <label class="form-check-label"><span style="font-size:18px; font-weight: bold;">Publicado</span></label>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nome*</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome do negócio" value="">
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: auto; display: inline-grid;">
                                        <label class="form-label">Descrição*</label>
                                        <div id="editor" class="form-control col-md-12"></div>
                                        <label class="form-label" id="caracteres-restantes" style="float: right;"></label>
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
                                        <select id="id_service" name="id_service[]" multiple="multiple" class="form-select">
                                            <option value="">Selecione a categoria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="phone" class="form-label">Contato</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="(xx) xxxxx-xxxx" value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="whatsapp" class="form-label">WhatsApp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="(xx) xxxxx-xxxx" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="instagram" class="form-label">Perfil instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Informe o link do instagram" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-3" id="div_zipcode">
                                        <label for="_zipcode" class="form-label">CEP*</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" onKeyup="loadzipcode(this.value)" placeholder="Informe o CEP" value="">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Importe a biblioteca DOMPurify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.3/purify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/quill-emoji@0.2.0/dist/quill-emoji.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill-emoji@0.2.0/dist/quill-emoji.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js" integrity="sha512-lxQ4VnKKW7foGFV6L9zlSe+6QppP9B2t+tMMaV4s4iqAv4iHIyXED7O+fke1VeLNaRdoVkVt8Hw/jmZ+XocsXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css" integrity="sha512-tlP4yGOtHdxdeW9/VptIsVMLtgnObNNr07KlHzK4B5zVUuzJ+9KrF86B/a7PJnzxEggPAMzoV/eOipZd8wWpag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css" integrity="sha512-fZNmykQ6RlCyzGl9he+ScLrlU0LWeaR6MO/Kq9lelfXOw54O63gizFMSD5fVgZvU1YfDIc6mxom5n60qJ1nCrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.js" integrity="sha512-YwbKCcfMdqB6NYfdzp1NtNcopsG84SxP8Wxk0FgUyTvgtQe0tQRRnnFOwK3xfnZ2XYls+rCfBrD0L2EqmSD2sA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#phone').mask('(99) 9 9999-9999');
        $('#whatsapp').mask('(99) 9 9999-9999');
        $('#id_service').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            maxHeight: 200,
            minWidth: 800,
            buttonWidth: '100%',
            widthSynchronizationMode: 'ifPopupIsSmaller',
            buttonTextAlignment: 'left',
            selectAllText: 'Selecionar todos',
            nonSelectedText: 'Selecione o serviço',
            nSelectedText: ' - Serviços selecionados!',
            allSelectedText: 'Todos',
            /*onSelectAll: function(options) {
                alert('Todos os serviços serão selecionados!');
            },*/
            filterPlaceholder: 'Procurar...'
        });

        // add an array of values
        const fontFamilyArr = ['Arial','Arial Black',"Calibri", "Calibri Light",'Futura','Nunito',"Roboto Condensed","Sans-Serif","Times New Roman"];
        let fonts = Quill.import("attributors/style/font");
        fonts.whitelist = fontFamilyArr;
        Quill.register(fonts, true);

        const fontSizeArr = ['12px', '14px', '16px','18px', '24px', '28px', '32px'];
        var Size = Quill.import('attributors/style/size');
        Size.whitelist = fontSizeArr;
        Quill.register(Size, true);

        var toolbarOptions = [
            /*[{ 'header': [1, 2, 3, 4, 5, 6, false] }],*/
            [/*{'font': fontFamilyArr},*/{'size': fontSizeArr}],
            ['bold', 'italic', 'underline', 'strike',{ 'color': [] }, { 'background': [] },{ 'align': [] },{ 'list': 'ordered'}, { 'list': 'bullet' },'code-block','link', 'image', 'video',{ 'emoji': true }],
            ['clean'],
        ];

        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Informe a descrição aqui...',
            modules: {
            toolbar: toolbarOptions,
            'emoji-toolbar': true
            },
            //lineHeight: 0
            sanitize: {
                p: {
                style: function(value) {
                    return 'color: red; font-size: 46px;';
                }
                }
            }
        });

        // Definir o tamanho padrão da fonte
        quill.format('size', '16px');
        quill.format('font', 'Nunito');

        // Monitorar o conteúdo do editor
        quill.on('text-change', function() {
            
            var maxLength = 1000;
            var conteudoEditor = quill.getText();
            var caracteresRestantes = maxLength - conteudoEditor.length+1;

            // Exibir a quantidade de caracteres restantes na página
            document.getElementById('caracteres-restantes').textContent = 'Caracteres restantes: '+caracteresRestantes;

            // Limitar a quantidade de caracteres no editor
            if (conteudoEditor.length-1 > maxLength) {
                quill.deleteText(maxLength, conteudoEditor.length);
            }
            
        });

        $("#btn_create").click(function() {

            $("#id_btn_create_text").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> &nbsp; Aguarde! Estamos validando seu seu negócio.&nbsp;");
            $("#btn_create").attr("disabled", "disbled");
            document.getElementById("businessForm").submit();
        });

        $("#id_category").change(function() {
            $("#id_service").html("");            
            $("#id_service").attr("disabled", "disbled");
            const url = $('#businessForm').attr("data-services-url");
            id_category = $(this).val();
            
            console.log(id_category);
            $.ajax({
                url: url,
                data: {
                    'id_category': id_category,
                },
                success: function(data) {
                    if (data) {
                        $("#id_service").prop("disabled", false);
                        console.log(data);
                        $("#id_service").html(data);
                        $("#id_service").multiselect('rebuild');
                    };
                }
            })
            
        });


        $("#uf").change(function() {
            $("#id_city").val("");
            const url = $('#businessForm').attr("data-cities-url");
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

    function loadzipcode() {

        zipcode = $('#zipcode').val();

        if ($('#zipcode').val().length > 8) {

            $('#loading').css('display', 'block');
            $('#district').css('display', 'none');
            $("#district").val("");
            const url = $('#businessForm').attr("data-district-url");

            console.log(zipcode);
            $.ajax({
                url: url,
                data: {
                    'zipcode': zipcode,
                },
                success: function(data) {
                    $('#loading').css('display', 'none');
                    $('#district').css('display', 'block');
                    $("#district").html(data);
                }
            })
        }
    };

    $("#businessForm").on("submit", function () {
        
        var description = document.querySelector('#editor').children[0].innerHTML;
        // Limpe o conteúdo antes de salvá-lo ou exibi-lo
        description = DOMPurify.sanitize(description, { ADD_ATTR: ['target'] });
        $(this).append("<textarea name='description' style='display:none'>"+description+"</textarea>");
   });

</script>
@endsection