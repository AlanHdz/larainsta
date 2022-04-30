<template>
  <div class="flex items-center justify-between mt-10 ml-10">
    <div class="avatar">
      <div class="rounded-full w-14 h-14">
        <img
          v-if="currentUser.image"
          class="rounded-full border border-gray-100 shadow-sm"
          :src="currentUser.image"
          alt="user image"
        />
        <img
          v-else
          class="rounded-full border border-gray-100 shadow-sm"
          src="/images/new_user.png"
          alt="user image"
        />
      </div>
    </div>
    <div class="flex-1 mx-4">
      <h2 class="font-bold">{{ currentUser.username }}</h2>
      <h3 class="text-sm text-gray-400">Welcome to larainsta</h3>
    </div>
    <button class="text-blue-400 text-sm font-semibold">Salir</button>
  </div>
</template>

<script>
import useAuth from "@/modules/auth/composables/useAuth";
export default {
  setup() {
    const { currentUser } = useAuth();

    return {
      currentUser,
    };
  },
};
</script>