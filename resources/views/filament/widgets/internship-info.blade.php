{{-- resources/views/filament/widgets/internship-info.blade.php --}}

<div class="internship-banner">
    <div class="internship-content">
        <div class="internship-icon">🎓</div>
        <div class="internship-text">
            <h3>Internship Project - E-Commerce Management System</h3>
            <p>This is a demo project created for internship purposes. All features are fully functional for demonstration.</p>
            <div class="internship-tags">
                <span class="tag">👨‍💻 Intern: Umesh</span>
                <span class="tag">🚀 Laravel 12</span>
                <span class="tag">✨ Filament 3</span>
                <span class="tag">💾 MySQL</span>
                <span class="tag">📧 Email Integration</span>
            </div>
        </div>
    </div>
</div>

<style>
.internship-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    margin-bottom: 20px;
    padding: 20px;
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.internship-content {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    color: white;
}

.internship-icon {
    font-size: 48px;
}

.internship-text h3 {
    margin: 0 0 8px 0;
    font-size: 20px;
    font-weight: 600;
}

.internship-text p {
    margin: 0 0 12px 0;
    opacity: 0.95;
}

.internship-tags {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.tag {
    background: rgba(255,255,255,0.2);
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
}

@media (max-width: 768px) {
    .internship-content {
        flex-direction: column;
        text-align: center;
    }
    
    .internship-tags {
        justify-content: center;
    }
}
</style>