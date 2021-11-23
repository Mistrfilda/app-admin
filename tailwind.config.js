const colors = require("tailwindcss/colors");

module.exports = {
  purge: [],
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