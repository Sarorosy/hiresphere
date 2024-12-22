<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">Edit Job</h1>

    <!-- Edit Job Form -->
    <div class="bg-white rounded shadow-md p-6">
        <form action="<?= base_url('jobs/update/' . base64_encode($job->id)) ?>" method="POST">
            <!-- Job Title -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium">Job Title</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($job->title) ?>" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2" required>
            </div>

            <!-- Job Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Job Description</label>
                <div id="quill-editor" class="mt-1 block w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></div>
                <textarea id="description" name="description" class="hidden"><?= htmlspecialchars($job->description) ?></textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-gray-700 font-medium">Location</label>
                <input type="text" id="location" name="location" value="<?= htmlspecialchars($job->location) ?>" class="mt-1 block border w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2" required>
            </div>

            <!-- Experience -->
            <div class="mb-4">
                <label for="experience" class="block text-gray-700 font-medium">Experience (in years)</label>
                <input type="number" id="experience" name="experience" value="<?= htmlspecialchars($job->experience) ?>" class="mt-1 border block w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2" required>
                <small class="text-gray-500">e.g. 2, 5, 10 (number of years)</small>
            </div>

            <!-- Salary -->
            <div class="mb-4">
                <label for="salary" class="block text-gray-700 font-medium">Salary</label>
                <input type="text" id="salary" name="salary" value="<?= htmlspecialchars($job->salary) ?>" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2" required>
                <small class="text-gray-500">e.g. 50,000, 75,000 (currency format)</small>
            </div>

            <!-- Skills -->
            <div class="mb-4">
                <label for="skills" class="block text-gray-700 font-medium">Required Skills</label>
                <input type="text" id="skills" name="skills" value="<?= htmlspecialchars($job->skills) ?>" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2" required>
                <small class="text-gray-500">e.g. Node, TypeScript (comma separated)</small>
            </div>

            <!-- Job Type -->
            <div class="mb-4">
                <label for="job_type" class="block text-gray-700 font-medium">Job Type</label>
                <select id="job_type" name="job_type" class="mt-1 block w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2">
                    <option value="Full-time" <?= $job->job_type == 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                    <option value="Part-time" <?= $job->job_type == 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                    <option value="Freelance" <?= $job->job_type == 'Freelance' ? 'selected' : '' ?>>Freelance</option>
                </select>
                <small class="text-gray-500">Choose the type of employment.</small>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none">Update Job</button>
                <a href="<?= base_url('jobs') ?>" class="text-blue-600 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>
</div>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Describe the role and responsibilities of the position.',
    });

    // Initialize with job description content
    quill.root.innerHTML = <?= json_encode($job->description) ?>;

    // Sync Quill content to hidden textarea on form submission
    document.querySelector('form').onsubmit = function() {
        document.querySelector('#description').value = quill.root.innerHTML;
    };
</script>
<style>
    .ql-editor{
        height:200px;
    }
</style>