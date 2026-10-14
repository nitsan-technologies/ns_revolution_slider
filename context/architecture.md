# ns_revolution_slider — Architecture

One Extbase plugin (`NsRevolutionSlider` / `Slider`, action `SliderController::sliderAction`, **non-cacheable**), two
record tables, one Page-module event listener, one FormEngine node resolver. No backend module.

## Registration

| Where | What |
|---|---|
| `ext_localconf.php` | `configurePlugin('NsRevolutionSlider', 'Slider', [SliderController => 'slider'])`; FormEngine `nodeResolver` 1760276100 for `flexFormTabsContainer` (premium strip) |
| `Configuration/TCA/Overrides/tt_content.php` | v12/v13: `addPlugin()` as `list_type` + FlexForm via `addPiFlexFormValue`; v14: `registerPlugin()` as `CType` with FlexForm (`features/slider-content-element.md`) |
| `Configuration/page.tsconfig` | v12/v13 new-content-wizard entry (CType `list`, list_type `nsrevolutionslider_slider`) |
| `Configuration/TCA/Overrides/sys_template.php` | Static template "[NITSAN] Slider Revolution" (`Configuration/TypoScript/`) |
| `Configuration/Sets/NsRevolutionSlider/` | Site set `nitsan/NsRevolutionSlider` ("Revolution Slider"), depends on `typo3/fluid-styled-content`, imports the same constants/setup, defines the settings |
| `ext_tables.php` | `addToInsertRecords()` for both record tables |
| `Configuration/Services.yaml` | Autowires `NITSAN\NsRevolutionSlider\` (except models); `FlexformProcess` on `PageContentPreviewRenderingEvent` |
| `Configuration/Icons.php` | `ns_revolution_slider-plugin-slider` |

## Files

| File | Role |
|---|---|
| `Classes/Controller/SliderController.php` | Loads assets, resolves slides, merges settings, adds the inline init script |
| `Classes/Controller/SlideItemController.php` | Unused (`core.md`) |
| `Classes/Domain/Model/{Slider,SlideItem}.php`, `Repository/*` | Extbase models/repositories (`features/slider-records.md`) |
| `Classes/EventListener/FlexformProcess.php` | Page module preview table + premium strip |
| `Classes/Upgrades/PluginListTypeToCTypeUpdate.php` | Upgrade wizard (v14 only) |
| `Classes/Backend/PremiumStrip.php` | Premium strip HTML (shared) |
| `Classes/Form/Resolver/PremiumStripFlexFormTabsContainerResolver.php`, `Classes/Form/Container/PremiumStripFlexFormTabsContainer.php` | Strip in the Plugin tab, above the FlexForm sheet tabs |
| `Configuration/FlexForm/FlexForm.xml` | Plugin options, 4 sheets |
| `Configuration/TCA/tx_nsrevolutionslider_domain_model_{slider,slideitem}.php` | Record TCA |
| `Configuration/TypoScript/{constants,setup}.typoscript` | `plugin.tx_nsrevolutionslider_slider` (view, persistence, settings), optional minimal `page`, `lib.replaceSpace` |
| `Resources/Private/Templates/Slider/Slider.html`, `Layouts/Default.html` | Revolution Slider 5.4.8 markup (`data-frames` presets per animation id 1–32) |
| `Resources/Public/Js/jquery-2.1.4.min.js` | Bundled jQuery |
| `Resources/Public/Css/revolution_slider.css` | Included by the minimal `page`; suggested value for `customStyleFilePath` |
| `Resources/Public/Css/backend-premium-strip.css` | Premium strip styling (backend only) |
