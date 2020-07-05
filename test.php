<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script>
<script>
var options = {fonts: {extendedJsFonts: true}, excludes: {userAgent: true}}
if (window.requestIdleCallback) {
    requestIdleCallback(function () {
        Fingerprint2.get(options, function (components) {
          console.log(components) // an array of components: {key: ..., value: ...}
        })
    })
} else {
    setTimeout(function () {
        Fingerprint2.get(options, function (components) {
          console.log(components) // an array of components: {key: ..., value: ...}
        })
    }, 500)
}
</script>