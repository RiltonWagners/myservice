<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessImage;
use App\Models\BusinessService;
use App\Models\Category;
use App\Models\Service;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function index()
    {   
        $business = Business::all()->orderBy('id', 'DESC')->get();

        if(empty($business[0])){
            return view('business.show', ['business' => false]);
        }
        
        return view('business.show', ['business' => $business]);
    }

    public function show(Request $request)
    {
        $id_business = $request->id;
        $slug_business = $request->name;

        try {
            $business = Business::where('id','=',$id_business)
                                ->where('slug','=',$slug_business)->get();

            return view('business.show', ['business' => $business[0]]);

        } catch (\Exception $e) {
           return redirect('/');
        }

    }

    public function my_business()
    {
        $user = Auth::user();
        $id_business = $user->id_business;

        $business = null;

        try {
            
            $business = Business::findOrFail($id_business);
            return view('my_business.my_business', ['my_business' => $business]);

        } catch (\Exception $e) {
            return view('my_business.index', ['my_business' => $business]);
        }

    }

    public function my_business_show()
    {
        $user = Auth::user();
        $id_business = $user->id_business;

        $business = null;

        //$endereço = "https://nominatim.openstreetmap.org/search?q=Avenida%20Doutor%20Munir%20Tann%C3%BAs%20Abdalla,%20Shopping%20Park,%20Uberl%C3%A2ndia,%20MG&format=json";

        try {
             $business = Business::findOrFail($id_business);
             return view('my_business.show', ['my_business' => $business]);

        } catch (\Exception $e) {
            return view('my_business.my_business', ['my_business' => $business]);
        }

    }

    public function my_business_create()
    {
        $user = Auth::user();
        $id_business = $user->id_business;

        if(!empty($id_business)){
            return redirect('/my_business');
        }

        $categories = Category::orderBy('name', 'ASC')->get();
        $states     = State::all();

        return view('my_business.create', [
            'categories' => $categories,
            'states'     => $states,
        ]);

    }

    public function my_business_store(Request $request)
    {
        $request->validate(
            [
                'name'         => 'required|max:250|min:5|unique:services,name',
                'description'  => 'required',
                'id_category'  => 'required',
                'id_service'   => 'required',
                'phone'        => ['nullable', 'regex:/^(\(\d{2}\) \d{4}-\d{4}|\(\d{2}\) \d{1} \d{4}-\d{4})$/'],
                'whatsapp'     => ['nullable', 'regex:/^(\(\d{2}\) \d{4}-\d{4}|\(\d{2}\) \d{1} \d{4}-\d{4})$/'],
                'instagram'    => ['nullable', 'regex:/^(?!(?:https?:\/\/)?(?:www\.)?[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)+(?:\/[^\s]*)?$).*$/'],
                'zipcode'      => 'required',
                'id_city'      => 'required',
            ],
            [
                'name.required'         => 'Informe o nome.',
                'description.required'  => 'Informe a Descrição.',
                'id_category.required'  => 'Selecione a Categoria.',
                'id_service.required'   => 'Selecione o Serviço.',
                'phone'                 => 'Formato do número do telefone inválido.',
                'whatsapp'              => 'Formato do número do whatsapp inválido.',
                'instagram'             => 'Informe apenas o nome do perfil do instagram.',
                'zipcode.required'      => 'Informe o CEP.',
                'id_city.required'      => 'Informe um CEP válido.',
            ]
        );

        $description = str_replace("<p>", "<p style='margin-bottom: auto;'>",$request->description);

        $status = 'unpublished';

        $business = new Business;

        $business->zipcode     = $request->zipcode;
        $business->id_city     = $request->id_city;
        $business->district    = $request->district;
        $business->street      = $request->street;
        $business->phone       = $request->phone;
        $business->whatsapp    = $request->whatsapp;
        $business->instagram   = $request->instagram;
        $business->name        = $request->name;
        $business->status      = $status;
        $business->description = $description;
        $business->path       = $request->path;

        $business->save();

        $id_business = $business->id;

        if(!empty($request->id_service)){

            foreach($request->id_service as $id_service){

                $service = [
                    'id_business' => $id_business,
                    'id_service'  => $id_service
                ];

                BusinessService::create($service);
            }
        }

        User::where('id', auth()->user()->id)
            ->update(['id_business'  => $id_business]);

        if ($request->hasFile('images')) {
            foreach ($request->allFiles()['images'] as $i => $image) {
                $file = $image;

                $image_name = md5($file->getClientOriginalName() . strtotime("now")) . "." . $file->extension();              

                $file->move(public_path("images/business/" . $id_business), $image_name);

                $path = "images/business/" . $id_business . "/" . $image_name;
            }

            Business::where('id', $id_business)
                    ->update([
                        'path' => $path
                    ]);
        }


        return redirect('/my_business')->with('message', 'Criado com sucesso!');
    }

    public function my_business_details()
    {
        $user = Auth::user();
        $id_business = $user->id_business;

        $business = null;

        try {
             $business = Business::findOrFail($id_business);
             return view('my_business.details', ['my_business' => $business]);

        } catch (\Exception $e) {
            return view('my_business.details', ['my_business' => $business]);
        }

    }

    public function my_business_edit()
    {
        $user = Auth::user();
        $id_business = $user->id_business;

        $categories = Category::orderBy('name', 'ASC')->get();
        $services   = Service::orderBy('name', 'ASC')->get();
        $states     = State::all();
        
        try {
            $business = Business::findOrFail($id_business);

            return view('my_business.create', [
                'my_business'  => $business,
                'categories'   => $categories,
                'services'     => $services,
                'states'       => $states,
            ]);

        } catch (\Exception $e) {
            return redirect('/my_business');
        }

        
    }

    public function my_business_update(Request $request)
    {
        $request->validate(
            [
                'name'         => 'required|max:250|min:5|unique:services,name',
                'description'  => 'required',
                'id_category'  => 'required',
                'id_service'   => 'required',
                'phone'        => ['nullable', 'regex:/^(\(\d{2}\) \d{4}-\d{4}|\(\d{2}\) \d{1} \d{4}-\d{4})$/'],
                'whatsapp'     => ['nullable', 'regex:/^(\(\d{2}\) \d{4}-\d{4}|\(\d{2}\) \d{1} \d{4}-\d{4})$/'],
                'instagram'    => ['nullable', 'regex:/^(?!(?:https?:\/\/)?(?:www\.)?[a-zA-Z0-9-]+(?:\.[a-zA-Z]+)+(?:\/[^\s]*)?$).*$/'],
                'zipcode'      => 'required',
                'id_city'      => 'required',
            ],
            [
                'name.required'         => 'Informe o nome.',
                'description.required'  => 'Informe a Descrição.',
                'id_category.required'  => 'Selecione a Categoria.',
                'id_service.required'   => 'Selecione o Serviço.',
                'phone'                 => 'Formato do número do telefone inválido.',
                'whatsapp'              => 'Formato do número do whatsapp inválido.',
                'instagram'             => 'Informe apenas o nome do perfil do instagram.',
                'zipcode.required'      => 'Informe o CEP.',
                'id_city.required'      => 'Informe um CEP válido.',
            ]
        );

        $user = Auth::user();
        $id_business = $user->id_business;
        $path = null;
        $business_path_delete = null;
        $description = str_replace("<p>", "<p style='margin-bottom: auto;'>",$request->description);

        $status = @$request->status == 'on' ? 'published' : 'unpublished';

        $business = Business::find($id_business);

        if ($request->hasFile('images')) {
            foreach ($request->allFiles()['images'] as $i => $image) {
                $file = $image;

                $image_name = md5($file->getClientOriginalName() . strtotime("now")) . "." . $file->extension();              

                $file->move(public_path("images/business/" . $id_business), $image_name);

                $path = "images/business/" . $id_business . "/" . $image_name;
            }

            //  Remover foto caso exista
            $business_path_delete = $business->path;

            if(!empty($business_path_delete)){
                Storage::disk('images')->delete($business_path_delete);
            }

            $business->path    = $path;
    
        }

        $business->zipcode     = $request->zipcode;
        $business->id_city     = $request->id_city;
        $business->district    = $request->district;
        $business->street      = $request->street;
        $business->phone       = $request->phone;
        $business->whatsapp    = $request->whatsapp;
        $business->instagram   = $request->instagram;
        $business->name        = $request->name;
        $business->status      = $status;
        $business->description = $description;

        $business->save();

        if(!empty($request->id_service)){

            // Obter os serviços do negócio a partir do relacionamento
            $business = BusinessService::where('id_business','=',$id_business);
            $services = $business->pluck('id_service')->toArray();

            // Obter os serviços selecionados pelo usuário no formulário
            $selected_services = $request->input('id_service', []);

            // Remover serviços que não estão mais selecionados
            $services_to_remove = array_diff($services, $selected_services);
            if (!empty($services_to_remove)) {
                BusinessService::where('id_business', $id_business)
                    ->whereIn('id_service', $services_to_remove)
                    ->delete();
            }

            // Adicionar novos serviços selecionados
            $services_to_add = array_diff($selected_services, $services);
            $services_data = [];
            foreach ($services_to_add as $id_service) {
                $services_data[] = [
                    'id_business' => $id_business,
                    'id_service'  => $id_service,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }

            BusinessService::insert($services_data);
        }

        return redirect('/my_business')->with('message', 'Editado com sucesso!');
    }

    public function destroy(Business $business)
    {
        //
    }

    public function search(Request $request)
    {
        if (trim($request->search) != "") {

            $states         = State::all();
            $cities         = City::all();
            $categories     = Category::all();
            $business   = Business::where('name', 'like', '%' . $request->search . '%')
                ->orwhere('description', 'like', '%' . $request->search . '%')
                ->get();

            return view('home', [
                                'business'      => $business,
                                'cities'        => $cities,
                                'states'        => $states,
                                'categories'    => $categories,
                                ]);
        }else{
            return redirect($request->header()['referer'][0])->with('message', 'Ops! Você não informou o que deseja buscar.');
        }
    }
    
}
