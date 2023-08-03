@extends('layouts.app')

@section('content')

<div class="pricing-header text-center">
    
    @if(!isset($search_category))       
        <div class="container">
            <div class="pricing-header text-center">                
                <img src="/img/profissionais.png" class="img-fluid" alt="..." style="width: 40%;">                
            </div>
        </div>
        <span style="font-size:30px">A plataforma ideal para quem procura encontrar profissionais com qualidade</span><br>
        <span style="font-size:20px">Pintores, mecânicos, eletricistas, fotógrafos e etc. Profissionais avaliados por pessoas como você.</span><br>
        <span style="color:#fe5002;font-weight: bold;font-size:25px">Encontre profissionais de...</span>
    @endif
    
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var scrollDistance = 340; // Distância a ser rolada em pixels

        $(".scroll-left").click(function() {
            $(".scrolling-wrapper").animate({
                scrollLeft: "-=" + scrollDistance
            }, 400);
        });

        $(".scroll-right").click(function() {
            $(".scrolling-wrapper").animate({
                scrollLeft: "+=" + scrollDistance
            }, 400);
        });
    });
</script>
<!-- CSS customizado -->
<style>
    .scrolling-wrapper {
        position: relative;
        overflow: hidden;
    }

    .scrolling-content {
        display: flex;
        flex-wrap: nowrap;
    }

    .nav-buttons {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
    }

    .scroll-left {
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    .scroll-right {
        padding: 10px;
        border: none;
        cursor: pointer;
    }
</style>


<div class="container">

    <div class="row justify-content-center">
    @if(isset($search_category) && !empty($search_category) && empty($filter_search))
        <h1 style="color:#fe5002; text-align: -webkit-center;">Profissionais de <strong>{{$search_category}}</strong></h1>
    @elseif(!empty($filter_search))
        <h1 style="color:#fe5002; text-align: -webkit-center;">Resultados para: <strong>{{@$filter_search}}</strong></h1>
    @endif

        <div class="col-md-1" style="width: 50px;">
            <div class="nav-buttons" style="top: 45%;">
                <i class="bi bi-chevron-left scroll-left" style="color:#fe5002; font-size: 25px; padding: 30px 0 60px 0;"></i>
            </div>
        </div>
        <div class="col-md-10">
            <div class="scrolling-wrapper">
                <div class="scrolling-content" style="padding-bottom: 20px; padding-top: 10px; justify-content: center;">
                    @foreach($categories as $category)
                    <a href="{{url('/').'/'.$category->slug}}" class="fetch_category" id="{{$category->id}}" style="text-decoration: none!important;">
                        <div class="card" style="width: 140px;
    height: 130px;
    margin-left: 4.5px;
    margin-right: 4.5px;
    line-height: 18px;
    padding: 32px 8px 0;
    text-align: center;
    background-color: #fff;
    border: 1px solid #ededed;
    border-radius: 5px;
    color: #2b2b2b;
    box-shadow: 1px 3px 3px 0 rgba(0,0,0,.17)!important; background-clip: padding-box; display: block; ">
                            <span style="display: block; color: #fe5002; height: 50px; line-height: 50px;">
                                <i class="{{$category->icon}}" style="font-size:35px;"></i></span>
                            <span class="button__card__text  ">{{$category->name}}</span>
                        </div>
                    </a>
                    @endforeach




                </div>

            </div>

        </div>
        <div class="col-md-1" style="width: 50px;">
            <div class="nav-buttons" style="top: 45%;">
                <i class="bi bi-chevron-right scroll-right" style="color:#fe5002; font-size: 25px; padding: 30px 0 60px 0;"></i>
            </div>
        </div>
    </div>

   

</div>














@if (count($business) > 0 && count($cities) > 0)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-1">
        </div>
        
        <div class="col-md-3" style="padding-bottom: 10px; width:24%;">
            <div class="d-none d-md-block" id="navbarSupportedContent">

                <div class="card" style="margin-bottom: 10px; height: auto;">
                    <form name="form" id="form" method="GET" action="">

                        <div class="accordion" id="accordionFlushExample1">
                            <div class="accordion-item">
                            </div>
                            <div class="accordion-item" style="background-color: white;">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="btn btn-outline-primary accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne" style="padding: 5px 10px; --bs-accordion-btn-icon-width: 1.0rem; background-color: white; color:darkslategray;">
                                        Localização
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne" data-bs-parent="#accordionFlushExample1">
                                    <div class="accordion-body" style="margin: -12px -15px;">
                                        <div class="accordion-item accordion-flush" id="accordionFlushExample2">
                                            @foreach($states as $state)


                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-heading{{$state->uf}}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$state->uf}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$state->uf}}" style="padding: 5px 10px; --bs-accordion-btn-icon-width: 1.0rem; font-size: 12px;">
                                                        <strong style="color:#4a4a4a;">{{$state->name}}</strong>
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapse{{$state->uf}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-collapse{{$state->uf}}" data-bs-parent="#accordionFlushExample2" data-bs-parent="#accordionFlushExample2" style="overflow-y: scroll;">
                                                    <div class="accordion-body" style="padding: 5px 0 0 0px; font-size: 12px; height: 130px !important; ">

                                                        @foreach($cities as $city)
                                                        @if($city->uf == $state->uf)
                                                        <ul class="list-group">
                                                            @if(isset($search_category))
                                                                @if((isset($filter_search) && !empty($filter_search)))
                                                                    <a href="{{route('search.category_city_search', ['state'=>$state->uf, 'city'=>$city->name,'filter_search'=>$filter_search])}}" class="list-group-item list-group-item-action fetch_city" id="{{$city->code}}" style="padding: 2px 5px 2px 6px;">{{$city->name}}
                                                                        <span style="float: right; padding-right: 5px;color: #fe5002;font-weight: 600;">{{$city->business_count}}</span>
                                                                    </a>
                                                                @else
                                                                    <a href="{{route('search.category_city', ['category'=>$search_category,'state'=>$state->uf, 'city'=>$city->name,'filter_search'=>$filter_search])}}" class="list-group-item list-group-item-action fetch_city" id="{{$city->code}}" style="padding: 2px 5px 2px 6px;">{{$city->name}}
                                                                        <span style="float: right; padding-right: 5px;color: #fe5002;font-weight: 600;">{{$city->business_count}}</span>
                                                                    </a>
                                                                @endif
                                                            @else 
                                                                <a href="{{route('search.city', ['state'=>$state->uf, 'city'=>$city->name, 'filter_search'=>$filter_search])}}" class="list-group-item list-group-item-action fetch_city" id="{{$city->code}}" style="padding: 2px 5px 2px 6px;">{{$city->name}}
                                                                    <span style="float: right; padding-right: 5px;color: #fe5002;font-weight: 600;">{{$city->business_count}}</span>
                                                                </a>
                                                            @endif
                                                            
                                                            <!--
                                            <input class="form-check-input" type="checkbox" value="" id="{{$city->id}}">
                                            <label class="form-check-label" for="{{$city->id}}">{{$city->name}}</label>-->
                                                        </ul>
                                                        @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-7" style="width: 57%; inset-block: auto; margin-left:10px;">

            

            <div id="business">
                <div class="pricing-header" style="padding-bottom: 5px; font-size: 16px; color:#4a4a4a;">

                    @if(count($business))
                        <span><strong>Mostrando <span style="color:#fe5002;">{{count($business)}}</span>{{count($business) > 1 ? ' resultados' : ' resultado'}}</strong></span>

                        @if(isset($filter_city) && !empty($filter_city))
                            @if(isset($filter_search) && !empty($filter_search))
                                <strong>em <span style="color:#fe5002;">{{$filter_city}}</span>, em busca por <span style="color:#fe5002;">'{{$filter_search}}'</span></strong>
                            @else
                                <strong>em <span style="color:#fe5002;">{{$filter_city}}</span></strong>
                            @endif
                        @else 
                            @if(isset($filter_search) && !empty($filter_search))
                                <strong>em busca por <span style="color:#fe5002;">'{{$filter_search}}'</span></strong>
                            @endif
                            
                        @endif
                    @else
                        <span><strong>Nenhum resultado encontrado</strong></span>
                    @endif
                    
                </div>

                
                @foreach($business as $busine)
                <!--web -->
                
                <div  id="navbarSupportedContent">

                    <div class="card" style="margin-bottom: 10px; padding-bottom: 10px; height: auto;">
                        <div class="media" style="height: auto; display: inline;">
                            <div class="media-body" style="padding: 5px; display: flex; margin: 10px;">

                                <div>
                                    @if($busine->path)
                                    <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/{{$busine->path}}" alt="..." style="border-radius: 100%; border: none;" width="55px" height="55px">
                                    </a>
                                    @else
                                    <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/img/image.jpg" alt="..." style="border-radius: 100%; border: none;" width="55px" height="55px">
                                    </a>
                                    @endif
                                </div>
                                <div style="margin-left: inherit;">
                                    <div>
                                        <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="stretched-link" style="text-decoration: none; color: #4a4a4a; padding-right: 10px;">
                                            <span class="mb-0 media-body-title"><strong>{{$busine->business_name}}</strong></span>
                                        </a>
                                    </div>
                                    <div>
                                        <i class="bi bi-star-fill" style="color: #ffd607;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffd607;"></i>
                                        <i class="bi bi-star-fill" style="color: #ffd607;"></i>
                                        <i class="bi bi-star-half" style="color: #ffd607;"></i>
                                        <i class="bi bi-star" style="color: #ffd607;"></i>
                                        <span class="mb-0 media-body-title-assessments">46 Avaliações</span>
                                    </div>
                                </div>


                            </div>
                            <div class="media-body media-body2">
                                <div class="media-body-description">
                                    <div class="media-body">
                                        <div class="media-body-category-item">
                                            <div class="media-body">
                                                <div><span style="font-size: 16px; color: #4a4a4a;" class="mb-0"><strong>{{$busine->BusinessService[0]->category}}</strong></span></div>
                                                @foreach($busine->BusinessService as $service)
                                                    <div style="padding: 0 10px; line-height: 22px; background-color: #e8e8e8; border-radius: 11px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">{{$service->Service[0]->name}}</div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="media-body-description">
                                        <span class="mb-1 text-muted" style="font-size: 14px;">{{ substr($busine->business_description, 0, 250)}}...</span>
                                        <span class="mb-1 text-muted" style="font-size: 14px;">{!! substr($busine->business_description, 0, 1000) !!}...</span>
                                    </div>
                                    -->
                                    
                                </div>
                                <div class="media-body-image">

                                    @forelse($busine->BusinessImage as $i => $image)
                                    
                                        @if($loop->first)
                                        <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                            <img src="/{{$image->path}}" alt="..." style="border-radius: 5px; border: none; width: 150px; margin-right: -15px; margin-top: -30px;">
                                        </a>
                                        @endif
                                        @empty
                                        <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                            <img src="/img/image.jpg" alt="..." style="border-radius: 5px; border: none; width: 150px; margin-right: -15px;  margin-top: -30px;">
                                        </a>
                                    @endforelse

                                </div>
                            </div>
                            <div class="media-body-city" style="padding-left: 80px;">
                                <span class="mb-2 text" style="font-size: 14px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-top: -5px; color: #007bff">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->slug, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="stretched-link" style="text-decoration: none; color: #4a4a4a; padding-right: 10px;">{{$busine->city->name}}/{{$busine->city->state->uf}}</a>
                                </span> 
                            </div>
                            <!--
                            <div class="media-body media-body-category">
                                <div class="media-body-category-item">
                                    <div><span style="font-size: 16px; color: #4a4a4a;" class="mb-0"><strong>{{$busine->BusinessService[0]->category}}</strong></span></div>
                                    @foreach($busine->BusinessService as $service)
                                        <div style="padding: 0 10px; line-height: 22px; background-color: #e8e8e8; border-radius: 11px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">{{$service->service[0]->name}}</div>
                                    @endforeach
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>

                <!--mobile -->
                <!--
                <div class="d-md-none">

                    <div class="card" style="margin-bottom: 10px;">
                        <div class="media">

                            @forelse($busine->BusinessImage as $i => $image)
                            @if($loop->first)
                            <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->name, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                <img src="/{{$image->path}}" alt="..." style="border-radius: 5px; border: none; width: 110px; height: 110px;" width="164px" height="123px">
                            </a>
                            @endif
                            @empty
                            <a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->name, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="align-self-center mr-1" style="text-decoration: none;">
                                <img src="/img/image.jpg" alt="..." style="border-radius: 5px; border: none; width: 110px; height: 110px;" width="164px" height="123px">
                            </a>
                            @endforelse

                            <div class="media-body" style="padding: 5px;">
                                <div><span style="font-size: 12px;" class="mb-0"><strong>{{$busine->business_name}}</strong></span></div>
                                <div><span class="mb-2 text-success" style="font-size: 12px;">{{$busine->BusinessService[0]->category}}</span></div>
                                <div><span class="mb-1 text-muted" style="font-size: 11px;">{{ implode(" ", array_slice(explode(" ", $busine->description), 0, 4))}}...</span></div>
                                <p class="mb-auto"></p>
                                <div>
                                    <span class="mb-2 text-success" style="font-size: 11px;"><a href="{{ route('business.show', ['category'=>$busine->BusinessService[0]->Service[0]->BusinessService->Service[0]->category->name, 'id'=> $busine->id_business, 'name'=>$busine->slug])}}" class="stretched-link" style="text-align: -webkit-right; text-decoration: none; color: #4a4a4a; float: right;padding-right: 10px;">{{$busine->city->name}}/{{$busine->city->state->uf}}</a></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                 -->
                @endforeach
                

            </div>
           
        </div>
        <div class="col-md-1">
        </div>
        <div id="check_form"></div>
    </div>
</div>
@endif


<script type="text/javascript">
    $(document).ready(function() {

        $(".fetch_category").click(function() {

            const url = "{{ route('search') }}";
            category = $(this).attr("id");
            $.ajax({
                url: url,
                data: {
                    'category': category,
                },
                success: function(data) {
                    $("#business").html(data);
                }
            })
        });
/*
        $(".fetch_city").click(function() {

        const url = "{{ route('search') }}";
        code = $(this).attr("id");
        $.ajax({
            url: url,
            data: {
                'code': code,
                'category': ""
            },
            success: function(data) {
                $("#business").html(data);
            }
        })
        });
*/

    });
</script>


@endsection