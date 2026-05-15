import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                "on-secondary-container": "#bfb2da",
                "on-tertiary-container": "#503d00",
                "outline-variant": "#494551",
                "surface-tint": "#cfbcff",
                "on-surface": "#e6e0e9",
                "secondary-fixed-dim": "#cdc0e9",
                "surface-variant": "#36343a",
                "surface-bright": "#3b383e",
                "secondary-fixed": "#e9ddff",
                "inverse-surface": "#e6e0e9",
                "on-secondary-fixed": "#1f1635",
                "background": "#141218",
                "on-error-container": "#ffdad6",
                "on-tertiary-fixed-variant": "#594400",
                "error": "#ffb4ab",
                "surface-container-lowest": "#0f0d13",
                "surface-container-highest": "#36343a",
                "surface": "#141218",
                "on-tertiary": "#3e2e00",
                "tertiary": "#e7c365",
                "tertiary-fixed": "#ffdf93",
                "primary-fixed-dim": "#cfbcff",
                "on-surface-variant": "#cbc4d2",
                "primary-container": "#6750a4",
                "on-error": "#690005",
                "surface-dim": "#141218",
                "primary": "#cfbcff",
                "surface-container-low": "#1d1b20",
                "on-primary-container": "#e0d2ff",
                "secondary": "#cdc0e9",
                "on-secondary-fixed-variant": "#4b4263",
                "surface-container-high": "#2b292f",
                "on-secondary": "#342b4b",
                "tertiary-fixed-dim": "#e7c365",
                "surface-container": "#211f24",
                "inverse-primary": "#6750a4",
                "error-container": "#93000a",
                "inverse-on-surface": "#322f35",
                "on-background": "#e6e0e9",
                "on-primary-fixed": "#22005d",
                "on-primary-fixed-variant": "#4f378a",
                "outline": "#948e9c",
                "secondary-container": "#4d4465",
                "primary-fixed": "#e9ddff",
                "on-tertiary-fixed": "#241a00",
                "tertiary-container": "#c9a74d",
                "on-primary": "#381e72"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            spacing: {
                "2xl": "3rem",
                "gutter": "1.5rem",
                "md": "1rem",
                "container-max": "1440px",
                "base": "4px",
                "lg": "1.5rem",
                "xl": "2rem",
                "sm": "0.5rem",
                "xs": "0.25rem"
            },
            fontFamily: {
                "body-md": ["Geist", "sans-serif"],
                "body-lg": ["Geist", "sans-serif"],
                "h3": ["Geist", "sans-serif"],
                "h2": ["Geist", "sans-serif"],
                "h1": ["Geist", "sans-serif"],
                "label-caps": ["Geist", "sans-serif"],
                "display": ["Geist", "sans-serif"],
                "body-sm": ["Geist", "sans-serif"],
                "code": ["JetBrains Mono", "monospace"],
                sans: ['Geist', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                "body-md": ["14px", { "lineHeight": "1.5", "fontWeight": "400" }],
                "body-lg": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                "h3": ["18px", { "lineHeight": "1.4", "fontWeight": "600" }],
                "h2": ["24px", { "lineHeight": "1.3", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                "h1": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                "label-caps": ["11px", { "lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600" }],
                "display": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.04em", "fontWeight": "700" }],
                "body-sm": ["13px", { "lineHeight": "1.5", "fontWeight": "400" }],
                "code": ["13px", { "lineHeight": "1.6", "fontWeight": "400" }]
            }
        },
    },

    plugins: [forms],
};
