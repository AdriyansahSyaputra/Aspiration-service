<x-dashboard.layout>

    <div class="w-full h-full p-2">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-slate-600">Lihat semua laporan dari, {{ $user->name }}</h1>

            <button onclick="history.back()" class="px-4 py-2 bg-red-500 text-white rounded-lg">Kembali</button>

        </div>

        {{-- Card reports --}}
        <div class="grid grid-cols-4 w-full gap-4">

            @foreach ($reports as $report)
            <div class="bg-white p-4 rounded-md shadow-md w-full h-full space-y-4">
                <h1 class="text-lg font-semibold text-slate-600">{{ $report->title }}</h1>

                <div class="bg-gray-100 w-full min-h-fit p-2 overflow-hidden">
                    <p class="text-sm text-gray-600 description">{{ $report->aspiration }}</p>
                </div>

                <p class="text-xs text-gray-500 font-light">{{ $report->date_occurred }}</p>

                <div class="flex justify-end">
                    <a href="{{ route('reports.show', $report->slug) }}" class="px-2 py-2 bg-blue-500 text-white rounded-lg text-sm">Lihat Laporan</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</x-dashboard.layout>

<script>
    const descriptions = document.querySelectorAll('.description');
    descriptions.forEach(description => {
        const words = description.textContent.split(' ');
        description.textContent = words.length > 20 ? words.slice(0, 20).join(' ') + '...' : description
            .textContent;
    });
</script>
