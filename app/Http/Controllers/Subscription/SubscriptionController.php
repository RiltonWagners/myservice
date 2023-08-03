<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
//require_once '../vendor/autoload.php';

class SubscriptionController extends Controller
{

    public function index()
    {
        $plans = Plan::with(['price' => function ($query) {
            $query->orderBy('price', 'ASC');
        }])->get();

        $subscription = Subscription::where('status', 'active')
                                      ->where('id_user', auth()->user()->id)
                                      ->get();

        $id_product = $subscription[0]->id_product;

        return view('subscriptions.index', ['plans' => $plans, 'subscription' => $id_product]);

    }

    public function create(Subscription $subscription)
    {
        //
    }

    public function store(Request $request)
    {
        $id_price = $request->id_price;
       \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        //$user = User::where('id_user', auth()->user()->id);
        $subscription = Subscription::where('id_user', '=', auth()->user()->id)->get();
        //dd($subscription[0]);
        if(!empty($subscription[0]->id_customer)){

            $session = $stripe->checkout->sessions->create([
                'customer' => $subscription[0]->id_customer,
                'success_url' => env('STRIPE_SUCCESS_URL'),
                'cancel_url' => env('STRIPE_CANCEL_URL'),
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $subscription[0]->id_price,
                        // For metered billing, do not pass quantity
                        'quantity' => 1,
                    ],
                ],
            ]);
    
            // Redirect to the URL returned on the Checkout Session.
            // With vanilla PHP, you can redirect with:
               //header("HTTP/1.1 303 See Other");
               header("Location: " . $session->url);
               exit();
        }else{
            
            //$id_price = $id_price;
        }
        
       
/*
        $subscription = new Subscription;   
        
        $subscription->name = $subscription->name;

        $subscription->save();

        return redirect(route('subscription.index'))->with('message', 'Subscription adicionada com sucesso!');
        */
    }

    public function show()
    {
        $subscription = Subscription::where('status', 'active')
                                      ->where('id_user', auth()->user()->id)
                                      ->get();
        
        $id_customer = $subscription[0]->id_customer;

        $stripe      = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $portal_session = $stripe->billingPortal->sessions->create([
            'customer' => $id_customer,
            'return_url' => env('STRIPE_RETURN_URL'),
          ]);
        /*
        $session = \Stripe\Checkout\Session::create([
            'customer' => $id_customer,
            'success_url' => 'http://127.0.0.1:8000/login',
            'cancel_url' => 'http://127.0.0.1:8000/login',
            'mode' => 'subscription',
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
        ]);
        */

        header("Location: " . $portal_session->url);
        exit();

    }

    public function edit(Request $request)
    {
       //
    }

    public function update(Request $request)
    {
        /*
        Subscription::where('id', $request->id)
                ->update(['id_customer' => $request->name]);

        return redirect(route('subscription.index'))->with('message', 'Subscription editado com sucesso!');
        */
    }

    public function destroy(Request $request)
    {
        //
    }

    public function register()
    {
        if(!empty(auth()->user()->id)){
            return redirect('/subscriptions');
        }

        return view('register.index');
    }
}
