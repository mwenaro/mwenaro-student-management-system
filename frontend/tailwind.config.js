/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{js,jsx,ts,tsx}"],
  theme: {
    fontFamily: {
      Heebo: ["Heebo", "sans-serif"],
    },

    extend: {
      colors: {
        myprimary: {
          DEFAULT: "#2B8FEC",
        },
        mysecondary: {
          DEFAULT: "#FFFFFF",
        },
        mygrad: {
          start: "#D6E3ED",
          end: "#C6D3DD",
        },
      },
      fontSize: {
        lg: ["16px"],
        base: ["12px"],
        sm: [
          "10px",
          {
            fontWeight: "500",
          },
        ],
      },
      screens: {
        xs: "375px",
        // => @media (min-width: 375px) { ... }
        sm: "512px",
        // => @media (min-width: 512px) { ... }

        md: "768px",
        // => @media (min-width: 768px) { ... }

        lg: "1024px",
        // => @media (min-width: 1024px) { ... }

        xl: "1280px",
        // => @media (min-width: 1280px) { ... }

        "2xl": "1536px",
        // => @media (min-width: 1536px) { ... }
      },
    },
    container: {
      center: true,
    },
  },
  plugins: [require("daisyui")],
};
