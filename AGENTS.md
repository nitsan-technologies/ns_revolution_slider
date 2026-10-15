# AGENTS.md — ns_revolution_slider (TYPO3 Revolution Slider)

Agent router for the Slider Revolution free extension. Load only what your task needs.

> **Principles:** `context/principles.md`
> **Session log:** `context/session-state.md`
> **Doc index:** `context/docs-map.md`

---

## Always load

| File | Why |
|---|---|
| `context/principles.md` | Guardrails, "nothing that works may break" rule |
| `context/core.md` | Identity, TYPO3/PHP/ns_license constraints, tooling, known issues |

---

## Task router

| Task | Load |
|---|---|
| Slider content element: registration, FlexForm, frontend rendering, JS/CSS library, settings, page preview, upgrade wizard | `context/features/slider-content-element.md` |
| Slider and Slide Item records (backend data, fields, relations) | `context/features/slider-records.md` |
| Premium strip / free trial / ns_license dependency | `context/features/premium-cta.md` |
| Files, registration, TypoScript, site set, assets | `context/architecture.md` |
| Lint / validate / manual test | `tasks/run-quality.md` |
| Update agent context after a change | `tasks/context-update.md` |

---

## Feature status

| Feature | Status | Agent entry |
|---|---|---|
| Content element "Slider Revolution" (Extbase plugin `Slider`) rendering a Revolution Slider 5.x | Done (needs the purchased JS/CSS library) | `context/features/slider-content-element.md` |
| Slider and Slide Item records | Done | `context/features/slider-records.md` |
| Page module preview of the content element | Done | `context/features/slider-content-element.md` |
| Upgrade wizard `list_type` → `CType` (TYPO3 v14) | Done | `context/features/slider-content-element.md` |
| Premium strip + ns_license free-trial deep link | Done (needs ns_license 14.5.4 release) | `context/features/premium-cta.md` |

No backend module. The free version does **not** ship the Revolution Slider library itself.

---

## Quick commands

```bash
cd packages/ns_revolution_slider   # or typo3conf/ext/ns_revolution_slider in Classic mode
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done
composer validate --no-check-publish
xmllint --noout Configuration/FlexForm/FlexForm.xml Resources/Private/Language/*.xlf
```
