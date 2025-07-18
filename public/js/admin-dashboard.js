// Admin Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Navigation functionality
    const navItems = document.querySelectorAll('.nav-item[data-section]');
    const contentSections = document.querySelectorAll('.content-section');
    const bottomNavItems = document.querySelectorAll('.bottom-nav-item[data-section]');

    function showSection(sectionId) {
        console.log('Switching to section:', sectionId);
        
        // Hide all sections
        contentSections.forEach(section => {
            section.style.display = 'none';
        });

        // Show target section
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.style.display = 'block';
            console.log('Section displayed:', sectionId);
        } else {
            console.error('Section not found:', sectionId);
        }

        // Update navigation active states
        navItems.forEach(item => {
            item.classList.remove('active');
            if (item.dataset.section === sectionId) {
                item.classList.add('active');
            }
        });

        bottomNavItems.forEach(item => {
            item.classList.remove('active');
            if (item.dataset.section === sectionId) {
                item.classList.add('active');
            }
        });
    }

    // Add click handlers to navigation items
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Navigation clicked:', this.dataset.section);
            showSection(this.dataset.section);
        });
    });

    bottomNavItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            showSection(this.dataset.section);
        });
    });

    // Mobile sidebar toggle
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.mobile-overlay');
        
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    // Make toggleSidebar globally available
    window.toggleSidebar = toggleSidebar;

    // Form submission handlers
    const cottageForm = document.getElementById('cottageForm');
    if (cottageForm) {
        cottageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const isEdit = document.getElementById('modalTitle').textContent.includes('تعديل');
            const url = isEdit ? `/admin/cottages/${this.dataset.cottageId}` : '/admin/cottages';
            
            // For PUT requests, we need to add the _method field
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            // Debug: Log form data
            console.log('Form submission details:');
            console.log('URL:', url);
            console.log('Method:', isEdit ? 'PUT (via POST)' : 'POST');
            console.log('Is Edit:', isEdit);
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }

            fetch(url, {
                method: 'POST', // Always use POST, Laravel will handle the method override
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('تم حفظ الشاليه بنجاح!');
                    closeCottageModal();
                    location.reload(); // Refresh to show updated data
                } else {
                    alert('حدث خطأ أثناء حفظ الشاليه');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.error('Error details:', error.message);
                alert('حدث خطأ أثناء حفظ الشاليه: ' + error.message);
            });
        });
    }

    // Image form submission
    const imageForm = document.getElementById('imageForm');
    if (imageForm) {
        imageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/gallery/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('تم رفع الصور بنجاح!');
                    closeImageModal();
                    location.reload();
                } else {
                    alert('حدث خطأ أثناء رفع الصور');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء رفع الصور');
            });
        });
    }

    // Video form submission
    const videoForm = document.getElementById('videoForm');
    if (videoForm) {
        videoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/videos/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('تم رفع الفيديو بنجاح!');
                    closeVideoModal();
                    location.reload();
                } else {
                    alert('حدث خطأ أثناء رفع الفيديو');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء رفع الفيديو');
            });
        });
    }

    // Hero image form submission
    const heroImageForm = document.getElementById('heroImageForm');
    if (heroImageForm) {
        heroImageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/hero-image/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('تم رفع الصورة الرئيسية بنجاح!\n\nملاحظة: يجب تحديث الصفحة الرئيسية لرؤية الصورة الجديدة.');
                    closeHeroImageModal();
                    location.reload();
                } else {
                    alert('حدث خطأ أثناء رفع الصورة الرئيسية');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء رفع الصورة الرئيسية');
            });
        });
    }

    // Hero video form submission
    const heroVideoForm = document.getElementById('heroVideoForm');
    if (heroVideoForm) {
        heroVideoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/hero-video/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('تم رفع الفيديو الرئيسي بنجاح!');
                    closeHeroVideoModal();
                    location.reload();
                } else {
                    alert('حدث خطأ أثناء رفع الفيديو الرئيسي');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء رفع الفيديو الرئيسي');
            });
        });
    }

    // Delete functionality
    window.confirmDelete = function() {
        if (deleteItemId && deleteItemType) {
            let url = '';
            
            switch(deleteItemType) {
                case 'cottage':
                    url = `/admin/cottages/${deleteItemId}`;
                    break;
                case 'image':
                    url = `/admin/gallery/delete/${deleteItemId}`;
                    break;
                case 'video':
                    url = `/admin/videos/delete/${deleteItemId}`;
                    break;
                case 'hero-image':
                    url = `/admin/hero-image/delete/${deleteItemId}`;
                    break;
                case 'hero-video':
                    url = `/admin/hero-video/delete/${deleteItemId}`;
                    break;
            }
            
            if (url) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        let message = 'تم الحذف بنجاح!';
                        if (deleteItemType === 'hero-image') {
                            message += '\n\nملاحظة: يجب تحديث الصفحة الرئيسية لرؤية التغييرات.';
                        }
                        alert(message);
                        closeDeleteModal();
                        location.reload();
                    } else {
                        alert('حدث خطأ أثناء الحذف');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء الحذف');
                });
            }
        }
    };

    // Edit cottage functionality
    window.editCottage = function(cottage) {
        const modal = document.getElementById('cottageModal');
        if (modal) {
            modal.style.display = 'block';
            document.getElementById('modalTitle').textContent = 'تعديل شاليه';
            
            // Fill form with cottage data
            document.getElementById('cottage_name').value = cottage.name || '';
            document.getElementById('cottage_price').value = cottage.price || '';
            document.getElementById('cottage_description').value = cottage.description || '';
            document.getElementById('cottage_featured').checked = cottage.featured || false;
            
            // Set cottage ID for edit mode
            cottageForm.dataset.cottageId = cottage.id;
            
            // Check features
            if (cottage.features) {
                cottage.features.forEach(feature => {
                    const checkbox = document.getElementById(`feature_${feature}`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });
            }
            
            setupModalCloseHandlers('cottageModal');
        }
    };

    // Modal close functionality
    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
        }
    };

    // Setup modal close handlers
    window.setupModalCloseHandlers = function(modalId) {
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
    };

    // File preview functionality
    function setupFilePreviews() {
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

        // Video previews
        const videoInputs = ['cottage_videos', 'cottage_main_video', 'video_file', 'hero_video'];
        videoInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const previewId = inputId === 'cottage_videos' ? 'videos_preview' : 
                                    inputId === 'cottage_main_video' ? 'main_video_preview' :
                                    inputId === 'video_file' ? 'video_preview' :
                                    inputId === 'hero_video' ? 'hero_video_preview' : null;
                    
                    if (file && previewId) {
                        const preview = document.getElementById(previewId);
                        if (preview) {
                            if (inputId === 'cottage_videos') {
                                // Handle multiple videos
                                const videoItem = createVideoPreviewItem(file, Date.now());
                                preview.appendChild(videoItem);
                            } else {
                                // Handle single video
                                const url = URL.createObjectURL(file);
                                preview.src = url;
                                preview.style.display = 'block';
                            }
                        }
                    }
                });
            }
        });
    }

    // Initialize file previews
    setupFilePreviews();
});

