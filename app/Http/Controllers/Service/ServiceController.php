<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $category;
    protected $service;

    public function __construct(Service $service, Category $category)
    {
        $this->category = $category;
        $this->service  = $service;
    }

    public function index()
    {
        $services = Service::orderBy('name', 'ASC')->get();
        return view('services.index', ['services' => $services]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('services.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'         => 'required|max:255|min:5|unique:services,name',
                'description'  => 'required|max:255|min:5',
                'id_category'  => 'required'
            ],
            [
                'name.required'         => 'O campo \'Nome\' é de preenchimento obrigatório.',
                'name.unique'           => 'Já existe um serviço com o nome \''. $request->name  .'\'.',
                'description.required'  => 'O campo \'Descrição\' é de preenchimento obrigatório.',
                'id_category.required'  => 'Selecione a categoria.',
            ]
        );

        $service = new Service();
        
        $service->name        = $request->name;
        $service->description = $request->description;
        $service->id_category = $request->id_category;

        $service->save();

        return redirect(route('service.index'))->with('message', 'Serviço adicionado com sucesso!');
    }

    public function show(Service $service)
    {
        //
    }

    public function edit(Request $request)
    {
        $categories = Category::all();
        $service  = Service::findOrFail($request->id);

        return view('services.create', ['categories' => $categories, 'service' => $service]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name'         => 'required|max:255|min:5|unique:services,name',
                'description'  => 'required|max:255|min:5',
                'id_category'  => 'required'
            ],
            [
                'name.required'         => 'O campo \'Nome\' é de preenchimento obrigatório.',
                'name.unique'           => 'Já existe um serviço com o nome \''. $request->name  .'\'.',
                'description.required'  => 'O campo \'Descrição\' é de preenchimento obrigatório.',
                'id_category.required'  => 'Selecione a categoria.',
            ]
        );

        $service = Service::findOrFail($request->id);
        $service->name        = $request->name;
        $service->description = $request->description;
        $service->id_category = $request->id_category;
        $service->save();
        /*
        Service::where('id', $request->id)
                ->update([
                        'name'        => $request->name, 
                        'description' => $request->description, 
                        'id_category' => $request->id_category
                        ]);
        */
        return redirect(route('service.index'))->with('message', 'Serviço editado com sucesso!');
    }

    public function destroy(Request $request)
    {
        Service::findOrFail($request->id)->delete();

        return redirect(route('service.index'))->with('message', 'Serviço excluído com sucesso!');
    }


    public function loadservices(Request $request)
    {
        $id_category = $request->id_category;

        $services = Service::where('id_category', $id_category)->get();
        
        return view('publications.function.services', ['services' => $services]);
    }
}
