/** @type {import('tailwindcss').Config} */
export const content = [
  "./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./resources/**/*.jsx",
  "./resources/**/*.vue",
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
];

export const theme = {
  // screens: {
  //     'sm': '640px',
  //     'md': '768px',
  //     'lg': '1024px',
  //     'xl': '1200px',
  //     '2xl': '1600px',
  // },
  // debugScreens: {
  //     prefix: "screen: ",
  //     selector: ".debug-tailwind-screens",
  // },
  container: {
      center: true,
      padding: "calc(var(--ba-gutter-x) * 0.5)",
  },
};

export const plugins = [
  require("tailwindcss"),
  require("autoprefixer"),
  require("tailwind-scrollbar"),
  require("tailwindcss-debug-screens"),
];

