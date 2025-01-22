<script setup>
import { defineProps, ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

// Define props
const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  finishedGames: Array,
  liveGames: Array,
});

// Use refs to create reactive copies of liveGames and finishedGames
const liveGames = ref([...props.liveGames]);
const finishedGames = ref([...props.finishedGames]);

onMounted(() => {
  Echo.channel("games").listen("GameUpdated", (event) => {
    const updatedGame = event.game;

    // Handle "In Progress" status
    if (updatedGame.status === "In Progress") {
      const existingLiveIndex = liveGames.value.findIndex(
        (game) => game.id === updatedGame.id
      );
      if (existingLiveIndex === -1) {
        liveGames.value.push(updatedGame); // Add to liveGames if not already present
      } else {
        liveGames.value[existingLiveIndex] = {
          ...liveGames.value[existingLiveIndex],
          ...updatedGame,
        };
      }

      // Remove from finishedGames if present
      finishedGames.value = finishedGames.value.filter(
        (game) => game.id !== updatedGame.id
      );
    }

    // Handle "Finished" status
    if (updatedGame.status === "Finished") {
      const existingFinishedIndex = finishedGames.value.findIndex(
        (game) => game.id === updatedGame.id
      );
      if (existingFinishedIndex === -1) {
        finishedGames.value.push(updatedGame); // Add to finishedGames if not already present
      } else {
        finishedGames.value[existingFinishedIndex] = updatedGame;
      }

      // Remove from liveGames if present
      liveGames.value = liveGames.value.filter(
        (game) => game.id !== updatedGame.id
      );
    }
  });
});
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <!-- Live Games Section -->
    <div v-if="liveGames.length" class="mb-8">
      <h2 class="text-2xl font-bold mb-4 text-green-600">Live Games</h2>
      <div class="space-y-4">
        <div
          v-for="game in liveGames"
          :key="game.id"
          class="p-4 bg-gray-100 rounded-lg shadow-md"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <img
                :src="`${game.team_a.logo}`"
                alt="Team A Logo"
                class="w-10 h-10 rounded-full mr-2"
              />
              <span class="text-lg font-semibold">{{ game.team_a.name }}</span>
            </div>
            <span class="text-red-500 font-bold">LIVE 🔴</span>
            <div class="flex items-center">
              <span class="text-lg font-semibold">{{ game.team_b.name }}</span>
              <img
                :src="`${game.team_b.logo}`"
                alt="Team B Logo"
                class="w-10 h-10 rounded-full ml-2"
              />
            </div>
          </div>
          <div class="text-center text-xl font-bold">
            {{ game.team_a_goals }} - {{ game.team_b_goals }}
          </div>
        </div>
      </div>
    </div>

    <!-- Finished Games Section -->
    <div v-if="finishedGames.length">
      <h2 class="text-2xl font-bold mb-4 text-gray-700">Finished Games</h2>
      <div class="space-y-4">
        <div
          v-for="game in finishedGames"
          :key="game.id"
          class="p-4 bg-gray-200 rounded-lg shadow-md"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <img
                :src="`${game.team_a.logo}`"
                alt="Team A Logo"
                class="w-10 h-10 rounded-full mr-2"
              />
              <span class="text-lg font-semibold">{{ game.team_a.name }}</span>
            </div>
            <span class="text-gray-500">Finished</span>
            <div class="flex items-center">
              <span class="text-lg font-semibold">{{ game.team_b.name }}</span>
              <img
                :src="`${game.team_b.logo}`"
                alt="Team B Logo"
                class="w-10 h-10 rounded-full ml-2"
              />
            </div>
          </div>
          <div class="text-center text-xl font-bold">
            {{ game.team_a_goals }} - {{ game.team_b_goals }}
          </div>
        </div>
      </div>
    </div>

    <!-- No Games Message -->
    <div
      v-if="!liveGames.length && !finishedGames.length"
      class="text-center text-gray-500 mt-6"
    >
      No games available.
    </div>
  </div>
</template>
