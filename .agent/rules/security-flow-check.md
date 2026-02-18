---
trigger: always_on
---

Laravel Web Application | Development Security Framework
📌 DOCUMENT OVERVIEW
Project Type: Laravel Web Application
User Roles: 3 (Admin, Business/Client, End-User)
Core Modules: Authentication, Coupon Code System, Subscription Plans, Special Project Flows
Purpose: Establish mandatory security audit checkpoints for every development sprint, ensuring zero vulnerabilities before deployment.

🔴 SECTION 1 — AUTHENTICATION & AUTHORIZATION SECURITY
1.1 User Role-Based Access Control (RBAC)
Check ID Security Check Priority
AUTH-001 Verify each of the 3 user roles has strictly defined permissions with no overlap leakage CRITICAL
AUTH-002 Ensure middleware guards are applied on every route group per role CRITICAL
AUTH-003 Test horizontal privilege escalation — User A cannot access User B's resources of the same role CRITICAL
AUTH-004 Test vertical privilege escalation — Lower role cannot access higher role endpoints by manipulating request CRITICAL
AUTH-005 Validate that role assignment cannot be tampered via mass-assignment or form injection HIGH
AUTH-006 Ensure $fillable and $guarded are properly set on User model to prevent role manipulation HIGH
AUTH-007 Confirm Gate and Policy definitions exist for every resource action (view, create, update, delete) HIGH
AUTH-008 Audit that API tokens/sessions are scoped per role and cannot be interchanged HIGH
1.2 Login & Session Security
Check ID Security Check Priority
AUTH-009 Enforce rate limiting on login attempts (ThrottleRequests middleware) — max 5 attempts/minute CRITICAL
AUTH-010 Implement and verify account lockout after repeated failed attempts HIGH
AUTH-011 Validate session fixation protection is active (session regeneration on login) CRITICAL
AUTH-012 Confirm session timeout is configured (idle timeout ≤ 30 minutes) HIGH
AUTH-013 Ensure HttpOnly, Secure, and SameSite flags are set on all cookies CRITICAL
AUTH-014 Verify password hashing uses bcrypt or argon2id — never plaintext or MD5 CRITICAL
AUTH-015 Validate password reset tokens expire within 60 minutes and are single-use HIGH
AUTH-016 Ensure logout destroys session completely and invalidates tokens HIGH
AUTH-017 Test "Remember Me" token security — tokens stored hashed, rotated on use MEDIUM
🟠 SECTION 2 — COUPON CODE SYSTEM SECURITY
Check ID Security Check Priority
CPN-001 Validate coupon codes are generated with cryptographically secure random strings (min 12 chars) CRITICAL
CPN-002 Ensure coupon validation happens server-side ONLY — never trust client-side validation CRITICAL
CPN-003 Test coupon race condition — applying same coupon simultaneously in multiple requests CRITICAL
CPN-004 Verify single-use coupons are atomically marked as used (DB transaction + locking) CRITICAL
CPN-005 Test coupon stacking prevention — users cannot apply multiple exclusive coupons HIGH
CPN-006 Validate coupon cannot be brute-forced (rate limit coupon apply endpoint — max 10 attempts/hour) HIGH
CPN-007 Ensure expired coupons are rejected with proper timestamp validation (server time, not client) HIGH
CPN-008 Verify coupon discount calculations happen server-side; manipulated discount values in requests are ignored CRITICAL
CPN-009 Test that coupon usage limits per-user and global limits are enforced correctly HIGH
CPN-010 Audit coupon codes are not exposed in URLs, logs, or client-side JavaScript MEDIUM
CPN-011 Ensure role-specific coupons cannot be used by unauthorized roles HIGH
CPN-012 Validate coupon amount cannot produce negative totals (free money vulnerability) CRITICAL
🟡 SECTION 3 — SUBSCRIPTION PLAN SECURITY
Check ID Security Check Priority
SUB-001 Verify subscription plan IDs/prices cannot be manipulated in client requests CRITICAL
SUB-002 Ensure plan pricing is always fetched from database/payment gateway — never from frontend payload CRITICAL
SUB-003 Validate webhook signatures from payment gateway (Stripe/Razorpay) to prevent spoofed events CRITICAL
SUB-004 Test subscription downgrade/upgrade flow for permission leakage (features of higher plan accessible after downgrade) CRITICAL
SUB-005 Ensure cancelled subscriptions revoke access at period end, not immediately grant extended access HIGH
SUB-006 Verify free trial abuse prevention — same user/email/card cannot re-register for trial HIGH
SUB-007 Audit that subscription status checks happen via middleware on every protected route, not cached indefinitely HIGH
SUB-008 Test payment failure handling — access is properly restricted when payment fails HIGH
SUB-009 Validate subscription receipts and invoices cannot be accessed by other users HIGH
SUB-010 Ensure subscription metadata is not leaking plan details of other users through API responses MEDIUM
SUB-011 Verify idempotency on payment processing — duplicate webhook events don't create duplicate charges CRITICAL
🟢 SECTION 4 — INPUT VALIDATION & DATA SECURITY
Check ID Security Check Priority
INP-001 Validate ALL user inputs server-side using Laravel Form Request classes CRITICAL
INP-002 Test for SQL injection on every form field, search parameter, and filter CRITICAL
INP-003 Verify Eloquent ORM/query builder is used everywhere — no raw queries with unescaped input CRITICAL
INP-004 Test for XSS (Cross-Site Scripting) on every output — ensure {{ }} (escaped) is used, not {!! !!} unless sanitized CRITICAL
INP-005 Validate CSRF tokens are present and verified on all POST/PUT/PATCH/DELETE requests CRITICAL
INP-006 Test file upload security — validate MIME types server-side, restrict extensions, limit file size, store outside webroot CRITICAL
INP-007 Ensure mass assignment protection is active on every model HIGH
INP-008 Validate email inputs against injection (header injection in contact forms) HIGH
INP-009 Test for IDOR (Insecure Direct Object Reference) on all resource endpoints CRITICAL
INP-010 Sanitize and validate all JSON/API payloads — reject unexpected fields HIGH
🔵 SECTION 5 — SPECIAL PROJECT FLOWS SECURITY
Check ID Security Check Priority
FLW-001 Audit multi-step flow state management — ensure steps cannot be skipped by direct URL access CRITICAL
FLW-002 Validate flow state integrity — signed/encrypted tokens to prevent tampering between steps HIGH
FLW-003 Test flow timeout — abandoned flows expire and don't leave dangling resources MEDIUM
FLW-004 Ensure flow-specific data is isolated per user session — no cross-user data leakage CRITICAL
FLW-005 Verify role-based flow access — each user role can only initiate flows permitted to them HIGH
FLW-006 Test concurrent flow execution — user running same flow in multiple tabs doesn't corrupt data HIGH
FLW-007 Audit flow completion callbacks/webhooks for authentication and authorization HIGH
FLW-008 Validate that flow outputs (generated files, reports) are access-controlled per user HIGH
🟣 SECTION 6 — API & INFRASTRUCTURE SECURITY
6.1 API Security
Check ID Security Check Priority
API-001 Enforce API rate limiting per user/role (configurable via RateLimiter in RouteServiceProvider) CRITICAL
API-002 Validate API authentication on every endpoint (Sanctum/Passport tokens) CRITICAL
API-003 Ensure API responses don't leak sensitive data (passwords, tokens, internal IDs, stack traces) CRITICAL
API-004 Verify API versioning is implemented to prevent breaking changes from exposing old vulnerabilities MEDIUM
API-005 Test CORS configuration — only allowed origins, methods, and headers HIGH
API-006 Ensure JSON responses use proper content-type headers to prevent MIME sniffing MEDIUM
API-007 Validate pagination limits to prevent denial-of-service via ?per_page=999999 HIGH
6.2 Server & Infrastructure
Check ID Security Check Priority
INF-001 Enforce HTTPS everywhere — redirect HTTP to HTTPS, set HSTS header CRITICAL
INF-002 Verify .env file is not accessible via web (return 403/404) CRITICAL
INF-003 Ensure APP_DEBUG=false in production CRITICAL
INF-004 Validate security headers: X-Content-Type-Options, X-Frame-Options, X-XSS-Protection, Content-Security-Policy HIGH
INF-005 Ensure database credentials, API keys, and secrets are in .env — never hardcoded CRITICAL
INF-006 Verify storage directories have proper permissions (no 777) HIGH
INF-007 Audit log files don't contain sensitive user data (passwords, tokens, card numbers) HIGH
INF-008 Ensure error pages are custom and don't expose framework version or stack traces MEDIUM
INF-009 Validate backup files and database dumps are not accessible via web HIGH
⚫ SECTION 7 — DATABASE & DATA PROTECTION
Check ID Security Check Priority
DAT-001 Encrypt sensitive fields at rest (PII, payment info) using Laravel's Crypt facade or $casts encrypted types CRITICAL
DAT-002 Ensure database user has minimum required privileges (no GRANT, DROP in production) HIGH
DAT-003 Validate soft-delete implementation doesn't leak deleted user data to active users HIGH
DAT-004 Audit database migrations for default values that could cause security issues MEDIUM
DAT-005 Test that database transactions are used for critical multi-step operations (payment + subscription) HIGH
DAT-006 Verify personal data export/deletion compliance (GDPR/privacy requirements) HIGH
🔶 SECTION 8 — DEVELOPMENT WORKFLOW SECURITY RULES
Pre-Commit Checklist (Every Developer Must Verify)
No hardcoded credentials, API keys, or secrets in code
All new routes have appropriate middleware (auth, role, throttle)
All new form inputs have server-side validation via Form Request
No {!! !!} used without explicit HTML sanitization
All new database queries use Eloquent/Query Builder (no raw unsanitized SQL)
All new file uploads validated for type, size, and stored securely
IDOR checks implemented on all new resource endpoints
Authorization policies created for all new models/resources
Sprint Security Review Protocol
Code Review: Every PR must be reviewed with security checklist above
Automated Scanning: Run composer audit + static analysis (Larastan/PHPStan) on every build
Dependency Check: Verify no known vulnerable packages via npm audit + composer audit
Penetration Testing: Conduct on every major release (role escalation, coupon abuse, subscription bypass)
Security Regression: All discovered vulnerabilities become permanent automated test cases
📊 AUDIT EXECUTION MATRIX
Audit Phase Frequency Responsible Sign-Off
Code-Level Security Review Every PR Developer + Reviewer Tech Lead
RBAC & Permission Audit Weekly Backend Lead Project Manager
Coupon & Subscription Abuse Testing Per Sprint QA + Security Tech Lead
Infrastructure Security Scan Bi-Weekly DevOps CTO
Full Penetration Test Pre-Release Security Team CTO + Client
Dependency Vulnerability Scan Daily (Automated) CI/CD Pipeline Auto-Alert
✅ COMPLIANCE SIGN-OFF
Every release must have documented sign-off confirming:

text

[ ] All CRITICAL checks passed
[ ] All HIGH checks passed or have documented exceptions
[ ] No known unpatched vulnerabilities in dependencies
[ ] Role-based access verified for all 3 user types
[ ] Coupon code system abuse-tested
[ ] Subscription flow integrity verified
[ ] Special project flows security-audited
Document Version: 1.0
Created By: Antigravity Security Team
Applicable To: All current and future development sprints
