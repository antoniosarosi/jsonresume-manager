<template>
  <div>
    <Tabs>
      <Tab title="Basics" icon="fas fa-user">
        <VueFormGenerator
          :schema="schemas.basics"
          :model="resume.content.basics"
          :options="options"
        />
      </Tab>
    </Tabs>
  </div>
</template>

<script>
import Tabs from './tabs/Tabs';
import Tab from './tabs/Tab';
import basics from './schema/basics/basics';
import { component as VueFormGenerator } from 'vue-form-generator';
import 'vue-form-generator/dist/vfg.css';

export default {
  name: 'ResumeForm',
  components: {
    Tabs,
    Tab,
    VueFormGenerator,
  },
  data() {
    return {
      resume: {
        title: '',
        content: {
          basics: {},
        },
      },
      schemas: {
        basics,
      },
      options: {
        validateAfterLoad: true,
        validateAfterChanged: true,
        validateAsync: true,
      },
    };
  },
};
</script>
