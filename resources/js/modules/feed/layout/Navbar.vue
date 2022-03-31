<template>
  <div class="shadow-sm border-b bg-white top-0 fixed w-full">
    <div class="flex justify-between max-w-6xl mx-5 xl:mx-auto p-3">
      <div class="relative w-42 h-7 lg-inline-grid">
        <img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png">
      </div>
      <div class="relative mt-1 p-1 pl-2 rounded-md sm:text-sm border-solid border-[1.2px] border-gray-300 flex bg-gray-50">
        <input type="text" placeholder="Buscar" class="headerinput pl-1 bg-gray-50 block focus:outline-none">
      </div>
    </div>
  </div>
  <router-view></router-view>
</template>