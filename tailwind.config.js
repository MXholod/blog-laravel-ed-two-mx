module.exports = {
  purge: [],
  /*
	Disabling Preflight
	If you’d like to completely disable Preflight — perhaps because you’re integrating Tailwind into an existing project or because you’d like to provide your own base styles — all you need to do is set 	preflight to false in the corePlugins section of your tailwind.config.js file:
	corePlugins: {
		preflight: false
	}
  */
  //corePlugins: {
    //preflight: false,
  //},
  /*
	Prefix
	The prefix option allows you to add a custom prefix to all of Tailwind’s generated utility classes. This can be really useful when layering Tailwind on top of existing CSS where there might be naming conflicts.
	For example, you could add a tw- prefix by setting the prefix option like so:
	prefix: 'tw-',
  */
  prefix: 'tw-',
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
