export default {
  fields: [
    //Name
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'Your name',
      label: 'Name',
      model: 'name',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    //Label
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'Programmer',
      label: 'Label',
      model: 'label',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    //Email
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'yourname@email.com',
      label: 'Email',
      model: 'email',
      validator: 'email',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    //Phone
    {
      type: 'input',
      inputType: 'tel',
      placeholder: '954000111',
      label: 'Phone',
      model: 'phone',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    //Website
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'http://yourwebsite.com',
      label: 'Website',
      model: 'website',
      validator: 'url',
      styleClasses: ['col-md-8', 'p-0', 'pr-md-1'],
    },
    //Summary
    {
      type: 'textArea',
      inputType: 'text',
      placeholder: 'A little bit about yourself',
      label: 'Summary',
      model: 'summary',
      styleClasses: ['col-md-12', 'p-0', 'pr-md-1'],
    },
  ],
};
