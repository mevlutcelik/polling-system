<?php
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
?>
<div id="fingerprint"></div>
<script>
  // Initialize the agent at application startup.
  const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
    .then(FingerprintJS => FingerprintJS.load())

  // Get the visitor identifier when you need it.
  fpPromise
    .then(fp => fp.get())
    .then(result => {
      // This is the visitor identifier:
      const visitorId = result.visitorId
      document.querySelector('#fingerprint').innerHTML = visitorId;
    })
    .catch(error => console.error(error))
</script>