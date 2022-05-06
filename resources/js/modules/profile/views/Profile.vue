<template>
  <div class="max-w-6xl mx-5 p-10 xl:mx-auto">
    <div class="grid grid-cols-4 gap-4">
      <div class="avatar justify-center">
        <div class="rounded-full w-36">
          <img v-if="user.image" :src="user.image" alt="user image" />
          <img v-else src="/images/new_user.png" alt="user image" />
        </div>
      </div>
      <div class="col-span-2">
        <span class="text-gray-700 text-2xl mr-4">{{ user.username }}</span>
        <div
          class="
            cursor-pointer
            inline
            text-sm text-gray-700
            font-semibold
            p-1
            px-2
            border border-gray-200
            rounded
            mr-4
          "
        >
          Editar perfil
        </div>
        <CogIcon class="cursor-pointer h-6 inline" />
        <div class="mt-4 flex">
          <div>
            <span class="font-semibold">{{ totalPosts }}</span> posts
          </div>
          <div class="ml-4">
            <span class="font-semibold">{{ user.follower_count }}</span>
            seguidores
          </div>
          <div class="ml-4">
            <span class="font-semibold">{{ user.following_count }}</span>
            siguiendo
          </div>
        </div>
      </div>
    </div>
    <hr class="border-gray-500 mt-6" />
    <div class="flex justify-center gap-10">
      <button
        class="
          focus:border-t
          border-gray-800
          py-4
          text-sm
          font-semibold
          flex
          gap-2
          text-gray-400
          focus:text-gray-600
        "
      >
        <font-awesome-icon size="lg" :icon="['fa', 'grip-vertical']" />
        POSTS
      </button>
      <button
        class="
          focus:border-t
          border-gray-800
          py-4
          text-sm
          font-semibold
          flex
          gap-2
          text-gray-400
          focus:text-gray-600
        "
      >
        <font-awesome-icon size="lg" :icon="['far', 'heart']" />
        FAVS
      </button>
      <button
        class="
          focus:border-t
          border-gray-800
          py-4
          text-sm
          font-semibold
          flex
          gap-2
          text-gray-400
          focus:text-gray-600
        "
      >
        <BookmarkIcon class="h-5 ml-0 mr-0" />
        GUARDADOS
      </button>
    </div>
    <div class="grid grid-cols-3 gap-5">
      <img v-for="(post, i) in posts" :key="i" :src="post.images[0].image_url" :alt="post.description">
    </div>
  </div>
</template>

<script>
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import useProfile from "../composables/useProfile";
import { CogIcon, BookmarkIcon } from "@heroicons/vue/solid";
import { computed, watch } from "vue";
export default {
  components: {
    CogIcon,
    BookmarkIcon
  },
  setup() {
    const router = useRoute();

    const { getUserWithPosts, posts, user } = useProfile();

    const totalPosts = computed(() => posts.value.length);

    onMounted(async () => {
      const username = router.params.username;
      await getUserWithPosts(username);
    });

    return {
      user,
      posts,
      totalPosts,
    };
  },
};
</script>