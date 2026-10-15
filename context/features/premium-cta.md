# Feature: Premium strip ("Start Free Trial")

**Status:** Done · verified on TYPO3 14.3 (2026-10-14) · needs ns_license **14.5.4** (the `trial` query
parameter) · v12/v13 not tested.

Light-blue card with a 4px left accent, 6px radius and 14px 18px padding (`actions-rocket` icon, blue
"Start Free Trial →" button; the arrow is `aria-hidden` markup). Two lines: semibold headline "You're using the
free version of NS Revolution Slider", description "Unlock premium features and get more out of NS Revolution
Slider." Wording and design are the team-wide standard from the 2026-10-14 review, identical in every NITSAN
strip except for the extension name. Inside the FlexForm panel (`.panel > …`) it is inset by 16px.

## Where it shows

| Place | How |
|---|---|
| Edit form of a Slider Revolution content element, **Plugin tab**, below the "Plugin Options" label and above the FlexForm sheet tabs (Main Settings, …) | FormEngine node resolver replaces `flexFormTabsContainer` for `pi_flexform` |
| Page module preview of the content element | `FlexformProcess` prepends it to the preview |

Inside the FlexForm panel the strip has no margin and only the left accent and bottom border, so it reads as
the panel's header row.

Not shown on the Slider record, the Slide Item record, above the record tabs, or on other content elements
(these placements were tried and removed on request). Shown to every backend user who can see the
element; ns_license's module is system-maintainer only, so other users get access denied after clicking.

## Classes

| File | Role |
|---|---|
| `Classes/Backend/PremiumStrip.php` | Builds the HTML; link = route `nitsan_nslicensemodule` + `trial=ns_revolution_slider` + `#free-section`; returns `''` when the route is missing (ns_license not active) |
| `Classes/Form/Resolver/PremiumStripFlexFormTabsContainerResolver.php` | Registered in `ext_localconf.php` (`nodeResolver` 1760276100, priority 40); matches `tt_content`, field `pi_flexform`, not inline, CType `nsrevolutionslider_slider` or `list` + matching `list_type` |
| `Classes/Form/Container/PremiumStripFlexFormTabsContainer.php` | Extends core `FlexFormTabsContainer`, prepends the strip and adds the stylesheet |
| `Resources/Public/Css/backend-premium-strip.css` | `.ns-revolution-slider-premium-strip` (light/dark via `light-dark()`); `.panel >` variant for the FlexForm placement |
| `locallang.xlf` | `premium.strip.headline`, `premium.strip.description`, `premium.strip.trial` |

`flexFormTabsContainer` is only used when the FlexForm has more than one sheet (it has four). Removing
sheets down to one would switch core to `flexFormNoTabsContainer` and hide the strip in the edit form.

## Premium product (context)

The premium edition (installed through ns_license) embeds the WordPress Slider Revolution builder
(`Resources/Public/vendor/wp/wp-content/plugins`, absent in the free repo; tables `wp_posts`,
`wp_revslider_slides`). ns_license has special backup/path-rewrite code for it (`NsLicenseModuleController`,
`NsLicenseRepository`). Installing premium replaces this extension's folder, so free-only files must not hold
user data.
