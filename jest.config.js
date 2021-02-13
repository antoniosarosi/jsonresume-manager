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
  }
}
