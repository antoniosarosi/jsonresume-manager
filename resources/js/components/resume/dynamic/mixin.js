// Helper used to manipulate list properties on objects

export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    model: {
      type: Object,
      required: true,
    },
    self: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      target: this.model,
      prop: this.self,
      push: () => ({}),
    };
  },

  methods: {
    add() {
      const { target, prop, push } = this.$data;
      if (!target[prop]) {
        this.$set(target, prop, []);
      }
      target[prop].push(push());
    },

    remove(index) {
      const { target, prop } = this.$data;
      if (target[prop]) {
        target[prop].splice(index, 1);
      }
    },
  },
};
