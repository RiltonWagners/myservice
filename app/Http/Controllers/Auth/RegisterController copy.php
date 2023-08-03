<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Plan;
use App\Models\Price;
use App\Models\Subscription;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//require_once('../vendor/autoload.php');

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name' => 'Informe o nome',
            'email' => 'Email já cadastrado',
            'password' => 'Informe a senha',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $email      = $data['email'];
        $name       = $data['name'];
        $id_price   = $data['id_price'];
        //$priceId    = $data['plan'];

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe     = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //$payload    = @file_get_contents('php://input');


        // The price ID passed from the front end.
        //$priceId = $_POST['priceId'];
        //$priceId = '{{id_price}}';

        //Cadastra o usuário no stripe
        $customer = $stripe->customers->create([
            'name'  => $name,
            'email' => $email, 
        ]);
        
        // dd($customer);

        //$plans = Plan::where(['name' => 'Plano Grátis'])->get();
        //$id_product = $plans->id_product;

        $price = Price::where(['id_product' => $id_price])
                                ->where(['active' => 'true'])
                                ->get();

        $id_price = $price->id_price;
        $id_product = $price->id_product;

        //if($option == "Professional"){

            $session = \Stripe\Checkout\Session::create([
                /*'client_reference_id' => $customer->id,*/
                'customer' => $customer->id,
                'success_url' => 'http://127.0.0.1:8000/welcome',
                'cancel_url' => 'http://127.0.0.1:8000/welcome',
                'mode' => 'subscription',
                'line_items' => [[
                    'price' => $id_price,
                    // For metered billing, do not pass quantity
                    'quantity' => 1,
                ]],
            ]);
dd($session);
            if(!empty($session)){

                $user = User::create([
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'password'  => Hash::make($data['password']),
                ]);

                // Após a confirmação do pagamento atualizar o plano de assinatura através do webhook
                Subscription::create([
                    'id_user'       => $user->id,
                    'id_customer'   => $customer->id,
                    'status'        => 'pending',
                    'id_price'      => $id_price,
                    'id_product'    => $id_product
                ]);

                header("Location: " . $session->url);
                exit();
            }
            //dd($session);
            // Redirect to the URL returned on the Checkout Session.
            // With vanilla PHP, you can redirect with:
            //header("HTTP/1.1 303 See Other");
        /*}else{

            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
            ]);

            Subscription::create([
                'id_user'       => $user->id,
                'id_customer'   => $customer->id,
                'status'        => 'active',
                'id_price'      => null,
                'id_product'    => $id_product,
            ]);

            return $user;
        }*/

    }
    
}
