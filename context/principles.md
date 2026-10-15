# ns_revolution_slider — Operating Principles

*Every change to code, context or docs must serve the goals below.*

---

## Goal 1 — Nothing that works may break

The extension is declared for TYPO3 v12, v13 and v14 at the same time (Composer and Classic mode), and
registers the plugin differently on v12/v13 (General Plugin, `list_type`) than on v14 (own `CType`).

- Every change must keep all three majors working, in the backend (edit form, page module) and the frontend.
- Existing content elements store their configuration in `pi_flexform` under `settings.*`. Never rename
  FlexForm keys, TCA columns or the plugin signature `nsrevolutionslider_slider` without a migration.
- Prefer the smallest change that fixes the root cause. No drive-by refactors.
- Run `tasks/run-quality.md` and re-test the affected flow before claiming done.

## Goal 2 — Token-cost efficiency (agent context)

- **DRY context:** each fact lives in exactly ONE file. Reference, don't copy.
- **Load on demand:** read `context/features/<area>.md` for the task, not everything.
- **Prune as you go:** keep `context/session-state.md` short.

## Goal 3 — Accuracy and trust

- Answer from context + code, never from invented API, setting or field names.
- Conflicting facts across files = fix the source file.

---

## Guardrails (non-negotiable)

- Never commit the Revolution Slider library (ThemePunch, licensed separately) into this repo. It lives in
  the installation (`fileadmin/revolution-slider/` by default).
- FormEngine nodes must work with both instantiation styles: v12 passes `(NodeFactory, array $data)` to the
  constructor, v13+ calls `setData()`. Do not add constructor dependencies to nodes or resolvers.
- Keep the TypoScript constants and the site set settings (`Configuration/Sets/NsRevolutionSlider/`) in sync
  when adding or renaming a setting.
- Do not change ns_license from an ns_revolution_slider task; reuse its module and trial modal.
- All UI text goes into `Resources/Private/Language/*.xlf`, no hard-coded labels.

---

## Apply this whenever you

- Edit `context/` or `AGENTS.md`
- Land a feature or bugfix (update the matching `context/features/*.md` + `session-state.md`)
