# Feature: Slider and Slide Item records

**Status:** Done · verified on TYPO3 14.3 (create/edit forms, no DB schema changes pending) · this workspace
currently holds 0 sliders and 0 slide items.

Editors create Slide Items, group them into a Slider, and pick either the Slider or individual Slide Items
in the content element (`slider-content-element.md`). Both tables are allowed on standard pages
(`ignorePageTypeRestriction`), selectable in the core "Insert records" element (`addToInsertRecords` in
`ext_tables.php`) and workspace-aware (`versioningWS`).

## Tables

| Table | Label field | Key fields |
|---|---|---|
| `tx_nsrevolutionslider_domain_model_slider` | `slider_name` | `slides`: select (`selectMultipleSideBySide`) with MM table `tx_nsrevolutionslider_slider_slideitem_mm` (not inline) |
| `tx_nsrevolutionslider_domain_model_slideitem` | `headline` | `slide_effect`, `data_duration` (ms, template default 3000), `image` (type `file`, max 1, image types), `headline`/`description`/`button_text` + their `*_animation`, `button_link` (type `link`), `box_check` + `box_*` (animation, size, colours, opacity, position), `*_position_x/y` for headline, description, button |

The content element FlexForm references records by uid (`settings.slider`, `settings.slides`).

## Models

| Class | Notes |
|---|---|
| `Domain/Model/Slider` | `sliderName`, `slides` (`ObjectStorage<SlideItem>`) |
| `Domain/Model/SlideItem` | DB fields plus runtime-only `headlineColor/Size`, `descriptionColor/Size`, `buttonTextColor/Size` filled by `SliderController` from the FlexForm |

Repositories (`SliderRepository`, `SlideItemRepository`) are plain Extbase repositories; only `findByUid` is
used.

## Code-read caveats

- `ctrl` sets `languageField` but no `transOrigPointerField`, although `l10n_parent` exists in
  `ext_tables.sql`; translations cannot be linked to their default-language record.
- Text box positions must be a number or a `[..]` array string, otherwise the box is dropped at render time.
