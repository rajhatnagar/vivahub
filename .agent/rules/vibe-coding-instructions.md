---
trigger: always_on
---

⚡ RULE 1 — UI-TO-BACKEND COMPLETENESS MAP
"Every Pixel Has a Purpose. Every Purpose Needs a Backend."
When UI/design is provided, decompose every screen into atomic elements before writing a single line of code.

Mandatory Decomposition Per Screen:

text

STEP 1: Screenshot the screen
STEP 2: Number EVERY interactive + data element
STEP 3: Fill this for EACH element:

Element: [e.g., "Subscribe Now" button]
├── API: [POST /api/subscriptions — exists? built?]
├── Validation: [plan_id required, payment_method required]
├── Auth/Role: [Only Role 2 & 3 can access, middleware?]
├── Business Logic: [Check eligibility, process payment, activate plan]
├── DB Operations: [Create subscription record, update user tier]
├── Response: [Success → redirect to dashboard, Fail → show error]
├── Side Effects: [Send welcome email, trigger webhook, clear cache]
├── Loading State: [Spinner on button, disable double-click]
├── Error State: [Payment failed toast, validation inline errors]
└── Empty State: [N/A for button — but what if no plans exist?]
The 15-Point Backend Trap Detector — Run Per Screen:

# Check Status

1 Every button has an API endpoint created & tested □
2 Every form has server-side FormRequest validation □
3 Every dropdown/select has a data-source API □
4 Every list has pagination, sort, filter & search backend □
5 Every status label has a state-machine in the model □
6 Every toggle/switch has a PATCH endpoint with auth □
7 Every file upload has backend MIME validation + storage □
8 Every counter/badge has an optimized count query □
9 Every delete has soft-delete, cascade check & confirmation □
10 Every notification on screen has Event+Listener+Queue □
11 Every navigation link has a route with correct middleware □
12 Every modal's action has its own dedicated endpoint □
13 Every price/amount is calculated SERVER-SIDE only □
14 Every timestamp displays in user's timezone (converted) □
15 Every "export/download" has a queued job for large data □
🚫 HARD STOP: If any checkbox is empty, you are NOT done with that screen.

👁️ RULE 2 — USER PSYCHOLOGY FIRST
"The User Doesn't Care About Your Code. They Care About Their Experience."
Before building, become each user role for 15 minutes. Narrate the experience out loud or in writing.

The Role-Walk Protocol:

text

FOR EACH OF THE 3 USER ROLES, DOCUMENT:

"I am [Role Name]. I just logged in."
→ What do I see first? Is it useful to ME?
→ I want to [primary action]. How many clicks? (Target: ≤3)
→ I filled a form wrong. What happens? Do I know what to fix?
→ I completed an action. Do I get confirmation? Do I know what's next?
→ I'm looking for [specific data]. Can I find it in <10 seconds?
→ I'm on my phone. Does everything still work?
→ My internet is slow. Do I see a loading state or a blank screen?
→ I'm new here. Is there any guidance/tooltip/empty-state help?
→ I made a mistake. Can I undo it? How?
→ I got an error. Does it tell me what went wrong AND what to do?
User Friction Elimination Matrix:

Friction Type Rule Implementation
Confusion Every action = immediate feedback Toast notifications, inline validation, state changes
Dead Ends Every screen has forward + backward path Breadcrumbs, back buttons, clear CTAs
Blind Waiting Never let user stare at nothing Skeleton loaders, progress bars, spinners
Mysterious Errors Error = What happened + What to do "Payment failed. Please check your card details and retry."
Data Loss Anxiety Auto-save long forms every 30s Draft system with localStorage + server sync
Access Confusion Explain WHY access is denied "Upgrade to Pro plan to access this feature" — not just 403
Overwhelm Progressive disclosure Show essential first, details on expand/click
Trust Issues Confirm destructive actions "Delete this project? This cannot be undone. [Cancel] [Delete]"
Golden Test: After building, hand your phone to someone non-technical. Watch them use the feature silently. Every point where they hesitate, squint, or tap wrong = a bug you must fix.

