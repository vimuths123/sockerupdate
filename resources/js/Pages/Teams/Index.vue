<script setup>
import { defineProps } from "vue";
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  teams: Object,
});

// Handle pagination change
const goToPage = (url) => {
  if (url) {
    router.visit(url);
  }
};

const deleteTeam = (teamId) => {
  if (confirm("Are you sure you want to delete this team?")) {
    router.delete(route("teams.destroy", teamId), {
      onSuccess: () => {
        router.visit(route("teams.index"));
      },
    });
  }
};
</script>


<template>
  <AppLayout title="Teams">
    <div class="p-5">
      <!-- Header with Title & Create Button -->
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Teams</h1>
        <Link
          href="/teams/create"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          + Create Team
        </Link>
      </div>

      <!-- Teams Table -->
      <div v-if="props.teams.data.length > 0">
        <table class="w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-200">
              <!-- <th class="border px-4 py-2">ID</th> -->
              <th class="border px-4 py-2">Name</th>
              <th class="border px-4 py-2">Logo</th>
              <th class="border px-4 py-2">Actions</th>
              <!-- Added Actions column -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="team in props.teams.data" :key="team.id">
              <!-- <td class="border px-4 py-2">{{ team.id }}</td> -->
              <td class="border px-4 py-2">{{ team.name }}</td>
              <td class="border px-4 py-2">
                <img
                  :src="team.logo"
                  alt="Logo"
                  class="h-10 w-10 object-cover"
                  v-if="team.logo"
                />
                <span v-else>No Logo</span>
              </td>
              <td class="border px-4 py-2 flex space-x-2">
                <!-- Update Button -->
                <Link
                  :href="`/teams/${team.id}/edit`"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                  Edit
                </Link>

                <button
                  @click="deleteTeam(team.id)"
                  class="ml-4 bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 px-4 py-2 rounded"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2">
          <button
            v-for="link in props.teams.links"
            :key="link.label"
            @click="goToPage(link.url)"
            :disabled="!link.url"
            v-html="link.label"
            class="px-4 py-2 border rounded"
            :class="{
              'bg-gray-300 text-gray-700': !link.url,
              'bg-blue-500 text-white': link.active,
              'bg-white text-blue-500': link.url && !link.active,
            }"
          ></button>
        </div>
      </div>
      <div v-else class="text-center text-gray-600">No teams available.</div>
    </div>
  </AppLayout>
</template>
