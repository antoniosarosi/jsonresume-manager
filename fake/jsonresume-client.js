const axios = require('axios');

axios
  .get('http://localhost:8080/api/resumes', {
    headers: {
      Authorization: 'Bearer 1|R1SY5y9r3390bGPdsFL8iogKDjogryhrEHLNvxFw',
    },
  })
  .then((res) => {
    console.log(res.data);
  })
  .catch((e) => {
    console.log(e.response.status);
    console.log(e.response.data);
  });
