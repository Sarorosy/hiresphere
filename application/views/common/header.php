<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="<?= base_url('dashboard'); ?>" class="text-xl font-bold text-blue-600">
                <img src="<?php echo base_url('public/vector/default-monochrome-white.svg') ?>" class="w-auto h-8 md:h-12" />
            </a>

            <!-- Mobile Menu Button -->
            <div class="block lg:hidden">
                <button id="mobileMenuButton" class="text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Links (Desktop Menu) -->
            <div class="hidden lg:flex space-x-6">
                <a href="<?= base_url('jobs/post'); ?>" class="text-gray-100 hover:text-white font-medium">Post a Job</a>
                <a href="<?= base_url('created-jobs'); ?>" class="text-gray-100 hover:text-white font-medium">Created Jobs</a>
                <a href="<?= base_url('jobs/applications'); ?>" class="text-gray-100 hover:text-white font-medium">Applications</a>
            </div>

            <!-- User Dropdown (Desktop only) -->
            <div class="relative hidden lg:block">
                <button id="userDropdown" class="flex items-center space-x-2 focus:outline-none">
                <?php if ($this->session->userdata('org_image')): ?>
            <!-- Display the organization image -->
            <img src="<?= base_url( $this->session->userdata('org_image')) ?>" 
                alt="Organization Logo" 
                class="w-8 h-8 rounded-full">
        <?php else: ?>
            <!-- Display the first letter of the organization name -->
            <div class="w-8 h-8 flex items-center justify-center bg-gray-600 text-white font-bold rounded-full">
                <?= strtoupper(substr($this->session->userdata('org_name'), 0, 1)) ?: 'G'; ?>
            </div>
        <?php endif; ?>
                    <span class="text-white font-medium">
                        <?= $this->session->userdata('org_name') ?: 'Guest'; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 bg-white border rounded shadow-md hidden w-36 rounded">
                    <a href="#" id="signOut" class="block px-4 py-2 text-white hover:bg-red-600 bg-red-500 rounded">Sign Out</a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default, shown on mobile) -->
        <div id="mobileMenu" class="lg:hidden bg-blue-200 px-4 py-2 hidden">
            <a href="<?= base_url('jobs/post'); ?>" class="block py-2 text-gray-100 hover:text-white font-medium">Post a Job</a>
            <a href="<?= base_url('created-jobs'); ?>" class="block py-2 text-gray-100 hover:text-white font-medium">Created Jobs</a>
            <a href="<?= base_url('jobs/applications'); ?>" class="block py-2 text-gray-100 hover:text-white font-medium">Applications</a>
            
            <!-- User Dropdown in Mobile Menu -->
            <div class="relative">
                <button id="userDropdownMobile" class="flex items-center space-x-2 focus:outline-none w-full text-left">
                    <span class="text-white font-medium">
                        <?= $this->session->userdata('org_name') ?: 'Guest'; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dropdownMenuMobile" class="mt-2 bg-white border rounded shadow-md hidden w-full">
                    <a href="#" id="signOutMobile" class="block px-4 py-2 text-white hover:bg-red-600 bg-red-500 rounded">Sign Out</a>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Toggle dropdown visibility (Desktop)
        $('#userDropdown').on('click', function () {
            $('#dropdownMenu').toggle();
        });

        // Handle Sign Out (Desktop)
        $('#signOut').on('click', function (e) {
            e.preventDefault();
            $.post('<?= base_url("orglogin/logout"); ?>', {}, function () {
                window.location.href = '<?= base_url("org/login"); ?>';
            });
        });

        // Toggle mobile menu visibility
        $('#mobileMenuButton').on('click', function () {
            $('#mobileMenu').toggle(); // Toggle the mobile menu when the button is clicked
        });

        // Toggle user dropdown in mobile menu
        $('#userDropdownMobile').on('click', function () {
            $('#dropdownMenuMobile').toggle();
        });

        // Handle Sign Out (Mobile)
        $('#signOutMobile').on('click', function (e) {
            e.preventDefault();
            $.post('<?= base_url("orglogin/logout"); ?>', {}, function () {
                window.location.href = '<?= base_url("org/login"); ?>';
            });
        });
    </script>