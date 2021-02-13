<template>
  <div class="card my-2">
    <div class="card-header">
      <h3>{{ title }}</h3>
    </div>

    <div class="card-body">
      <div v-for="(_, index) in model[self]" :key="index">
        <div class="d-flex mb-4 p-0">
          <div class="col-10 p-0">
            <input
              type="text"
              required
              autofocus
              class="form-control"
              :placeholder="placeholder"
              v-model="model[self][index]"
            />
          </div>
          <div class="col-2">
            <div class="d-flex justify-content-end">
              <button class="btn btn-danger" @click="remove(index)">
                <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div>
        <button class="btn btn-primary" @click="add()">
          Add New
        </button>
      </div>
    </div>
  </div>
</template>

<script>
/**
 * Display a list of inputs.
 */
import mixin from './mixin';

export default {
  name: 'ListForm',

  mixins: [mixin],

  props: {
    placeholder: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      push: () => '',
    };
  },
};
</script>
