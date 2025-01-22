<template>
  <AppLayout title="Edit Game">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-4">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Edit Game</h1>
        <!-- Button to go back to Games Page -->
        <Link
          :href="route('games.index')"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          Back to Games
        </Link>
      </div>

      <form @submit.prevent="submit">
        <!-- Team A Selection -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Team A</label>
          <select v-model="form.team_a_id" class="w-full p-2 border rounded" :class="{'border-red-500': form.errors.team_a_id}">
            <option value="" disabled>Select Team A</option>
            <option v-for="team in teams" :key="team.id" :value="team.id">
              {{ team.name }}
            </option>
          </select>
          <p v-if="form.errors.team_a_id" class="text-red-600 text-sm">
            {{ form.errors.team_a_id }}
          </p>
        </div>

        <!-- Team B Selection -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Team B</label>
          <select v-model="form.team_b_id" class="w-full p-2 border rounded" :class="{'border-red-500': form.errors.team_b_id}">
            <option value="" disabled>Select Team B</option>
            <option v-for="team in teams" :key="team.id" :value="team.id">
              {{ team.name }}
            </option>
          </select>
          <p v-if="form.errors.team_b_id" class="text-red-600 text-sm">
            {{ form.errors.team_b_id }}
          </p>
        </div>

        <!-- Team A Goals -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Team A Goals</label>
          <input
            v-model="form.team_a_goals"
            type="number"
            class="w-full p-2 border rounded"
            placeholder="Enter Team A goals"
            :class="{'border-red-500': form.errors.team_a_goals}"
          />
          <p v-if="form.errors.team_a_goals" class="text-red-600 text-sm">
            {{ form.errors.team_a_goals }}
          </p>
        </div>

        <!-- Team B Goals -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Team B Goals</label>
          <input
            v-model="form.team_b_goals"
            type="number"
            class="w-full p-2 border rounded"
            placeholder="Enter Team B goals"
            :class="{'border-red-500': form.errors.team_b_goals}"
          />
          <p v-if="form.errors.team_b_goals" class="text-red-600 text-sm">
            {{ form.errors.team_b_goals }}
          </p>
        </div>

        <!-- Winner Team Selection -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Winner Team</label>
          <select v-model="form.winner_team_id" class="w-full p-2 border rounded" :class="{'border-red-500': form.errors.winner_team_id}">
            <option value="" disabled>Select Winner Team</option>
            <option v-for="team in teams" :key="team.id" :value="team.id">
              {{ team.name }}
            </option>
            <option value="">No Winner</option>
          </select>
          <p v-if="form.errors.winner_team_id" class="text-red-600 text-sm">
            {{ form.errors.winner_team_id }}
          </p>
        </div>

        <!-- Location -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Location</label>
          <input
            v-model="form.location"
            type="text"
            class="w-full p-2 border rounded"
            placeholder="Enter match location"
            :class="{'border-red-500': form.errors.location}"
          />
          <p v-if="form.errors.location" class="text-red-600 text-sm">
            {{ form.errors.location }}
          </p>
        </div>

        <!-- Status -->
        <div class="mb-4">
          <label class="block text-gray-700 font-semibold mb-2">Status</label>
          <select v-model="form.status" class="w-full p-2 border rounded" :class="{'border-red-500': form.errors.status}">
            <option value="Scheduled">Scheduled</option>
            <option value="In Progress">In Progress</option>
            <option value="Finished">Finished</option>
          </select>
          <p v-if="form.errors.status" class="text-red-600 text-sm">
            {{ form.errors.status }}
          </p>
        </div>

        <div class="mt-6 flex items-center">
          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            Update Game
          </button>
          <Link
            :href="route('games.index')"
            class="ml-4 text-gray-600 hover:underline"
          >
            Cancel
          </Link>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  game: Object,
  teams: Array,
});

const form = useForm({
  team_a_id: props.game.team_a_id,
  team_b_id: props.game.team_b_id,
  team_a_goals: props.game.team_a_goals,
  team_b_goals: props.game.team_b_goals,
  winner_team_id: props.game.winner_team_id ?? '',
  location: props.game.location,
  status: props.game.status,
});

const submit = () => {
  form.put(route("games.update", props.game.id));
};
</script>
