@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')

{{-- PAGE TITLE --}}
<h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard HairCare</h1>

{{-- STAT CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Pengguna --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <i class="fa-solid fa-users text-pink-400 text-lg"></i>
            <span class="text-gray-500 font-medium text-sm">Total Pengguna</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($totalUsers) }}</p>
    </div>

    {{-- Produk Tersedia --}}
    <div class="bg-pink-50 rounded-xl p-6 shadow-sm border border-pink-100">
        <div class="flex items-center gap-3 mb-2">
            <i class="fa-solid fa-box text-pink-400 text-lg"></i>
            <span class="text-gray-500 font-medium text-sm">Produk Tersedia</span>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ number_format($totalProducts) }}</p>
    </div>

    {{-- Top Produk --}}
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center gap-3 mb-2">
            <i class="fa-solid fa-ranking-star text-pink-400 text-lg"></i>
            <span class="text-gray-500 font-medium text-sm">Top Produk</span>
        </div>
        <p class="text-xl font-bold text-gray-800">{{ $topProduct ? $topProduct->name : '-' }}</p>
    </div>
</div>

{{-- TOP KATEGORI CHART --}}
<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
    <h2 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fa-solid fa-chart-bar text-pink-400 mr-2"></i>Top Kategori
    </h2>
    <div id="topKategoriChart"></div>
</div>

{{-- RIWAYAT INTERAKSI PENGGUNA --}}
<div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
    <h2 class="text-lg font-bold text-gray-800 mb-4">
        <i class="fa-solid fa-clock-rotate-left text-pink-400 mr-2"></i>Riwayat Interaksi Pengguna
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Pengguna</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Masalah Rambut</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Produk yang Direkomendasikan</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAssessments as $assessment)
                <tr class="border-b border-gray-100 hover:bg-pink-50/50 transition-colors">
                    <td class="py-3 px-4 text-gray-700">{{ $assessment->user->name ?? '-' }}</td>
                    <td class="py-3 px-4 text-gray-600">
                        {{ ucfirst(str_replace('_', ' ', $assessment->hair_problem)) }}
                    </td>
                    <td class="py-3 px-4 text-gray-600">
                        {{ $assessment->hair_type ? ucfirst($assessment->hair_type) : '-' }}
                    </td>
                    <td class="py-3 px-4 text-gray-500">{{ $assessment->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 text-center text-gray-400">Belum ada data interaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [{
                name: 'Jumlah Produk',
                data: {!! json_encode($categoryChart['counts']) !!}
            }],
            chart: {
                type: 'bar',
                height: 280,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    borderRadius: 6,
                    barHeight: '55%',
                    distributed: true
                }
            },
            colors: ['#ec4899', '#f472b6', '#f9a8d4', '#fbcfe8', '#fce7f3'],
            dataLabels: { enabled: false },
            xaxis: {
                categories: {!! json_encode($categoryChart['names']) !!},
                labels: { style: { colors: '#6b7280', fontSize: '13px' } }
            },
            yaxis: {
                labels: { style: { colors: '#374151', fontSize: '13px', fontWeight: 500 } }
            },
            grid: {
                borderColor: '#f3f4f6',
                xaxis: { lines: { show: true } },
                yaxis: { lines: { show: false } }
            },
            legend: { show: false },
            tooltip: {
                theme: 'light',
                y: { formatter: val => val + ' produk' }
            }
        };

        var chart = new ApexCharts(document.querySelector("#topKategoriChart"), options);
        chart.render();
    });
</script>
@endsection
