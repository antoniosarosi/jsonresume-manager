<template>
  <div>
    <Alert
      v-if="alert.messages.length !== 0"
      :messages="alert.messages"
      :type="alert.type"
      @close="alert.messages = []"
    />

    <div class="row mb-3">
      <div class="col-sm-8">
        <div class="form-group">
          <input
            v-model="resume.title"
            placeholder="Resume Title"
            required
            autofocus
            class="form-control w-100"
          />
        </div>
      </div>
      <div class="col-sm-4">
        <button class="btn btn-success btn-block" @click="submit()">
          Submit <i class="fa fa-upload"></i>
        </button>
      </div>
    </div>

    <Tabs>
      <Tab icon="fa fa-user" title="Basics">
        <VueFormGenerator
          :schema="schemas.basics"
          :model="resume.content.basics"
          :options="options"
        />
        <VueFormGenerator
          :schema="schemas.location"
          :model="resume.content.basics.location"
          :options="options"
          class="mt-3"
        />
      </Tab>
      <Tab icon="fa fa-users" title="Profiles">
        <DynamicForm
          title="Profile"
          self="profiles"
          :model="resume.content.basics"
          :schema="schemas.profiles"
        />
      </Tab>
      <Tab icon="fa fa-briefcase" title="Work">
        <DynamicForm
          title="Work"
          self="work"
          :model="resume.content"
          :schema="schemas.work"
          :subforms="subforms.highlights"
        />
      </Tab>
      <Tab icon="fa fa-graduation-cap" title="Education">
        <DynamicForm
          title="Education"
          self="education"
          :model="resume.content"
          :schema="schemas.education"
          :subforms="subforms.courses"
        />
      </Tab>
      <Tab icon="fa fa-lightbulb" title="Skills">
        <DynamicForm
          title="Skill"
          self="skills"
          :model="resume.content"
          :schema="schemas.skills"
          :subforms="subforms.keywords"
        />
      </Tab>
      <Tab icon="fa fa-trophy" title="Awards">
        <DynamicForm
          title="Award"
          self="awards"
          :model="resume.content"
          :schema="schemas.awards"
        />
      </Tab>
    </Tabs>
  </div>
</template>

<script>
import basics from './schema/basics/basics';
import location from './schema/basics/location';
import profiles from './schema/basics/profiles';
import work from './schema/work';
import education from './schema/education';
import skills from './schema/skills';
import awards from './schema/awards';
import schema from './jsonresume';
import Alert from '../reusable/Alert';
import Tab from './tabs/Tab';
import Tabs from './tabs/Tabs';
import { component as VueFormGenerator } from 'vue-form-generator';
import 'vue-form-generator/dist/vfg.css';
import DynamicForm from './dynamic/DynamicForm';
import ListForm from './dynamic/ListForm';

export default {
  name: 'ResumeForm',

  props: {
    update: false,
    resume: {
      type: Object,
      default: () => ({
        id: null,
        title: 'Resume Title',
        content: schema,
      }),
    },
  },

  components: {
    VueFormGenerator,
    DynamicForm,
    ListForm,
    Alert,
    Tabs,
    Tab,
  },

  data: () => ({
    alert: {
      type: '',
      messages: [],
    },

    schemas: {
      basics,
      location,
      profiles,
      work,
      education,
      skills,
      awards,
    },

    options: {
      validateAfterLoad: true,
      validateAfterChanged: true,
      validateAsync: true,
    },

    subforms: {
      highlights: [
        {
          component: ListForm,
          props: {
            self: 'highlights',
            title: 'Highlights',
            placeholder: 'Started company',
          },
        },
      ],
      courses: [
        {
          component: ListForm,
          props: {
            self: 'courses',
            title: 'Courses',
            placeholder: 'DB1101 - Basic SQL',
          },
        },
      ],
      keywords: [
        {
          component: ListForm,
          props: {
            self: 'keywords',
            title: 'Keywords',
            placeholder: 'Javascript',
          },
        },
      ],
    },
  }),

  mounted() {
    console.log(this.resume);
  },

  methods: {
    validate(target, parent = 'resume') {
      let errors = [];
      for (const [prop, value] of Object.entries(target)) {
        if (Array.isArray(value)) {
          if (value.length === 0) {
            errors.push(`${parent} > ${prop} must have at least one element`);
            continue;
          }
          for (let i in value) {
            if (typeof value[i] === null || value[i] === '') {
              errors.push(`${parent} > ${prop} > ${i} cannot be empty`);
            } else if (typeof value[i] === 'object') {
              errors = errors.concat(
                this.validate(value[i], `${parent} > ${prop} > ${i}`)
              );
            }
          }
        } else if (typeof value === 'object') {
          errors = errors.concat(this.validate(value, `${parent} > ${prop}`));
        } else if (value === null || value === '') {
          errors.push(`${parent} > ${prop} is required`);
        }
      }

      return errors;
    },

    isValid() {
      const { alert } = this.$data;
      const { resume } = this.$props;
      alert.messages = [];
      const errors = this.validate(resume.content);
      if (errors.length == 0) {
        return true;
      }

      alert.type = 'warning';
      alert.messages = errors.slice(0, 3);
      if (errors.length > 3) {
        alert.messages.push(
          `<strong>${errors.length - 3} more errors...</strong>`
        );
      }

      return false;
    },

    async submit() {
      if (!this.isValid()) {
        return;
      }
      const { alert } = this.$data;
      const { resume, update } = this.$props;
      try {
        const res = update
          ? await axios.put(route('resumes.update', resume.id), resume)
          : await axios.post(route('resumes.store'), resume);
        window.location = route('resumes.index');
      } catch (e) {
        const errors = e.response.data.errors;
        for (const [prop, value] of Object.entries(errors)) {
          const origin = prop.split('.').join(' > ');
          for (const error of value) {
            const message = error.replace(prop, `<strong>${origin}</strong>`);
            alert.messages.push(message);
          }
        }
        alert.type = 'danger';
      }
    },
  },
};
</script>
