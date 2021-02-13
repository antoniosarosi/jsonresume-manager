<template>
  <BTab title-link-class="p-2">
    <template v-slot:title>
      <div class="d-flex justify-content-center">
        <div>
          <i :class="icon"></i>
        </div>
        <div class="d-none d-md-block ml-2 font-weight-bold">
          {{ title }}
        </div>
      </div>
    </template>
    <slot></slot>
  </BTab>
</template>

<script>
import { BTab } from "bootstrap-vue";

/**
 * Custom wrapper for BTab, makes it easy to add icons.
 */
export default {
  name: "Tab",
  
  components: { BTab },

  props: {
    icon: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    }
  }
};
</script>

<style scoped>
i {
  font-size: 20px;
}
</style>
