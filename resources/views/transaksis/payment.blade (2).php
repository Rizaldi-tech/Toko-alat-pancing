<!DOCTYPE html>
<html>
<head>
    <title>Halaman Pembayaran</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="YOUR_CLIENT_KEY"></script>
</head>
<body>
    <h1>Silakan lakukan pembayaran</h1>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        let payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    alert('Pembayaran berhasil');
                    console.log(result);
                    window.location.href = "/transaksis"; // Redirect setelah sukses
                },
                onPending: function (result) {
                    alert('Menunggu pembayaran');
                    console.log(result);
                },
                onError: function (result) {
                    alert('Pembayaran gagal');
                    console.log(result);
                },
                onClose: function () {
                    alert('Anda belum menyelesaikan pembayaran');
                }
            });
        });
    </script>
</body>
</html>
