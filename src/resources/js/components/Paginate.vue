<template>
  <div>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li
          class="page-item"
          :class="{disabled: currentPage === 1 || pages.length === 0}"
        >
          <a
            class="page-link"
            href="#"
            @click="$emit('pre')"
          >&lt;</a>
        </li>
        <li
          v-for="(number, index) in pages"
          :key="index"
          class="page-item"
          :class="{active: Number(number) === Number(currentPage)}"
        >
          <a
            class="page-link"
            href="#"
            @click="$emit('page', number)"
          >{{ number }}</a>
        </li>
        <li
          class="page-item"
          :class="{disabled: currentPage === lastPage}"
        >
          <a
            class="page-link"
            href="#"
            @click="$emit('next')"
          >&gt;</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'Paginate',
  props: {
    lastPage: {
      type: Number,
      required: true,
    },
    currentPage: {
      type: Number,
      required: true,
    }
  },
  computed: {
    pages() {
      return [...Array(this.lastPage).keys()].map(i => ++i);
    }
  }
};
</script>

<style scoped>

</style>
