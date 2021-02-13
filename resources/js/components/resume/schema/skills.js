export default {
  fields: [
    // Name
    {
      type: 'input',
      inputType: 'text',
      label: 'Name',
      placeholder: 'Web Development',
      model: 'name',
      styleClasses: ['col-md-6', 'p-0', 'pr-md-1'],
    },
    // Level
    {
      type: 'input',
      inputType: 'text',
      label: 'level',
      placeholder: 'Master',
      model: 'level',
      styleClasses: ['col-md-6', 'p-0'],
    },
  ],
};
