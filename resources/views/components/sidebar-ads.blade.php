{{-- resources/views/components/sidebar-ads.blade.php --}}

@if(isset($sidebarAds) && $sidebarAds->count() > 0)
<div class="sidebar-ads space-y-4">
    @foreach($sidebarAds as $ad)
    <a href="{{ $ad->url ?: '#' }}" 
       target="{{ $ad->url ? '_blank' : '_self' }}"
       class="sidebar-ad block group"
       onclick="trackAdClick({{ $ad->id }})">
        <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
            @if($ad->image && \App\Helpers\ImageHelper::getAdImage($ad->image))
                <img src="{{ \App\Helpers\ImageHelper::getAdImage($ad->image) }}" 
                     alt="{{ $ad->title }}"
                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-48 bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center">
                    <div class="text-center p-6">
                        <div class="text-4xl mb-3">📢</div>
                        <h3 class="font-bold text-gray-800">{{ $ad->title }}</h3>
                        @if($ad->description)
                            <p class="text-sm text-gray-600 mt-2">{!! nl2br(e($ad->description)) !!}</p>
                        @endif
                    </div>
                </div>
            @endif
            @if($ad->description && $ad->image)
                <div class="p-4">
                    <p class="text-sm text-gray-600">{!! nl2br(e($ad->description)) !!}</p>
                </div>
            @endif
        </div>
    </a>
    @endforeach
</div>

<script>
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