<template>
  <div class="modal-backdrop">
    <div class="modal">
      <div class="modal-header">
        <slot name="header"></slot>
        <button type="button" class="btn-close" @click="close"></button>
      </div>
    </div>
  </div>
</template>