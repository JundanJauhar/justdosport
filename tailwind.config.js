/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js}",
  ],
  theme: {
    extend: {
      backgroundImage: {
        "my-image" : "url(https://tse4.mm.bing.net/th?id=OIP.dKaUgFfnxTAQcl43kbMbnwAAAA&pid=Api&P=0&h=220)",
      },
    },
  },
  plugins: [
      require('daisyui'),

  ],
}

