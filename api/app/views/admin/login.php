<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.0/dist/full.css" rel="stylesheet">
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-4">Admin Login</h1>
        <form method="POST" action="/laundry-app/public/index.php?url=admin/authenticate" class="space-y-4">
            <input type="text" name="username" placeholder="Username" required class="input input-bordered w-full">
            <input type="password" name="password" placeholder="Password" required class="input input-bordered w-full">
            <button type="submit" class="btn btn-blue w-full">Login</button>
        </form>
        <?php if (isset($error)) echo "<p class='text-red-500 mt-4'>$error</p>"; ?>
    </div>
</body>
</html>
