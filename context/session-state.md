# ns_revolution_slider — Session state

Short log of recent work. Keep only what the next session needs; move lasting facts into the topic files.

## 2026-10-12

- Added the ns_license dependency (`composer.json` `^14.5.4`, `ext_emconf.php` `14.5.4-14.9.99`).
- Added the premium strip (`features/premium-cta.md`). Placements tried and removed on request: FlexForm
  sheet, Slider record, Slide Item record. Final: above the content element tabs + Page module preview.
  Verified on TYPO3 14.3.
- Created the agent context (`AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/`).
- All of the above is committed on branch `feature/ns-license-premium-strip` (not pushed).

## 2026-10-14

- Moved the edit-form strip from above the record tabs into the Plugin tab, below "Plugin Options" and
  above the FlexForm sheet tabs (resolver now targets `flexFormTabsContainer`). Page module preview
  unchanged. Verified on TYPO3 14.3 with content elements #56 and #57. Not committed yet.
- Changed the strip colours from grey to light blue (edit form and Page module preview), also in
  ns_hubspot, ns_feedback and ns_backup.
- Strip icon changed from `actions-star` to `actions-rocket` (all four extensions).
- Strip design aligned with the ns_backup `feature/ns-license-premium-strip-highlight` strip (4px left
  accent, 10px padding); inside the FlexForm panel only the left accent and bottom border remain.
- Strip text changed to "You are using the free version" / "Upgrade to Premium for the visual Slider
  Revolution builder." (same pattern in all four extensions).

## Open

- Test the strip and the General Plugin path on TYPO3 v12 and v13.
- Verify the trial modal opens for `ns_revolution_slider` once ns_license 14.5.4 is released.

## 2026-10-14 — Banner redesign from review

- Team-wide standard, same in every NITSAN strip except the name: "You're using the free version of NS
  Revolution Slider" / "Unlock premium features and get more out of NS Revolution Slider.", two lines,
  "Start Free Trial →", 14px 18px padding, 6px radius, inset 16px inside the FlexForm panel (see
  `features/premium-cta.md`). Version 13.0.0 → 13.1.0. Plugin tab (element 56) and Page module (page 7)
  verified live on 14.3.7; temporary admin removed. Uncommitted.

## 2026-10-15 — Context audit

- Code-read audit: corrected the v13 `registerPlugin()` claim, `customStyle` (read but never defined) and
  `addToInsertRecords` meaning; added plugin type per major, v14 wizard merge, preview fields, deprecations.

## 2026-11-26 — Security hardening (13.0.2)

- `SliderController`: FlexForm/TypoScript values for the Revolution init script go through integer/CSV/
  select sanitisation + `json_encode` (no raw string concat). Empty/`..` asset paths no longer scan the
  public root; slide UIDs cast to int. jQuery 2.1.4 left unchanged to avoid ThemePunch breakage.
  Version `13.0.1` → `13.0.2`.

## 2026-11-26 — FE blank slider on themed sites

- Cause: extension CSS was only registered inside `loadMinimalPageTemplate` PAGE; Camino static include
  never loaded `revolution_slider.css`, so pending/fallback stayed invisible; test slides also had no
  images and `#fff` text. Fix: always `page.includeCSS.tx_nsrevolutionslider`; stronger fallback CSS
  later reverted from `revolution_slider.css`.

## 2026-11-26 — F-03 / F-04 without behaviour change

- F-03: bundled jQuery 2.1.4 → 3.7.1; `includeJquery` still defaults to on; legacy TypoScript path
  `Js/jquery-2.1.4.min.js` remaps to 3.7.1.
- F-04: `slider` action is cacheable (`configurePlugin` non-cacheable list empty).

## 2026-11-27 — Residual Low findings (kit 0.2.3)

- Font-size FlexForm values → `buildResponsiveSizeAttribute()` (integer tokens only; same four-slot
  Revolution shape). Optional `customStyle` → `sanitizeInlineCss()` before `addInlineStyleSheet`.
- Added `CHANGELOG.md` for 13.0.2 remediations + regression checklist.
