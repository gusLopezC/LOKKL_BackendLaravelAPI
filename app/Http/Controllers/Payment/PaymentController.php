<?php

namespace App\Http\Controllers\Payment;


use App\User;
use App\Payments;


use App\Mail\CrearReserva\ReservaClienteMail;
use App\Mail\CrearReserva\ReservaVendedorMail;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Carbon\Carbon;


class PaymentController extends Controller
{
    //

    public function index()
    {
        return view('pagos.verpagos');
    }


    public function execute()
    {
        // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'Aav7SidP-qC0cPKBxFMkiAy4wRclwi1jPequ-NnM2XP0AbrsFBxZZvuk9yTIos7ehkSfp2sij_WQ-9VlS',     // ClientID
                'EPPW6Yx8eI61vVMcs8M2HPZpEW0GmDje0G7NWz-C8Og7v0lsMbYu_cY4wewZJUVRvNO4aDJPqPhlIwBZ'      // ClientSecret
            )
        );


        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);


        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(2.2)
            ->setTax(1.3)
            ->setSubtotal(17.50);

        $amount->setCurrency('USD');
        $amount->setTotal(21);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
    }


    public function pagoStripe(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 10000,
                'currency' => 'mxn',
                "description" => "Test payment"
            ));


            Charge::create([
                "amount" => 1000,
                "currency" => "mxn",
                "source" => $request->stripeToken,
                "description" => "Test payment"
            ]);
            return 'Cargo exitoso!' + $request->stripeToken;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function pagoStripeApi(Request $request)
    {
        $price = str_replace('.', '', $request->price);
        try {

            $user = User::where('id', $request->id_user)->first();
            $guia = User::where('id', $request->id_vendedor)->first();

            Stripe::setApiKey(config('services.stripe.secret'));
            $cargo = Charge::create([
                "amount" => $price,
                "currency" => $request->moneda,
                "source" => $request->stripeToken,
                "description" =>  $request->name_tour . '-' . $request->name . ' ' . $request->lastname . ' ' . $request->fecha,
            ]);

            $latestOrder = Payments::orderBy('created_at', 'DESC')->first();

            $payment = Payments::create([
                'order_nr' => str_pad($latestOrder->id + 1, 8, "0", STR_PAD_LEFT),
                'ModoPago' => 'Stripe',
                'IdPago' => $request->stripeToken,
                'DatosComprador' => 'Nombre Contacto: ' . $request->name . '' . $request->lastname . ' Email: ' . $request->email . ' Telefono: ' .  $request->telephone,
                'NameTour' => $request->name_tour,
                'Monto' => $request->price,
                'Moneda' => $request->moneda,
                'Fechareserva' => Carbon::createFromFormat('Y-m-d', $request->fecha),
                'CantidadTuristas' => $request->cantidadTurtias,
                'NumTarjeta' => $request->NumTarjeta,
                'EstadoDinero' => 'Almacenado en cuenta',
                'id_tour' => $request->id_tour,
                'id_comprador' => $request->id_user,
                'id_guia' => $request->id_vendedor
            ]);

            $payment->getComprador;
            $payment->getGuia;
            //Mail::to($user->email)->send(new ReservaClienteMail($payment));
            //Mail::to($guia->email)->send(new ReservaVendedorMail($payment));
            Mail::to('guslopezcallejas@gmail.com')->send(new ReservaClienteMail($payment));
            Mail::to('guslopezcallejas@gmail.com')->send(new ReservaVendedorMail($payment));

            return response()->json(['Cargo' => $payment], 201);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
