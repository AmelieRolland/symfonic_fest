// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      // ici vvvv
      "./vendor/tales-from-a-dev/flowbite-bundle/templates/**/*.html.twig",
      "./assets/**/*.js",
      "./templates/**/*.html.twig",
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  };