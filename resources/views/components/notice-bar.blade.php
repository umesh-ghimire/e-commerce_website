{{-- resources/views/components/notice-bar.blade.php --}}

@if(isset($notices) && $notices->count() > 0)
<div class="notice-container">
    @foreach($notices as $notice)
    <div class="notice-card notice-{{ $notice->type }} {{ $notice->is_pinned ? 'notice-pinned' : '' }}">
        <div class="notice-header">
            <span class="notice-icon">
                @switch($notice->type)
                    @case('info') ℹ️ @break
                    @case('success') ✅ @break
                    @case('warning') ⚠️ @break
                    @case('danger') 🔴 @break
                @endswitch
            </span>
            <strong class="notice-title">{{ $notice->title }}</strong>
            @if($notice->is_pinned)
                <span class="pin-badge">📌 Pinned</span>
            @endif
        </div>
        <div class="notice-content">
            {!! nl2br(e($notice->content)) !!}
        </div>
    </div>
    @endforeach
</div>

<style>
.notice-container {
    max-width: 1280px;
    margin: 20px auto;
    padding: 0 20px;
}

.notice-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-left: 4px solid;
}

.notice-pinned {
    background: linear-gradient(135deg, #fff9e6 0%, #fff 100%);
    border-left-width: 6px;
}

.notice-info {
    border-left-color: #3b82f6;
    background: #eff6ff;
}

.notice-success {
    border-left-color: #10b981;
    background: #ecfdf5;
}

.notice-warning {
    border-left-color: #f59e0b;
    background: #fffbeb;
}

.notice-danger {
    border-left-color: #ef4444;
    background: #fef2f2;
}

.notice-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-wrap: wrap;
}

.notice-icon {
    font-size: 20px;
}

.notice-title {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
}

.pin-badge {
    background: #f59e0b;
    color: white;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 500;
}

.notice-content {
    color: #4b5563;
    line-height: 1.6;
    white-space: pre-wrap;
}

@media (max-width: 768px) {
    .notice-card {
        padding: 15px;
    }
    .notice-title {
        font-size: 16px;
    }
}
</style>
@endif