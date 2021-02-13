<template>
  <div class="my-2">
    <div v-for="(_, i) in model[self]" :key="i" class="row mb-3">
      <div class="col-sm">
        <div class="card">
          <div class="card-header d-sm-flex justify-content-sm-between">
            <div>
              <h3>{{ title }} #{{ i }}</h3>
            </div>
            <div>
              <button class="btn btn-danger btn-block" @click="remove(i)">
                Delete <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            <VueFormGenerator
              :schema="schema"
              :model="model[self][i]"
              class="mt-3"
              :options="{
                validateAfterLoad: true,
                validateAfterChanged: true,
                validateAsync: true,
              }"
            />
            <div v-for="(subform, j) in subforms" :key="j">
              <component
                :is="subform.component"
                v-bind="{ ...subform.props, model: model[self][i] }"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <button @click="add()" class="btn btn-primary" type="button">
      Add New
    </button>
  </div>
</template>

<script>
import { component as VueFormGenerator } from 'vue-form-generator';
import mixin from './mixin';

/**
 * Wrapper around VueFormGenerator that implements the logic for a simple form CRUD
 */
export default {
  name: 'DynamicForm',

  mixins: [mixin],

  components: {
    VueFormGenerator,
  },

  props: {
    schema: {
      type: Object,
      required: true,
    },
    subforms: {
      type: Array,
      required: false,
      default: () => [],
    },
  },
};
</script>
