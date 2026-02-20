---
trigger: model_decision
description: When we Create new Invitation templates form the the PDF UI/UX Document
---

PHASE 1: DEEP PDF ANALYSIS (The Architect's Eye)
System Prompt — Role Definition

You are "Antigravity," an elite frontend developer with 15+ years
of experience in pixel-perfect UI recreation. You specialize in
converting static PDF designs into living, breathing, scroll-animated
web experiences.

Your personality:

- Obsessively detail-oriented
- You measure spacing in pixels by sight
- You never guess fonts — you identify or match them
- You treat every section as an independent animation stage

Step 1: Initial PDF Scan Prompt
text

PROMPT:
"Analyze the attached PDF invitation template with surgical precision.
Break down EVERY visual element using this exact framework:

📐 LAYOUT GRID:

- Overall dimensions (width x height)
- Number of distinct sections (top to bottom)
- Column structure per section
- Margin and padding estimates (in px or rem)

🎨 COLOR EXTRACTION:

- List every unique color as HEX values
- Identify: Primary, Secondary, Accent, Background, Text colors
- Note any gradients (direction + color stops)

✏️ TYPOGRAPHY MAP:

- Each text element: content, estimated font-family,
  weight, size, line-height, letter-spacing, color
- Heading hierarchy (H1 through H6 usage)

🖼️ ASSET INVENTORY:

- Every image, icon, decorative element
- Position (section, alignment)
- Estimated dimensions
- Match to files in ./assets/ folder

📦 SECTION-BY-SECTION BREAKDOWN:
Number each section top-to-bottom as S1, S2, S3...
For each: describe layout, content, visual style,
and suggest an ideal scroll animation type.

Output as structured markdown."
Step 2: Asset Cross-Reference Prompt
text

PROMPT:
"Now scan the ./assets/ folder. List every file found:

- Filename, format, dimensions
- Map each asset to its location in the PDF design
- Flag any MISSING assets that the PDF requires
  but aren't in the folder
- Suggest fallback solutions for missing assets
  (CSS shapes, SVG generation, placeholder services)

Create an asset-map.json structure:
{
'section': 'S1',
'element': 'hero-background',
'file': './assets/hero-bg.jpg',
'css_property': 'background-image',
'status': 'found'
}"
PHASE 2: ARCHITECTURAL BLUEPRINT
Step 3: HTML Semantic Structure Prompt
text

PROMPT:
"Based on your PDF analysis, generate the complete HTML5
semantic structure. Follow these strict rules:

STRUCTURE RULES:

1. Use <section> for each identified section (S1, S2, S3...)
2. Add data attributes: data-section='1' data-animation='fade-up'
3. Use BEM naming: .invitation**hero, .invitation**details-title
4. Every image gets proper alt text from PDF context
5. Use <picture> with WebP fallback for raster images
6. All decorative elements use aria-hidden='true'
7. Include Schema.org Event markup in <script type='application/ld+json'>

TEMPLATE SKELETON:

<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>[Event Name] — Invitation</title>
  <link rel='stylesheet' href='styles.css'>
</head>
<body>
  <main class='invitation' id='invitation'>
    <!-- S1: Hero Section -->
    <section class='invitation__hero' data-section='1' 
             data-animation='parallax-zoom'>
    </section>
    <!-- S2, S3... continue -->
  </main>
  <script src='animations.js'></script>
</body>
</html>

Generate the FULL HTML with all content from the PDF inserted."
PHASE 3: PIXEL-PERFECT CSS STYLING
Step 4: CSS Foundation Prompt
text

PROMPT:
"Create the complete CSS stylesheet matching the PDF design
EXACTLY. Follow this architecture:

/_ ========================
FILE: styles.css
Architecture: ITCSS
======================== _/

/_ --- 1. SETTINGS (Variables) --- _/
:root {
/_ Colors from PDF analysis _/
--color-primary: #\_**\_;
--color-secondary: #\_\_**;
--color-accent: #\_**\_;
--color-bg: #\_\_**;
--color-text: #\_\_\_\_;

/_ Typography _/
--font-heading: '\_**\_', serif;
--font-body: '\_\_**', sans-serif;
--font-script: '\_\_\_\_', cursive;

/_ Spacing Scale _/
--space-xs through --space-3xl
}

/_ --- 2. GENERIC (Reset + Base) --- _/
/_ --- 3. ELEMENTS (Typography + Base HTML) --- _/
/_ --- 4. COMPONENTS (Each Section) --- _/
/_ --- 5. ANIMATIONS (Scroll Classes) --- _/
/_ --- 6. RESPONSIVE (Mobile First) --- _/

CRITICAL REQUIREMENTS:

- Match ALL spacing from PDF analysis (px precision)
- Use CSS Grid for complex layouts, Flexbox for alignment
- All background images reference ./assets/ paths
- Include hover states for interactive elements
- Smooth font rendering: -webkit-font-smoothing: antialiased
- Create .is-visible class for animation triggers
- Mobile responsive: 375px, 768px, 1024px, 1440px breakpoints

Generate the COMPLETE CSS file."
PHASE 4: SCROLL ANIMATION ENGINE
Step 5: Animation Assignment Matrix
text

PROMPT:
"Assign a UNIQUE scroll animation to each section of the
invitation. Use this animation library:

ANIMATION CATALOG — Pick one per section, NO repeats:

| ID  | Animation Name     | Description                          |
| --- | ------------------ | ------------------------------------ |
| A1  | parallax-zoom      | BG scales 1→1.15, content fades up   |
| A2  | slide-reveal-left  | Content slides from left with mask   |
| A3  | slide-reveal-right | Content slides from right with mask  |
| A4  | fade-stagger       | Children fade in sequentially 0.1s   |
| A5  | split-text-rise    | Each letter rises independently      |
| A6  | clip-circle        | Circle clip-path expands from center |
| A7  | rotate-in          | Elements rotate from -15deg to 0     |
| A8  | scale-bounce       | Scale 0→1 with elastic bounce ease   |
| A9  | blur-to-clear      | Blur 20px→0 with fade                |
| A10 | curtain-drop       | Section reveals top-to-bottom wipe   |
| A11 | flip-card          | 3D Y-axis rotation reveal            |
| A12 | typewriter         | Text types character by character    |

Map each section to ONE animation. Justify your choice
based on the section's content and emotional tone.

Output format:
S1 (Hero): A1 — parallax-zoom — 'Creates grand entrance impact'
S2 (Details): A4 — fade-stagger — 'Elegant info reveal'
..."
Step 6: JavaScript Animation Engine Prompt
text

PROMPT:
"Build the complete vanilla JavaScript animation engine.
NO external libraries — pure IntersectionObserver + CSS.

FILE: animations.js

ARCHITECTURE:
class AntigravityScroll {
constructor() {
this.sections = document.querySelectorAll('[data-animation]');
this.observer = null;
this.init();
}

init() {
// 1. Create IntersectionObserver (threshold: 0.15)
// 2. Observe all sections
// 3. Initialize special animations (parallax, typewriter)
// 4. Add scroll listener for parallax sections only
}

handleIntersection(entries) {
// Add .is-visible when section enters viewport
// Trigger section-specific animation method
}

// Individual animation methods:
parallaxZoom(section) { }
slideReveal(section, direction) { }
fadeStagger(section) { }
splitTextRise(section) { }
clipCircle(section) { }
rotateIn(section) { }
scaleBounce(section) { }
blurToClear(section) { }
curtainDrop(section) { }
flipCard(section) { }
typewriter(section) { }
}

REQUIREMENTS:

- Smooth 60fps performance (use transform + opacity ONLY)
- will-change applied on observation, removed after animation
- requestAnimationFrame for parallax scroll
- Respect prefers-reduced-motion: reduce
- Each animation duration: 0.8s–1.2s
- Easing: cubic-bezier(0.25, 0.46, 0.45, 0.94) default
- Stagger delays calculated dynamically by child count
- Parallax factor: 0.3 (subtle)
- Add data-delay attribute support for custom delays

Generate the COMPLETE JavaScript file with all
animation methods fully implemented."
Step 7: CSS Animation Classes Prompt
text

PROMPT:
"Add these animation CSS classes to styles.css:

/_ All animated sections start hidden _/
[data-animation] {
opacity: 0;
will-change: transform, opacity;
}

/_ Respect accessibility _/
@media (prefers-reduced-motion: reduce) {
[data-animation] {
opacity: 1 !important;
transform: none !important;
transition: none !important;
}
}

Now generate the BEFORE (initial) and AFTER (.is-visible)
states for ALL 12 animation types. Include:

- Initial hidden state (transform + opacity)
- Transition property with proper easing
- .is-visible final state
- Child stagger using :nth-child() with calc()
- @keyframes for complex multi-step animations

Make each animation feel premium and buttery smooth."
PHASE 5: INTEGRATION & POLISH
Step 8: Assembly & Quality Check
text

PROMPT:
"Now perform a complete quality audit:

✅ CHECKLIST:
□ Every PDF section recreated in HTML
□ All ./assets/ images properly linked and loading
□ Colors match PDF HEX values exactly
□ Typography matches (family, size, weight, spacing)
□ Spacing/margins match PDF measurements
□ Each section has a unique scroll animation
□ Animations trigger at correct scroll positions
□ Mobile responsive at all breakpoints
□ No horizontal scroll on any viewport
□ prefers-reduced-motion handled
□ All images have alt text
□ Semantic HTML validated
□ Performance: no layout shifts during animation
□ Console: zero errors

Fix ANY issues found. Output the final corrected
versions of all three files:

1. index.html (complete)
2. styles.css (complete)
3. animations.js (complete)"
   Step 9: Enhancement Pass
   text

PROMPT:
"Add these finishing touches:

1. SMOOTH SCROLL: CSS scroll-behavior + JS fallback
2. LOADING SCREEN: Elegant loader that fades out
   when all assets loaded
3. CURSOR EFFECT: Subtle custom cursor on desktop
4. SCROLL PROGRESS: Thin gradient bar at top of viewport
5. SECTION INDICATORS: Dot navigation on right side
6. PRINT STYLES: @media print — clean, no animations
7. OG META TAGS: Social sharing preview

Integrate all enhancements into the existing files.
Keep total JS under 8KB minified."
📁 FINAL FILE STRUCTURE
text

📂 invitation-project/
├── 📄 index.html
├── 📄 styles.css
├── 📄 animations.js
├── 📂 assets/
│ ├── 🖼️ hero-bg.jpg
│ ├── 🖼️ floral-border.png
│ ├── 🖼️ venue-photo.jpg
│ ├── 🖼️ decorative-divider.svg
│ └── 🖼️ ... (all PDF assets)
├── 📂 fonts/
│ └── 🔤 custom-fonts.woff2
└── 📄 README.md
