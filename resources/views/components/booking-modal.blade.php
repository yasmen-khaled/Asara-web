<!-- Booking Modal Component -->
<div class="booking-modal" id="bookingModal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <button class="modal-close" aria-label="إغلاق">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-header">
            <h3>احجز إقامتك</h3>
            <p class="cottage-name"></p>
        </div>

        <div class="modal-body">
            <!-- Date Selection -->
            <div class="date-selection">
                <div class="date-group">
                    <label>تاريخ الوصول</label>
                    <input type="date" id="modalCheckIn" class="date-input">
                </div>
                <div class="date-group">
                    <label>تاريخ المغادرة</label>
                    <input type="date" id="modalCheckOut" class="date-input">
                </div>
            </div>

            <!-- Guest Selection -->
            <div class="guest-selection">
                <label>عدد الضيوف</label>
                <select id="modalGuests">
                    <option value="2">2 ضيوف</option>
                    <option value="3">3 ضيوف</option>
                    <option value="4" selected>4 ضيوف</option>
                    <option value="5">5 ضيوف</option>
                    <option value="6">6 ضيوف</option>
                    <option value="8">8+ ضيوف</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="notes-section">
                <label>ملاحظات إضافية</label>
                <textarea id="modalNotes" rows="3" placeholder="هل لديك أي متطلبات خاصة؟"></textarea>
            </div>

            <!-- Customer Info -->
            <div class="customer-info">
                <div class="info-group">
                    <label>الاسم الكريم</label>
                    <input type="text" id="modalName" class="info-input" placeholder="أدخل اسمك" required>
                </div>
                <div class="info-group">
                    <label>رقم الهاتف</label>
                    <input type="text" id="modalPhone" class="info-input" placeholder="أدخل رقم هاتفك" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="submit-booking" onclick="submitBooking()">
                <i class="fab fa-whatsapp"></i>
                تأكيد الحجز
            </button>
        </div>
    </div>
</div>

<style>
/* RTL Support for Modal */
.modal-content {
    text-align: right;
    direction: rtl;
    font-family: 'Cairo', 'Tajawal', sans-serif;
}

.modal-close {
    left: auto;
    right: 20px;
}

.date-selection {
    direction: rtl;
}

.date-input,
#modalGuests,
#modalNotes,
.info-input {
    font-family: 'Cairo', 'Tajawal', sans-serif;
    text-align: right;
}

.submit-booking {
    font-family: 'Cairo', 'Tajawal', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.submit-booking i {
    margin-left: 8px;
}
</style>

<style>
.booking-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1000;
    font-family: 'Cairo', 'Tajawal', sans-serif;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
}

.modal-content {
    position: relative;
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    background: white;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    direction: rtl;
    max-height: 80vh;
    overflow-y: auto;
}

.modal-close {
    position: absolute;
    top: 20px;
    left: 20px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modal-close:hover {
    color: #e74c3c;
    transform: scale(1.1);
}

.modal-header {
    text-align: center;
    margin-bottom: 30px;
}

.modal-header h3 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 10px;
}

.cottage-name {
    color: #666;
    font-size: 1.1rem;
}

.date-selection {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.date-group {
    display: flex;
    flex-direction: column;
}

.customer-info {
    margin-bottom: 25px;
}

.info-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.info-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.info-input {
    padding: 12px 15px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.info-input:focus {
    outline: none;
    border-color: #3498db;
    background: white;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.info-input::placeholder {
    color: #95a5a6;
}

.date-group label,
.guest-selection label,
.notes-section label {
    margin-bottom: 8px;
    color: #2c3e50;
    font-weight: 500;
}

.date-input,
.guest-selection select,
.notes-section textarea {
    padding: 12px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.date-input:focus,
.guest-selection select:focus,
.notes-section textarea:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.guest-selection,
.notes-section {
    margin-bottom: 25px;
}

.guest-selection select {
    width: 100%;
}

.notes-section textarea {
    width: 100%;
    resize: vertical;
}

.modal-footer {
    text-align: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e1e8ed;
}

.submit-booking {
    background: #25d366;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.submit-booking:hover {
    background: #128c7e;
    transform: translateY(-2px);
}

.submit-booking i {
    font-size: 1.2rem;
}

@media (max-width: 768px) {
    .booking-modal {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 10px;
    }

    .modal-content {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 20px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 12px;
    }

    .modal-header {
        margin-bottom: 20px;
    }

    .modal-header h3 {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    .cottage-name {
        font-size: 1rem;
    }

    .date-selection {
        grid-template-columns: 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .guest-selection,
    .notes-section,
    .customer-info {
        margin-bottom: 20px;
    }

    .info-group {
        margin-bottom: 12px;
    }

    .date-input,
    .guest-selection select,
    .notes-section textarea,
    .info-input {
        padding: 10px 12px;
        font-size: 16px; /* Prevent zoom on iOS */
    }

    .notes-section textarea {
        min-height: 60px;
        max-height: 100px;
    }

    .submit-booking {
        width: 100%;
        padding: 12px 20px;
        font-size: 1rem;
        margin-top: 10px;
        position: sticky;
        bottom: 0;
        background: #25d366;
        z-index: 10;
    }

    .modal-body {
        padding-bottom: 80px; /* Space for sticky button */
    }

    .modal-close {
        top: 15px;
        left: 15px;
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .booking-modal {
        padding: 5px;
    }

    .modal-content {
        padding: 15px;
        max-height: 95vh;
    }

    .modal-header h3 {
        font-size: 1.3rem;
    }

    .cottage-name {
        font-size: 0.9rem;
    }

    .date-selection {
        gap: 12px;
        margin-bottom: 15px;
    }

    .guest-selection,
    .notes-section,
    .customer-info {
        margin-bottom: 15px;
    }

    .info-group {
        margin-bottom: 10px;
    }

    .info-group label,
    .date-group label,
    .guest-selection label,
    .notes-section label {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }

    .date-input,
    .guest-selection select,
    .notes-section textarea,
    .info-input {
        padding: 8px 10px;
        font-size: 14px;
    }

    .submit-booking {
        padding: 10px 16px;
        font-size: 0.95rem;
        position: sticky;
        bottom: 0;
        background: #25d366;
        z-index: 10;
    }

    .modal-body {
        padding-bottom: 70px; /* Space for sticky button */
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum dates for booking form
    const checkinInput = document.getElementById('modalCheckIn');
    const checkoutInput = document.getElementById('modalCheckOut');

    if (checkinInput && checkoutInput) {
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        checkinInput.min = today;
        checkoutInput.min = today;
        
        // Set default values
        checkinInput.value = today;
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        checkoutInput.value = tomorrow.toISOString().split('T')[0];

        // Update checkout minimum when checkin changes
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            checkinDate.setDate(checkinDate.getDate() + 1); // Next day minimum
            checkoutInput.min = checkinDate.toISOString().split('T')[0];
            
            // Clear checkout if it's now invalid
            if (checkoutInput.value && new Date(checkoutInput.value) <= new Date(this.value)) {
                checkoutInput.value = '';
            }
        });
    }
});
</script> 