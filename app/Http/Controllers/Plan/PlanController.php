<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Price;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index()
    {
        //$plans = Plan::orderBy('name', 'ASC')->table->Price->orderBy('name', 'ASC')->get();
        $plans = Plan::with(['price' => function ($query) {
                            $query->orderBy('price', 'ASC');
                        }])
                        ->get();
    
        return view('plans.plans', ['plans' => $plans]);
    }

    public function plans()
    {
        //$plans = Plan::orderBy('name', 'ASC')->table->Price->orderBy('name', 'ASC')->get();
        $plans = Plan::with(['price' => function ($query) {
                            $query->orderBy('price', 'ASC');
                        }])
                        ->get();
        
        return view('plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:255|min:5|unique:plans'
            ],
            [
                'name.required' => 'O campo \'Nome\' é de preenchimento obrigatório.',
                'name.unique'   => 'Já existe um plano com o nome \''. $request->name  .'\'.'
            ]
        );

        $message = "";
        $price   = format_number($request->price);
        $active = $request->active == true ? "true" : "false";

        $stripe  = new \Stripe\StripeClient(env('STRIPE_SECRET'));        

        try {
            
            $stripe_product = $stripe->products->create([
                'name'               => $request->name,
                'active'             => $active,
                'description'        => $request->description
            ]);

            try {
            
                if(!empty($stripe_product->id)){

                    $stripe_price = $stripe->prices->create([
                        'unit_amount' => somenteNumeros($price),
                        'currency'    => 'brl',
                        'recurring'   => ['interval' => 'month'],
                        'active'      => $active,
                        'product'     => $stripe_product->id,
                    ]);
                }

            } catch (\Exception $e) {
                $message = $e->getMessage();
                //return redirect(route('plan.index'))->with('message', $message);
            }

            if(!empty($stripe_price->id)){

                $plan = new Plan;
                $plan->name         = $request->name;
                $plan->active       = $active;
                $plan->description  = $request->description;
                $plan->id_product   = $stripe_product->id;
                $plan->save();

                $price = new Price;
                $price->id_price           = $stripe_price->id;
                $price->id_plan            = $plan->id;
                $price->id_product         = $stripe_product->id;
                $price->price              = format_number($request->price);
                $price->active             = $active;
                $price->recurring_interval = $stripe_price->recurring->interval;
                $price->save();

                
                return redirect(route('plan.index'))->with('message', 'Plano adicionado com sucesso!');
            }

        } catch (\Exception $e) {
            $message = $e->getMessage();
            //return redirect(route('plan.index'))->with('message', $message);
        }
        

        return redirect(route('plan.index'))->with('message', 'Falha ao cadastrar o plano! '.$message);
    }

    public function show(Plan $plan)
    {
        //
    }

    public function edit(Request $request)
    {
        $plan = Plan::findOrFail($request->id);

        return view('plans.create', ['plan' => $plan]);

    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:255|min:5'
            ],
            [
                'name.required' => 'O campo \'Nome\' é de preenchimento obrigatório.',
               /* 'name.unique'   => 'Já existe um plano com o nome \''. $request->name  .'\'.'*/
            ]
        );

        $plan = Plan::findOrFail($request->id);

        $id_product = $plan->id_product;
        $id_price   = $plan->id_price;
        $active = $request->active == true ? "true" : "false";
        //$price      = format_number($request->price);
        $message    = "";

        try {

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $stripe_product = $stripe->products->update(
                $id_product,
                [
                    'name'               => $request->name,
                    'active'             => $active,
                    'description'        => $request->description,
                    []
                ]
            );
            //dd($stripe_product);
            try {

                $stripe_price = $stripe->prices->update(
                    $id_price,
                    [
                        'active'      => $active,
                    ]
                );

            } catch (\Exception $e) {
                if($e->getMessage() == "The resource ID cannot be null or whitespace."){
                    $message = " O valor não pode ser alterado.";
                }else{
                    $message = $e->getMessage();
                }
            }

            $plan->name        = $request->name;
            $plan->active      = $active;
            $plan->description = $request->description;
            $plan->save();

            /*
            Plan::where('id', $request->id)->update([
                'name'        => $request->name,
                'active'      => $active,
                'description' => $request->description,
            ]);
            */

            Price::where('id', $request->id)
                ->update([
                    'active'      => $active,
                ]);

            return redirect(route('plan.index'))->with('message', 'Plano editado com sucesso! '.$message);

        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect(route('plan.index'))->with('message', 'Falha ao editar o plano! '.$message);
        }
    }

    public function destroy(Request $request)
    {
        /*
        *   A exclusão de um produto só é possível se não houver preços associados a ele. 
        *   Além disso, excluir um produto com type=good só é possível se não houver SKUs associados a ele.
        */

        $plan = Plan::findOrFail($request->id);

        $id_product = $plan->id_product;

        if(!empty($id_product)){

            try {

                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                $product = $stripe->products->delete(
                    $id_product,
                    []
                );

                if(@$product->deleted){
                    Plan::findOrFail($request->id)->delete();

                    return redirect(route('plan.index'))->with('message', 'Plano excluído com sucesso!');
                }


            } catch (\Exception $e) {

                if($e->getMessage() == "This product cannot be deleted because it has one or more user-created prices."){
                    $message = "Este produto não pode ser excluído porque possui um ou mais preços criados pelo usuário.";
                }else{
                    $message = $e->getMessage();
                }
                return redirect(route('plan.index'))->with('message', $message);
            }
        }
        
        return redirect(route('plan.index'))->with('message', 'Falha ao remover o plano! Não encontrado.');
    }

   
}

function format_number($value){

    

    // Remove os pontos e substitui a vírgula por ponto
    $value = str_replace(".", ".", $value);
    $value = str_replace(",", ".", $value);
    $value = str_replace("R$ ", "", $value);
    
    // Converte para float
    $value = floatval($value);
    
    // Formata o número com duas casas decimais
    $value = number_format($value, 2, '.', '');

    return $value;
}

function somenteNumeros($value) {
    $number = preg_replace('/[^0-9]/', '', $value);

    return $number;
}