<div class="container mx-auto p-6 bg-white shadow-md rounded-lg max-w-4xl my-3">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Post a Job</h1>

    <!-- Display success message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Display validation errors -->
    <?php echo validation_errors('<div class="bg-red-500 text-white p-3 rounded mb-4">', '</div>'); ?>

    <!-- Job Posting Form -->
    <form action="<?= base_url('jobs/post_job'); ?>" method="POST" class="space-y-6">
        
        <!-- Job Title -->
        <div>
            <label for="title" class="block text-lg font-semibold text-gray-700">Job Title</label>
            <input type="text" id="title" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <small class="text-gray-500">e.g. Software Engineer, Data Analyst</small>
        </div>

        <!-- Job Description -->
        <div>
    <label for="description" class="block text-lg font-semibold text-gray-700">Job Description</label>
    <div id="quill-editor" class="w-full h-40 border border-gray-300 rounded-lg"></div>
    <input type="hidden" id="description" name="description">
    <small class="text-gray-500">Describe the role and responsibilities of the position.</small>
</div>

        <!-- Location -->
        <div>
            <label for="location" class="block text-lg font-semibold text-gray-700">Location</label>
            <input type="text" id="location" name="location" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <small class="text-gray-500">e.g. New York, Remote</small>
        </div>

        <!-- Experience -->
        <div>
            <label for="experience" class="block text-lg font-semibold text-gray-700">Experience (in years)</label>
            <input type="number" id="experience" name="experience" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <small class="text-gray-500">e.g. 2, 5, 10 (number of years)</small>
        </div>

        <!-- Salary -->
        <div>
            <label for="salary" class="block text-lg font-semibold text-gray-700">Salary</label>
            <input type="text" id="salary" name="salary" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <small class="text-gray-500">e.g. 50,000, 75,000 (currency format)</small>
        </div>

        <!-- Skills -->
        <div>
            <label for="skills" class="block text-lg font-semibold text-gray-700">Required Skills</label>
            <input type="text" id="skills" name="skills" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <small class="text-gray-500">e.g. Node, TypeScript (comma separated)</small>
        </div>

        <!-- Job Type -->
        <div>
            <label for="job_type" class="block text-lg font-semibold text-gray-700">Job Type</label>
            <select id="job_type" name="job_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Freelance">Freelance</option>
            </select>
            <small class="text-gray-500">Choose the type of employment.</small>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg font-semibold transition duration-300">
                Post Job
            </button>
        </div>
    </form>

    <div class="bg-yellow-100 p-4 mt-6 rounded-lg">
        <p class="text-lg font-semibold text-gray-700">Note:</p>
        <p class="text-gray-600">To post a job, you are required to pay INR 99. After the payment, the job will be visible to others and you will be redirected to the payment page to complete the transaction.</p>
    </div>
</div>
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Quill editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Write the job description here...',
        });

        // Synchronize Quill content to hidden input
        var form = document.querySelector('form');
        var descriptionInput = document.querySelector('#description');

        form.addEventListener('submit', function () {
            descriptionInput.value = quill.root.innerHTML;
        });
    });
</script>
<style>
    .ql-editor{
        height:200px;
    }
</style>