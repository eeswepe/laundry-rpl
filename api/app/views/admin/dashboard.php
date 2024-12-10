<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet" />
    
</head>
<body class="bg-gray-100 p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <a href="/laundry-app/admin/logout" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
    </div>

    <!-- Form Filter dan Pencarian -->
    <div class="mb-4 flex justify-between">
        <div class="sm:flex sm:flex-row flex-col sm:space-x-2 space-y-2 sm:space-y-0">
            <form action="/laundry-app/admin/dashboard" method="GET" class="sm:w-1/2 w-full flex flex-col sm:flex-row sm:space-x-2">
                <select name="status" class="border rounded p-2 w-full sm:w-auto">
                    <option value="">Semua Status</option>
                    <option value="Not Processed">Belum Diproses</option>
                    <option value="In Progress">Diproses</option>
                    <option value="Finished">Selesai</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 sm:w-auto mt-2 sm:mt-0">Filter</button>
            </form>
            <form action="/laundry-app/admin/dashboard" method="GET" class="sm:w-1/2 w-full flex flex-col sm:flex-row sm:space-x-2 mt-2 sm:mt-0">
                <input type="text" name="search_id" placeholder="Cari berdasarkan ID" class="border rounded p-2 w-full sm:w-auto" required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 sm:w-auto mt-2 sm:mt-0">Cari</button>
            </form>
        </div>
    </div>


    <div class="flex space-x-2 mb-2">
        <div class="bg-white shadow-md rounded-md p-1 flex-1 text-sm">
            <h3 class="font-semibold mb-1">Belum diproses</h3>
            <p class="font-bold"><?php echo $notProcessedLaundryCount; ?></p>
        </div>
        <div class="bg-white shadow-md rounded-md p-1 flex-1 text-sm">
            <h3 class="font-semibold mb-1">Diproses</h3>
            <p class="font-bold"><?php echo $inProgressLaundryCount; ?></p>
        </div>
        <div class="bg-white shadow-md rounded-md p-1 flex-1 text-sm">
            <h3 class="font-semibold mb-1">Selesai</h3>
            <p class="font-bold"><?php echo $finishedLaundryCount; ?></p>
        </div>
        <div class="bg-white shadow-md rounded-md p-1 flex-1 text-sm">
            <h3 class="font-semibold mb-1">Belum dibayar</h3>
            <p class="font-bold"><?php echo $unpaidLaundryCount; ?></p>
        </div>
    </div>

    <div class="m-5">
        <a href="/laundry-app/add" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Laundry</a>
    </div>
    
    <h2 class="text-xl font-semibold mb-4">Daftar Laundry</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($laundries)): ?>
            <?php foreach ($laundries as $laundry): ?>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="font-bold text-lg"><?php echo htmlspecialchars($laundry['nama']); ?></h3>
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($laundry['id']); ?></p>
                    <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($laundry['nomor_hp']); ?></p>
                    <p><strong>Alamat:</strong> <?php echo htmlspecialchars($laundry['alamat']); ?></p>
                    <p><strong>Jenis:</strong> <?php echo htmlspecialchars($laundry['jenis']); ?></p>
                    <p><strong>Paket:</strong> <?php echo htmlspecialchars($laundry['paket']); ?></p>
                    <p><strong>Layanan:</strong> <?php echo htmlspecialchars($laundry['layanan']); ?></p>
                    <p><strong>Rincian Pesanan:</strong> <?php echo htmlspecialchars($laundry['rincian_pesanan']); ?></p>
                    <p><strong>Metode Pembayaran:</strong> <?php echo htmlspecialchars($laundry['metode_pembayaran']); ?></p>
                    <p><strong>Tanggal Pemesanan:</strong> <?php echo htmlspecialchars(date('d-m-Y', strtotime($laundry['order_date']))); ?></p>
                    <p><strong>Selesai:</strong> <?php echo htmlspecialchars($laundry['status']); ?></p>
                    <p><strong>Dibayar:</strong> <?php echo htmlspecialchars($laundry['is_paid'] ? 'Sudah Dibayar' : 'Belum Dibayar'); ?></p>
                    <p><strong>Biaya:</strong> Rp.<?php echo htmlspecialchars($laundry['biaya']); ?></p>
                    <p><strong>Pengantaran:</strong> <?php echo htmlspecialchars($laundry['pengantaran']); ?></p>
                    <div class="mt-4 flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0">
                        <a href="/laundry-app/admin/mark-in-progress&id=<?php echo $laundry['id']; ?>" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-center w-full sm:w-auto">Tandai Diproses</a>
                        <a href="/laundry-app/admin/mark-finished&id=<?php echo $laundry['id']; ?>" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-center w-full sm:w-auto">Tandai Selesai</a>
                        <a href="/laundry-app/admin/mark-paid&id=<?php echo $laundry['id']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-center w-full sm:w-auto">Tandai Dibayar</a>
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0 flex-1">
                        <a href="/laundry-app/admin/delete&id=<?php echo $laundry['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-center w-full sm:w-auto"><i class="fas fa-trash-alt mr-1"></i>Hapus</a>
                        <a href="https://wa.me/<?php echo $laundry['nomor_hp']; ?>" target="_blank" rel="noopener noreferrer" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 text-center w-full sm:w-auto"><i class="fab fa-whatsapp mr-1"></i>Hubungi</a>
                    </div>
                    <form action="/laundry-app/admin/update-biaya" method="GET" class="mt-4">
                        <input type="hidden" name="id" value="<?php echo $laundry['id']; ?>">
                        <div class="flex space-x-2">
                            <input type="number" name="biaya" placeholder="Biaya laundry" class="border rounded p-2 w-1/2" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" style="-webkit-appearance: none; -moz-appearance: textfield;">
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Update Biaya</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white shadow-md rounded-lg p-4">
                <p class="text-center">Tidak ada data laundry.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="mt-6">
        <h3 class="text-lg font-semibold">Halaman:</h3>
        <div class="flex space-x-2">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="/laundry-app/admin/dashboard&page=<?php echo $i; ?>" class="text-blue-500 hover:underline"><?php echo $i; ?></a>
                <?php if ($i < $totalPages): ?>
                    <span>|</span>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
