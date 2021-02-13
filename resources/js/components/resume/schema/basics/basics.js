export default {
  fields: [
    // Profile Image
    {
      type: 'resume-image',
      label: 'Resume Profile Image',
      model: 'picture',
    },
    // Label
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'Programmer',
      label: 'Label',
      model: 'label',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    // Name
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'Your Name',
      label: 'Name',
      model: 'name',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
    },
    // Email
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'yourname@example.com',
      label: 'Email',
      model: 'email',
      styleClasses: ['col-md-4', 'p-0', 'pr-md-1'],
      validator: 'email',
    },
    // Phone
    {
      type: 'input',
      inputType: 'tel',
      placeholder: '987654321',
      label: 'Phone',
      model: 'phone',
      styleClasses: ['col-md-6', 'p-0', 'pl-md-1'],
    },
    // Website
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'yourwebsite.com',
      label: 'Website',
      model: 'website',
      styleClasses: ['col-md-6', 'p-0', 'pl-md-1'],
      validator: 'url',
    },
    // Summary
    {
      type: 'textArea',
      inputType: 'text',
      label: 'Summary',
      placeholder: 'A little bit about yourself...',
      model: 'summary',
      styleClasses: ['col-md-12', 'p-0'],
    },
  ],
};
