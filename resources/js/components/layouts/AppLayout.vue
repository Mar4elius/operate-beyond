<template>
  <div class="min-h-screen relative bg-white overflow-hidden">
    <!-- This will be the main layout where we will use slots to insert components we need for a page -->
    <header>
      <!-- Header contect comes here -->
      <slot name="header"> </slot>
    </header>
    <main>
      <!-- Main content comes here -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <slot name="main"> Main Content </slot>
      </div>
    </main>
    <footer>
      <!-- Footer content comes here -->
      <slot name="footer"></slot>
    </footer>
  </div>
</template>

<script>

export default {
  setup() {
    //
  },
};
</script>
