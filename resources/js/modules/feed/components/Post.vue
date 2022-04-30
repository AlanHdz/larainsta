<template>
  <div class="bg-white my-7 border rounder rounder-sm">
    <div class="flex items-center p-4">
      <div class="w-10 h-10 mr-3">
        <img
          v-if="post.user.image"
          class="rounded-full border border-gray-100 shadow-sm"
          src="https://randomuser.me/api/portraits/women/81.jpg"
          alt="user image"
        />
        <img
          v-else
          class="rounded-full border border-gray-100 shadow-sm"
          src="/images/new_user.png"
          alt="user image"
        />
      </div>
      <p class="flex-1 text-sm font-semibold">{{ post.user.username }}</p>
      <div class="dropdown cursor-pointer relative" @click="toggleDropdownPost">
        <DotsHorizontalIcon class="h-5 cursor-pointer" />
        <ul
          class="dropdown-menu absolute hidden pt-1 bg-white"
          :class="!showDropdownPost ? 'hidden' : 'block'"
        >
          <li class="">
            <a
              class="
                rounded
                hover hover:bg-gray-200
                py-2
                px-4
                block
                whitespace-no-wrap
                text-red-500
              "
              @click="deletePost(post.id)"
              href="#"
              >Eliminar</a
            >
          </li>
          <hr />
        </ul>
      </div>
    </div>
    <img class="w-full" :src="post.images[0].image_url" alt="" srcset="" />
    <div class="flex justify-between p-4">
      <div class="flex space-x-4 items-center">
        <HeartIcon class="h-6 cursor-pointer" />
        <font-awesome-icon
          class="cursor-pointer"
          size="lg"
          :icon="['far', 'comment']"
        />
        <PaperAirplaneIcon
          class="h-6 cursor-pointer rotate-[60deg] -translate-y-1"
        />
      </div>
      <BookmarkIcon class="h-6" />
    </div>
  </div>
</template>

<script>
import {
  DotsHorizontalIcon,
  HeartIcon,
  PaperAirplaneIcon,
  BookmarkIcon,
} from "@heroicons/vue/outline";
import { ref } from "vue";
import useAuth from '../../auth/composables/useAuth';
import useFeed from '../composables/useFeed';
import { useToast } from "vue-toastification";
export default {
  components: {
    DotsHorizontalIcon,
    HeartIcon,
    PaperAirplaneIcon,
    BookmarkIcon,
  },
  props: {
    post: Object,
  },
  setup() {
    const showDropdownPost = ref(false)

    const { currentUser } = useAuth();

    const { deletePostComposable } = useFeed();

    const toast = useToast()

    const toggleDropdownPost = () => {
      showDropdownPost.value = !showDropdownPost.value
    }

    const deletePost = async (postId) => {
      const { ok, message } = await deletePostComposable(postId)

      if (ok) {
        toast.success(message, { timeout: 2000 })
      } else {
        toast.error(message, { timeout: 2000 })
      }
    }
    
    return {
      showDropdownPost,
      toggleDropdownPost,
      currentUser,
      deletePost
    }
  },
};
</script>

<style scoped>
.block {
  display: block;
}
</style>