<x-mail::message>
# Halo, {{ $userName }}

Admin telah memberikan tanggapan terhadap aspirasi anda.

### Kode Laporan:
{{ $id }}

### Subject:
{{ $subject }}

### Tanggapan:
{{ $responseText }} 

<x-mail::button :url="'http://layanan-aspirasi.id/laporan-saya'">
Lihat Status Laporan
</x-mail::button>

Terima kasih telah menyampaikan aspirasi anda!<br>

Salam,  
{{ config('app.name') }}
</x-mail::message>