🔍 RULE 3 — DEEP IMPACT ANALYSIS (DIA)
"Touching One Wire Can Short-Circuit the Entire Board."
MANDATORY: Complete this analysis BEFORE writing any code. Get Tech Lead sign-off.

text

╔══════════════════════════════════════════════════╗
║ DEEP IMPACT ANALYSIS — [Feature Name] ║
╠══════════════════════════════════════════════════╣
║ ║
║ 1. WHAT AM I CHANGING? ║
║ Models: **\*\***\_\_\_**\*\*** ║
║ Tables: **\*\***\_\_\_**\*\*** ║
║ APIs: **\*\***\_\_\_**\*\*** ║
║ Views: **\*\***\_\_\_**\*\*** ║
║ ║
║ 2. WHAT FEATURES DOES THIS TOUCH? ║
║ □ Authentication/Login flow ║
║ □ User registration/profile ║
║ □ Role permissions (which roles?) ║
║ □ Coupon code system ║
║ □ Subscription/billing ║
║ □ Payment processing ║
║ □ Special project flows ║
║ □ Notifications (email/in-app/SMS) ║
║ □ Dashboard stats/counters ║
║ □ Reports/exports ║
║ □ Search/filter functionality ║
║ □ Third-party integrations ║
║ □ Admin management panels ║
║ ║
║ 3. ROLE IMPACT ASSESSMENT: ║
║ Role 1 (Admin): [What changes for them?] ║
║ Role 2 (Client): [What changes for them?] ║
║ Role 3 (User): [What changes for them?] ║
║ Guests: [Any impact?] ║
║ ║
║ 4. DATA IMPACT: ║
║ Existing records affected? [Migration plan] ║
║ Cache invalidation needed? [Which keys?] ║
║ Search index rebuild needed? [Yes/No] ║
║ ║
║ 5. PERFORMANCE IMPACT: ║
║ New queries: [Count + complexity] ║
║ N+1 risk: [Where? Use eager loading] ║
║ Heavy task: [Queue it? Which queue?] ║
║ New DB indexes needed? [Which columns?] ║
║ ║
║ 6. BREAKING CHANGE RISK: ║
║ API response structure changing? [Version it]║
║ Database column renamed/removed? [Plan] ║
║ Config/ENV changes? [Document] ║
║ ║
║ 7. DEPENDENCY CHAIN: ║
║ Must Feature X be built first? [Yes/No] ║
║ Will Feature Y break without this? [Yes/No] ║
║ ║
║ SIGN-OFF: **\*\***\_**\*\*** DATE: \***\*\_\_\_\*\*** ║
╚══════════════════════════════════════════════════╝
Real-World Example:

text

Feature: "Allow coupon codes on subscription upgrades"

IMPACT CHAIN DISCOVERED:
├── Coupon Module: Must support "subscription-only" coupon type → new DB column
├── Subscription: Upgrade price calculation must accept discount → service change
├── Payment Gateway: Charge amount changes → webhook payload changes
├── Invoice: Must reflect coupon on recurring invoice → template change
├── Admin: Must see coupon usage per subscription → new report query
├── Role 3 User: Sees discounted price on upgrade page → frontend change
├── Role 1 Admin: Must be able to create subscription-specific coupons → form change
├── Existing Coupons: Must NOT accidentally apply to subscriptions → scope filter needed
└── Revenue Reports: Discounted subscriptions skew MRR → calculation update

WITHOUT DIA → Developer builds coupon-on-upgrade logic only.
Invoices show wrong amounts. Reports break. Admin can't track it.
9 CASCADING BUGS from 1 "simple" feature.
✅✅ RULE 4 — DOUBLE VERIFICATION PROTOCOL
"Trust Nothing. Verify Everything. Then Verify Again Differently."
VERIFICATION ROUND 1 — BUILD VERIFICATION (Self-Test)

text

