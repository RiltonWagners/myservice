<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use App\Models\User;

//require_once '../vendor/autoload.php';

class CreateController extends Controller
{

    public function create(){
        //dd("teste");
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        function calculateOrderAmount(array $items): int {
            // Replace this constant with a calculation of the order's amount
            // Calculate the order total on the server to prevent
            // people from directly manipulating the amount on the client
            return 1400;
        }

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            //dd($jsonObj->items);
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => calculateOrderAmount($jsonObj->items),
                'currency' => 'brl',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);

        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }



    public function checkout(){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys


        //
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        /*
        Category::where('id', 3)
                ->update(['name' => 'Saúde 3']);
        */
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); # OK

        $payload = @file_get_contents('php://input');
       // dd($payload);
       
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        
        $event = null;

        $email  = json_decode($payload)->object->email;
        $id     = json_decode($payload)->object->id;

        $user = User::where('email', '=', $email)->get();

        if(empty($user)){
            //return ["message"=>"Usuário não cadastrado"];
            
            $exist_user = $stripe->customers->retrieve(
                $id,
            []
            );

            if(!empty($exist_user->id) && @!$exist_user->deleted){
                
                $stripe->customers->delete(
                    $id,
                []
                );
            }

            return ["message"=>"Usuário não cadastrado"];
        }else{
            //return ["message"=>"Registrar usuário no plano"];
            /*
            $PaymentMethod = $stripe->customers->allPaymentMethods(
                                                    'cus_OBfDPOnhqArxph',
                                                    ['type' => 'card']
                                                );
            return $PaymentMethod;
            */
            $stripe->subscriptions->create([
            'customer' => 'cus_OBGPQFg4vJxB4Y',
            'items' => [
                ['price' => 'price_1NN3eDBWhRPzAP4l3Iqjxlb7'],
            ],
            "invoice_settings" => [
                "custom_fields" => null,
                "default_payment_method" => 'null',
                "footer" => null,
                "rendering_options" => null
            ],
            ]);

            return ["message"=>"Registrado com sucesso"];
        }





        // The price ID passed from the front end.
        $priceId = $_POST['priceId'];
        //$priceId = '{{id_price}}';

        $session = \Stripe\Checkout\Session::create([
            'client_reference_id' => '',
            'success_url' => env('STRIPE_SUCCESS_URL'),
            'cancel_url' => env('STRIPE_CANCEL_URL'),
            'mode' => 'subscription',
            'line_items' => [[
                'price' => $priceId,
                // For metered billing, do not pass quantity
                'quantity' => 1,
            ]],
        ]);
//dd($session);
        // Redirect to the URL returned on the Checkout Session.
        // With vanilla PHP, you can redirect with:
           //header("HTTP/1.1 303 See Other");
           header("Location: " . $session->url);
           exit();
    }
}