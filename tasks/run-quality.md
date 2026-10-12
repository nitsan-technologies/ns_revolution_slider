# Task: Quality checks

The repo has no automated tests, linters or PHPStan setup. Run these checks before claiming done.

## Static

```bash
for f in $(find . -name "*.php" -not -path "./.git/*"); do php -l "$f"; done
composer validate --no-check-publish
xmllint --noout Configuration/FlexForm/FlexForm.xml Resources/Private/Language/*.xlf
```

Parse `Configuration/Sets/NsRevolutionSlider/*.yaml` with a YAML linter (e.g. Symfony YAML in the TYPO3
instance).

Classic mode: after adding, moving or removing a class run `typo3 dumpautoload`, then `typo3 cache:flush`.
Composer mode: `composer dump-autoload`.

## Manual (on each supported major you touched: v12, v13, v14)

1. **Admin Tools > Maintenance > Analyze Database Structure:** no pending changes for
   `tx_nsrevolutionslider_*`.
2. **New content element wizard:** "Slider Revolution" is listed (v12/v13 as General Plugin, v14 as own
   type) and saves.
3. **Edit form:** FlexForm sheets load; switching `slides_type` reloads; premium strip shows once above the
   tabs.
4. **Page module:** preview table renders; premium strip shows once, not inside the edit link.
5. **Strip absent** on Slider and Slide Item records and on other content elements.
6. **Records:** create Slide Items with image, assign them to a Slider.
7. **Frontend with library:** copy the Revolution Slider 5.x JS/CSS into `fileadmin/revolution-slider/`,
   include the site set or static template (set `loadMinimalPageTemplate` = 0 on themed sites), check the
   slider animates and the browser console is clean, for both "whole slider" and "selected slides".
8. **Frontend without library:** page still returns 200 and logs the "library not loaded" console error.
9. **v14 upgrade wizard:** a `list_type` record from v12/v13 migrates to the CType.

Clean up temporary backend users and test records afterwards.
