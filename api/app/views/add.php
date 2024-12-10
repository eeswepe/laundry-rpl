<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
    <style>
        /* Custom styles for a more appealing design */
        body {
            background: linear-gradient(to right, #e0f7fa, #bbdefb);
        }
        .form-container {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }
        .input, .select, .textarea {
            transition: border-color 0.3s ease;
        }
        .input:focus, .select:focus, .textarea:focus {
            border-color: #3b82f6; /* Tailwind's blue-500 */
            box-shadow: 0 0 0 1px rgba(59, 130, 246, 0.5);
        }
        .btn-blue {
            background-color: #3b82f6; /* Tailwind's blue-500 */
            transition: background-color 0.3s ease;
        }
        .btn-blue:hover {
            background-color: #2563eb; /* Tailwind's blue-600 */
        }
    </style>
</head>
<body class="p-5">
    <div class="container mx-auto form-container p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Form Pemesanan Laundry</h1>

        <form method="POST" action="add">
            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="label text-blue-500">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required class="input input-bordered input-blue w-full" />
            </div>

            <!-- No HP -->
            <div class="mb-4">
                <label for="nomor_hp" class="label text-blue-500">No HP</label>
                <input type="text" id="nomor_hp" name="nomor_hp" placeholder="Masukkan No HP" required class="input input-bordered input-blue w-full" />
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="label text-blue-500">Alamat</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" required class="input input-bordered input-blue w-full" />
            </div>

            <!-- Pilih Jenis -->
            <div class="mb-4">
                <label class="label text-blue-500">Pilih Jenis</label>
                <select name="jenis" required class="select select-bordered select-blue w-full">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Pakaian">Pakaian</option>
                    <option value="Bed cover besar">Bed Cover Besar</option>
                    <option value="Bed cover kecil">Bed Cover Kecil</option>
                    <option value="Selimut/sprei">Selimut/Sprei</option>
                </select>
            </div>

            <!-- Pilihan Paket -->
            <div class="mb-4">
                <label class="label text-blue-500">Pilihan Paket</label>
                <select name="paket" required class="select select-bordered select-blue w-full">
                    <option value="">-- Pilih Paket --</option>
                    <option value="Cuci Kering Setrika">Cuci Kering Setrika</option>
                    <option value="Cuci Kering">Cuci Kering</option>
                    <option value="Setrika + Wangi">Setrika + Wangi</option>
                </select>
            </div>

            <!-- Pilih Layanan -->
            <div class="mb-4">
                <label class="label text-blue-500">Pilih Layanan</label>
                <select name="layanan" required class="select select-bordered select-blue w-full">
                    <option value="">-- Pilih Layanan --</option>
                    <option value="Reguler 3 Hari">Reguler 3 Hari</option>
                    <option value="Express Same Day 1 Hari">Express Same Day 1 Hari</option>
                    <option value="Express 6-8 Jam">Express 6-8 Jam</option>
                </select>
            </div>

            <!-- Rincian Pesanan -->
            <div class="mb-4">
                <label for="rincian_pesanan" class="label text-blue-500">Rincian Pesanan</label>
                <textarea id="rincian_pesanan" name="rincian_pesanan" placeholder="Masukkan Rincian Pesanan" required class="textarea textarea-bordered textarea-blue w-full"></textarea>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label class="label text-blue-500">Metode Pembayaran</label>
                <select name="metode_pembayaran" required class="select select-bordered select-blue w-full">
                    <option value="">-- Pilih Metode Pembayaran --</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </div>

            <!-- Pengantaran -->
            <div class="mb-4">
                <label class="label text-blue-500">Pengantaran</label>
                <select name="pengantaran" required class="select select-bordered select-blue w-full">
                    <option value="">-- Pilih Pengantaran --</option>
                    <option value="Diantar Sendiri">Diantar Sendiri</option>
                    <option value="Antar Jemput">Antar Jemput</option>
                </select>
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-blue w-full">Kirim Pesanan</button>
            </div>
        </form>
    </div>
</body>
</html>