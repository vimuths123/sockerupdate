<script setup>
import { defineProps } from "vue";
import { router, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  games: Object,
});

// Handle pagination change
const goToPage = (url) => {
  if (url) {
    router.visit(url);
  }
};

// Delete game function
const deleteGame = (gameId) => {
  if (confirm("Are you sure you want to delete this game?")) {
    router.delete(route("games.destroy", gameId), {
      onSuccess: () => {
        router.visit(route("games.index"));
      },
    });
  }
};
</script>

<template>
  <AppLayout title="Games">
    <div class="p-5">
      <!-- Header with Title & Create Button -->
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Games</h1>
        <Link
          href="/games/create"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          + Create Game
        </Link>
      </div>

      <!-- Games Table -->
      <div v-if="props.games.data.length > 0">
        <table class="w-full border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-200">
              <th class="border px-4 py-2">Team A</th>
              <th class="border px-4 py-2">Team B</th>
              <th class="border px-4 py-2">Team A Goals</th>
              <th class="border px-4 py-2">Team B Goals</th>
              <th class="border px-4 py-2">Winner Team</th>
              <th class="border px-4 py-2">Location</th>
              <th class="border px-4 py-2">Status</th>
              <th class="border px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="game in props.games.data" :key="game.id">
              <td class="border px-4 py-2">{{ game.team_a?.name }}</td>
              <td class="border px-4 py-2">{{ game.team_b?.name }}</td>
              <td class="border px-4 py-2">{{ game.team_a_goals }}</td>
              <td class="border px-4 py-2">{{ game.team_b_goals }}</td>
              <td class="border px-4 py-2">
                {{ game.winner_team?.name || 'No winner yet' }}
              </td>
              <td class="border px-4 py-2">{{ game.location }}</td>
              <td class="border px-4 py-2">{{ game.status }}</td>
              <td class="border px-4 py-2 flex space-x-2">
                <!-- Edit Button -->
                <Link
                  :href="`/games/${game.id}/edit`"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                  Edit
                </Link>
                <!-- Delete Button -->
                <button
                  @click="deleteGame(game.id)"
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
            v-for="link in props.games.links"
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
      <div v-else class="text-center text-gray-600">No games available.</div>
    </div>
  </AppLayout>
</template>
