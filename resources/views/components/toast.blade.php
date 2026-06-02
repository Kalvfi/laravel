@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.duration.500ms
        class="fixed bottom-5 right-5 bg-green-600 text-white font-bold px-6 py-3 rounded shadow-xl z-50">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.opacity.duration.500ms
        class="fixed bottom-5 right-5 bg-red-600 text-white font-bold px-6 py-3 rounded shadow-xl z-50">
        {{ session('error') }}
    </div>
@endif
