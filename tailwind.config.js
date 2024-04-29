import preset from "./vendor/filament/support/tailwind.config.preset";

const colors = require("tailwindcss/colors");

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    // theme: {
    //     extend: {
    //         colors: {
    //             primary: colors.slate,
    //             secondary: colors.sky,
    //             tertiary: colors.teal,
    //         },
    //         backgroundImage: {
    //             image: "url('assets/shipping-truck.jpg')",
    //         },
    //     },
    // },
};
