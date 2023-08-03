<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago\{MercadoPago, Preference};

class MercadoPagoController extends Controller
{
    public function payment(Request $request)
    {
        return view('payment.payment');
    }

    public function createPayment(Request $request)
    {

        // Configure suas credenciais do Mercado Pago
        \MercadoPago\SDK::setAccessToken(env('ACCESS_TOKEN_MP','ACCESS_TOKEN_MP_TEST'));

        // Cria uma nova preferência de pagamento
        $preference = new Preference();

        $item = new \MercadoPago\Item();
        $item->title = 'Publicação';
        $item->quantity = 1;
        $item->unit_price = 9.90; // Valor do pagamento

        $preference->items = [$item];
        $preference->payment_methods = [
            'excluded_payment_methods' => [
                ['id' => 'excluded_payment_method_id']
            ],
            'excluded_payment_types' => [
                ['id' => 'excluded_payment_type_id']
            ],
            'installments' => 1 // Número de parcelas
        ];

        $preference->back_urls = [
            'success' => route('payment.success'), // Rota para sucesso
            'failure' => route('payment.failure'), // Rota para falha
            'pending' => route('payment.pending')  // Rota para pendente
        ];

        $preference->auto_return = 'approved'; // Redirecionar automaticamente em caso de aprovação

        $preference->save();

        // Redirecione o cliente para a página de pagamento do Mercado Pago
        return redirect($preference->init_point);
    }

    public function successPayment()
    {
        // Lógica para processar um pagamento aprovado
        return response()->json(['message' => 'Test payment approved']);
    }

    public function failurePayment()
    {
        // Lógica para processar um pagamento rejeitado
        return response()->json(['message' => 'Test payment rejected']);
    }

    public function pendingPayment()
    {
        // Lógica para processar um pagamento pendente
        return response()->json(['message' => 'Test payment pending']);
    }
}