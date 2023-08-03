<?php

namespace App\Http\Controllers\Webhooks;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Price;
use App\Models\Plan;

require_once('../vendor/autoload.php');

class StripeController extends Controller
{    
    public function stripe()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); # OK

        $payload = @file_get_contents('php://input');
        //dd($payload);
       
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
                //json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }
        
        $payload = json_decode($payload);
        
        // Handle the event
        switch ($event->type) {
        case 'checkout.session.async_payment_failed':
            $session = $event->data->object;
            break;
        case 'checkout.session.async_payment_succeeded':
            $session = $event->data->object;
            break;
        case 'checkout.session.completed':
            $session = $event->data->object;
            break;
        case 'checkout.session.expired':
            $session = $event->data->object;
            break;
        case 'customer.created':
            $session = $event->data->object;
            break;
        case 'customer.updated':
            $session = $event->data->object;
            break;
        case 'customer.subscription.created':
            $session = $event->data->object;
            
            $id_customer  = $payload->data->object->customer;
            $id_price     = $payload->data->object->plan->id;
            $id_product   = $payload->data->object->plan->product;            
            
            $user = User::where('id_customer', $id_customer)->get();

            //  Cancela o plano ativo antes de inserir o novo plano
            Subscription::where('id_user', $user[0]->id_user)
                         ->where(function ($query) {
                            $query->where('status', 'active');
                        })
                        ->update(['status' => 'canceled']);

            $subscription = new Subscription; 
            
            $subscription->id_user     = $user[0]->id_user;
            $subscription->status      = 'active';
            $subscription->id_price    = $id_price;
            $subscription->id_product  = $id_product;
    
            $subscription->save();
            
            break;

        case 'customer.subscription.deleted':
            $session      = $event->data->object;
            $id_customer  = $payload->data->object->customer;
            $id_price     = $payload->data->object->items->data[0]->price->id;
            
            $user = Subscription::where('id_customer', $id_customer)->get();
            
            Subscription::where('id_user', $user[0]->id_user)
                        /*->where('status', 'active')*/
                        ->where('id_price', $id_price)
                        ->update(['status' => 'canceled']);

            //Após cancelar o plando assinar o Plano Grátis
            
            //  Busca os dados do plano grátis
            $plans = Plan::where(['id' => '1'])->get();
            
            $subscription = new Subscription; 

            $subscription->id_user     = $user[0]->id_user;
            $subscription->status      = 'active';
            $subscription->id_price    = $id_price;
            $subscription->id_product  = $plans[0]->id_product;
    
            $subscription->save();
            
            break;

            
        case 'product.updated':
            $session = $event->data->object;

            $id_price  = $payload->data->object->default_price;

            $id_product  = $payload->data->object->id;
            $name        = $payload->data->object->name;
            $description = $payload->data->object->description;
            $active      = $payload->data->object->active == true ? "true" : "false";
            

            Plan::where('id_product', $id_product)
                    ->update([
                            'name' => $name,
                            'description' => $description,
                            'active' => $active
                    ]);
            break;
            
        case 'price.updated':
            $session = $event->data->object;

            $id_price    = $payload->data->object->id;
            $id_product  = $payload->data->object->product;
            $active      = $payload->data->object->active == true ? "true" : "false";
            $price       = substr_replace($payload->data->object->unit_amount, '.', -2, 0);


            Price::where('id_price', $id_price)
                ->where('id_product', $id_product)
                    ->update([
                            'price' => $price,
                            'active' => $active
                    ]);
            break;
        
        
        default:
            $session = $event->type;
            
        }
        echo 'Received unknown event type ' . $session;
        http_response_code(200);
    }
}