Functional Completeness:
□ Tested as Role 1 → full flow works start to finish
□ Tested as Role 2 → correct data visibility & permissions
□ Tested as Role 3 → correct restrictions & user experience
□ Tested as Guest → properly redirected/blocked
□ Happy path works with valid data
□ Sad path works — every invalid input shows proper error
□ Edge cases — empty data, max-length, special chars, zero values
□ Concurrent usage — two tabs, same action = no corruption
□ Mobile responsive — all breakpoints tested
□ Page load < 2 seconds, API response < 500ms

Backend Integrity:
□ Data saves correctly in all related tables
□ Relationships/foreign keys intact
□ Transactions used for multi-step DB operations
□ Queued jobs execute successfully
□ Emails/notifications trigger correctly
□ File uploads stored in correct path with correct permissions
VERIFICATION ROUND 2 — BLAST RADIUS REGRESSION (Impact Test)

text

□ Run FULL automated test suite — 100% pass (not just new tests)
□ Manually test top 3 related features (from DIA Section 2)
□ Verify dashboard numbers/counters still accurate for ALL roles
□ Verify coupon system still works (if pricing/billing changed)
□ Verify subscription flows still work (if user/role logic changed)
□ Verify notifications still trigger (if event flow changed)
□ Check Laravel logs — ZERO new errors/warnings
□ Check browser console — ZERO new JS errors on any page
□ Check database — no orphaned records, no integrity violations
□ Check API responses — no unintended structure changes
PR Verification Stamp (REQUIRED in every Pull Request):

Markdown

## ✅ DOUBLE VERIFICATION COMPLETE

### V1 — Build Verification

- Role 1 tested: ✅ [screenshot]
- Role 2 tested: ✅ [screenshot]
- Role 3 tested: ✅ [screenshot]
- Edge cases: [list what was tested]
- Mobile: ✅ [screenshot]

### V2 — Regression Verification

- Test suite: 156/156 PASS ✅
- Related feature [Coupons]: ✅ working
- Related feature [Subscriptions]: ✅ working
- Related feature [Notifications]: ✅ working
- Error logs: ✅ clean
- Console errors: ✅ none
  🏗️ RULE 5 — FULL-STACK COMPLETENESS DEFINITION
  A feature is DONE only when ALL layers exist:

text

DATABASE □ Migration (up+down) □ Seeder □ Indexes □ Relationships
MODEL □ Fillable □ Casts □ Scopes □ Accessors □ Relations
VALIDATION □ FormRequest □ Custom rules □ Error messages
AUTH □ Policy □ Gate □ Middleware □ Role-check
SERVICE □ Business logic isolated □ Testable □ Reusable
CONTROLLER □ Thin □ Delegates to service □ Returns proper response
API □ Versioned □ Consistent format □ Proper HTTP status codes
FRONTEND □ Data binding □ Loading state □ Error state □ Empty state
QUEUE □ Heavy tasks async □ Retry logic □ Failed-job handling
EVENTS □ Dispatched □ Listeners registered □ Notifications sent
TESTS □ Unit □ Feature □ Auth □ Validation □ Edge cases
DOCS □ API documented □ ENV changes noted □ Migration notes
🔄 RULE 6 — THE THINK→PLAN→BUILD→VERIFY CYCLE
text

THINK (20 min) → Decompose UI, walk as 3 users, list edge cases
PLAN (15 min) → Complete DIA, get approval, define API contracts
BUILD (varies) → Follow completeness definition, commit small & logical
VERIFY (25 min) → Round 1: functional, Round 2: regression
SHIP (only if) → Both verifications pass, PR stamp completed
NEVER skip THINK and PLAN to "save time." Skipping 35 minutes of planning creates 35 HOURS of debugging.

📏 DAILY SELF-SCORE

# Question ✓/✗

1 Did I map every UI element to backend before coding?
2 Did I experience the flow as all 3 user roles?
3 Did I complete Deep Impact Analysis?
4 Did I handle all error, loading & empty states?
5 Did I verify twice using two different methods?
6 Would a first-time user complete this flow without help?
7 Did I check that no existing feature broke?
Score 7/7 = Ship. Below 7 = Fix first.
