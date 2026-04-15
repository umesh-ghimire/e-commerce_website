<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
                @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('profile.notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-emerald-600 hover:text-emerald-700">Mark all as read</button>
                </form>
                @endif
            </div>

            @if($notifications->count() > 0)
                <div class="space-y-3">
                    @foreach($notifications as $notification)
                    <div class="bg-white rounded-2xl shadow-sm p-4 {{ !$notification->is_read ? 'border-l-4 border-emerald-500' : '' }}">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $notification->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notification->is_read)
                            <form action="{{ route('profile.notification.read', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-gray-600">Mark read</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $notifications->links() }}</div>
            @else
                <div class="bg-white rounded-2xl p-12 text-center">
                    <p class="text-gray-500">No notifications</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>