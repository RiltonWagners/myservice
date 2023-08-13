@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            @foreach($publications as $publication)
            <div  id="navbarSupportedContent">

                    <div class="card" style="margin-bottom: 10px; padding-bottom: 10px; height: auto;">
                        <div class="media" style="height: auto; display: inline;">
                            <div class="media-body" style="padding: 5px; display: flex; margin: 10px;">

                                <div>
                                    @forelse($publication->PublicationImage as $i => $image)
                                    @if($loop->first)
                                    <a href="{{ route('my_publications.show', $publication->id)}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/{{$image->path}}" alt="..." style="border-radius: 100%; border: none;" width="55px" height="55px">
                                    </a>
                                    @endif
                                    @empty
                                    <a href="{{ route('my_publications.show', $publication->id)}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/img/image.jpg" alt="..." style="border-radius: 100%; border: none;" width="55px" height="55px">
                                    </a>
                                    @endforelse
                                </div>
                                <div style="margin-left: inherit;">
                                    <div>
                                        <a href="{{ route('my_publications.show', $publication->id)}}" class="stretched-link" style="text-decoration: none; color: #4a4a4a; padding-right: 10px;">
                                            <span class="mb-0 media-body-title"><strong>{{$publication->title}}</strong></span>
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
                                    <div class="media-body-description">
                                        <span class="mb-1 text-muted" style="font-size: 14px;">{{ implode(" ", array_slice(explode(" ", $publication->publication_description), 0, 50))}}...</span>
                                    </div>
                                    <div class="media-body-city">
                                        <span class="mb-2 text" style="font-size: 14px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" style="margin-top: -5px; color: #007bff">
                                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            </svg>
                                            <a href="{{ route('my_publications.show', $publication->id)}}" class="stretched-link" style="text-decoration: none; color: #4a4a4a; padding-right: 10px;">{{$publication->city->name}}/{{$publication->city->state->uf}}</a></span>
                                    </div>
                                </div>
                                <div class="media-body-image">

                                    @forelse($publication->PublicationImage as $i => $image)
                                    @if($loop->first)
                                    <a href="{{ route('my_publications.show', $publication->id)}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/{{$image->path}}" alt="..." style="border-radius: 5px; border: none; width: 150px; margin-right: -15px;">
                                    </a>
                                    @endif
                                    @empty
                                    <a href="{{ route('my_publications.show', $publication->id)}}" class="align-self-center mr-1" style="text-decoration: none;">
                                        <img src="/img/image.jpg" alt="..." style="border-radius: 5px; border: none; width: 150px; margin-right: -15px;">
                                    </a>
                                    @endforelse

                                </div>
                            </div>
                            <div class="media-body media-body-category">
                                <div class="media-body-category-item">
                                    <div class="media-body">
                                        <div><span style="font-size: 16px; color: #4a4a4a;" class="mb-0"><strong>{{$publication->service->category->name}}</strong></span></div>
                                        <div style="padding: 0 10px; line-height: 22px; background-color: #e8e8e8; border-radius: 11px; color: #000; font-size: 14px; margin: 2px; max-width: max-content;">{{$publication->service->name}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>
@endsection