var stripe = Stripe('pk_test_XeKhLaxXckcBJYYgCWEeBrKx');
var elements = stripe.elements();

var card = elements.create('card', {
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
card.mount('#card-element');

var $form = document.getElementById('checkout-form');

$form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('#card-errors');
      errorElement.textContent = result.error.message;
    } else {
  var $hiddenInput = document.createElement('input');
  $hiddenInput.setAttribute('type', 'hidden');
  $hiddenInput.setAttribute('name', 'stripeToken');
  $hiddenInput.setAttribute('value', result.token.id);
  $form.appendChild($hiddenInput);

  // Submit the form
  $form.submit();
    }
  });
});

function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  
}