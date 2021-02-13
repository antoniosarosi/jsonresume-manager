<template>
  <div class="d-sm-inline-flex w-100">
    <div>
      <img :src="image" />
    </div>
    <div class="align-self-center pl-sm-3 pt-3 pt-sm-0 ">
      <input type="file" @change="onImageChange($event)" />
    </div>
  </div>
</template>

<script>
import { abstractField } from 'vue-form-generator';

export default {
  /**
   * Naming must follow this convention, FieldCustom, and then you can use it as
   * "Custom" (register it as FieldCustom)
   * https://vue-generators.gitbook.io/vue-generators/fields/custom_fields
   */
  name: 'FieldResumeImage',

  mixins: [abstractField],

  data() {
    return {
      reader: new FileReader(),
      image: this.model[this.schema.model],
    };
  },

  created() {
    this.reader.onload = (e) => {
      this.model[this.schema.model] = e.target.result;
      this.image = e.target.result;
    };
  },

  methods: {
    onImageChange(e) {
      this.reader.readAsDataURL(e.target.files[0]);
    },
  },
};
</script>

<style scoped>
img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
</style>
