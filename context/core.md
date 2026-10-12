# ns_revolution_slider — Core facts

## Identity

| Item | Value |
|---|---|
| Extension key | `ns_revolution_slider` |
| Composer name | `nitsan/ns-revolution-slider` |
| Title (ext_emconf) / product name | TYPO3 Revolution Slider / Slider Revolution |
| Namespace | `NITSAN\NsRevolutionSlider\` → `Classes/` (upper-case `NITSAN`) |
| Version (ext_emconf) | 13.0.0 |
| Repository | https://github.com/nitsan-technologies/ns_revolution_slider (default branch `master`) |
| Licensing status (NITSAN Free/Freemium sheet) | **Freemium** — this repo is the free version |
| Premium version | Sheet: https://t3planet.de/typo3-slider-revolution-erweiterung (€169/year) · README: https://t3planet.com/typo3-slider-revolution-extension |

## Compatibility

| Source | TYPO3 | PHP |
|---|---|---|
| `ext_emconf.php` | `12.0.0-14.9.99` | not declared |
| `composer.json` | `typo3/cms-core ^12 \|\| ^13 \|\| ^14` | not declared |
| ns_license 14.5.4 (dependency) | `12.4.18-14.9.99` | — |

- Effective minimum is **TYPO3 12.4.18** (through ns_license).
- PHP 8.1+ (readonly promoted properties, union types, `enum_exists`).
- Plugin registration differs per major (`features/slider-content-element.md`).
- Verified on TYPO3 14.3.7 classic mode (DDEV). v12 and v13 not tested in this workspace.

## Dependencies

| Package | Constraint | Why |
|---|---|---|
| `typo3/cms-core` | see above | only TYPO3 package declared in `composer.json` |
| `typo3/cms-extbase`, `-fluid`, `-backend` | **not declared** | Extbase plugin, Fluid template, FormEngine/page-module integration |
| `typo3/cms-fluid-styled-content` | **not declared** in composer; required by the site set | set dependency |
| `typo3/cms-install` | **not declared** | upgrade wizard (`#[UpgradeWizard]`) |
| `nitsan/ns-license` / `ns_license` | `^14.5.4` / `14.5.4-14.9.99` | free-trial deep link (`features/premium-cta.md`) |
| Revolution Slider 5.x jQuery library (ThemePunch) | not shipped | must be bought and copied to `fileadmin/revolution-slider/{js,css}/` |
| jQuery 2.1.4 | shipped (`Resources/Public/Js/`) | loaded when `includeJquery` = 1 |

## Tooling

- No PHPUnit, PHPStan, CS fixer or package.json in the repo.
- CI: `.github/workflows/ter-release.yml` only (publishes tags to TER, PHP 7.4 runner, deprecated `set-output`).
- No Crowdin config. Labels: `locallang.xlf` (frontend/preview/strip), `locallang_db.xlf` (TCA, FlexForm,
  constants), two `locallang_csh_*.xlf`.

## Conventions

- Mostly legacy Extbase code (2019); newer files (`EventListener`, `Upgrades`, `Backend`, `Form`) use
  `declare(strict_types=1);` and `final`.
- FormEngine nodes must stay instantiable on v12 and v13+ (`principles.md`).

## Known issues (existing, not fixed)

Verified live on v14.3 (2026-10-12):

- The Camino site of this workspace includes neither the site set nor the static template, and
  `fileadmin/revolution-slider/` does not exist. Content element #56 (no slider selected) still renders: no
  slider markup, but the inline init script `nsRevolutionSliderInit_56` is printed in the footer.

Code-read:

- `loadMinimalPageTemplate` defaults to **1** in the static constants and the site set. When enabled it
  replaces the site's `page = PAGE` with a bare page that only lists colPos 0 content. Sites with a theme must
  set it to 0.
- Without the purchased library the slider stays hidden; the init script logs
  `Revolution Slider library not loaded` and shows the fallback markup.
- An empty `jsFolderPath` / `cssFolderPath` makes `SliderController` scan the public web root for `.js`/`.css`.
- Font sizes are passed as `[desktop, tablet, tablet, mobile]`; the "notebook" level gets the tablet value.
- `SlideItemController::listAction()` is not registered in `configurePlugin()` and has no template (dead code).
- `ext_tables.sql` still declares legacy columns (`cruser_id`, `t3ver_id`, `t3ver_count`, `t3ver_tstamp`,
  `t3ver_move_id`).
- `composer.json` licence `GPL-2.0+` is a deprecated SPDX id (README badge says GPL-3.0). `ext_emconf` keeps
  obsolete keys (`uploadfolder`, `createDirs`) and both `classmap` and `psr-4` autoloading.
- README is outdated (v12.0.2 badge, TYPO3 12) and links t3planet.com, the sheet uses t3planet.de.
