module.exports = {
  content: ["./app/***/**/*{html,php,js,css}", ".app/css/*"],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      }
    },
  },
  variants: {
    extend: {
      display: ['group-focus']
    },
  },
  plugins: [],
}
