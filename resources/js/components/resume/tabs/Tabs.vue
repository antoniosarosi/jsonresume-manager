<template>
  <BTabs pills justified v-model="tab">
    <slot></slot>
    <div class="text-center">
      <BButtonGroup class="w-100">
        <BButton block class="m-0" variant="secondary" @click="tab--">
          <i class="fa fa-arrow-circle-left"></i> Previous
        </BButton>
        <BButton block class="m-0" variant="primary" @click="tab++">
          Next <i class="fa fa-arrow-circle-right"></i> 
        </BButton>
      </BButtonGroup>
    </div>
  </BTabs>
</template>

<script>
import { BTabs, BButtonGroup, BButton } from "bootstrap-vue";

/**
 * Custom wrapper around BTabs that makes it easier to crate forms.
 */
export default {
  name: "Tabs",

  components: {
    BTabs,
    BButtonGroup,
    BButton
  },

  data: () => ({
    tab: 0
  })
};
</script>
