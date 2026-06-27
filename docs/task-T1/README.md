# T1 — Trình soạn thảo tài liệu cơ bản

**Ngày:** 2026-06-27

---

## 1. Tổng quan

Tính năng cho phép người dùng tạo và chỉnh sửa tài liệu văn bản trực tiếp trên trình duyệt. Khi truy cập trang chỉnh sửa, hệ thống tự động khởi tạo một tài liệu mới. Người dùng có thể nhập nội dung, áp dụng định dạng văn bản, và lưu tài liệu vào cơ sở dữ liệu.

---

## 2. Yêu cầu chức năng

### 2.1 Khởi tạo tài liệu

- Khi người dùng truy cập trang soạn thảo, hệ thống tự động tạo mới một tài liệu và gán `id` duy nhất.
- Người dùng được điều hướng đến URL `/documents/:id/edit`.

### 2.2 Soạn thảo nội dung

Người dùng có thể nhập và chỉnh sửa:

| Trường | Mô tả |
|--------|-------|
| Tiêu đề | Dòng tiêu đề của tài liệu |
| Nội dung | Vùng văn bản chính, hỗ trợ định dạng phong phú |

### 2.3 Định dạng văn bản (Inline)

Áp dụng cho vùng văn bản được chọn:

| Định dạng | Phím tắt | Mô tả |
|-----------|----------|-------|
| In đậm | `Ctrl + B` | Làm đậm chữ được chọn |
| In nghiêng | `Ctrl + I` | Làm nghiêng chữ được chọn |
| Gạch dưới | `Ctrl + U` | Thêm gạch chân cho chữ được chọn |

### 2.4 Căn chỉnh đoạn văn (Block)

Áp dụng cho đoạn văn hiện tại (toàn bộ dòng/đoạn, không cần chọn):

| Căn chỉnh | Mô tả |
|-----------|-------|
| Trái | Căn lề trái (mặc định) |
| Giữa | Căn giữa |
| Phải | Căn lề phải |
| Đều | Canh đều hai bên (justify) |

### 2.5 Lưu tài liệu

- Người dùng bấm nút **Lưu** để lưu nội dung hiện tại vào cơ sở dữ liệu.
- Thông tin lưu bao gồm tiêu đề, nội dung có định dạng, và thời gian cập nhật.

---

## 3. Thiết kế kỹ thuật

### 3.1 Định tuyến

```
GET  /documents/:id/edit    →  Trang soạn thảo tài liệu
POST /documents             →  Tạo mới tài liệu (tự động khi vào trang)
PUT  /documents/:id         →  Lưu nội dung tài liệu
```

### 3.2 Cơ sở dữ liệu

**Bảng `users`**

| Cột | Kiểu | Ghi chú |
|-----|------|---------|
| id | bigint, auto-increment | Khóa chính |
| first_name | varchar(100) | |
| last_name | varchar(100) | |
| email | varchar(255) | Duy nhất |
| password | varchar(255) | Đã mã hóa |
| created_at | datetime | |
| updated_at | datetime | |

**Bảng `documents`**

| Cột | Kiểu | Ghi chú |
|-----|------|---------|
| id | uuid | Khóa chính |
| title | varchar(500) | Tiêu đề tài liệu |
| content | longtext | Nội dung dạng HTML / Delta JSON |
| created_user | bigint | Khóa ngoại → `users.id` |
| created_at | datetime | |
| updated_at | datetime | |

### 3.3 Luồng hoạt động

```
[Người dùng truy cập trang]
        │
        ▼
[Hệ thống tạo tài liệu mới]
        │
        ▼
[Người dùng nhập tiêu đề & nội dung]
        │
        ▼
[Người dùng chọn văn bản → áp dụng định dạng]
        │
        ▼
[Người dùng bấm Lưu → hệ thống ghi vào DB]
        │
        ▼
[Hiển thị thông báo lưu thành công]
```

---

## 4. Tiêu chí nghiệm thu

- Khi vào trang, hệ thống tự động tạo tài liệu mới và URL hiển thị đúng định dạng `/documents/:id/edit`.
- Người dùng nhập được tiêu đề và nội dung.
- Chọn văn bản và áp dụng định dạng **đậm**, *nghiêng*, gạch dưới hoạt động đúng.
- Căn chỉnh đoạn văn (trái / giữa / phải / đều) hoạt động đúng.
- Bấm Lưu ghi dữ liệu vào DB; tải lại trang vẫn hiển thị đúng nội dung đã lưu.
- Giao diện hiển thị đúng trên trình duyệt Chrome phiên bản mới nhất.
