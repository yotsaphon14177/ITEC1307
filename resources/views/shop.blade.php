
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wombat Coffee Roasters</title>
    
    <link rel="stylesheet" href="css/listing2.css">
    <link rel="stylesheet" href="css/listing3.css">
    <link rel="stylesheet" href="css/listing5.css">
    <link rel="stylesheet" href="css/listing7.css">
    <link rel="stylesheet" href="css/listing8.css">
    <link rel="stylesheet" href="css/listing9.css">
    <link rel="stylesheet" href="css/listing10.css">
</head>
<header id="header" class="page-header">
                <div class="title">
                  <h1>Wombat Coffee Roasters</h1>
                  <div class="slogan">We love coffee</div>
                </div>
        </header>
<nav class="menu" id="main-menu">
                <button class="menu-toggle" id="toggle-menu">             
                  toggle menu
                </button>
                <div class="menu-dropdown">                               
                  <ul class="nav-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Shop</a></li>
                    <li><a href="/menu">Menu</a></li>
                    <li><a href="/about">About</a></li>
                    
                  </ul>
                </div>
                </nav>
    <div class="wrapper">
        <div class="checkout container">

            <header>
                <h1>Hi, <br>Let's test a transaction</h1>
                <p>
                    Make a test payment with Braintree using PayPal or a card
                </p>
            </header>

            <form method="post" id="payment-form" action="{{ route('payment.make') }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button" type="submit"><span>Test Transaction</span></button>
            </form>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.21.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{Braintree_ClientToken::generate()}}";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
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
    <script src="Js/demo.js"></script>
</body>
</html>
