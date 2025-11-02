// tailwind.config.cjs
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'grid',
    'grid-cols-1',
    'sm:grid-cols-2',
    'gap-4',
    'overflow-y-auto',
    'max-h-[75vh]',
    'max-h-[90vh]'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
