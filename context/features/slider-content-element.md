# Feature: Slider content element

**Status:** Done · verified on TYPO3 14.3 (backend edit form, Page module preview, frontend output without
library) · v12/v13 path code-read only.

Renders a Revolution Slider 5.x (jQuery, ThemePunch) from Slider / Slide Item records
(`slider-records.md`). The extension provides markup, settings and asset loading; the library is not shipped.

## Registration per TYPO3 version

| TYPO3 | Type | Edit form |
|---|---|---|
| v12, v13 | General Plugin: `CType = list`, `list_type = nsrevolutionslider_slider` (`addPlugin`), wizard entry from `page.tsconfig` | Plugin tab shows the FlexForm (`subtypes_addlist`) |
| v14 | Own `CType = nsrevolutionslider_slider` (`registerPlugin` with FlexForm) | Plugin tab shows the FlexForm |

`tt_content.php` removes a stray `CType` registration on v12/v13 on purpose: since v13 `registerPlugin()`
creates a CType, which would break the General Plugin UX there.

**Upgrade wizard** `nsRevolutionSliderPluginListTypeToCTypeUpdate` ("Migrate Revolution Slider plugins to
content elements"), runs only on v14: moves `list_type = nsrevolutionslider_slider` records to the CType and
fixes records an earlier wizard version migrated to `CType = slider`.

## FlexForm (`Configuration/FlexForm/FlexForm.xml`)

| Sheet (label) | Settings |
|---|---|
| `sDEF` (Main Settings) | `slides_type` (0 = whole slider, 1 = selected slides; reloads form), `slider` (group, max 1), `slides` (group), `slide_duration`, `slide_effect`, `headline_animation`, `description_animation`, `button_animation` |
| `general` (General Settings) | `sliderLayout`, `shadow`, `spinner`, `stopLoop`, `stopAtSlide`, `responsiveLevels`, `visibilityLevels`, `gridwidth`, `gridheight`, `hideSliderAtLimit`, `debugMode` |
| `navigationStyles` (Navigation Settings) | `keyboardNavigation`, `keyboard_direction`, `mouseScrollNavigation`, `onHoverStop`, `touchenabled`, `arrowsEnable`, `arrowsStyle`, `arrowsHideOnleave`, `bulletsEnable`, `bulletsStyle` |
| `fontStyle` (Font Style Settings) | `headline_color`, `description_color`, `button_text_color`, `{headline,description,button_text}_size_{desktop,tablet,mobile}` |

Animation ids 1–32 map to `data-frames` presets in `Templates/Slider/Slider.html` (0 = global setting).

## Settings precedence

1. Per slide: `slide_effect` and the three animations of the Slide Item record win when set.
2. FlexForm snake_case keys (`slide_duration`, `slide_effect`, `*_animation`) win over the TypoScript
   camelCase defaults (`slideDuration`, `slideEffect`, `*Animation`).
3. Colours always come from the FlexForm (default `#fff`); sizes are built as JS arrays from the FlexForm.

TypoScript `plugin.tx_nsrevolutionslider_slider.settings` (static template or site set):
`includeJquery`, `jQueryFile`, `jsFolderPath` (default `fileadmin/revolution-slider/js/`), `cssFolderPath`
(`fileadmin/revolution-slider/css/`), `customStyleFilePath`, `customStyle` (inline CSS), default animations
and duration. `persistence.storagePid` is set but irrelevant (records are loaded with `findByUid`).
`loadMinimalPageTemplate` is a top-level constant, see `core.md` known issues.

## Frontend flow (`SliderController`)

1. `initializeAction()` registers assets via `AssetCollector`: bundled jQuery (optional), every `.js` in
   `jsFolderPath` and `jsFolderPath/extensions/` (ThemePunch tools → revolution → slideanims/layeranimation/
   navigation first; `jquery.themepunch.enablelog.js` and `tp-color-picker.min.js` skipped), every `.css` in
   `cssFolderPath`, `customStyleFilePath`, `navigation-skins/<arrowsStyle or bulletsStyle>.css`.
2. `sliderAction()` reads the content element uid from `currentContentObject`, loads the slides (whole
   slider through its MM relation, or the selected Slide Items in order), applies settings, disables the text
   box when `box_position_x` is neither numeric nor a `[..]` array.
3. Fluid renders `#rev_slider_{uid}` (`data-version="5.4.8"`, layout classes for fullwidth/fullscreen).
4. A footer inline script `nsRevolutionSliderInit_{uid}` calls `jQuery(...).revolution({...})` on window
   load; without the library it logs a console error and shows the fallback.

Code-read caveats: FlexForm values (`responsiveLevels`, `gridwidth`, …) are concatenated into the JS
unescaped; `shadow` is emitted as `'spinner1'`/`'spinner0'` instead of a shadow level; only one navigation
skin is loaded when arrows and bullets use different styles.

## Page module preview (`EventListener/FlexformProcess.php`)

`PageContentPreviewRenderingEvent` listener for both registrations (CType or `list` + list_type). Shows a
table with Main / General / Navigation / Font settings. The slider is shown as its uid, selected slides as a
count. The premium strip is prepended (`premium-cta.md`).
