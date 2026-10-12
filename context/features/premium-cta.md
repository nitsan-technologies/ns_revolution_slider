# Feature: Premium strip ("Start Free Trial")

**Status:** Done (2026-10-12, uncommitted) · verified on TYPO3 14.3 · needs ns_license **14.5.4** (the
`trial` query parameter) · v12/v13 not tested.

Grey strip with headline "Slider Revolution Premium", text and a "Start Free Trial" button, same look as
ns_hubspot / ns_feedback.

## Where it shows

| Place | How |
|---|---|
| Edit form of a Slider Revolution content element, above the tabs (below the record title) | FormEngine node resolver replaces `tabsContainer` |
| Page module preview of the content element | `FlexformProcess` prepends it to the preview |

Not shown on the Slider record, the Slide Item record, inside the FlexForm, or on other content elements
(these placements were tried and removed on request). Shown to every backend user who can see the
element; ns_license's module is system-maintainer only, so other users get access denied after clicking.

## Classes

| File | Role |
|---|---|
| `Classes/Backend/PremiumStrip.php` | Builds the HTML; link = route `nitsan_nslicensemodule` + `trial=ns_revolution_slider` + `#free-section`; returns `''` when the route is missing (ns_license not active) |
| `Classes/Form/Resolver/PremiumStripTabsContainerResolver.php` | Registered in `ext_localconf.php` (`nodeResolver` 1760276100, priority 40); matches `tt_content`, not inline, CType `nsrevolutionslider_slider` or `list` + matching `list_type` |
| `Classes/Form/Container/PremiumStripTabsContainer.php` | Extends core `TabsContainer`, prepends the strip and adds the stylesheet |
| `Resources/Public/Css/backend-premium-strip.css` | `.ns-revolution-slider-premium-strip` (light/dark via `light-dark()`) |
| `locallang.xlf` | `premium.strip.headline`, `premium.strip.description`, `premium.strip.trial` |

## Premium product (context)

The premium edition (installed through ns_license) embeds the WordPress Slider Revolution builder
(`Resources/Public/vendor/wp/wp-content/plugins`, absent in the free repo; tables `wp_posts`, `wp_revslider_slides`). ns_license
has special backup/path-rewrite code for it (`NsLicenseModuleController`, `NsLicenseRepository`). Installing
premium replaces this extension's folder, so free-only files must not hold user data.
