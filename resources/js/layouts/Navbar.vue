<template>
  <div class="h-screen pt-20">
    <div class="shadow-sm border-b bg-white top-0 fixed w-full z-20">
      <div class="flex justify-between max-w-4xl mx-5 xl:mx-auto p-2">
        <div class="flex justify-between w-4/6">
          <div class="relative w-42 h-7 lg-inline-grid">
            <img
              src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png"
            />
          </div>
          <div
            ref="inputSearch"
            class="
              hidden
              relative
              mt-1
              p-1
              pl-2
              rounded-md
              sm:text-sm
              border-solid border-[1.2px] border-gray-300
              md:flex
              bg-gray-50
            "
          >
            <SearchIcon
              v-if="searchIconVisibility"
              class="h-5 w-5 text-gray-400"
            />
            <input
              type="text"
              placeholder="Buscar"
              class="headerinput pl-1 bg-gray-50 block focus:outline-none"
            />
            <PlusCircleIcon
              v-if="plusCircleIconVisibility"
              class="h-5 w-5 text-gray-400 rotate-45"
            />
          </div>
        </div>
        <div class="flex items-center justify-end space-x-4">
          <HomeIcon class="h-6 cursor-pointer" />
          <div class="relative">
            <font-awesome-icon
              class="cursor-pointer"
              size="lg"
              :icon="['far', 'heart']"
            />
            <div
              class="
                block
                absolute
                w-1
                h-1
                left-1/2
                -translate-x-1/2
                bg-red-600
                rounded-full
              "
            ></div>
          </div>
          <div class="dropdown relative w-9 h-9 cursor-pointer" @click="toggleDropdown">
            <img
              v-if="currentUser.image"
              class="rounded-full border border-gray-100 shadow-sm"
              :class="!showDropdown ? '' : 'border-black'"
              :src="currentUser.image"
              alt="user image"
            />
            <img
              v-else
              class="rounded-full border border-gray-100 shadow-sm"
              :class="!showDropdown ? '' : 'border-black'"
              src="/images/new_user.png"
              alt="user image"
            />
            <ul class="dropdown-menu absolute hidden pt-1 bg-white" :class="!showDropdown ? 'hidden' : 'block'">
              <li class="">
                <a class="rounded hover hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Perfil</a>
              </li>
              <li class="">
                <a class="rounded hover hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Configuracion</a>
              </li>
              <hr>
              <li class="">
                <a class="rounded hover hover:bg-gray-200 py-2 px-4 block whitespace-no-wrap" href="#">Salir</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import { SearchIcon, PlusCircleIcon, HomeIcon } from "@heroicons/vue/solid";
import { onMounted, onUnmounted, ref } from "vue";
import useAuth from "../modules/auth/composables/useAuth";
export default {
  setup() {
    const searchIconVisibility = ref(true);
    const plusCircleIconVisibility = ref(false);
    const inputSearch = ref(null);
    const showDropdown = ref(false);

    const { currentUser } = useAuth();

    const mouseDownInput = (e) => {
      if (!inputSearch.value.contains(e.target)) {
        searchIconVisibility.value = true;
        plusCircleIconVisibility.value = false;
      } else {
        searchIconVisibility.value = false;
        plusCircleIconVisibility.value = true;
      }
    };

    const toggleDropdown = () => {
      showDropdown.value = !showDropdown.value;
    };

    onMounted(() => {
      document.addEventListener("mousedown", mouseDownInput);
    });

    onUnmounted(() => {
      document.removeEventListener("mousedown", mouseDownInput);
    });

    return {
      searchIconVisibility,
      plusCircleIconVisibility,
      inputSearch,
      currentUser,
      toggleDropdown,
      showDropdown,
    };
  },
  components: {
    SearchIcon,
    PlusCircleIcon,
    HomeIcon,
  },
};
</script>

<style scoped>
.block {
  display: block;
}
</style>