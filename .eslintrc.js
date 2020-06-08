module.exports = {
  env: {
    browser: true,
    es6: true,
    node: true
  },
  extends: [
    'plugin:vue/recommended',
    'standard'
  ],
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly'
  },
  parserOptions: {
    ecmaVersion: 11,
    sourceType: 'module'
  },
  plugins: [
    'vue'
  ],
  rules: {
    'vue/require-default-prop': 0,
    'vue/require-prop-types' : 0,
    'semi': [2, 'always'],
    "indent": ["error", 4],
    "vue/html-indent": ["error", 4, { "baseIndent": 1 }],
    'vue/no-use-v-if-with-v-for': 0,
    'vue/order-in-components': 0,
    'no-useless-escape': 0,
  }
};
