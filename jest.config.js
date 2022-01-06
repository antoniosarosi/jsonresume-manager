module.exports = {
  // specifies aliases for imports
  moduleNameMapper: {
    '^@/(.*)$': '<rootDir>/$1',
    '^~/(.*)$': '<rootDir>/$1',
    '^vue$': 'vue/dist/vue.common.js'
  },
  // specifies extensions of files that will be tested
  moduleFileExtensions: ['js', 'vue', 'json'],
  // specifies that .js files must be transformed using babel-jest, and vue files must be transformed using vue-jest
  transform: {
    '^.+\\.js$': 'babel-jest',
    '.*\\.(vue)$': 'vue-jest'
  },
  // The default environment in Jest is a Node.js environment. 
  //If you are building a web app, you can use a browser-like environment through jsdom instead.
  "testEnvironment": "jsdom"
}
