@extends('layouts.app')


@section('content')
<div class="container py-5">
    <h1>Sponsorizza il tuo profilo</h1>
    <form method="post" id="payment-form" action="{{ route('admin.paymentcheckout', [Auth::user()->id] )}}">
        @csrf
        <section>
            <p class="py-2">Seleziona un tipo di sponsorizzazione</p>
{{--             <select name="sponsorship_id" id="sponsorship_id">
                <option> Seleziona una sponsorizazione</option> --}}
            </select>
            <label for="amount">
                {{-- <span class="input-label">Amount</span> --}}
                
                @error('amount')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </label>
            
            @foreach ($sponsorship as $element)
                {{-- <option value="{{ $element->id }}">{{$element->length}} - {{$element->price}} </option> --}}
                <div class="first hero">
                    <div class="hero-description-bk"></div>
                    <div class="hero-description">
                        <p>Compra la seguente sponsorizazione! Otterrai {{$element->length}} ore di profilo boostato</p>
                    </div>
                    <div  class="hero-date">
                        <p><h3>Prezzo</h3>{{$element->price}}</p>
                    <input id="sponsorship_id" value="{{$element->id}}" name="sponsorship_id" type="radio">
                    </div>
                </div>
                  
            @endforeach

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>
</div>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

<script>
var form = document.querySelector('#payment-form');
var client_token = "{{ $token }}";

braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
}, function(createErr, instance) {
    if (createErr) {
        console.log('Create Error', createErr);
        return;
    }
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        instance.requestPaymentMethod(function(err, payload) {
            if (err) {
                console.log('Request Payment Method Error', err);
                return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();
        });
    });
});
</script>
@endsection
