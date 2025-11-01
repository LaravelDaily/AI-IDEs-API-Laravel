# Job Description: Laravel IDEs & Dev Tools Public API

## 🎯 Goal
Build a public REST API in **Laravel** that provides information about modern **developer tools and IDEs** (e.g., Cursor, Claude Code, Windsurf, Codex CLI, etc.).

The API should serve structured, filterable data about:
- Tools (name, vendor, etc.)
- Versions (version numbers, release dates, changelogs)
- Pricing plans (with currencies)

This project will be used as a **demo API** for a Laravel tutorial aimed at developers outside the Laravel ecosystem — showcasing Laravel’s power for building clean, maintainable APIs.

---

## 🧱 Technical Requirements

- Framework: **Laravel 12+**
- Database: **MySQL**
- PHP: **8.2+**
- Include **query filters** and **caching** for list endpoints
- Include **API documentation (with Scribe package)**
- The API should be **read-only** (no authentication needed for now)

---

## ⚙️ API Endpoints

| Method | Endpoint | Description |
|--------|-----------|--------------|
| `GET` | `/api/tools` | List tools (supports filters and pagination) |
| `GET` | `/api/tools/{slug}` | Show single tool (supports `?include=versions,pricing`) |
| `GET` | `/api/tools/{slug}/versions` | List all versions |
| `GET` | `/api/tools/{slug}/versions/{version}` | Show version details |
| `GET` | `/api/versions` | List latest released versions of all tools |

### Filters (for `/api/tools`)
- `?search=cursor`
- `?vendor=Anthropic`

---

## 🧠 Implementation Notes

- Use **Laravel API Resources** to structure JSON responses
- Use **query scopes or a Filter class** for clean filtering logic
- Use **response caching** for `/api/tools` (e.g., 30–60 min)
- Include **basic tests** for:
  - Response structure
  - Filtering
  - Version lookup

---

## Plan of Action

1. (done) Installed Laravel and API
2. (done) DB structure with Models, Migrations, dummy Seede
3. (done) Seed real data of all versions of the tools
4. (done) Build API endpoints one-by-one
5. (done) Pagination, Filters
6. (skipped) Caching
7. (done) Rate limiting
8. API docs

---

## Building API Prompt for /api/tools

Build API endpoint `GET` `/api/tools` to list tools from Tool model
Load tool including their pricing plans (always) and versions (optional, true by default) ordered by version release date desc, showing only 5 latest versions.
Use Eloquent API resources.
No pagination needed for tools, because there will be only a few tools.
Support ordering: by name (asc default or desc), by cheapest/most expensive non-free monthly pricing plan, or latest version release (only desc).
Support filtering of search by name (question - which package or natively? separate video?)
Generate automated tests, run `php artisan test` and fix errors, if any.
