const axios = require('axios');

axios
  .get('http://localhost:8080/api/resumes/1', {
    headers: {
      Authorization: 'Bearer 1|cl4fVO8riliupB0g1DrRnF6ZMU1X16R47nTJD0CM',
    },
  })
  .then((res) => {
    console.log(res.data);
  })
  .catch((e) => {
    console.log(e.response.status);
    console.log(e.response.data);
  });
