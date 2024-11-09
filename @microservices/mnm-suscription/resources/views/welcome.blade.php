<!DOCTYPE html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
</head>
<body>
  <script src="https://www.paypal.com/sdk/js?client-id=Ab9zjw_w3YjEdDBbx-pkCust7z8X_sLBL_1ra40L5VbOTeNPDX3_ymvgKVtz2hoFnFglc02gSsx8bhKv&vault=true&intent=subscription">
  </script> // Add your client_id
     <div id="paypal-button-container"></div>
      <script>
       paypal.Buttons({
        createSubscription: function(data, actions) {
          return actions.subscription.create({
           'plan_id': 'P-5VS965785E4395949M4WUDAA' // Creates the subscription
           });
         },
         onApprove: function(data, actions) {
           alert('You have successfully subscribed to ' + data.subscriptionID); // Optional message given to subscriber
         }
       }).render('#paypal-button-container'); // Renders the PayPal button
      </script>
  </body>
</html>