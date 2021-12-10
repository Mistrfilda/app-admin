const colors = require("tailwindcss/colors");

module.exports = {
	purge: {
		content: [
			'./src/**/*.html',
			'./src/**/*.latte',
			'./assets/**/*.html',
			'./assets/**/*.latte',
			'./assets/**/*.ts',
			'./assets/**/*.js'
		],
		options: {
			// Whitelisting some classes to avoid purge
			safelist: [/^bg-/, /^text-/, /^border-/, /^hover-/]
		}
	},
	theme: {
		extend: {
			colors: {
				orange: colors.orange,
				sky: colors.sky,
				emerald: colors.emerald,
				teal: colors.teal,
				cyan: colors.cyan,
				indigo: colors.indigo
			}
		}
	},
	variants: {
		extend: {
			fontWeight: ["hover", "focus"]
		}
	},
	plugins: [
		require("@tailwindcss/forms"),
		require("@tailwindcss/typography"),
		require("@tailwindcss/aspect-ratio")
	]
};