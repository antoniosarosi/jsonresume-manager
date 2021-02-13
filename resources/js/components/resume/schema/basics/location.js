export default {
  fields: [
    // Address
    {
      type: 'input',
      inputType: 'text',
      placeholder: '2712 Broadway St',
      label: 'Address',
      model: 'address',
      styleClasses: ['col-md-4', 'p-0', 'pl-md-1'],
    },
    // Postal Code
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'CA 94115',
      label: 'Postal Code',
      model: 'postalCode',
      styleClasses: ['col-md-4', 'p-0', 'pl-md-1'],
    },
    // City
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'San Francisco',
      label: 'City',
      model: 'city',
      styleClasses: ['col-md-4', 'p-0', 'pl-md-1'],
    },
    // Country Code
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'US',
      label: 'Country Code',
      model: 'countryCode',
      styleClasses: ['col-md-6', 'p-0', 'pl-md-1'],
    },
    // Region
    {
      type: 'input',
      inputType: 'text',
      placeholder: 'California',
      label: 'Region',
      model: 'region',
      styleClasses: ['col-md-6', 'p-0', 'pl-md-1'],
    },
  ],
};
