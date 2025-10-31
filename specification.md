# Job Description: Laravel IDEs & Dev Tools Public API

## 🎯 Goal
Build a public REST API in **Laravel** that provides information about modern **developer tools and IDEs** (e.g., Cursor, Claude Code, Windsurf, Codex CLI, etc.).

The API should serve structured, filterable data about:
- Tools (name, vendor, license, etc.)
- Versions (version numbers, release dates, changelogs)
- Pricing plans (free/paid tiers, currencies)

This project will be used as a **demo API** for a Laravel tutorial aimed at developers outside the Laravel ecosystem — showcasing Laravel’s power for building clean, maintainable APIs.

---

## 🧱 Technical Requirements

- Framework: **Laravel 11+**
- Database: **MySQL or PostgreSQL**
- PHP: **8.2+**
- Use **Eloquent models, migrations, and seeders**
- Use **API Resources** for clean JSON output
- Include **query filters** and **caching** for list endpoints
- Include **API documentation (OpenAPI or simple Markdown readme)**
- The API should be **read-only** (no authentication needed for now)

---

## 🗂️ Database Schema

### Table: `vendors`
| Column | Type | Notes |
|--------|------|-------|
| id | bigint, PK |  |
| name | string, unique | Vendor name (e.g., Cursor, Anthropic) |
| website_url | string, nullable |  |
| contact_email | string, nullable |  |
| created_at / updated_at | timestamps |  |

---

### Table: `tools`
| Column | Type | Notes |
|--------|------|-------|
| id | bigint, PK |  |
| vendor_id | FK → vendors.id, nullable |  |
| name | string, unique | Tool name |
| slug | string, unique | For API routes |
| category | enum(`IDE`,`Editor`,`CLI`,`Plugin`) |  |
| license_type | enum(`proprietary`,`oss`,`freemium`) |  |
| website_url | string, nullable |  |
| repo_url | string, nullable |  |
| initial_release_date | date, nullable |  |
| short_description | string, nullable |  |
| active | boolean, default true |  |
| tags | json, nullable | e.g. ["ai-assisted","vscode-base"] |
| languages | json, nullable | e.g. ["js","ts","php","py"] |
| integrations | json, nullable | e.g. ["github","openai","anthropic"] |
| meta | json, nullable | Flexible extra data |
| created_at / updated_at | timestamps |  |

---

### Table: `versions`
| Column | Type | Notes |
|--------|------|-------|
| id | bigint, PK |  |
| tool_id | FK → tools.id |  |
| version | string | e.g. 0.43.1 |
| release_channel | enum(`stable`,`beta`,`insider`,`canary`), default `stable` |  |
| release_date | date |  |
| eol_date | date, nullable |  |
| lts | boolean, default false |  |
| changelog_url | string, nullable |  |
| download_url | string, nullable |  |
| notes | json, nullable | e.g. ["Added AI autocomplete", "Bug fixes"] |
| created_at / updated_at | timestamps |  |
| UNIQUE(tool_id, version) | constraint |  |

---

### Table: `pricing_plans`
| Column | Type | Notes |
|--------|------|-------|
| id | bigint, PK |  |
| tool_id | FK → tools.id |  |
| name | string | e.g. Free, Pro, Team |
| billing_period | enum(`monthly`,`yearly`,`one_time`) |  |
| tier | enum(`free`,`paid`) |  |
| features | json, nullable | Feature flags/limits |
| deprecated | boolean, default false |  |
| created_at / updated_at | timestamps |  |

---

### Table: `prices`
| Column | Type | Notes |
|--------|------|-------|
| id | bigint, PK |  |
| pricing_plan_id | FK → pricing_plans.id |  |
| currency | char(3) | e.g. USD, EUR |
| amount_decimal | decimal(10,2) | e.g. 20.00 |
| region | string, nullable | e.g. US, EU, IN |
| notes | string, nullable |  |
| created_at / updated_at | timestamps |  |
| UNIQUE(pricing_plan_id, currency, region) | constraint |  |

---

## 🧩 Eloquent Relationships

- **Vendor**
  - `hasMany(Tool::class)`
- **Tool**
  - `belongsTo(Vendor::class)`
  - `hasMany(Version::class)`
  - `hasMany(PricingPlan::class)`
- **Version**
  - `belongsTo(Tool::class)`
- **PricingPlan**
  - `belongsTo(Tool::class)`
  - `hasMany(Price::class)`
- **Price**
  - `belongsTo(PricingPlan::class)`

---

## ⚙️ API Endpoints

| Method | Endpoint | Description |
|--------|-----------|--------------|
| `GET` | `/api/tools` | List tools (supports filters and pagination) |
| `GET` | `/api/tools/{slug}` | Show single tool (supports `?include=versions,pricing`) |
| `GET` | `/api/tools/{slug}/versions` | List all versions |
| `GET` | `/api/tools/{slug}/versions/{version}` | Show version details |
| `GET` | `/api/tools/{slug}/pricing` | Show pricing plans and prices |

### Filters (for `/api/tools`)
- `?search=cursor`
- `?category=IDE`
- `?license_type=freemium`
- `?vendor=Anthropic`
- `?active=true`

---

## 🧠 Implementation Notes

- Use **Laravel API Resources** to structure JSON responses
- Use **query scopes or a Filter class** for clean filtering logic
- Use **response caching** for `/api/tools` (e.g., 30–60 min)
- Use **database seeders** for at least 3–4 tools:
  - Cursor
  - Claude Code
  - Windsurf
  - Codex CLI
- Include **basic tests** for:
  - Response structure
  - Filtering
  - Version lookup
- Add a **README.md** with example API responses

---

## 📤 Example Seed (Cursor)

```php
$vendor = Vendor::create(['name' => 'Cursor', 'website_url' => 'https://www.cursor.com']);

$tool = Tool::create([
  'vendor_id' => $vendor->id,
  'name' => 'Cursor',
  'slug' => 'cursor',
  'category' => 'IDE',
  'license_type' => 'freemium',
  'website_url' => 'https://www.cursor.com',
  'short_description' => 'AI-first IDE with inline chat and codegen',
  'tags' => ['ai-assisted','vscode-base'],
  'languages' => ['js','ts','py','php'],
  'integrations' => ['github','openai','anthropic'],
]);

$tool->versions()->create([
  'version' => '0.43.1',
  'release_channel' => 'stable',
  'release_date' => '2025-10-15',
  'notes' => ['improved inline edits', 'faster autocomplete'],
]);

$plan = $tool->pricingPlans()->create([
  'name' => 'Pro',
  'billing_period' => 'monthly',
  'tier' => 'paid',
  'features' => ['ai_credits_per_month' => 5000, 'priority_support' => true],
]);

$plan->prices()->createMany([
  ['currency' => 'USD', 'amount_decimal' => 20.00, 'region' => 'US'],
  ['currency' => 'EUR', 'amount_decimal' => 22.00, 'region' => 'EU'],
]);

