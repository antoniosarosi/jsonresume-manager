<template>
  <div
    class="alert alert-dismissible fade show"
    role="alert"
    :class="`alert-${type}`"
  >
    <div
      v-if="typeof messages === 'string' || messages.length === 1"
      v-html="messages[0]"
    />
    <ul class="mb-0" v-else>
      <li v-for="(msg, i) in messages" :key="i" v-html="msg" />
    </ul>
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"
      @click="$emit('close')"
    >
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    messages: {
      type: [String, Array],
      required: true,
    },
    type: {
      type: String,
      required: false,
      default: () => 'warning',
      validator: (value) =>
        [
          'success',
          'warning',
          'danger',
          'primary',
          'secondary',
          'info',
          'light',
          'dark',
        ].indexOf(value) !== -1,
    },
  },
};
</script>
