<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('dashboard.dashboard') }} - {{ __('messages.asara_beach_cottages') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --primary-color: #448eb9;
            --primary-light: #3b82f6;
            --primary-dark: #53aaf1;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --text-color: #1e293b;
            --text-light: #64748b;
            --text-muted: #94a3b8;
            --bg-color: #f8fafc;
            --bg-secondary: #f1f5f9;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --border-light: #f1f5f9;
            --sidebar-width: 260px;
            --header-height: 64px;
            --transition: all 0.2s ease;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 6px;
            --radius: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: {{ app()->getLocale() === 'ar' ? "'Cairo'" : "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial" }}, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.5;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--white);
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            color: var(--white);
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
            letter-spacing: -0.025em;
        }

        .sidebar-header p {
            font-size: 13px;
            opacity: 0.9;
            font-weight: 400;
        }

        .sidebar-nav {
            padding: 16px 0;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            margin: 2px 12px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            position: relative;
        }

        .nav-item i {
            margin-left: 12px;
            width: 20px;
            text-align: center;
            font-size: 16px;
            color: var(--text-light);
            transition: var(--transition);
        }

        .nav-item:hover {
            background: var(--bg-secondary);
            color: var(--primary-color);
        }

        .nav-item:hover i {
            color: var(--primary-color);
        }

        .nav-item.active {
            background: var(--primary-color);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .nav-item.active i {
            color: var(--white);
        }

        /* Main Content */
        .main-content {
            margin-right: var(--sidebar-width);
            padding: 24px;
            min-height: 100vh;
            transition: var(--transition);
            background: var(--bg-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
        }

        .stat-card i {
            font-size: 24px;
            color: var(--primary-color);
            margin-left: 16px;
            padding: 16px;
            background: var(--bg-secondary);
            border-radius: var(--radius);
            transition: var(--transition);
            min-width: 56px;
            text-align: center;
        }

        .stat-info {
            flex: 1;
        }

        .stat-info h3 {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-info p {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-color);
            line-height: 1;
        }

        /* Content Cards */
        .content-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-light);
            background: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
            color: var(--text-color);
            font-weight: 600;
            margin: 0;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            text-decoration: none;
            min-height: 40px;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-secondary);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-danger {
            background: var(--danger-color);
            color: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .btn-danger:hover {
            background: #dc2626;
            box-shadow: var(--shadow);
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin: 0;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-light);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
        }

        .data-table th,
        .data-table td {
            padding: 16px 20px;
            text-align: right;
            border-bottom: 1px solid var(--border-light);
            font-size: 14px;
        }

        .data-table th {
            background: var(--bg-secondary);
            font-weight: 600;
            color: var(--text-color);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .data-table tr:hover {
            background: var(--bg-color);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .cottage-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cottage-info img {
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
            object-fit: cover;
            border: 2px solid var(--border-light);
        }

        /* Badges */
        .badge {
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-success {
            background: #ecfdf5;
            color: var(--success-color);
            border: 1px solid #d1fae5;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: var(--text-light);
            border: 1px solid var(--border-light);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 4px;
        }

        .action-btn {
            padding: 8px;
            border-radius: var(--radius);
            border: 1px solid var(--border-light);
            background: var(--white);
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            min-width: 32px;
            min-height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        .action-btn:hover[title*="Delete"] {
            background: var(--danger-color);
            border-color: var(--danger-color);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            padding: 20px;
        }

        .modal-content {
            position: relative;
            background: var(--white);
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            max-height: calc(100vh - 80px);
            overflow: hidden;
            border: 1px solid var(--border-light);
        }

        .modal-header {
            padding: 24px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-secondary);
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .modal-close {
            background: var(--white);
            border: 1px solid var(--border-light);
            width: 32px;
            height: 32px;
            border-radius: var(--radius);
            font-size: 16px;
            cursor: pointer;
            color: var(--text-light);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            color: var(--danger-color);
            border-color: var(--danger-color);
            background: #fef2f2;
        }

        .modal-body {
            padding: 24px;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .modal-footer {
            padding: 24px;
            border-top: 1px solid var(--border-light);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: var(--bg-secondary);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border-light);
            border-radius: var(--radius-lg);
            font-size: 14px;
            transition: var(--transition);
            background: var(--bg-secondary);
            line-height: 1.5;
            font-weight: 400;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
            transform: translateY(-1px);
        }

        .form-control:hover:not(:focus) {
            border-color: var(--border-color);
            background: var(--white);
        }

        .form-control::placeholder {
            color: var(--text-muted);
            font-style: italic;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        /* File Input Styling */
        .file-input-wrapper {
            position: relative;
            display: block;
            overflow: hidden;
            border-radius: var(--radius-lg);
            border: 2px dashed var(--border-color);
            background: var(--bg-secondary);
            transition: var(--transition);
            cursor: pointer;
        }

        .file-input-wrapper:hover {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.02);
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-content {
            padding: 24px;
            text-align: center;
            color: var(--text-light);
        }

        .file-input-content i {
            font-size: 32px;
            color: var(--primary-color);
            margin-bottom: 12px;
            display: block;
        }

        .file-input-content .title {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
        }

        .file-input-content .subtitle {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Video Preview Styling */
        .videos-preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .video-preview-item {
            position: relative;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 2px solid var(--border-light);
            transition: var(--transition);
        }

        .video-preview-item:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .video-preview-item video {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }

        .video-preview-info {
            padding: 12px;
            background: var(--white);
        }

        .video-preview-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 4px;
            word-break: break-word;
        }

        .video-preview-size {
            font-size: 11px;
            color: var(--text-muted);
        }

        .video-preview-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            background: rgba(239, 68, 68, 0.9);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: var(--transition);
        }

        .video-preview-remove:hover {
            background: var(--danger-color);
            transform: scale(1.1);
        }

        .video-preview-play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background: rgba(37, 99, 235, 0.9);
            color: var(--white);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: var(--transition);
        }

        .video-preview-play:hover {
            background: var(--primary-color);
            transform: translate(-50%, -50%) scale(1.1);
        }

        .video-preview {
            margin-top: 16px;
        }

        .video-preview video {
            border-radius: var(--radius-lg);
            border: 2px solid var(--border-light);
        }

        /* Checkbox Styling */
        .checkbox-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            border: 2px solid var(--border-light);
            transition: var(--transition);
            cursor: pointer;
        }

        .checkbox-wrapper:hover {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.02);
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .checkbox-label {
            flex: 1;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color);
            line-height: 1.4;
        }

        /* Features Grid Styling */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .feature-checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--bg-secondary);
            border-radius: var(--radius);
            border: 2px solid var(--border-light);
            transition: var(--transition);
            cursor: pointer;
        }

        .feature-checkbox-wrapper:hover {
            border-color: var(--primary-color);
            background: rgba(37, 99, 235, 0.02);
            transform: translateY(-1px);
        }

        .feature-checkbox-wrapper input[type="checkbox"]:checked + .feature-checkbox-label {
            color: var(--primary-color);
        }

        .feature-checkbox-wrapper input[type="checkbox"]:checked + .feature-checkbox-label i {
            color: var(--primary-color);
        }

        .feature-checkbox {
            width: 16px;
            height: 16px;
            margin: 0;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .feature-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-color);
            transition: var(--transition);
            flex: 1;
        }

        .feature-checkbox-label i {
            width: 16px;
            text-align: center;
            color: var(--text-light);
            transition: var(--transition);
        }

        /* Preview Styles */
        .image-preview {
            margin-top: 16px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 2px solid var(--border-light);
            background: var(--bg-secondary);
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            display: block;
        }

        .image-preview:empty::after {
            content: "صورة المعاينة ستظهر هنا";
            color: var(--text-muted);
            font-style: italic;
        }

        .images-preview-container {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .image-preview-item {
            aspect-ratio: 1;
            border-radius: var(--radius);
            background-color: var(--bg-secondary);
            background-size: cover;
            background-position: center;
            border: 2px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        /* Video Preview */
        .video-preview {
            margin-top: 16px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 2px solid var(--border-light);
            background: var(--bg-secondary);
        }

        .video-preview video {
            width: 100%;
            height: auto;
            max-height: 300px;
            display: block;
        }

        /* Form Section Dividers */
        .form-section {
            padding: 24px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .form-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            color: var(--primary-color);
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .gallery-item {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            aspect-ratio: 1;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* Videos Grid Styles */
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .video-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .video-item video {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            background: #000;
        }

        .video-info {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
        }

        .btn-icon {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        /* Add new styles for language switcher */
        .lang-switcher {
            padding: 12px 20px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            text-decoration: none;
            transition: 0.3s;
        }

        .lang-switcher:hover {
            background: var(--bg-color);
            color: var(--primary-color);
        }

        .lang-switcher i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
        }
        
        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: 0.3s;
            font-size: 14px;
            text-align: right;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            :root {
                --sidebar-width: 240px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .modal-content {
                width: 95%;
                margin: 20px auto;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        /* RTL Specific Styles */
        [dir="ltr"] {
            .sidebar {
                right: auto;
                left: 0;
                border-left: none;
                border-right: 1px solid var(--border-color);
            }

            .main-content {
                margin-right: 0;
                margin-left: var(--sidebar-width);
            }

            .nav-item i,
            .stat-card i {
                margin-left: 0;
                margin-right: 0.75rem;
            }

            .data-table th,
            .data-table td {
                text-align: left;
            }

            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .main-content {
                    margin-left: 0;
                }
            }
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background: var(--primary-color);
            color: var(--white);
            padding: 0.5rem;
            border-radius: var(--radius);
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }

        /* Add these styles to your existing styles */
        .image-preview {
            margin-top: 10px;
            width: 100%;
            height: 200px;
            border: 2px dashed var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            overflow: hidden;
            position: relative;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .images-preview-container {
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .image-preview-item {
            width: 100%;
            padding-bottom: 100%;
            border: 2px dashed var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            margin-bottom: 5px;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px; /* Changed from --radius to 4px */
            cursor: pointer;
            margin-right: 10px;
        }

        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Gallery Grid Styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-item-overlay {
            opacity: 1;
        }

        /* Videos Grid Styles */
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .video-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .video-item video {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            background: #000;
        }

        .video-info {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
        }

        .btn-icon {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        /* Add new styles for language switcher */
        .lang-switcher {
            padding: 12px 20px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            text-decoration: none;
            transition: 0.3s;
        }

        .lang-switcher:hover {
            background: var(--bg-color);
            color: var(--primary-color);
        }

        .lang-switcher i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            body {
                padding-top: 64px;
            }

            /* Mobile Header */
            .mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 64px;
                background: var(--white);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 20px;
                box-shadow: var(--shadow);
                z-index: 999;
                border-bottom: 1px solid var(--border-light);
            }

            .mobile-header h1 {
                font-size: 18px;
                color: var(--text-color);
                margin: 0;
                font-weight: 600;
            }

            .menu-toggle {
                background: var(--bg-secondary);
                color: var(--text-color);
                padding: 8px;
                border: 1px solid var(--border-light);
                border-radius: var(--radius);
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
            }

            .menu-toggle:hover {
                background: var(--primary-color);
                color: var(--white);
                border-color: var(--primary-color);
            }

            /* Sidebar Mobile */
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                width: 85%;
                max-width: 320px;
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin: 0;
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                margin-bottom: 24px;
            }

            .stat-card {
                padding: 16px;
                flex-direction: column;
                text-align: center;
                gap: 12px;
            }

            .stat-card i {
                font-size: 20px;
                padding: 12px;
                margin: 0;
                width: 44px;
                height: 44px;
                align-self: center;
            }

            .stat-info h3 {
                font-size: 11px;
                margin-bottom: 4px;
            }

            .stat-info p {
                font-size: 24px;
            }

            /* Mobile Table Styles */
            .table-container {
                margin: 0;
                border-radius: var(--radius);
                overflow: hidden;
                background: var(--white);
                box-shadow: var(--shadow);
            }

            .data-table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .data-table th,
            .data-table td {
                white-space: nowrap;
                padding: 0.75rem;
            }

            /* Mobile Cards */
            .content-card {
                margin-bottom: 1rem;
                border-radius: var(--radius);
            }

            .card-header {
                padding: 1rem;
            }

            /* Mobile Buttons */
            .btn {
                height: 40px;
                padding: 0 1rem;
                font-size: 0.875rem;
            }

            /* Mobile Gallery Grid */
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.75rem;
                padding: 0.75rem;
            }

            /* Mobile Modal */
            .modal-content {
                width: 95%;
                margin: 1rem auto;
                max-height: 90vh;
            }

            .modal-header {
                padding: 1rem;
            }

            .modal-body {
                padding: 1rem;
            }

            .modal-footer {
                padding: 1rem;
            }

            /* Mobile Form Elements */
            .form-control {
                height: 40px;
                font-size: 16px; /* Prevent zoom on iOS */
            }

            textarea.form-control {
                height: auto;
            }

            /* Mobile Action Buttons */
            .action-buttons {
                display: flex;
                gap: 1rem;
            }

            .action-btn {
                padding: 0.5rem 0.75rem;
                background: var(--bg-color);
                border-radius: var(--radius-sm);
            }

            /* Bottom Navigation */
            .bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: var(--white);
                box-shadow: var(--shadow);
                z-index: 998;
                padding: 0.5rem;
                justify-content: space-around;
            }

            .bottom-nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 0.5rem;
                color: var(--text-light);
                text-decoration: none;
                font-size: 0.75rem;
                transition: var(--transition);
            }

            .bottom-nav-item i {
                font-size: 1.25rem;
                margin-bottom: 0.25rem;
            }

            .bottom-nav-item.active {
                color: var(--primary-color);
            }

            /* Mobile Overlay */
            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(4px);
                z-index: 999;
            }

            .mobile-overlay.active {
                display: block;
            }

            /* Adjust main content padding for bottom nav */
            .main-content {
                padding-bottom: 4.5rem;
            }
        }

        /* Small Mobile Devices */
        @media (max-width: 380px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 0.75rem;
            }

            .btn {
                padding: 0 0.75rem;
                font-size: 0.813rem;
            }
        }

        /* RTL Specific Styles */
        [dir="ltr"] {
            .sidebar {
                right: auto;
                left: 0;
                border-left: none;
                border-right: 1px solid var(--border-color);
            }

            .main-content {
                margin-right: 0;
                margin-left: var(--sidebar-width);
            }

            .nav-item i,
            .stat-card i {
                margin-left: 0;
                margin-right: 0.75rem;
            }

            .data-table th,
            .data-table td {
                text-align: left;
            }

            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }

                .main-content {
                    margin-left: 0;
                }
            }
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background: var(--primary-color);
            color: var(--white);
            padding: 0.5rem;
            border-radius: var(--radius);
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }

        /* Add these styles to your existing styles */
        .image-preview {
            margin-top: 10px;
            width: 100%;
            height: 200px;
            border: 2px dashed var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            overflow: hidden;
            position: relative;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .images-preview-container {
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .image-preview-item {
            width: 100%;
            padding-bottom: 100%;
            border: 2px dashed var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px; /* Changed from --radius to 4px */
            margin-bottom: 5px;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px; /* Changed from --radius to 4px */
            cursor: pointer;
            margin-right: 10px;
        }

        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }

        /* Gallery Grid Styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-item-overlay {
            opacity: 1;
        }

        /* Videos Grid Styles */
        .videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .video-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .video-item video {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            background: #000;
        }

        .video-info {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
        }

        .btn-icon {
            background: none;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-icon:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        /* Add new styles for language switcher */
        .lang-switcher {
            padding: 12px 20px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-color);
            text-decoration: none;
            transition: 0.3s;
        }

        .lang-switcher:hover {
            background: var(--bg-color);
            color: var(--primary-color);
        }

        .lang-switcher i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
        }

        [dir="ltr"] .sidebar {
            right: auto;
            left: 0;
            border-left: none;
            border-right: 1px solid var(--border-color);
        }

        [dir="ltr"] .main-content {
            margin-right: 0;
            margin-left: var(--sidebar-width);
        }

        [dir="ltr"] .nav-item i,
        [dir="ltr"] .lang-switcher i {
            margin-left: 0;
            margin-right: 10px;
        }

        [dir="ltr"] .stat-card i {
            margin-left: 0;
            margin-right: 15px;
        }

        [dir="ltr"] .data-table th,
        [dir="ltr"] .data-table td {
            text-align: left;
        }

        /* Management Sections Styling */
        .management-section {
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            border-radius: var(--radius);
            margin-top: 15px;
            overflow: hidden;
        }

        .section-header {
            background: var(--white);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-color);
        }

        .section-header i {
            color: var(--primary-color);
            width: 16px;
            text-align: center;
        }

        .blocked-dates-section .section-header i {
            color: var(--danger-color);
        }

        .special-prices-section .section-header i {
            color: var(--success-color);
        }

        .section-content {
            padding: 16px;
        }

        .dates-list {
            list-style: none;
            margin: 0 0 12px 0;
            padding: 0;
            max-height: 120px;
            overflow-y: auto;
            border: 1px solid var(--border-light);
            border-radius: var(--radius);
            background: var(--white);
        }

        .dates-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-bottom: 1px solid var(--border-light);
            font-size: 13px;
            color: var(--text-color);
        }

        .dates-list li:last-child {
            border-bottom: none;
        }

        .dates-list li:empty {
            padding: 12px;
            text-align: center;
            color: var(--text-muted);
            font-style: italic;
        }

        .dates-list li:empty::after {
            content: "لا توجد تواريخ محجوزة";
        }

        .special-price-list li:empty::after {
            content: "لا توجد أسعار خاصة";
        }

        .dates-list .remove-btn {
            background: var(--danger-color);
            color: var(--white);
            border: none;
            border-radius: var(--radius-sm);
            padding: 4px 8px;
            font-size: 11px;
            cursor: pointer;
            transition: var(--transition);
        }

        .dates-list .remove-btn:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .input-group {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .date-input,
        .price-input {
            flex: 1;
            min-width: 120px;
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 13px;
            background: var(--white);
            transition: var(--transition);
        }

        .date-input:focus,
        .price-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .price-input {
            min-width: 100px;
        }

        .message-area {
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: var(--radius);
            font-size: 12px;
            min-height: 20px;
            transition: var(--transition);
        }

        .message-area:empty {
            display: none;
        }

        .message-area.success {
            background: #ecfdf5;
            color: var(--success-color);
            border: 1px solid #d1fae5;
        }

        .message-area.error {
            background: #fef2f2;
            color: var(--danger-color);
            border: 1px solid #fecaca;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .input-group {
                flex-direction: column;
                align-items: stretch;
            }

            .date-input,
            .price-input {
                min-width: auto;
            }

            .dates-list {
                max-height: 100px;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Mobile Header -->
    <header class="mobile-header d-md-none">
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h1>{{ __('dashboard.dashboard') }}</h1>
        <a href="{{ url('/') }}" target="_blank" class="btn-icon">
            <i class="fas fa-globe"></i>
        </a>
    </header>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>{{ __('messages.asara') }}</h2>
            <p>{{ __('dashboard.control_panel') }}</p>
        </div>
        
        <nav class="sidebar-nav">
            <a href="#" class="nav-item" data-section="cottages-section">
                <i class="fas fa-home"></i>
                <span>{{ __('dashboard.home') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="cottages-section">
                <i class="fas fa-building"></i>
                <span>{{ __('dashboard.cottages') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="bookings-section">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ __('dashboard.bookings') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="customers-section">
                <i class="fas fa-users"></i>
                <span>{{ __('dashboard.customers') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="reviews-section">
                <i class="fas fa-star"></i>
                <span>{{ __('dashboard.reviews') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="images-section">
                <i class="fas fa-images"></i>
                <span>{{ __('dashboard.gallery') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="videos-section">
                <i class="fas fa-video"></i>
                <span>{{ __('dashboard.videos') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="hero-media-section">
                <i class="fas fa-image"></i>
                <span>{{ __('dashboard.hero_media') }}</span>
            </a>
            <a href="#" class="nav-item" data-section="settings-section">
                <i class="fas fa-cog"></i>
                <span>{{ __('dashboard.settings') }}</span>
            </a>
            <a href="{{ url('/') }}" class="nav-item" target="_blank">
                <i class="fas fa-globe"></i>
                <span>{{ __('dashboard.website') }}</span>
            </a>
        </nav>

        <!-- Language Switcher -->
        <a href="{{ route('language.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}" class="lang-switcher">
            <i class="fas fa-globe"></i>
            <span>{{ app()->getLocale() === 'en' ? 'العربية' : 'English' }}</span>
        </a>
        
        <!-- Logout Button -->
        <form method="POST" action="{{ route('admin.logout') }}" style="margin-top: auto;">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>تسجيل الخروج</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-home"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.cottages') }}</h3>
                    <p>{{ $stats['total_cottages'] ?? 0 }}</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-calendar-check"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.bookings') }}</h3>
                    <p>{{ $stats['total_bookings'] ?? 0 }}</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.customers') }}</h3>
                    <p>{{ $stats['total_customers'] ?? 0 }}</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-dollar-sign"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.revenue') }}</h3>
                    <p>{{ number_format($stats['total_revenue'] ?? 0) }} {{ __('dashboard.currency') }}</p>
                    <small style="color: var(--text-light); font-size: 11px; margin-top: 4px; display: block;">
                        (متوسط السعر × عدد الأيام)
                    </small>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-star"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.reviews') }}</h3>
                    <p>{{ $stats['total_reviews'] ?? 0 }}</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <div class="stat-info">
                    <h3>{{ __('dashboard.pending_bookings') }}</h3>
                    <p>{{ $stats['pending_bookings'] ?? 0 }}</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-calendar-alt"></i>
                <div class="stat-info">
                    <h3>إيرادات الشهر الحالي</h3>
                    <p>{{ number_format($stats['monthly_revenue'] ?? 0) }} {{ __('dashboard.currency') }}</p>
                    <small style="color: var(--text-light); font-size: 11px; margin-top: 4px; display: block;">
                        ({{ $stats['monthly_bookings'] ?? 0 }} حجز)
                    </small>
                </div>
            </div>
        </div>

        <!-- Cottages Section -->
        <div id="cottages-section" class="content-section">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.cottage_list') }}</h2>
                    <button class="btn-primary" onclick="openAddCottageModal()">
                        <i class="fas fa-plus"></i>
                        {{ __('dashboard.add_cottage') }}
                    </button>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.cottage') }}</th>
                                <th>{{ __('dashboard.price') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                                <th>{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cottages ?? [] as $cottage)
                            <tr>
                                <td>
                                    <div class="cottage-info">
                                        @if($cottage->cover_image)
                                            <img src="{{ asset('images/' . $cottage->cover_image) }}" 
                                                 alt="{{ $cottage->name }}"
                                                 onerror="this.src='{{ asset('images/r1.jpg') }}'">
                                        @else
                                            <img src="{{ asset('images/r1.jpg') }}" 
                                                 alt="{{ $cottage->name }}">
                                        @endif
                                        <span>{{ $cottage->name }}</span>
                                    </div>
                                    <!-- Blocked Dates Management UI -->
                                    <div class="management-section blocked-dates-section">
                                        <div class="section-header">
                                            <i class="fas fa-ban"></i>
                                            <strong>تواريخ محجوزة/محجوبة</strong>
                                        </div>
                                        <div class="section-content">
                                            <ul class="dates-list blocked-dates-list" id="blocked-dates-list-{{ $cottage->id }}"></ul>
                                            <div class="input-group">
                                                <input type="text" id="block-date-{{ $cottage->id }}" class="date-input" placeholder="اختر تواريخ للحجب">
                                                <button class="btn btn-danger btn-sm" onclick="addBlockedDate({{ $cottage->id }})">
                                                    <i class="fas fa-ban"></i>
                                                    حجب تواريخ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Special Prices Management UI -->
                                    <div class="management-section special-prices-section">
                                        <div class="section-header">
                                            <i class="fas fa-tag"></i>
                                            <strong>عروض/أسعار خاصة</strong>
                                        </div>
                                        <div class="section-content">
                                            <ul class="dates-list special-price-list" id="special-price-list-{{ $cottage->id }}"></ul>
                                            <div class="input-group">
                                                <input type="text" id="special-price-date-{{ $cottage->id }}" class="date-input" placeholder="اختر تواريخ">
                                                <input type="number" id="special-price-value-{{ $cottage->id }}" class="price-input" min="0" placeholder="السعر الخاص (د.ل)">
                                                <button class="btn btn-success btn-sm" onclick="addSpecialPrice({{ $cottage->id }})">
                                                    <i class="fas fa-tag"></i>
                                                    تعيين سعر خاص
                                                </button>
                                            </div>
                                            <div id="special-price-msg-{{ $cottage->id }}" class="message-area"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $cottage->price }} {{ __('dashboard.currency') }}</td>
                                <td>
                                    @if($cottage->featured)
                                        <span class="badge badge-success">{{ __('dashboard.featured') }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ __('dashboard.regular') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button onclick='editCottage(@json($cottage))' title="{{ __('dashboard.edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $cottage->id }})" title="{{ __('dashboard.delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{ route('cottage.show', $cottage->id) }}" title="{{ __('dashboard.view') }}" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr><td colspan="4"><div id="blocked-dates-msg-{{ $cottage->id }}" class="message-area"></div></td></tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px;">
                                    <i class="fas fa-home" style="font-size: 48px; color: #ddd; margin-bottom: 10px;"></i>
                                    <p>{{ __('dashboard.no_cottages_added') }}</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bookings Section -->
        <div id="bookings-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.booking_list') }}</h2>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('dashboard.booking_number') }}</th>
                                <th>{{ __('dashboard.customer_name') }}</th>
                                <th>{{ __('dashboard.cottage') }}</th>
                                <th>{{ __('dashboard.arrival_date') }}</th>
                                <th>{{ __('dashboard.departure_date') }}</th>
                                <th>{{ __('dashboard.status') }}</th>
                                <th>{{ __('dashboard.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 30px;">
                                    <i class="fas fa-calendar" style="font-size: 48px; color: #ddd; margin-bottom: 10px;"></i>
                                    <p>{{ __('dashboard.no_current_bookings') }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customers Section -->
        <div id="customers-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>العملاء</h2>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الهاتف</th>
                                <th>آخر حجز</th>
                                <th>عدد الحجوزات</th>
                                <th>إجمالي الإيرادات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                @php
                                    $customerRevenue = 0;
                                    $averageCottagePrice = \App\Models\Cottage::avg('price') ?: 200;
                                    
                                    foreach ($customer->bookingRequests as $booking) {
                                        $checkin = \Carbon\Carbon::parse($booking->checkin);
                                        $checkout = \Carbon\Carbon::parse($booking->checkout);
                                        $days = $checkin->diffInDays($checkout);
                                        $customerRevenue += $days * $averageCottagePrice;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        @if($customer->bookingRequests->count())
                                            {{ $customer->bookingRequests->first()->checkin }} - {{ $customer->bookingRequests->first()->checkout }}
                                            ({{ $customer->bookingRequests->first()->guests }} ضيف)
                                        @else
                                            ---
                                        @endif
                                    </td>
                                    <td>{{ $customer->bookingRequests->count() }}</td>
                                    <td>{{ number_format($customerRevenue, 0) }} د.ل</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button onclick="deleteCustomer({{ $customer->id }}, '{{ $customer->name }}')" title="حذف العميل" class="action-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 30px;">
                                        <i class="fas fa-users" style="font-size: 48px; color: #ddd; margin-bottom: 10px;"></i>
                                        <p>لا يوجد عملاء بعد</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div id="reviews-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>التقييمات</h2>
                </div>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>العميل</th>
                                <th>البريد الإلكتروني</th>
                                <th>الشاليه</th>
                                <th>التقييم</th>
                                <th>التعليق</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews ?? [] as $review)
                                @php
                                    $cottage = \App\Models\Cottage::find($review->cottage_id);
                                    $cottageName = $cottage ? $cottage->name : 'غير محدد';
                                @endphp
                                <tr>
                                    <td>{{ $review->guest_name }}</td>
                                    <td>{{ $review->guest_email }}</td>
                                    <td>{{ $cottageName }}</td>
                                    <td>
                                        <div style="color: #f59e0b;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span style="margin-right: 5px; color: var(--text-color);">({{ $review->rating }}/5)</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $review->review_text }}">
                                            {{ Str::limit($review->review_text, 50) }}
                                        </div>
                                    </td>
                                    <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button onclick="deleteReview({{ $review->id }}, '{{ $review->guest_name }}')" title="حذف التقييم" class="action-btn">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 30px;">
                                        <i class="fas fa-star" style="font-size: 48px; color: #ddd; margin-bottom: 10px;"></i>
                                        <p>لا توجد تقييمات بعد</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Images Gallery Section -->
        <div id="images-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.gallery') }}</h2>
                    <button class="btn-primary" onclick="openAddImageModal()">
                        <i class="fas fa-plus"></i>
                        {{ __('dashboard.add_images') }}
                    </button>
                </div>
                <div class="gallery-grid">
                    @foreach(glob(public_path('images/moments/*.jpg')) as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('images/moments/' . basename($image)) }}" alt="{{ __('dashboard.gallery_image') }}">
                            <div class="gallery-item-overlay">
                                <button class="btn-icon" onclick="deleteImage('{{ basename($image) }}')" title="{{ __('dashboard.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Videos Section -->
        <div id="videos-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.videos') }}</h2>
                    <button class="btn-primary" onclick="openAddVideoModal()">
                        <i class="fas fa-plus"></i>
                        {{ __('dashboard.add_video') }}
                    </button>
                </div>
                <div class="videos-grid">
                    @foreach(glob(public_path('videos/*.mp4')) as $video)
                        <div class="video-item">
                            <video controls>
                                <source src="{{ asset('videos/' . basename($video)) }}" type="video/mp4">
                                {{ __('dashboard.browser_does_not_support_video') }}
                            </video>
                            <div class="video-info">
                                <span>{{ basename($video) }}</span>
                                <button class="btn-icon" onclick="deleteVideo('{{ basename($video) }}')" title="{{ __('dashboard.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Hero Media Section -->
        <div id="hero-media-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.hero_media') }}</h2>
                    <div style="display: flex; gap: 10px;">
                        <button class="btn-primary" onclick="openAddHeroImageModal()">
                            <i class="fas fa-plus"></i>
                            {{ __('dashboard.add_hero_image') }}
                        </button>
                        <button class="btn-primary" onclick="openAddHeroVideoModal()">
                            <i class="fas fa-video"></i>
                            {{ __('dashboard.add_hero_video') }}
                        </button>
                    </div>
                </div>
                
                <!-- Hero Images -->
                <div style="padding: 20px;">
                    <h3 style="margin-bottom: 15px; color: var(--text-color);">
                        <i class="fas fa-images" style="margin-right: 8px;"></i>
                        {{ __('dashboard.hero_slider_images') }}
                    </h3>
                    <div style="background: #e3f2fd; border: 1px solid #2196f3; border-radius: 8px; padding: 12px; margin-bottom: 20px; color: #1976d2;">
                        <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                        <strong>ملاحظة:</strong> بعد إضافة أو حذف الصور الرئيسية، يجب تحديث الصفحة الرئيسية لرؤية التغييرات.
                        <br><br>
                        <a href="{{ url('/') }}" target="_blank" class="btn-primary" style="text-decoration: none; display: inline-block; margin-top: 8px;">
                            <i class="fas fa-external-link-alt"></i>
                            عرض الصفحة الرئيسية
                        </a>
                    </div>
                    <div class="gallery-grid">
                        @php
                            // Get all hero images that start with "cover"
                            $heroImages = glob(public_path('images/cover*.jpg'));
                            if (empty($heroImages)) {
                                $heroImages = [
                                    public_path('images/cover.jpg'),
                                    public_path('images/cover3.jpg'),
                                    public_path('images/cover4.jpg')
                                ];
                            }
                            
                            foreach ($heroImages as $image) {
                                if (file_exists($image)) {
                                    $imageName = basename($image);
                                    echo '<div class="gallery-item">';
                                    echo '<img src="' . asset('images/' . $imageName) . '" alt="Hero Image">';
                                    echo '<div class="gallery-item-overlay">';
                                    echo '<button class="btn-icon" onclick="deleteHeroImage(\'' . $imageName . '\')" title="' . __('dashboard.delete') . '">';
                                    echo '<i class="fas fa-trash"></i>';
                                    echo '</button>';
                                    echo '<button class="btn-icon" onclick="setAsPrimaryHero(\'' . $imageName . '\')" title="' . __('dashboard.set_as_primary') . '" style="margin-left: 10px;">';
                                    echo '<i class="fas fa-star"></i>';
                                    echo '</button>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        @endphp
                    </div>
                </div>

                <!-- Hero Videos -->
                <div style="padding: 20px; border-top: 1px solid var(--border-color);">
                    <h3 style="margin-bottom: 15px; color: var(--text-color);">
                        <i class="fas fa-video" style="margin-right: 8px;"></i>
                        {{ __('dashboard.hero_experience_video') }}
                    </h3>
                    <div class="videos-grid">
                        @if(file_exists(public_path('images/video.mp4')))
                            <div class="video-item">
                                <video controls>
                                    <source src="{{ asset('images/video.mp4') }}" type="video/mp4">
                                    {{ __('dashboard.browser_does_not_support_video') }}
                                </video>
                                <div class="video-info">
                                    <span>{{ __('dashboard.experience_video') }}</span>
                                    <button class="btn-icon" onclick="deleteHeroVideo('video.mp4')" title="{{ __('dashboard.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fas fa-video" style="font-size: 48px; margin-bottom: 15px;"></i>
                                <p>{{ __('dashboard.no_hero_video') }}</p>
                                <button class="btn-primary" onclick="openAddHeroVideoModal()" style="margin-top: 15px;">
                                    <i class="fas fa-plus"></i>
                                    {{ __('dashboard.add_hero_video') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settings-section" class="content-section" style="display: none;">
            <div class="content-card">
                <div class="card-header">
                    <h2>{{ __('dashboard.system_settings') }}</h2>
                </div>
                <div class="settings-container" style="padding: 20px;">
                    <div class="form-group">
                        <label>{{ __('dashboard.site_name') }}</label>
                        <input type="text" value="إغرماون" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ __('dashboard.email') }}</label>
                        <input type="email" value="info@example.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ __('dashboard.phone_number') }}</label>
                        <input type="tel" value="+218 91-886-8883" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>{{ __('dashboard.address') }}</label>
                        <input type="text" value="عصارة، طرابلس، ليبيا" class="form-control">
                    </div>
                    <button class="btn-primary" style="margin-top: 20px;">
                        <i class="fas fa-save"></i>
                        {{ __('dashboard.save_changes') }}
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Cottage Modal -->
    <div id="cottageModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">{{ __('dashboard.add_cottage') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="cottageForm" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-info-circle"></i>
                            {{ __('dashboard.basic_information') }}
                        </div>
                        
                    <div class="form-group">
                        <label for="cottage_name">{{ __('dashboard.cottage_name') }}</label>
                            <input type="text" id="cottage_name" name="name" class="form-control" placeholder="{{ __('dashboard.enter_cottage_name') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cottage_price">{{ __('dashboard.price') }} ({{ __('dashboard.currency') }})</label>
                            <input type="number" id="cottage_price" name="price" class="form-control" placeholder="0" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cottage_description">{{ __('dashboard.description') }}</label>
                            <textarea id="cottage_description" name="description" class="form-control" placeholder="{{ __('dashboard.enter_description') }}" required></textarea>
                        </div>
                    </div>
                    
                    <!-- Images Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-images"></i>
                            {{ __('dashboard.images') }}
                    </div>
                    
                    <div class="form-group">
                        <label for="cottage_cover">{{ __('dashboard.cover_image') }}</label>
                            <div class="file-input-wrapper">
                        <input type="file" id="cottage_cover" name="cover" accept="image/*" required>
                                <div class="file-input-content">
                                    <i class="fas fa-image"></i>
                                    <div class="title">{{ __('dashboard.select_cover_image') }}</div>
                                    <div class="subtitle">{{ __('dashboard.recommended_size') }}: 800x600px</div>
                                </div>
                            </div>
                        <div class="image-preview">
                                <img id="cover_preview" src="" alt="{{ __('dashboard.cover_image') }}" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cottage_images">{{ __('dashboard.cottage_images') }}</label>
                            <div class="file-input-wrapper">
                        <input type="file" id="cottage_images" name="images[]" accept="image/*" multiple>
                                <div class="file-input-content">
                                    <i class="fas fa-images"></i>
                                    <div class="title">{{ __('dashboard.select_multiple_images') }}</div>
                                    <div class="subtitle">{{ __('dashboard.up_to_10_images') }}</div>
                                </div>
                            </div>
                        <div id="images_preview" class="images-preview-container"></div>
                    </div>
                    </div>

                    <!-- Features Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-star"></i>
                            {{ __('dashboard.features') }}
                        </div>
                        
                        <div class="form-group">
                            <label>{{ __('dashboard.select_features') }}</label>
                            <div class="features-grid">
                                @php
                                    $availableFeatures = [
                                        ['icon' => 'fas fa-bed', 'name' => 'غرفة نوم فاخرة', 'key' => 'luxury_bedroom'],
                                        ['icon' => 'fas fa-wind', 'name' => 'تكييف مركزي', 'key' => 'central_ac'],
                                        ['icon' => 'fas fa-wifi', 'name' => 'إنترنت فائق السرعة', 'key' => 'high_speed_wifi'],
                                        ['icon' => 'fas fa-tv', 'name' => 'تلفاز ذكي', 'key' => 'smart_tv'],
                                        ['icon' => 'fas fa-shower', 'name' => 'حمام فاخر', 'key' => 'luxury_bathroom'],
                                        ['icon' => 'fas fa-umbrella-beach', 'name' => 'شرفة مطلة على البحر', 'key' => 'sea_view_balcony'],
                                        ['icon' => 'fas fa-swimming-pool', 'name' => 'مسبح خاص', 'key' => 'private_pool'],
                                        ['icon' => 'fas fa-utensils', 'name' => 'مطبخ مجهز', 'key' => 'equipped_kitchen'],
                                        ['icon' => 'fas fa-car', 'name' => 'موقف سيارات', 'key' => 'parking'],
                                        ['icon' => 'fas fa-shield-alt', 'name' => 'نظام أمان 24/7', 'key' => 'security_system'],
                                        ['icon' => 'fas fa-broom', 'name' => 'خدمة تنظيف يومية', 'key' => 'daily_cleaning'],
                                        ['icon' => 'fas fa-concierge-bell', 'name' => 'خدمة كونسيرج', 'key' => 'concierge_service'],
                                        ['icon' => 'fas fa-dumbbell', 'name' => 'صالة رياضية', 'key' => 'gym'],
                                        ['icon' => 'fas fa-spa', 'name' => 'سبا ومساج', 'key' => 'spa_massage'],
                                        ['icon' => 'fas fa-baby-carriage', 'name' => 'مناسب للأطفال', 'key' => 'child_friendly'],
                                        ['icon' => 'fas fa-wheelchair', 'name' => 'مناسب لذوي الاحتياجات', 'key' => 'accessible'],
                                        ['icon' => 'fas fa-smoking-ban', 'name' => 'منطقة غير مدخنة', 'key' => 'non_smoking'],
                                        ['icon' => 'fas fa-paw', 'name' => 'يسمح بالحيوانات الأليفة', 'key' => 'pet_friendly']
                                    ];
                                @endphp
                                
                                @foreach($availableFeatures as $feature)
                                    <div class="feature-checkbox-wrapper">
                                        <input type="checkbox" id="feature_{{ $feature['key'] }}" name="features[]" value="{{ $feature['key'] }}" class="feature-checkbox">
                                        <label for="feature_{{ $feature['key'] }}" class="feature-checkbox-label">
                                            <i class="{{ $feature['icon'] }}"></i>
                                            <span>{{ $feature['name'] }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    
                    <!-- Settings Section -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-cog"></i>
                            {{ __('dashboard.settings') }}
                        </div>
                        
                        <div class="form-group">
                            <div class="checkbox-wrapper">
                                <input type="hidden" name="featured" value="0">
                                <input type="checkbox" id="cottage_featured" name="featured" value="1">
                                <label for="cottage_featured" class="checkbox-label">
                                    <strong>{{ __('dashboard.is_featured') }}</strong><br>
                                    <small>{{ __('dashboard.featured_cottages_appear_first') }}</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeCottageModal()">{{ __('dashboard.cancel') }}</button>
                <button type="submit" class="btn-primary" form="cottageForm">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('dashboard.confirm_delete') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{ __('dashboard.confirm_delete') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeDeleteModal()">{{ __('dashboard.cancel') }}</button>
                <button type="button" class="btn-danger" onclick="confirmDelete()">{{ __('dashboard.delete') }}</button>
            </div>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('dashboard.add_images') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="imageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="gallery_images">{{ __('dashboard.select_images') }}</label>
                        <div class="file-input-wrapper">
                        <input type="file" id="gallery_images" name="images[]" accept="image/*" multiple required>
                            <div class="file-input-content">
                                <i class="fas fa-images"></i>
                                <div class="title">{{ __('dashboard.select_gallery_images') }}</div>
                                <div class="subtitle">{{ __('dashboard.multiple_images_supported') }}</div>
                            </div>
                        </div>
                        <div id="gallery_preview" class="images-preview-container"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeImageModal()">{{ __('dashboard.cancel') }}</button>
                <button type="submit" class="btn-primary" form="imageForm">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>

    <!-- Add Video Modal -->
    <div id="videoModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('dashboard.add_video') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="videoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="video_file">{{ __('dashboard.select_video') }}</label>
                        <div class="file-input-wrapper">
                        <input type="file" id="video_file" name="video" accept="video/mp4" required>
                            <div class="file-input-content">
                                <i class="fas fa-video"></i>
                                <div class="title">{{ __('dashboard.select_video_file') }}</div>
                                <div class="subtitle">{{ __('dashboard.mp4_format_only') }}</div>
                            </div>
                        </div>
                        <div class="video-preview">
                            <video id="video_preview" controls style="width: 100%; display: none;">
                                <source src="" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeVideoModal()">{{ __('dashboard.cancel') }}</button>
                <button type="submit" class="btn-primary" form="videoForm">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>

    <!-- Add Hero Image Modal -->
    <div id="heroImageModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('dashboard.add_hero_image') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="heroImageForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="hero_image">{{ __('dashboard.select_hero_image') }}</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="hero_image" name="hero_image" accept="image/*" required>
                            <div class="file-input-content">
                                <i class="fas fa-image"></i>
                                <div class="title">{{ __('dashboard.select_hero_image') }}</div>
                                <div class="subtitle">{{ __('dashboard.recommended_size') }}: 1920x1080px {{ __('dashboard.or_higher') }}</div>
                            </div>
                        </div>
                        <div class="image-preview">
                            <img id="hero_image_preview" src="" alt="{{ __('dashboard.hero_image_preview') }}" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="set_as_primary" name="set_as_primary">
                            <label for="set_as_primary" class="checkbox-label">
                                <strong>{{ __('dashboard.set_as_primary_hero') }}</strong><br>
                                <small>{{ __('dashboard.primary_image_shows_first') }}</small>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeHeroImageModal()">{{ __('dashboard.cancel') }}</button>
                <button type="submit" class="btn-primary" form="heroImageForm">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>

    <!-- Add Hero Video Modal -->
    <div id="heroVideoModal" class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('dashboard.add_hero_video') }}</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="heroVideoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="hero_video">{{ __('dashboard.select_hero_video') }}</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="hero_video" name="hero_video" accept="video/mp4" required>
                            <div class="file-input-content">
                                <i class="fas fa-video"></i>
                                <div class="title">{{ __('dashboard.select_hero_video') }}</div>
                                <div class="subtitle">{{ __('dashboard.video_will_replace_current') }}</div>
                            </div>
                        </div>
                        <div class="video-preview">
                            <video id="hero_video_preview" controls style="width: 100%; display: none;">
                                <source src="" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeHeroVideoModal()">{{ __('dashboard.cancel') }}</button>
                <button type="submit" class="btn-primary" form="heroVideoForm">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="bottom-nav d-md-none">
        <a href="#" class="bottom-nav-item active" data-section="cottages-section">
            <i class="fas fa-home"></i>
            <span>{{ __('dashboard.cottages') }}</span>
        </a>
        <a href="#" class="bottom-nav-item" data-section="bookings-section">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ __('dashboard.bookings') }}</span>
        </a>
        <a href="#" class="bottom-nav-item" data-section="images-section">
            <i class="fas fa-images"></i>
            <span>{{ __('dashboard.gallery') }}</span>
        </a>
        <a href="#" class="bottom-nav-item" data-section="settings-section">
            <i class="fas fa-cog"></i>
            <span>{{ __('dashboard.settings') }}</span>
        </a>
    </nav>

    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Modal Functions
        function openAddCottageModal() {
            const modal = document.getElementById('cottageModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('modalTitle').textContent = '{{ __("dashboard.add_cottage") }}';
                document.getElementById('cottageForm').reset();
                setupModalCloseHandlers('cottageModal');
            }
        }

        function openAddImageModal() {
            const modal = document.getElementById('imageModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('imageForm').reset();
                setupModalCloseHandlers('imageModal');
            }
        }

        function openAddVideoModal() {
            const modal = document.getElementById('videoModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('videoForm').reset();
                setupModalCloseHandlers('videoModal');
            }
        }

        function openAddHeroImageModal() {
            const modal = document.getElementById('heroImageModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('heroImageForm').reset();
                setupModalCloseHandlers('heroImageModal');
            }
        }

        function openAddHeroVideoModal() {
            const modal = document.getElementById('heroVideoModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('heroVideoForm').reset();
                setupModalCloseHandlers('heroVideoModal');
            }
        }

        function editCottage(cottage) {
            const modal = document.getElementById('cottageModal');
            if (modal) {
                modal.style.display = 'block';
                document.getElementById('modalTitle').textContent = '{{ __("dashboard.edit_cottage") }}';
                
                // Fill form with cottage data
                document.getElementById('cottage_name').value = cottage.name || '';
                document.getElementById('cottage_price').value = cottage.price || '';
                document.getElementById('cottage_description').value = cottage.description || '';
                document.getElementById('cottage_featured').checked = cottage.featured || false;
                
                setupModalCloseHandlers('cottageModal');
            }
        }

        function closeCottageModal() {
            closeModal('cottageModal');
        }

        function closeImageModal() {
            closeModal('imageModal');
        }

        function closeVideoModal() {
            closeModal('videoModal');
        }

        function closeHeroImageModal() {
            closeModal('heroImageModal');
        }

        function closeHeroVideoModal() {
            closeModal('heroVideoModal');
        }

        function closeDeleteModal() {
            closeModal('deleteModal');
        }

        // These variables are now declared in admin-dashboard.js

        // These functions are now defined in admin-dashboard.js

        // Helper function to close any modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // Setup modal close handlers
        function setupModalCloseHandlers(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

                const closeBtn = modal.querySelector('.modal-close');
                const overlay = modal.querySelector('.modal-overlay');
                
                if (closeBtn) {
                closeBtn.onclick = () => closeModal(modalId);
                }
                if (overlay) {
                overlay.onclick = () => closeModal(modalId);
                }
                
                // Close on Escape key
            const escapeHandler = function(e) {
                if (e.key === 'Escape') {
                    closeModal(modalId);
                    document.removeEventListener('keydown', escapeHandler);
                }
            };
            document.addEventListener('keydown', escapeHandler);
        }

        // File preview handlers
        document.addEventListener('DOMContentLoaded', function() {
            // Cover image preview
            const coverInput = document.getElementById('cottage_cover');
            if (coverInput) {
                coverInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('cover_preview');
                    if (file && preview) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Multiple images preview
            const imagesInput = document.getElementById('cottage_images');
            if (imagesInput) {
                imagesInput.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const preview = document.getElementById('images_preview');
                    if (files && preview) {
                        preview.innerHTML = '';
                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'image-preview-item';
                                div.style.backgroundImage = `url(${e.target.result})`;
                                preview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                });
            }



            // Gallery images preview
            const galleryInput = document.getElementById('gallery_images');
            if (galleryInput) {
                galleryInput.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const preview = document.getElementById('gallery_preview');
                    if (files && preview) {
                        preview.innerHTML = '';
                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const div = document.createElement('div');
                                div.className = 'image-preview-item';
                                div.style.backgroundImage = `url(${e.target.result})`;
                                preview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                });
            }

            // Video preview
            const videoInput = document.getElementById('video_file');
            if (videoInput) {
                videoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('video_preview');
                    if (file && preview) {
                        const url = URL.createObjectURL(file);
                        preview.src = url;
                        preview.style.display = 'block';
                    }
                });
            }

            // Hero image preview
            const heroImageInput = document.getElementById('hero_image');
            if (heroImageInput) {
                heroImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('hero_image_preview');
                    if (file && preview) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Hero video preview
            const heroVideoInput = document.getElementById('hero_video');
            if (heroVideoInput) {
                heroVideoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('hero_video_preview');
                    if (file && preview) {
                        const url = URL.createObjectURL(file);
                        preview.src = url;
                        preview.style.display = 'block';
                    }
                });
            }
        });



        // Helper function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Helper function to update file input after removing a file
        function updateFileInput(inputId, removedIndex) {
            const input = document.getElementById(inputId);
            if (!input) return;
            
            const dt = new DataTransfer();
            const files = input.files;
            
            for (let i = 0; i < files.length; i++) {
                if (i !== removedIndex) {
                    dt.items.add(files[i]);
                }
            }
            
            input.files = dt.files;
        }

        // Form submission handlers are now handled in admin-dashboard.js

        // Customer deletion function
        function deleteCustomer(customerId, customerName) {
            if (confirm(`هل أنت متأكد من حذف العميل "${customerName}"؟\nسيتم حذف جميع حجوزاته أيضاً.`)) {
                fetch(`/admin/customers/${customerId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('تم حذف العميل بنجاح');
                        location.reload(); // Refresh the page to update the table
                    } else {
                        alert('حدث خطأ أثناء حذف العميل: ' + (data.message || 'خطأ غير معروف'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف العميل');
                });
            }
        }

        // Message display function
        function showMessage(elementId, message, type) {
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = message;
                element.className = `message-area ${type}`;
                setTimeout(() => {
                    element.textContent = '';
                    element.className = 'message-area';
                }, 3000);
            }
        }

        // Review deletion function
        function deleteReview(reviewId, guestName) {
            if (confirm(`هل أنت متأكد من حذف تقييم "${guestName}"؟`)) {
                fetch(`/admin/reviews/${reviewId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('تم حذف التقييم بنجاح');
                        location.reload();
                    } else {
                        alert('حدث خطأ أثناء حذف التقييم: ' + (data.message || 'خطأ غير معروف'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء حذف التقييم');
                });
            }
        }

        // Blocked Dates Management Functions
        function fetchBlockedDates(cottageId) {
            fetch(`/api/cottages/${cottageId}/unavailable-dates`)
                .then(res => res.json())
                .then(dates => {
                    const list = document.getElementById(`blocked-dates-list-${cottageId}`);
                    if (list) {
                        list.innerHTML = '';
                        if (dates.length === 0) {
                            const li = document.createElement('li');
                            li.innerHTML = '<span style="color: var(--text-muted); font-style: italic;">لا توجد تواريخ محجوزة</span>';
                            list.appendChild(li);
                        } else {
                            dates.forEach(date => {
                                const li = document.createElement('li');
                                li.innerHTML = `
                                    <span>${date}</span>
                                    <button class="remove-btn" onclick="removeBlockedDate(${cottageId}, '${date}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                `;
                                list.appendChild(li);
                            });
                        }
                    }
                });
        }
        function addBlockedDate(cottageId) {
            const input = document.getElementById(`block-date-${cottageId}`);
            const dates = input.value.split(',').map(d => d.trim()).filter(Boolean);
            if (!dates.length) return alert('اختر تاريخاً واحداً على الأقل');
            fetch('/api/blocked-dates', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ cottage_id: cottageId, dates: dates })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    fetchBlockedDates(cottageId);
                    showMessage(`blocked-dates-msg-${cottageId}`, 'تم حجب التواريخ بنجاح', 'success');
                    input.value = '';
                } else {
                    showMessage(`blocked-dates-msg-${cottageId}`, 'حدث خطأ!', 'error');
                }
            });
        }
        function removeBlockedDate(cottageId, date) {
            // Add a small delay to prevent rate limiting
            setTimeout(() => {
                // URL encode the date parameter to handle hyphens properly
                const encodedDate = encodeURIComponent(date);
                fetch(`/api/blocked-dates/${cottageId}/${encodedDate}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    console.log('Response status:', res.status);
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        fetchBlockedDates(cottageId);
                        showMessage(`blocked-dates-msg-${cottageId}`, 'تم إلغاء الحجب', 'success');
                    } else {
                        showMessage(`blocked-dates-msg-${cottageId}`, 'حدث خطأ!', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error removing blocked date:', error);
                    showMessage(`blocked-dates-msg-${cottageId}`, 'حدث خطأ في الاتصال', 'error');
                });
            }, 100); // 100ms delay
        }
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($cottages ?? [] as $cottage)
                fetchBlockedDates({{ $cottage->id }});
                // Enable multi-date selection for blocking
                if (window.flatpickr) {
                    flatpickr(`#block-date-{{ $cottage->id }}`, {
                        mode: 'multiple',
                        minDate: 'today',
                        dateFormat: 'Y-m-d',
                    });
                }
            @endforeach
        });

        // Special Prices Management Functions
        function fetchSpecialPrices(cottageId) {
            fetch(`/api/cottages/${cottageId}/special-prices`)
                .then(res => res.json())
                .then(prices => {
                    const list = document.getElementById(`special-price-list-${cottageId}`);
                    if (list) {
                        list.innerHTML = '';
                        if (prices.length === 0) {
                            const li = document.createElement('li');
                            li.innerHTML = '<span style="color: var(--text-muted); font-style: italic;">لا توجد أسعار خاصة</span>';
                            list.appendChild(li);
                        } else {
                            prices.forEach(item => {
                                const li = document.createElement('li');
                                li.innerHTML = `
                                    <span>${item.date}: ${item.price} د.ل</span>
                                    <button class="remove-btn" onclick="removeSpecialPrice(${cottageId}, '${item.date}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                `;
                                list.appendChild(li);
                            });
                        }
                    }
                });
        }
        function addSpecialPrice(cottageId) {
            const input = document.getElementById(`special-price-date-${cottageId}`);
            const priceInput = document.getElementById(`special-price-value-${cottageId}`);
            const dates = input.value.split(',').map(d => d.trim()).filter(Boolean);
            const price = priceInput.value;
            if (!dates.length || !price) return alert('اختر تواريخ وأدخل السعر الخاص');
            fetch('/api/special-prices', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ cottage_id: cottageId, dates: dates, price: price })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    fetchSpecialPrices(cottageId);
                    showMessage(`special-price-msg-${cottageId}`, 'تم تعيين السعر الخاص بنجاح', 'success');
                    input.value = '';
                    priceInput.value = '';
                } else {
                    showMessage(`special-price-msg-${cottageId}`, 'حدث خطأ!', 'error');
                }
            });
        }
        function removeSpecialPrice(cottageId, date) {
            // Add a small delay to prevent rate limiting
            setTimeout(() => {
                // URL encode the date parameter to handle hyphens properly
                const encodedDate = encodeURIComponent(date);
                fetch(`/api/special-prices/${cottageId}/${encodedDate}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    console.log('Response status:', res.status);
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        fetchSpecialPrices(cottageId);
                        showMessage(`special-price-msg-${cottageId}`, 'تم إلغاء السعر الخاص', 'success');
                    } else {
                        showMessage(`special-price-msg-${cottageId}`, 'حدث خطأ!', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error removing special price:', error);
                    showMessage(`special-price-msg-${cottageId}`, 'حدث خطأ في الاتصال', 'error');
                });
            }, 100); // 100ms delay
        }
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($cottages ?? [] as $cottage)
                fetchSpecialPrices({{ $cottage->id }});
                // Enable multi-date selection for special prices
                if (window.flatpickr) {
                    flatpickr(`#special-price-date-{{ $cottage->id }}`, {
                        mode: 'multiple',
                        minDate: 'today',
                        dateFormat: 'Y-m-d',
                    });
                }
            @endforeach
        });
    </script>
</body>
</html> 