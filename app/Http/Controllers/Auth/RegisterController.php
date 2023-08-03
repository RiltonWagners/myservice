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
                'email' => ['required', 'email', 'max:255', 'unique:users', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'name.required' => 'Informe o nome',
                'email.required' => 'Informe o e-mail',
                'email.email' => 'E-mail informado é inválido',
                'email.regex' => 'E-mail informado é inválido',
                'email.unique' => 'O e-mail informado já está sendo utilizado. Por favor, insira um e-mail diferente.',
                'password.required' => 'Informe a senha',
                'password.min' => 'A senha deve conter no mínimo :min caracteres',
                'password.confirmed' => 'As senhas não coincidem',
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

        $plan = Plan::where(['id' => 1])->get();

        $id_product = $plan[0]->id_product;

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe     = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //$payload    = @file_get_contents('php://input');

        //Cadastra o usuário no stripe
        $customer = $stripe->customers->create([
            'name'  => $name,
            'email' => $email, 
        ]);
        
        // dd($customer);

        //  Busca os dados do plano grátis
        $price = Price::where(['id' => 1])->get();

        $id_price   = $price[0]->id_price;
        $id_product = $price[0]->id_product;

        /*
        $session = \Stripe\Checkout\Session::create([
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
        */
        //if(!empty($session)){

            $user = User::create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'password'      => Hash::make($data['password']),
                'id_customer'   => $customer->id,
            ]);

            // Após a confirmação do pagamento atualizar o plano de assinatura através do webhook
            Subscription::create([
                'id_user'       => $user->id,
                'status'        => 'active',
                'id_price'      => $id_price,
                'id_product'    => $id_product
            ]);

            //header("Location: " . $session->url);
            //exit();
        //}
        return $user;
    }
    
}
