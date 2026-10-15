# Task: Update the agent context

Run after any change to code, configuration or behaviour.

1. Find the one file that owns the fact (`context/docs-map.md`). Edit it there; do not copy facts into
   other files.
2. New feature → add `context/features/<name>.md` with a **Status** line, a row in the `AGENTS.md` feature
   table and task router, and a row in `context/docs-map.md`.
3. Mark each claim as verified (with TYPO3 version and date) or code-read.
4. Fixed a known issue → remove it from `context/core.md`.
5. Add a dated entry to `context/session-state.md`; drop entries the next session no longer needs.
6. Check that every path named in the context still exists.
