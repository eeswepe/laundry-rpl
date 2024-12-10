<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <style>
        @media (max-width: 768px) {
            .hidden-mobile {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-5">
    <h1 class="text-3xl font-bold mb-4">Laundry List</h1>
    <h2 class="text-xl mb-4">Daftar Laundry</h2>
    
    <form action="/laundry-app/list" method="GET" class="mb-4 flex sm:flex-row flex-col sm:space-x-2 space-y-2 sm:space-y-0">
        <input type="text" name="search_id" placeholder="Cari berdasarkan ID" class="border rounded p-1 sm:p-2 sm:w-auto w-full" required>
        <button type="submit" class="bg-blue-500 text-white px-2 sm:px-4 py-1 sm:py-2 rounded hover:bg-blue-600">Cari</button>
    </form>
    
    <table class="min-w-full bg-white border border-gray-200 text-sm">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="py-1 px-2">ID</th>
                <th class="py-1 px-2">Nama</th>
                <th class="py-1 px-2 hidden-mobile">Layanan</th>
                <th class="py-1 px-2 hidden-mobile">Metode Pembayaran</th>
                <th class="py-1 px-2">Status</th>
                <th class="py-1 px-2 hidden-mobile">Dibayar</th>
                <th class="py-1 px-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($laundries)): ?>
                <?php foreach ($laundries as $laundry): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-1 px-2 border-r text-center"><?php echo htmlspecialchars($laundry['id']); ?></td>
                        <td class="py-1 px-2 border-r text-center"><?php echo htmlspecialchars($laundry['nama']); ?></td>
                        <td class="py-1 px-2 border-r hidden-mobile text-center"><?php echo htmlspecialchars($laundry['layanan']); ?></td>
                        <td class="py-1 px-2 border-r hidden-mobile text-center"><?php echo htmlspecialchars($laundry['metode_pembayaran']); ?></td>
                        <td class="py-1 px-2 border-r text-center"><?php echo htmlspecialchars($laundry['status']); ?></td>
                        <td class="py-1 px-2 hidden-mobile text-center"><?php echo htmlspecialchars($laundry['is_paid'] ? 'Sudah Dibayar' : 'Belum Dibayar'); ?></td>
                        <td class="py-1 px-2 text-center">
                            <button type="button" onclick="showPopup(<?php echo htmlspecialchars(json_encode($laundry)); ?>)" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Detail Pembayaran</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-1">Tidak ada data laundry.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="mt-4">
        <h3 class="text-lg">Halaman:</h3>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/laundry-app/admin/dashboard&page=<?php echo $i; ?>" class="text-blue-500 hover:underline"><?php echo $i; ?></a>
            <?php if ($i < $totalPages): ?>
                <span class="mx-2">|</span>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    
    <script>
        function showPopup(laundry) {
            Swal.fire({
                title: 'Detail Pembayaran',
                html: '<p>Metode Pembayaran: ' + laundry.metode_pembayaran + '</p>' +
                    '<p>Dibayar: ' + (laundry.is_paid ? 'Sudah Dibayar' : 'Belum Dibayar') + '</p>' +
                    '<p>Biaya: ' + (laundry.biaya > 0 ? 'Rp. ' + laundry.biaya : 'Belum di update') + '</p>' +
                    '<img src="./qrcodes/qris_' + laundry.id + '.png" alt="QRIS" class="w-full my-4" />' +
                    '<p class="text-center">' + (laundry.biaya > 0 ? '* Scan QRIS di atas untuk membayar, lalu kirimkan hasil Screenshoot pembayaran untuk konfirmasi' : 'Tunggu admin menghitung biaya') + '</p>',
                    showCancelButton: true,
                confirmButtonText: 'Konfirmasi Pembayaran <i class="fas fa-arrow-right"></i>',
                cancelButtonText: 'Kembali',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    if (laundry.biaya <= 0) {
                        return false;
                    }
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve();
                        }, 1000);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading(),
                confirmButtonColor: laundry.biaya > 0 ? '#3085d6' : '#808080',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('https://wa.me/6289682388596?text=Saya+ingin+mengkonfirmasi+pembayaran+pesanan+atas+nama+' + encodeURIComponent(laundry.nama) + '+dengan+id+' + laundry.id, '_blank');
                }
            });
        }
    </script>
</body>
</html>