// Global functions for modal operations
window.openAddCottageModal = function() {
    const modal = document.getElementById('cottageModal');
    if (modal) {
        modal.style.display = 'block';
        document.getElementById('modalTitle').textContent = 'إضافة شاليه جديد';
        document.getElementById('cottageForm').reset();
        document.getElementById('cottageForm').removeAttribute('data-cottage-id');
        setupModalCloseHandlers('cottageModal');
    }
};

window.openAddImageModal = function() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.style.display = 'block';
        document.getElementById('imageForm').reset();
        setupModalCloseHandlers('imageModal');
    }
};

window.openAddVideoModal = function() {
    const modal = document.getElementById('videoModal');
    if (modal) {
        modal.style.display = 'block';
        document.getElementById('videoForm').reset();
        setupModalCloseHandlers('videoModal');
    }
};

window.openAddHeroImageModal = function() {
    const modal = document.getElementById('heroImageModal');
    if (modal) {
        modal.style.display = 'block';
        document.getElementById('heroImageForm').reset();
        setupModalCloseHandlers('heroImageModal');
    }
};

window.openAddHeroVideoModal = function() {
    const modal = document.getElementById('heroVideoModal');
    if (modal) {
        modal.style.display = 'block';
        document.getElementById('heroVideoForm').reset();
        setupModalCloseHandlers('heroVideoModal');
    }
};

window.closeCottageModal = function() {
    closeModal('cottageModal');
};

window.closeImageModal = function() {
    closeModal('imageModal');
};

window.closeVideoModal = function() {
    closeModal('videoModal');
};

window.closeHeroImageModal = function() {
    closeModal('heroImageModal');
};

window.closeHeroVideoModal = function() {
    closeModal('heroVideoModal');
};

window.closeDeleteModal = function() {
    closeModal('deleteModal');
};

let deleteItemId = null;
let deleteItemType = null;

window.openDeleteModal = function(id, type = 'cottage') {
    deleteItemId = id;
    deleteItemType = type;
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.style.display = 'block';
        setupModalCloseHandlers('deleteModal');
    }
};

window.deleteImage = function(filename) {
    openDeleteModal(filename, 'image');
};

window.deleteVideo = function(filename) {
    openDeleteModal(filename, 'video');
};

window.deleteHeroImage = function(filename) {
    openDeleteModal(filename, 'hero-image');
};

window.deleteHeroVideo = function(filename) {
    openDeleteModal(filename, 'hero-video');
};

window.setAsPrimaryHero = function(filename) {
    // Add logic to set image as primary hero image
    console.log('Setting as primary hero image:', filename);
    // You can add AJAX call here to update the backend
};

// Helper function to create video preview item
function createVideoPreviewItem(file, index) {
    const videoItem = document.createElement('div');
    videoItem.className = 'video-preview-item';
    
    const video = document.createElement('video');
    video.muted = true;
    video.preload = 'metadata';
    
    const url = URL.createObjectURL(file);
    video.src = url;
    
    const videoInfo = document.createElement('div');
    videoInfo.className = 'video-preview-info';
    
    const videoName = document.createElement('div');
    videoName.className = 'video-preview-name';
    videoName.textContent = file.name;
    
    const videoSize = document.createElement('div');
    videoSize.className = 'video-preview-size';
    videoSize.textContent = formatFileSize(file.size);
    
    const removeBtn = document.createElement('button');
    removeBtn.className = 'video-preview-remove';
    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
    removeBtn.onclick = function() {
        URL.revokeObjectURL(url);
        videoItem.remove();
    };
    
    const playBtn = document.createElement('button');
    playBtn.className = 'video-preview-play';
    playBtn.innerHTML = '<i class="fas fa-play"></i>';
    playBtn.onclick = function() {
        if (video.paused) {
            video.play();
            playBtn.innerHTML = '<i class="fas fa-pause"></i>';
        } else {
            video.pause();
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
        }
    };
    
    video.addEventListener('ended', function() {
        playBtn.innerHTML = '<i class="fas fa-play"></i>';
    });
    
    videoInfo.appendChild(videoName);
    videoInfo.appendChild(videoSize);
    videoItem.appendChild(video);
    videoItem.appendChild(videoInfo);
    videoItem.appendChild(removeBtn);
    videoItem.appendChild(playBtn);
    
    return videoItem;
}

// Helper function to format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
