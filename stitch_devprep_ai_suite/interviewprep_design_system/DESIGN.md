---
name: InterviewPrep Design System
colors:
  surface: '#141218'
  surface-dim: '#141218'
  surface-bright: '#3b383e'
  surface-container-lowest: '#0f0d13'
  surface-container-low: '#1d1b20'
  surface-container: '#211f24'
  surface-container-high: '#2b292f'
  surface-container-highest: '#36343a'
  on-surface: '#e6e0e9'
  on-surface-variant: '#cbc4d2'
  inverse-surface: '#e6e0e9'
  inverse-on-surface: '#322f35'
  outline: '#948e9c'
  outline-variant: '#494551'
  surface-tint: '#cfbcff'
  primary: '#cfbcff'
  on-primary: '#381e72'
  primary-container: '#6750a4'
  on-primary-container: '#e0d2ff'
  inverse-primary: '#6750a4'
  secondary: '#cdc0e9'
  on-secondary: '#342b4b'
  secondary-container: '#4d4465'
  on-secondary-container: '#bfb2da'
  tertiary: '#e7c365'
  on-tertiary: '#3e2e00'
  tertiary-container: '#c9a74d'
  on-tertiary-container: '#503d00'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#e9ddff'
  primary-fixed-dim: '#cfbcff'
  on-primary-fixed: '#22005d'
  on-primary-fixed-variant: '#4f378a'
  secondary-fixed: '#e9ddff'
  secondary-fixed-dim: '#cdc0e9'
  on-secondary-fixed: '#1f1635'
  on-secondary-fixed-variant: '#4b4263'
  tertiary-fixed: '#ffdf93'
  tertiary-fixed-dim: '#e7c365'
  on-tertiary-fixed: '#241a00'
  on-tertiary-fixed-variant: '#594400'
  background: '#141218'
  on-background: '#e6e0e9'
  surface-variant: '#36343a'
typography:
  display:
    fontFamily: Geist
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.04em
  h1:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  h2:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.3'
    letterSpacing: -0.01em
  h3:
    fontFamily: Geist
    fontSize: 18px
    fontWeight: '600'
    lineHeight: '1.4'
  body-lg:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '400'
    lineHeight: '1.5'
  body-sm:
    fontFamily: Geist
    fontSize: 13px
    fontWeight: '400'
    lineHeight: '1.5'
  code:
    fontFamily: JetBrains Mono
    fontSize: 13px
    fontWeight: '400'
    lineHeight: '1.6'
  label-caps:
    fontFamily: Geist
    fontSize: 11px
    fontWeight: '600'
    lineHeight: '1'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 0.25rem
  sm: 0.5rem
  md: 1rem
  lg: 1.5rem
  xl: 2rem
  2xl: 3rem
  gutter: 1.5rem
  container-max: 1440px
---

## Brand & Style

This design system is engineered for high-performance developer workflows, blending the utility of a code editor with the premium feel of a high-end SaaS platform. It evokes a sense of **precision, speed, and intelligence**. 

The aesthetic is heavily influenced by "Technical Minimalism"—where whitespace is intentional, borders are razor-thin, and the interface recedes to let the content (code and interview data) lead. The brand personality is professional and authoritative, yet forward-thinking, utilizing AI-centric visual cues like subtle gradients and glass effects to signify the platform's advanced capabilities. It avoids the "generic SaaS" look by prioritizing high-contrast information density and custom-tuned surfaces.

## Colors

The color palette is anchored in a deep, cinematic dark mode. 

- **Foundations:** The primary background uses a deep charcoal (#0B0E14) to reduce eye strain, while surfaces (#161B22) provide necessary elevation for cards and sidebars.
- **Accents:** A signature Indigo-to-Violet gradient is reserved for high-intent actions, AI-driven insights, and primary progress indicators. 
- **Functional:** Success, Warning, and Danger colors follow standard developer mental models (Emerald, Amber, Rose) but are slightly desaturated to maintain the professional atmosphere.
- **Interactive:** Borders use a precise Gray-800 (#30363D) to define structure without adding visual noise. Active states should use the primary accent or a subtle brightening of the border color.

## Typography

This design system utilizes **Geist** for its technical, Swiss-inspired precision. The scale focuses on high-contrast hierarchy to help developers quickly scan interview questions and performance metrics.

- **Headings:** Bold and tight. Large display sizes use negative letter-spacing for a sophisticated, editorial look.
- **Body:** Standardized at 14px for optimal information density without sacrificing legibility. 
- **Mono:** JetBrains Mono is introduced for code blocks and specific technical metadata (e.g., time complexities, memory usage) to reinforce the developer-centric nature of the tool.
- **Labels:** Small, uppercase labels are used for utility sections and sidebar headers to create clear structural divisions.

## Layout & Spacing

The layout philosophy follows a **Fluid Grid** system within a max-width container for desktop, transitioning to a single-column layout for mobile.

- **Rhythm:** An 8pt grid system governs all spatial relationships.
- **Desktop:** 12-column grid with 24px (1.5rem) gutters. Sidebars are typically fixed-width (240px-280px) to maximize the "Canvas" area for coding exercises.
- **Hierarchy:** Use spacious padding (2xl) for main dashboard sections to create a "premium" feel, while inner components (lists, tables) use tighter (sm to md) spacing to maintain utility.
- **Responsiveness:** Margins shrink from 48px on large desktops to 16px on mobile. Elements should reflow vertically, with the sidebar moving to a bottom navigation or a hamburger menu.

## Elevation & Depth

Depth is achieved through **Tonal Layering** and **Glassmorphism** rather than traditional heavy shadows.

- **Layer 0 (Background):** Deep charcoal (#0B0E14).
- **Layer 1 (Surfaces):** Slightly lighter slate (#161B22) with a 1px border (#30363D).
- **Layer 2 (Overlays/Modals):** Surfaces with a `backdrop-filter: blur(12px)` and 70% opacity. This creates a "frosted" effect that maintains context of the background.
- **Shadows:** Use extremely soft, diffused shadows (0px 8px 32px rgba(0,0,0,0.5)) to lift active cards or modals. 
- **AI Highlight:** Components featuring AI insights should use a subtle outer glow or "ring" using the Indigo-to-Violet gradient at low opacity.

## Shapes

The design system uses a generous rounding scale to balance the "hard" technical nature of code with a modern, approachable SaaS feel.

- **Primary Radius:** 12px (xl) for most standard components like buttons, input fields, and small cards.
- **Container Radius:** 16px (2xl) for large dashboard cards, modal containers, and main content areas.
- **Interactive States:** Buttons should remain consistent with primary radius, but code tags or "chips" may use a smaller 6px radius for better fit within text rows.

## Components

- **Buttons:** Primary buttons use the Indigo-to-Violet gradient with white text. Secondary buttons are "Ghost" style: #161B22 background with a gray-800 border.
- **Inputs:** Dark fields (#0B0E14) with a subtle 1px border. On focus, the border transitions to the primary Indigo accent with a 2px outer glow.
- **Cards:** Use #161B22 as the surface. Header sections within cards should be separated by a subtle gray-800 horizontal rule.
- **Chips/Badges:** Small, 12px text, Geist Mono, with a subtle background tint of their functional color (e.g., Success green at 10% opacity).
- **AI Assistant Widget:** A persistent floating action button or sidebar module featuring a glassmorphic background and a subtle pulsing gradient border to signify "active intelligence."
- **Code Editor:** Custom themed to match the #0B0E14 background, utilizing the primary accent colors for syntax highlighting.