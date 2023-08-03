<?php

namespace App\Http\Controllers\Publication;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\PublicationImage;
use App\Models\Category;
use App\Models\Service;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{

    public function index()
    {
        $publications = Publication::all()->orderBy('id', 'DESC')->get();


        return view('publications.index', ['publications' => $publications]);
    }

    public function create()
    {
        $categories = Category::all();
        $states = State::all();

        return view('my_publications.create', [
            'categories' => $categories,
            'states'     => $states,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title'        => 'required|max:250|min:5|unique:services,name',
                'description'  => 'required|max:500',
                'id_category'  => 'required',
                'id_service'   => 'required',
                'zipcode'      => 'required',
                'id_city'      => 'required',
            ],
            [
                'title.required'        => 'Informe o Título.',
                'description.required'  => 'Informe a Descrição.',
                'description.max:500'   => 'O campo Descrição excedeu o número de caracteres permitido.',
                'id_category.required'  => 'Selecione a Categoria.',
                'id_service.required'   => 'Selecione o Serviço.',
                'zipcode.required'      => 'Informe o CEP.',
                'id_city.required'      => 'Informe um CEP válido.',
            ]
        );

        $publication = new Publication;

        $publication->id_user     = auth()->user()->id;
        $publication->zipcode     = $request->zipcode;
        $publication->id_city     = $request->id_city;
        $publication->district    = $request->district;
        $publication->street      = $request->street;
        $publication->id_service  = $request->id_service;
        $publication->title       = $request->title;
        $publication->description = $request->description;

        $publication->save();

        if ($request->hasFile('images')) {
            foreach ($request->allFiles()['images'] as $i => $image) {
                $file = $image;

                $publication_image = new PublicationImage();
                $publication_image->id_publication = $publication->id;

                $image_name = md5($file->getClientOriginalName() . strtotime("now")) . "." . $file->extension();

                $publication_image->path = "images/publications/" . $publication->id . "/" . $image_name;

                $file->move(public_path("images/publications/" . $publication->id), $image_name);

                $publication_image->save();

                unset($publication_image);
            }
        }


        return redirect('/')->with('message', 'Anúncio criado com sucesso!');
    }

    public function show(Request $request)
    {
        $id = $request->id;

        $publication = Publication::findOrFail($id);

        return view('publications.show', ['publication' => $publication]);
    }

    public function my_show(Request $request)
    {
        $id = $request->id;

        $publication = Publication::findOrFail($id);

        return view('my_publication.show', ['publication' => $publication, 'my_publication' => true]);
    }

    public function edit(Request $request)
    {
        $id         = $request->id;
        $categories = Category::all();
        $services   = Service::all();
        $states     = State::all();

        $publication = Publication::findOrFail($id);

        return view('my_publications.create', [
            'publication'  => $publication,
            'categories'   => $categories,
            'services'     => $services,
            'states'       => $states,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'title'        => 'required|max:250|min:5|unique:services,name',
                'description'  => 'required|max:500',
                'id_category'  => 'required',
                'id_service'   => 'required',
                'zipcode'      => 'required',
                'id_city'      => 'required',
            ],
            [
                'title.required'        => 'Informe o Título.',
                'description.required'  => 'Informe a Descrição.',
                'description.max:500'   => 'O campo Descrição excedeu o número de caracteres permitido.',
                'id_category.required'  => 'Selecione a Categoria.',
                'id_service.required'   => 'Selecione o Serviço.',
                'zipcode.required'      => 'Informe o CEP.',
                'id_city.required'      => 'Informe um CEP válido.',
            ]
        );

        if ($request->hasFile('images')) {
            foreach ($request->allFiles()['images'] as $i => $image) {
                $file = $image;

                $publication_image = new PublicationImage();
                $publication_image->id_publication = $request->id;

                $image_name = md5($file->getClientOriginalName() . strtotime("now")) . "." . $file->extension();

                $publication_image->path = "images/publications/" . $request->id . "/" . $image_name;

                $file->move(public_path("images/publications/" . $request->id), $image_name);

                $publication_image->save();

                unset($publication_image);
            }
        }

        $publication = Publication::FindOrFail($request->id);

        $publication->zipcode     = $request->zipcode;
        $publication->id_city     = $request->id_city;
        $publication->district    = $request->district;
        $publication->street      = $request->street;
        $publication->id_service  = $request->id_service;
        $publication->title       = $request->title;
        $publication->description = $request->description;

        $publication->save();

        /*
        Publication::where('id', $request->id)
            ->update([
                'zipcode'     => $request->zipcode,
                'id_city'     => $request->id_city,
                'district'    => $request->district,
                'street'      => $request->street,
                'id_service'  => $request->id_service,
                'title'       => $request->title,
                'description' => $request->description
            ]);
        */

        return redirect('/my_publications')->with('message', 'Anúncio editado com sucesso!');
    }

    public function destroy(Publication $publication)
    {
        //
    }

    public function my()
    {
        $user = Auth::user();

        $publications = Publication::where('id_user', '=', $user->id) ->get(['*','publications.description as publication_description', 'publications.id as id_publication']);
       
        return view('my_publications.my', ['publications' => $publications]);
    }

    public function search(Request $request)
    {
        if (trim($request->search) != "") {

            $states         = State::all();
            $cities         = City::all();
            $categories     = Category::all();
            $publications   = Publication::where('title', 'like', '%' . $request->search . '%')
                ->orwhere('description', 'like', '%' . $request->search . '%')
                ->get();

            return view('home', [
                                'publications'  => $publications,
                                'cities'        => $cities,
                                'states'        => $states,
                                'categories'    => $categories,
                                ]);
        }else{
            return redirect($request->header()['referer'][0])->with('message', 'Ops! Você não informou o que deseja buscar.');
        }
    }
    
}
