# T1 — Basic Document Editor

**Date:** 2026-06-27

---

## 1. Overview

This feature allows users to create and edit text documents directly in the browser. When the editor page is accessed, the system automatically initializes a new document. Users can enter content, apply text formatting, and save the document to the database.

---

## 2. Functional Requirements

### 2.1 Document Initialization

- When a user navigates to the editor page, the system automatically creates a new document and assigns it a unique `id`.
- The user is redirected to `/documents/:id/edit`.

### 2.2 Content Editing

Users can enter and edit the following fields:

| Field | Description |
|-------|-------------|
| Title | The document's title line |
| Content | Main text area, supporting rich text formatting |

### 2.3 Inline Text Formatting

Applied to the currently selected text:

| Format | Shortcut | Description |
|--------|----------|-------------|
| Bold | `Ctrl + B` | Makes the selected text bold |
| Italic | `Ctrl + I` | Makes the selected text italic |
| Underline | `Ctrl + U` | Adds an underline to the selected text |

### 2.4 Block-level Alignment

Applied to the current paragraph (no selection required):

| Alignment | Description |
|-----------|-------------|
| Left | Align text to the left (default) |
| Center | Center the text |
| Right | Align text to the right |
| Justify | Stretch text to fill the full line width |

### 2.5 Saving the Document

- The user clicks the **Save** button to persist the current content to the database.
- Saved data includes the title, formatted content, and the updated timestamp.

---

## 3. Technical Design

### 3.1 Routing

```
GET  /documents/:id/edit   →  Document editor page
POST /documents             →  Create a new document (triggered automatically on page load)
PUT  /documents/:id         →  Save document content
```

### 3.2 Database Schema

**Table `users`**

| Column | Type | Notes |
|--------|------|-------|
| id | bigint, auto-increment | Primary key |
| first_name | varchar(100) | |
| last_name | varchar(100) | |
| email | varchar(255) | Unique |
| password | varchar(255) | Hashed |
| created_at | datetime | |
| updated_at | datetime | |

**Table `documents`**

| Column | Type | Notes |
|--------|------|-------|
| id | uuid | Primary key |
| title | varchar(500) | Document title |
| content | longtext | Rich content stored as HTML / Delta JSON |
| created_user | bigint | Foreign key → `users.id` |
| created_at | datetime | |
| updated_at | datetime | |

### 3.3 User Flow

```
[User navigates to the page]
        │
        ▼
[System creates a new document]
        │
        ▼
[User enters title & content]
        │
        ▼
[User selects text → applies formatting]
        │
        ▼
[User clicks Save → system writes to DB]
        │
        ▼
[Success notification displayed]
```

---

## 4. Acceptance Criteria

- Navigating to the page automatically creates a new document; the URL correctly reflects `/documents/:id/edit`.
- Users can enter a title and body content.
- Selecting text and applying **bold**, *italic*, and underline formatting works correctly.
- Paragraph alignment (left / center / right / justify) works correctly.
- Clicking Save persists data to the DB; reloading the page displays the saved content correctly.
- The interface renders correctly on the latest version of Chrome.
