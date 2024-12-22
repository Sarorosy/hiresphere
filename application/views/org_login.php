<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireSphere - Organization Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <div class="w-full flex items-center justify-center rounded my-2">
        <img src="<?php echo base_url('public/vector/default-monochrome-black.svg') ?>" class="h-12 w-auto my-1 rounded" />
        </div>
        <hr/>
        <h2 class="text-2xl font-bold text-center text-blue-900 mt-1">Organization Login</h2>
        
        <form action="<?= base_url('OrgLogin/login') ?>" method="POST" class="mt-4">
            <?php if ($this->session->flashdata('error')): ?>
                <div class="text-red-500 bg-red-100 rounded px-1 py-2 text-center  text-sm"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
        </form>
        <p class="text-sm text-center text-gray-600 mt-4">Don't have an account? <a href="<?= base_url('OrgLogin/register') ?>" class="text-blue-500 hover:underline">Register</a></p>
    </div>
</body>
</html>
