<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Publication;
use App\Models\PublicationImage;
use App\Models\Business;
use App\Models\BusinessImageImage;
use App\Models\State;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    protected $categories;

    //OK
    public function __construct()
    {
       //$this->middleware('auth');

        $this->categories = DB::table('categories')
                            ->join('services', 'services.id_category', '=', 'categories.id')
                            ->join('business_services', 'business_services.id_service', '=', 'services.id')
                            ->join('businesses', 'businesses.id', '=', 'business_services.id_business')
                            ->select('categories.*')
                            ->where('businesses.status', '=', 'published')
                            ->orderBy('categories.name','ASC')
                            ->distinct()
                            ->get();
    }

    //OK
    public function index()
    {
        $states         = DB::table('businesses')
                            ->join('cities', 'businesses.id_city', '=', 'cities.code')
                            ->join('states', 'cities.uf', '=', 'states.uf')
                            ->distinct()
                            ->select('states.name','states.uf')
                            ->get();
        $cities         = DB::table('businesses')
                            ->join('cities', 'businesses.id_city', '=', 'cities.code')
                            ->join('states', 'cities.uf', '=', 'states.uf')
                            ->distinct()
                            ->select('cities.name','cities.code','cities.uf','cities.id')
                            ->get();

        return view('home', [
                                'business'      => [],
                                'cities'        => $cities,
                                'states'        => $states,
                                'categories'    => $this->categories,
                            ]);
    }

    //OK
    public function search(Request $request)
    {
        
        //Filtro por cidade
        if(isset($request->code) && $request->code != ""){
        
            $business   = Business::where([['id_city', '=', $request->code],['status', '=', 'published']])
                                          ->get();

            if(count($business) > 0){
                return view('function.result_business', [
                    'business'  => $business,
                    ]);
            }else{
                return view('function.result_businesss', [
                    'business'  => $business,
                    'message'       => 'Nenhum resultado foi encontrado'
                    ]);
            }
        }

        //Filtro por categoria
        else if(isset($request->category) && $request->category != ""){
        
            $business   = Business::join('business_services', 'business_services.id_business', '=', 'businesses.id')
                                    ->join('services', 'services.id', '=', 'business_services.id_service')
                                    ->join('categories', 'categories.id', '=', 'services.id_category')
                                    ->where('services.id_category', '=', $request->category)
                                    ->get(['*','businesses.description as business_description', 'businesses.id as id_business']);

            if(count($business) > 0){
                return view('function.result_business', [
                    'business'  => $business,
                    ]);
            }else{
                return view('function.result_businesss', [
                    'business'  => $business,
                    'message'       => 'Nenhum resultado foi encontrado'
                    ]);
            }
        }

        //Campo de busca
        if(isset($request->search) && $request->search != ""){

            $states         = DB::table('businesses')
                                ->join('cities', 'businesses.id_city', '=', 'cities.code')
                                ->join('states', 'cities.uf', '=', 'states.uf')
                                ->orwhere('businesses.name', 'like', '%'.$request->search.'%')
                                ->orwhere('businesses.description', 'like', '%'.$request->search.'%')
                                ->distinct()
                                ->select('states.name','states.uf')
                                ->get();

            $cities = DB::table('businesses')
                                ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                                ->join('services', 'services.id', '=', 'business_services.id_service')
                                ->join('categories', 'categories.id', '=', 'services.id_category')
                                ->join('cities', 'businesses.id_city', '=', 'cities.code')
                                ->join('states', 'cities.uf', '=', 'states.uf')
                                ->where('businesses.status', '=', 'published')
                                ->where('businesses.name', 'like', '%'.$request->search.'%')
                                ->where('businesses.description', 'like', '%'.$request->search.'%')
                                ->distinct()
                                ->select('cities.name','cities.code','cities.uf','cities.id',DB::raw('count(DISTINCT businesses.id) as business_count'))
                                ->groupBy('cities.name','cities.code','cities.uf','cities.id')
                                ->get();

            $business   = Business::where('name', 'like', '%'.$request->search.'%')
                                    ->orwhere('description', 'like', '%'.$request->search.'%')
                                    ->select(['*', 'businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business'])
                                    ->get(['*','businesses.description as business_description', 'businesses.id as id_business']);

            if(count($business) > 0){
                return view('home', [
                    'business'        => $business,
                    'cities'          => $cities,
                    'states'          => $states,
                    'categories'      => $this->categories,
                    'search_category' => false,
                    'filter_search'   => $request->search,
                    'filter_city'     => null,
                    ]);
            }else{
                return view('home', [
                    'business'        => $business,
                    'cities'          => [],
                    'states'          => [],
                    'categories'      => $this->categories,
                    'search_category' => false,
                    'filter_search'   => $request->search,
                    'filter_city'     => null,
                ])->with('message_not_found', 'Nenhum resultado foi encontrado');
            }
        }else{
            $business = Array();

            $states  = DB::table('businesses')
                        ->join('cities', 'businesses.id_city', '=', 'cities.code')
                        ->join('states', 'cities.uf', '=', 'states.uf')
                        ->distinct()
                        ->select('states.name','states.uf')
                        ->get();

            $cities = DB::table('businesses')
                        ->join('cities', 'businesses.id_city', '=', 'cities.code')
                        ->join('states', 'cities.uf', '=', 'states.uf')
                        ->distinct()
                        ->select('cities.name','cities.code','cities.uf','cities.id',DB::raw('count(DISTINCT businesses.id) as business_count'))
                        ->groupBy('cities.name', 'cities.code', 'cities.uf', 'cities.id')
                        ->get();
    
            return view('home', [
                'business'        => $business,
                'cities'          => $cities,
                'states'          => $states,
                'categories'      => $this->categories,
                'search_category' => false,
                'filter_search'   => $request->search,
                'filter_city'     => null,
            ])->with('message_not_found', 'Nenhum resultado foi encontrado');
        }

    }

    //OK
    public function search_category(Request $request)
    {
        $cities = City::All();

        //Busca por categoria
        if(!empty($request->category)){
            
            $states  = DB::table('businesses')
                        ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                        ->join('cities', 'businesses.id_city', '=', 'cities.code')
                        ->join('states', 'cities.uf', '=', 'states.uf')
                        ->join('services', 'services.id', '=', 'business_services.id_service')
                        ->join('categories', 'categories.id', '=', 'services.id_category')
                        //->where('categories.name', 'like', '%' . $request->segment(3) . '%')
                        ->where('categories.slug', '=', $request->category)
                        ->orwhere('categories.name', '=', $request->category)
                        ->distinct()
                        ->select('states.name','states.uf')
                        ->get();

            $cities = DB::table('businesses')
                        ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                        ->join('cities', 'businesses.id_city', '=', 'cities.code')
                        ->join('states', 'cities.uf', '=', 'states.uf')
                        ->join('services', 'services.id', '=', 'business_services.id_service')
                        ->join('categories', 'categories.id', '=', 'services.id_category')
                        //->where('categories.name', 'like', '%' . $request->segment(1) . '%')
                        ->where('categories.slug', '=', $request->category)
                        ->orwhere('categories.name', '=', $request->category)
                        ->distinct()
                        ->select('cities.name', 'cities.code', 'cities.uf', 'cities.id', DB::raw('count(DISTINCT businesses.id) as business_count'))
                        ->groupBy('cities.name', 'cities.code', 'cities.uf', 'cities.id')
                        ->get();

            $business   = Business::join('business_services', 'business_services.id_business', '=', 'businesses.id')
                                    ->join('services', 'services.id', '=', 'business_services.id_service')
                                    ->join('categories', 'categories.id', '=', 'services.id_category')
                                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                                    ->join('states', 'cities.uf', '=', 'states.uf')
                                    //->leftJoin('businesses_images', 'businesses_images.id_business', '=', 'business.id')
                                    //->where('categories.name', 'like', '%'.$request->segment(3).'%')
                                    ->where('categories.slug', '=', $request->category)
                                    ->orwhere('categories.name', '=', $request->category)
                                    ->where('businesses.status', '=', 'published')
                                    //->where('states.uf', '=', $request->segment(1))
                                    ->select(['businesses.id as id_business', 'businesses.name as business_name'])
                                    //->groupBy('businesses.id')
                                    ->get();

            $business_array=[];
            foreach($business as $busine){
                array_push($business_array, $busine->id_business);
            }

            $business   = Business::wherein('id', $business_array)
                                    ->select(['*', 'businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business'])
                                    ->get();

            if(count($business) > 0){
                return view('home', [
                    'business'        => $business,
                    'cities'          => $cities,
                    'states'          => $states,
                    'categories'      => $this->categories,
                    'category_slug'   => $business[0]->BusinessService[0]->Service[0]->category->slug,
                    'search_category' => $business[0]->BusinessService[0]->Service[0]->category->name,//$request->category,
                    'search'          => null,
                    'filter_search'   => null,
                    'filter_city'     => null,
                    ]);
            }else{
                return view('home', [
                    'business'        => $business,
                    'cities'          => $cities,
                    'states'          => $states,
                    'categories'      => $this->categories,
                    'category_slug'   => null,
                    'search_category' => null,
                    'search'          => null,
                    'filter_search'   => null,
                    'filter_city'     => null,
                    'message'       => 'Nenhum resultado foi encontrado'
                    ]);
            }

        }
       
    }

    //OK
    public function search_category_city(Request $request)
    {
        $city = City::where('name', '=', str_replace("-", " ", $request->segment(3)))
                        ->where('uf', '=', $request->segment(2))
                        ->get();
        $id_city = $city[0]->id ? $city[0]->id : 0;
        $name_city = $city[0]->id ? $city[0]->name : $request->segment(3);

        $states  = DB::table('businesses')
                    ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->join('services', 'services.id', '=', 'business_services.id_service')
                    ->join('categories', 'categories.id', '=', 'services.id_category')
                    ->where('categories.slug', '=', $request->category)
                    ->distinct()
                    ->select('states.name','states.uf')
                    ->get();

        $cities = DB::table('businesses')
                    ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->join('services', 'services.id', '=', 'business_services.id_service')
                    ->join('categories', 'categories.id', '=', 'services.id_category')
                    ->where('categories.slug', '=', $request->category)
                    ->distinct()
                    ->select('cities.name', 'cities.code', 'cities.uf', 'cities.id', DB::raw('count(DISTINCT businesses.id) as business_count'))
                    ->groupBy('cities.name', 'cities.code', 'cities.uf', 'cities.id')
                    ->get();

        $business   = Business::join('business_services', 'business_services.id_business', '=', 'businesses.id')
                        ->join('services', 'services.id', '=', 'business_services.id_service')
                        ->join('categories', 'categories.id', '=', 'services.id_category')
                        ->join('cities', 'cities.code', '=', 'businesses.id_city')
                        ->join('states', 'states.uf', '=', 'cities.uf')
                        ->where('categories.slug', '=', $request->category)
                        ->where('cities.id', '=', $id_city)
                        ->where('states.uf', '=', $request->segment(2))
                        //->where('businesses.name', 'like', '%' . $request->segment(4) . '%')
                        //->orwhere('businesses.description', 'like', '%' . $request->segment(4) . '%')
                        ->where('businesses.status', '=', 'published')
                        ->get(['businesses.id AS id_business']);

        $business_array=[];
        foreach($business as $busine){
            array_push($business_array, $busine->id_business);
        }
        $business   = Business::wherein('id', $business_array)
                    ->select(['*', 'businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business'])
                    ->get();

        $message = "'message' => 'Nenhum resultado foi encontrado'";
        
        return view('home', [
            'business'        => $business,
            'cities'          => $cities,
            'states'          => $states,
            'filter_city'     => $name_city,
            'filter_state'    => $request->segment(2),
            'filter_search'   => null,
            'categories'      => $this->categories,
            'search_category' => $request->category,
            count($business) > 0 ? $message : ""
            ]);
       
    }

    //OK
    public function search_category_city_search(Request $request)
    {
        $city = City::where('name', '=', str_replace("-", " ", $request->segment(3)))
                        ->where('uf', '=', $request->segment(2))
                        ->get();
        $id_city = $city[0]->id ? $city[0]->id : 0;
        $name_city = $city[0]->id ? $city[0]->name : $request->segment(3);

        $states  = DB::table('businesses')
                    ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->join('services', 'services.id', '=', 'business_services.id_service')
                    ->join('categories', 'categories.id', '=', 'services.id_category')
                    ->where('categories.name', 'like', '%'.$request->segment(4).'%')
                    ->distinct()
                    ->select('states.name','states.uf')
                    ->get();

        $cities = DB::table('businesses')
                    ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->join('services', 'services.id', '=', 'business_services.id_service')
                    ->join('categories', 'categories.id', '=', 'services.id_category')
                    ->where('categories.name', 'like', '%'.$request->segment(4).'%')
                    ->distinct()
                    ->select('cities.name', 'cities.code', 'cities.uf', 'cities.id', DB::raw('count(DISTINCT businesses.id) as business_count'))
                    ->groupBy('cities.name', 'cities.code', 'cities.uf', 'cities.id')
                    ->get();

        $business   = Business::join('business_services', 'business_services.id_business', '=', 'businesses.id')
                        ->join('services', 'services.id', '=', 'business_services.id_service')
                        ->join('categories', 'categories.id', '=', 'services.id_category')
                        ->join('cities', 'cities.code', '=', 'businesses.id_city')
                        ->join('states', 'states.uf', '=', 'cities.uf')
                        ->where('categories.name', 'like', '%'.$request->segment(4).'%')
                        ->where('cities.id', '=', $id_city)
                        ->where('states.uf', '=', $request->segment(2))
                        ->where('businesses.name', 'like', '%'.$request->segment(4).'%')
                        ->where('businesses.description', 'like', '%'.$request->segment(4).'%')
                        ->where('businesses.status', '=', 'published')
                        ->distinct()
                        ->get(['businesses.id AS id_business']);

        $business_array=[];
        foreach($business as $busine){
            array_push($business_array, $busine->id_business);
        }
        $business   = Business::wherein('id', $business_array)
                    ->select(['*', 'businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business'])
                    ->get();

        $message = "'message' => 'Nenhum resultado foi encontrado'";
        
        return view('home', [
            'business'        => $business,
            'cities'          => $cities,
            'states'          => $states,
            'filter_city'     => $name_city,
            'filter_state'    => $request->segment(2),
            'filter_search'   => $request->segment(4),
            'categories'      => $this->categories,
            'search_category' => $request->segment(4),
            count($business) > 0 ? $message : ""
            ]);
       
    }

    public function search_city(Request $request)
    {
        $city = City::where('name', '=', str_replace("-", " ", $request->segment(2)))
                        ->where('uf', '=', $request->segment(1))
                        ->get();
        $id_city = $city[0]->id ? $city[0]->id : 0;
        $name_city = $city[0]->id ? $city[0]->name : $request->segment(2);

        $states  = DB::table('businesses')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->distinct()
                    ->select('states.name','states.uf')
                    ->get();

        $cities = DB::table('businesses')
                    ->join('business_services', 'business_services.id_business', '=', 'businesses.id')
                    ->join('services', 'services.id', '=', 'business_services.id_service')
                    ->join('categories', 'categories.id', '=', 'services.id_category')
                    ->join('cities', 'businesses.id_city', '=', 'cities.code')
                    ->join('states', 'cities.uf', '=', 'states.uf')
                    ->where('cities.id', '=', $id_city)
                    ->where('states.uf', '=', $request->segment(1))
                    ->where('businesses.status', '=', 'published')
                    ->distinct()
                    ->select('cities.name','cities.code','cities.uf','cities.id',DB::raw('count(DISTINCT businesses.id) as business_count'))
                    ->groupBy('cities.name','cities.code','cities.uf','cities.id','businesses.id')
                    ->get();
        
        $business   = Business::join('business_services', 'business_services.id_business', '=', 'businesses.id')
                                ->join('services', 'services.id', '=', 'business_services.id_service')
                                ->join('categories', 'categories.id', '=', 'services.id_category')
                                ->join('cities', 'cities.code', '=', 'businesses.id_city')
                                ->join('states', 'states.uf', '=', 'cities.uf')
                                ->where('cities.id', '=', $id_city)
                                ->where('states.uf', '=', $request->segment(1))
                                ->where('businesses.name', 'like', '%' . $request->segment(3) . '%')
                                ->orwhere('businesses.description', 'like', '%' . $request->segment(3) . '%')
                                ->where('businesses.status', '=', 'published')
                                ->distinct()
                                //->get(['businesses.id as id_business']);
                                ->get(['businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business']);

        $business_array=[];
        foreach($business as $busine){
            array_push($business_array, $busine->id_business);
        }
        $business   = Business::wherein('id', $business_array)
                    ->select(['*', 'businesses.description as business_description', 'businesses.name as business_name', 'businesses.id as id_business'])
                    ->get();

        if(count($business) > 0){
            return view('home', [
                'business'        => $business,
                'cities'          => $cities,
                'states'          => $states,
                'filter_city'     => $name_city,
                'filter_state'    => $request->segment(1),
                'filter_search'   => $request->segment(3),
                'categories'      => $this->categories
                ]);
        }else{
            return view('home', [
                'business'        => $business,
                'cities'          => $cities,
                'states'          => $states,
                'filter_city'     => $name_city,
                'filter_state'    => $request->segment(1),
                'filter_search'   => $request->segment(3),
                'categories'      => $this->categories,
                'message'       => 'Nenhum resultado foi encontrado'
                ]);
        }
       
    }

    public function register()
    {
        $plans = Plan::with(['price' => function ($query) {
            $query->orderBy('price', 'ASC');
        }])->get();

        return view('auth.register', ['plans' => $plans]);
    }
}
