# ns_revolution_slider — Session state

Short log of recent work. Keep only what the next session needs; move lasting facts into the topic files.

## 2026-10-12

- Added the ns_license dependency (`composer.json` `^14.5.4`, `ext_emconf.php` `14.5.4-14.9.99`).
- Added the premium strip (`features/premium-cta.md`). Placements tried and removed on request: FlexForm
  sheet, Slider record, Slide Item record. Final: above the content element tabs + Page module preview.
  Verified on TYPO3 14.3.
- Created the agent context (`AGENTS.md`, `CLAUDE.md`, `context/`, `tasks/`).
- All of the above is committed on branch `feature/ns-license-premium-strip` (not pushed).

## Open

- Test the strip and the General Plugin path on TYPO3 v12 and v13.
- Verify the trial modal opens for `ns_revolution_slider` once ns_license 14.5.4 is released.
