{{-- resources/views/components/popup-ads.blade.php --}}

@if(isset($popupAds) && $popupAds->count() > 0)
@foreach($popupAds as $ad)
<div id="popup-{{ $ad->id }}" class="popup-overlay" style="display: none;">
    <div class="popup-container">
        <div class="popup-content">
            <button class="popup-close" onclick="closePopup({{ $ad->id }})">&times;</button>
            @if($ad->image)
                <img src="{{ \App\Helpers\ImageHelper::getAdImage($ad->image) }}" 
                     alt="{{ $ad->title }}"
                     class="popup-image">
            @endif
            <div class="popup-text">
                <h3>{{ $ad->title }}</h3>
                @if($ad->description)
                    <p>{!! nl2br(e($ad->description)) !!}</p>
                @endif
                @if($ad->url)
                    <a href="{{ $ad->url }}" 
                       class="popup-btn"
                       target="_blank"
                       onclick="trackAdClick({{ $ad->id }})">
                        Learn More →
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease-out;
}

.popup-container {
    max-width: 500px;
    width: 90%;
    animation: slideUp 0.3s ease-out;
}

.popup-content {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
}

.popup-close {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #666;
    z-index: 10;
}

.popup-close:hover {
    color: #000;
}

.popup-image {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
}

.popup-text {
    padding: 24px;
}

.popup-text h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 12px;
    color: #1f2937;
}

.popup-text p {
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 20px;
    white-space: pre-wrap;
}

.popup-btn {
    display: inline-block;
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    color: white;
    padding: 10px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.popup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($popupAds as $ad)
    setTimeout(function() {
        const popup = document.getElementById('popup-{{ $ad->id }}');
        if (popup && !localStorage.getItem('popup_closed_{{ $ad->id }}')) {
            popup.style.display = 'flex';
        }
    }, 2000);
    @endforeach
});

function closePopup(adId) {
    const popup = document.getElementById('popup-' + adId);
    if (popup) {
        popup.style.display = 'none';
        localStorage.setItem('popup_closed_' + adId, 'true');
    }
}

function trackAdClick(adId) {
    fetch('{{ route("track.ad.click") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ ad_id: adId })
    });
}
</script>
@endif