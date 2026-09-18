# Aureus Ad Cycler

> **Prestige Advertising Traffic Exchange & Automated FIFO Cycler Engine (150% ROI)**

Aureus Ad Cycler is a web platform built on Laravel 13 and Tailwind CSS, pairing directory advertising credits with an automated, race-condition-safe First-In, First-Out (FIFO) cycler queue engine.

---

## 🌟 Core Functional Architecture

### 1. Dual-Balance Ledger & Wallets
- **Purchase Balance (`purchase_balance`):** Dedicated funds for purchasing advertising packs.
- **Earnings Balance (`earnings_balance`):** Segregated balance for cycler ROI payouts and directory revenue, available for withdrawal or reinvestment.
- **Ad Credits (`ad_credits`):** Utility token awarded with every pack purchase, redeemable to drive targeted impressions across member campaigns.
- **AppSec Hardened:** Balances are non-mass-assignable (`$fillable = ['user_id']`), preventing parameter tampering (CWE-915).
- **Double-Entry Audit Trail:** All movements generate immutable records in the `transactions` ledger.

### 2. High-Frequency FIFO Cycler Engine
- **Atomic Operations:** Balance deductions, queue progression, and ROI disbursements are wrapped in database transactions using pessimistic row-locking (`lockForUpdate()`).
- **Composite Indexing:** The FIFO queue is optimized via composite index `idx_cycler_fifo` (`[ad_pack_tier_id, status, id ASC]`).
- **Official Pack Tiers:**
  - **Tier I:** $10.00 | 1,000 Ad Credits | 2 Downstream Required | **$15.00 Payout (150% ROI)**
  - **Tier II:** $25.00 | 3,000 Ad Credits | 2 Downstream Required | **$37.50 Payout (150% ROI)**
  - **Tier III:** $50.00 | 7,500 Ad Credits | 2 Downstream Required | **$75.00 Payout (150% ROI)**

### 3. Member Directory Traffic Exchange
- **Campaign Creation:** Members create text or banner promotions with custom headlines and destination URLs.
- **Credit Allocation:** Real-time credit transfers from user wallets to campaigns.
- **Impression Telemetry:** Real-time impression debits and auto-depletion/reactivation lifecycles.
- **Safe Click Telemetry:** Open-redirect prevention with URL validation and IPv4/IPv6 interaction audit logging.

### 4. White & Gold Luxury UI/UX Design System
- **Color Palette:** Pure White (`#FFFFFF`), Light Slate (`#F8FAFC`), Champagne Gold (`#D4AF37`), Metallic Gold (`#C5A059`), and Obsidian Slate (`#0F172A`).
- **Typography:** Cormorant Garamond (Prestige Serif) + Plus Jakarta Sans (Clean Modern Sans-Serif).
- **Responsive Architecture:** Sticky top navigation with real-time balance indicators and accessible off-canvas hamburger drawer.
- **Design Atlas:** Dedicated local route at `/browser` showcasing tokens, typography, and live widgets.

---

## 🚀 Installation & Local Setup

### Prerequisites
- **PHP:** 8.3+
- **Composer:** 2.x
- **Node.js:** 20+ & npm
- **SQLite** or MySQL / PostgreSQL

### Quickstart

```powershell
# 1. Clone repository
git clone https://github.com/david44220/antigravityaureus.git
cd antigravityaureus

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies & compile assets
npm install
npm run build

# 4. Configure environment
cp .env.example .env
php artisan key:generate

# 5. Run database migrations & seed demo tiers/user
touch database/database.sqlite
php artisan migrate --seed

# 6. Start development server
php artisan serve
```

Access the application in your browser at `http://localhost:8000`.

---

## 🧪 Automated Testing Suite

The application includes an automated feature test suite verifying FIFO queue concurrency, row-locking integrity, double-entry ledger balance, and UI access control:

```powershell
php artisan test
```

```json
{"tool":"phpunit","result":"passed","tests":14,"passed":14,"assertions":48}
```

---

## 🗺️ Route Overview

| Method | URI | Description | Middleware |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | Public Luxury Landing Page | `web` |
| `GET` | `/directory` | Public Traffic Directory Exchange | `web` |
| `GET` | `/directory/click/{ad}` | Secure Click Telemetry & Redirection | `web` |
| `GET` | `/login` | Local Environment Demo Authenticator | `web` |
| `GET` | `/browser` | Luxury UI Component Atlas | `web` (Local Only) |
| `GET` | `/dashboard` | Member Portfolio & Active Positions | `auth` |
| `GET` | `/ad-packs` | Pack Storefront & Cycler Enrollment | `auth` |
| `POST` | `/ad-packs/buy` | Atomic Pack Purchase Action | `auth` |
| `GET` | `/cycler` | Live FIFO Queue Progression Visualizer | `auth` |
| `GET` | `/wallet` | Ledger Balances & Transaction Log | `auth` |
| `POST` | `/wallet/deposit` | Purchase Balance Deposit | `auth` |
| `GET` | `/ads` | Campaign Management & Credit Allocator | `auth` |
| `POST` | `/ads` | Create New Ad Campaign | `auth` |

---

## 🛡️ Security Hardening

- **Pessimistic Concurrency Locking:** Strict prevention of double-spend exploits under high concurrency via database row locks (`lockForUpdate()`).
- **Strict Authorization:** Laravel Policies protect wallet operations, campaign ownership, and credit allocation.
- **Open-Redirect Hardening:** Directory click handler validates target URLs before outbound dispatch.
- **Environment Shielding:** Diagnostic showcases (`/browser`) and simulation authenticators strictly abort with `403 Forbidden` outside local environments.

---

## 📄 License

The Aureus Ad Cycler platform is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
