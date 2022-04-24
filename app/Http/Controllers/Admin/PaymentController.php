<?php

namespace App\Http\Controllers\Admin;

use DateInterval;
use DateTime;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(User $user)
    {

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        $sponsorship = Sponsorship::all();

        return view('admin.sponsorship.index', [
            'token' => $token,
            'user' => $user,
            'sponsorship' => $sponsorship

        ]);
    }

    public function checkout(Request $request, User $user)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
/*         $userInfo = Auth::user();
 */ 
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $user['name'],
                'lastName' => $user['surname'],
/*                 'email' => $user['email'], */
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $request->validate( [
            'sponsorship_id' => 'required|integer|exists:sponsorships,id',
        ]);

        $data = $request->all();

        
        $nuovaSponsorship = new Sponsorship();
        $sponsorshipLength = intval(Sponsorship::where('id', $data['sponsorship_id'])->pluck('length')->first()); // pluck restituisce il solo valore e non anche la chiave! la first va usata perché è [value]
        $start = new DateTime();
        $expiration = clone $start;
        $expiration->add(new DateInterval('PT'.$sponsorshipLength.'H'));

        $user->sponsorships()->attach($data['sponsorship_id'], array('start_date'=>$start,'expiration'=>$expiration));

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            return back()->with('success_message', 'Transaction successful');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: ' . $result->message);
        }


    }

}