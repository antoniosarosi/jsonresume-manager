<template>
  <BTab title-link-class="p-2">
    <template v-slot:title>
      <div class="d-flex justify-content-center">
        <div>
          <i style="font-size:20px;" :class="icon"></i>
        </div>
        <div class="ml-2 font-weight-bold d-none d-md-block">
          {{ title }}
        </div>
      </div>
    </template>
    <slot></slot>
  </BTab>
</template>

<script>
import { BTab } from 'bootstrap-vue';

export default {
  name: 'Tab',

  props: {
    title: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      required: true,
    },
  },

  components: {
    BTab,
  },
};
</script>
