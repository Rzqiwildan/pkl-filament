<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        <style>@page {
            margin: 0;
            size: landscape;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            height: 100%;
            padding: 30px;
            border: 15px solid #1B86B7;
            box-sizing: border-box;
        }

        .text-center {
            text-align: center;
        }

        .logo {
            width: 100px;
            margin: 0 auto 20px;
        }

        .title {
            color: #1B86B7;
            font-size: 40px;
            margin: 0 0 5px 0;
        }

        .subtitle {
            font-size: 20px;
            color: #333;
            margin: 0 0 20px 0;
        }

        .content {
            margin-bottom: 20px;
        }

        .name {
            font-size: 30px;
            color: #333;
            margin: 10px 0;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding: 0 80px;
        }

        .signature {
            text-align: center;
        }

        .signature-line {
            width: 180px;
            border-bottom: 1px solid black;
            margin: 30px auto 5px;
        }

        p {
            margin: 5px 0;
        }

        h3 {
            margin: 10px 0;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <!-- Logo -->
        <div class="text-center">
            <img src="https://sso.undip.ac.id/assets/app/images/logo-undip-mail.png" alt="Logo" class="logo">
        </div>

        <!-- Title -->
        <div class="text-center">
            <h1 class="title">SERTIFIKAT</h1>
            <h2 class="subtitle">PELATIHAN ONLINE</h2>
        </div>

        <!-- Content -->
        <div class="text-center content">
            <p>Diberikan kepada:</p>
            <h2 class="name">{{ $quizAttempt->user->name }}</h2>
            <p>Atas keberhasilan menyelesaikan pelatihan</p>
            <h3>{{ $quizAttempt->quiz->bagianPelatihan->pelatihan->name }}</h3>
        </div>

        <!-- Date -->
        <div class="text-center">
            <p>Diberikan pada tanggal
                {{ \Carbon\Carbon::parse($quizAttempt->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</p>
        </div>

        <!-- Signatures -->
        <div class="signature-container">
            <div class="signature">
                <div class="signature-line"></div>
                <p><strong>Kepala Pelatihan</strong></p>
                <p>Nama Kepala</p>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <p><strong>Instruktur</strong></p>
                <p>Nama Instruktur</p>
            </div>
        </div>
    </div>
</body>

</html>
