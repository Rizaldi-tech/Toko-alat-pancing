<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="YOUR_CLIENT_KEY"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%;
            max-width: 400px;
        }

        .container h1 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        .btn-pay {
            display: inline-block;
            background-color: #1abc9c;
            color: #fff;
            text-transform: uppercase;
            font-size: 1em;
            font-weight: bold;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
            outline: none;
        }

        .btn-pay:hover {
            background-color: #16a085;
            transform: translateY(-3px);
        }

        .btn-pay:active {
            background-color: #12876f;
            transform: translateY(2px);
        }

        .info {
            margin-top: 15px;
            font-size: 0.9em;
            color: #7f8c8d;
        }

        footer {
            margin-top: 20px;
            font-size: 0.8em;
            color: #bdc3c7;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Silakan Lakukan Pembayaran</h1>
        <button id="pay-button" class="btn-pay">Bayar Sekarang</button>
        <div class="info">
            <p>Pastikan informasi pembayaran sudah benar sebelum melanjutkan.</p>
        </div>
        <footer>
            &copy; 2024, Halaman Pembayaran Anda
        </footer>
    </div>

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