<?php
$this->load->view('common/header'); // Load header
?>

<div class="flex flex-col h-screen">
    <!-- Main content -->
    <main class="flex-1">
        <?php $this->load->view($main); // Load main content dynamically ?>
    </main>

    <!-- Footer -->
    <?php $this->load->view('common/footer'); // Load footer ?>
</div>
