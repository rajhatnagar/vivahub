# VivaHub - Comprehensive Project Documentation

## 1. Project Overview & Architecture

**VivaHub** is a premium, multi-tenant digital invitation builder platform constructed on the **Laravel API/MVC Framework**. It enables users and partner agencies to rapidly generate, customize, and publish stunning responsive mobile-friendly invitations across various categories (e.g., weddings, events).

The platform supports a robust Role-Based Access Control (RBAC) system, custom pricing tiers, agency credit wallets, secure checkout gateways (via Razorpay), and dynamic coupon integration.

---

## 2. User Roles & Permissions

VivaHub strictly enforces three distinct user roles throughout the application via Middleware sets and Blade Directives:

### 1. Administrator (Role 1)

- **Primary Function:** System oversight, template management, and financial auditing.
- **Capabilities:**
    - Create, upload, and toggle active Templates (Gallery).
    - Manage all platform Users and Partner Agencies.
    - Create and distribute global or role-restricted Coupon Codes.
    - Modify Subscription Plans, pricing, and active limits.
    - View all transactions, logs, and system metrics.
    - Bypass payment barriers during template testing.
    - Toggle UI themes (Day/Night modes).

### 2. Partner / Agency (Role 2)

- **Primary Function:** B2B Clients generating multiple invitations on behalf of their own customers.
- **Capabilities:**
    - Access to a specialized Partner Dashboard displaying "Active Credits".
    - Ability to purchase wholesale "Plans/Credits" (e.g., 50 Credits for a discounted rate).
    - Uses the Invitation Builder normally, but upon checkout, they bypass standard gateways natively if they possess enough credits.
    - Every published invitation automatically subtracts precisely **5 Credits** from their wallet.
    - Can apply "100% Off Agency Coupons" provided by Admins to bypass standard checkout entirely.

### 3. Standard User (Role 3)

- **Primary Function:** B2C Direct Customers creating a single personal invitation.
- **Capabilities:**
    - Standard registration and profile management.
    - Complete access to the 6-Step Digital Invitation Builder wizard.
    - Standard Checkout Gateway access utilizing Razorpay.
    - Can apply percentage or flat-discount coupons to individual templates.
    - Access to a standard "My Invitations" dashboard to view and manage their purchased products.

---

## 3. Core Features & Modules

### A. The 6-Step Invitation Builder

The central engine of the platform is located at `/resources/views/user/builder.blade.php`. It allows real-time input and instant visual previews across:

1. **Couple Details** (Names, parents, primary event dates).
2. **Event Scheduling** (Haldi, Mehendi, Sangeet, Wedding locations/times).
3. **Gallery** (Image uploads, cropped and previewed live).
4. **Music & Audio** (Uploading MP3 tracks to accompany the invitation).
5. **Final Settings & Downloads** (Customization tweaks and explicit download buttons).
6. **Checkout & Gateway Modal** (The finalizing step prompting payment).

### B. Dynamic Payments & "Dual-Button" Checkout

The checkout process utilizes dynamic Blade injection (`$isPartner` context variable) to seamlessly adapt to whoever is using it:

- **For Partners:** The modal displays two options: **Publish (-5 Credits)** alongside a dynamic **Pay With ₹** fallback button if their wallet expires.
- **For Users:** The modal displays standard Coupon Input validation and a unified **Pay with ₹** button integrated with Razorpay.
- _Security:_ Database `updateOrCreate` uses precise ID targeting (`$data['id']`) to prevent duplicate template overwrites from concurrent users.

### C. Coupon & Financial System

The system supports complex coupon mathematics executed entirely Server-Side to prevent client manipulation. Coupons can be:

- Assocaited strictly to Subscriptions vs. Individual Templates.
- Restricted by Role (e.g., Partner-Only codes).
- Flat amounts or Percentages.
- Actively tracked in `Admin Logs` for usage compliance.

---

## 4. Implementation Details

### Tech Stack

- **Backend:** Laravel (PHP 8.x)
- **Frontend Engine:** Blade Templating
- **Styling:** Vanilla CSS & Tailwind CSS (JIT Engine)
- **Database:** MySQL (Eloquent ORM)
- **Payments:** Razorpay API Integration

### UI/UX Paradigms

- **Absolute Decoupling:** The Builder utilizes `position: absolute !important` on desktop displays to enforce strict side-by-side (45% Form / 55% Preview) rendering without the risk of flex-box collapsing overlapping input fields.
- **Mobile First Action Bars:** On viewports under 768px, bottom navigation flows use `sticky` positioning heavily offset by `pb-32` padding variables so end-users can scroll through huge forms without elements hiding underneath the buttons.
- **Fallback Images:** Inline Javascript intercepts `img.onerror` states to gracefully replace 404 thumbnails with visually pleasing SVG placeholders, ensuring premium aesthetics even during database mismatches.

---

## 5. How to Use This Project (Workflows)

### Setting Up Locally

1. Clone the repository into your WAMP/XAMPP server root (e.g., `c:\wamp64\www\vivahub_laravel`).
2. Run `composer install` and `npm install`.
3. Configure your `.env` file with your local MySQL credentials and Razorpay test keys.
4. Run `php artisan migrate --seed` to scaffold the database.
5. Launch the application either via `php artisan serve` or directly through your WAMP Apache host `http://localhost/vivahub_laravel/public`.

### Standard Workflow — Creating an Invitation

- **Step 1:** Users navigate to `Template Gallery` and click **Use Template**.
- **Step 2:** The system initiates a drafted entity inside the database and locks the ID.
- **Step 3:** The user fills in the form fields. The mobile mockup on the right side of the screen updates via Javascript DOM reflection instantly.
- **Step 4:** Once complete, the user hits **Publish**.
- **Step 5:** The Checkout Modal overlays the Builder. Standard users enter a coupon (if applicable) and pay via Razorpay. Partners click the `Publish (-5 Credits)` button.
- **Step 6:** The system updates the Draft to `Published`, assigns a strict `expires_at` validity (e.g., +365 Days), and routes the user back to their dashboard.

### Admin Workflow — Uploading a New Template

- **Step 1:** Log into the Admin Portal (`/admin/dashboard`).
- **Step 2:** Navigate to `Templates` and hit **Upload Template**.
- **Step 3:** Pack the required HTML folder structures into a ZIP file and provide a preview Thumbnail.
- **Step 4:** The Laravel backend decompresses the asset, saves it cleanly to `public/assets/wedding-templates/`, logs the internal path to the Database, and instantly pushes the live design to the user-facing Gallery.

---

_Documentation automatically generated & verified against active source code architecture as of March 2026._
