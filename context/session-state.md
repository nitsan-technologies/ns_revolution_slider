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
