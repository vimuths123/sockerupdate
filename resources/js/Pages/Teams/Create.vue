<template>
  <AppLayout title="Create Team">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-4">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Create New Teams</h1>
        <!-- Button to go back to Teams Page -->
        <Link
          :href="route('teams.index')"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          Back to Teams
        </Link>
      </div>

      <form @submit.prevent="submit" class="space-y-4">
        <!-- Team Name -->
        <div>
          <label for="name" class="block text-lg font-medium text-gray-600">Team Name</label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            placeholder="Enter team name"
            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <!-- Validation Error for Name -->
          <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
        </div>

        <!-- Team Logo Upload -->
        <div>
          <label for="logo" class="block text-lg font-medium text-gray-600">Team Logo</label>
          <input
            type="file"
            id="logo"
            @change="handleFileUpload"
            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <!-- Validation Error for Logo -->
          <p v-if="form.errors.logo" class="text-red-500 text-sm mt-1">{{ form.errors.logo }}</p>
        </div>

        <!-- Description -->
        <div>
          <label for="description" class="block text-lg font-medium text-gray-600">Description</label>
          <textarea
            v-model="form.description"
            id="description"
            placeholder="Provide a description of the team"
            rows="4"
            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
          <!-- Validation Error for Description -->
          <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
        </div>

        <!-- Submit Button -->
        <div>
          <button
            type="submit"
            class="w-full bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
          >
            Create Team
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    name: "",
    logo: null,
    description: "",
});

// Handle file upload for logo
const handleFileUpload = (event) => {
    form.logo = event.target.files[0];
};

// Submit the form
const submit = () => {
    form.post(route("teams.store"));
};
</script>
