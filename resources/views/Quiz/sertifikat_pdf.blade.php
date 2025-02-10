<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .content {
            text-align: center;
            padding: 50px;
        }
        .title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .name {
            font-size: 28px;
            margin: 20px 0;
        }
        .date {
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="title">Sertifikat Pelatihan</div>
        <div class="name">{{ $user->name }}</div>
        <div class="description">
            Telah berhasil menyelesaikan pelatihan <strong>{{ $pelatihan->nama }}</strong>.
        </div>
        <div class="date">
            Tanggal: {{ now()->format('d M Y') }}
        </div>
    </div>
</body>
</html>
