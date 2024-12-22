<div class="max-w-3xl mx-auto mt-8 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Organization Profile</h1>

    <!-- Success and Error Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    <div>
    <?php if (!empty($organization->profile_pic) && file_exists(FCPATH . $organization->profile_pic)): ?>
        <div class="mb-4">
            <img src="<?= base_url($organization->profile_pic); ?>" alt="Profile Picture" class="w-32 h-32 object-cover rounded-full shadow-md">
        </div>
    <?php else: ?>
        <div class="mb-4 w-32 h-32 flex items-center justify-center rounded-full bg-gray-600 text-white text-2xl font-bold shadow-md">
            <?= strtoupper(substr($organization->name, 0, 1)); ?>
        </div>
    <?php endif; ?>
</div>


    <form method="post" action="<?= base_url('Dashboard/update_profile'); ?>" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" id="name" value="<?= $organization->name; ?>" readonly class="editable w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="email" value="<?= $organization->email; ?>" readonly class="editable w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
        </div>

        <div class="mb-4">
            <label for="contact_number" class="block text-gray-700 font-medium mb-2">Contact Number</label>
            <input type="text" id="contact_number" value="<?= $organization->contact_number; ?>" readonly class="editable w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
            <textarea id="address" rows="3" readonly class="editable w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 focus:outline-none"><?= $organization->address; ?></textarea>
        </div>

        <div class="mb-6">
            <label for="profile_pic" class="block text-gray-700 font-medium mb-2">Profile Picture</label>
            <input type="file" id="profile_pic" name="profile_pic" readonly class="editable w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 focus:outline-none">
        </div>

        <div class="flex space-x-4">
            <button type="button" id="edit-btn" class="w-full py-3 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">
                Edit
            </button>
            <button type="button" id="cancel-btn" class="w-full py-3 bg-red-500 text-white font-medium rounded-lg shadow-md hover:bg-red-600 focus:outline-none hidden">
                Cancel
            </button>
            <button type="submit" id="submit-btn" class="w-full py-3 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 focus:outline-none hidden">
                Save
            </button>
        </div>
    </form>
</div>

<script>
    const editBtn = document.getElementById('edit-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const submitBtn = document.getElementById('submit-btn');
    const editableFields = document.querySelectorAll('.editable');

    editBtn.addEventListener('click', () => {
        editableFields.forEach(field => {
            field.removeAttribute('readonly');
            field.classList.remove('bg-gray-100', 'text-gray-600');
        });
        editBtn.classList.add('hidden');
        cancelBtn.classList.remove('hidden');
        submitBtn.classList.remove('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        editableFields.forEach(field => {
            field.setAttribute('readonly', true);
            field.classList.add('bg-gray-100', 'text-gray-600');
        });
        editBtn.classList.remove('hidden');
        cancelBtn.classList.add('hidden');
        submitBtn.classList.add('hidden');
    });
</script>
