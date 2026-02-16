@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10 font-sans text-gray-800">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Checkout Process</h1>

        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- LEFT COLUMN: Shipping Form -->
                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <span
                                class="bg-orange-100 text-orange-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                            Informasi Pengiriman
                        </h2>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap Penerima <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="customer_name" required
                                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 py-3 px-4 shadow-sm transition-all"
                                    placeholder="Nama Lengkap sesuai KTP">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp/HP <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm font-bold">+62</span>
                                    </div>
                                    <input type="tel" name="customer_phone" required
                                        class="w-full pl-12 rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 py-3 px-4 shadow-sm transition-all"
                                        placeholder="81234567890">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Kami akan menghubungi via WhatsApp untuk
                                    konfirmasi pesanan.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap Pengiriman
                                    <span class="text-red-500">*</span></label>
                                <textarea name="customer_address" rows="4" required
                                    class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 py-3 px-4 shadow-sm transition-all"
                                    placeholder="Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos."></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- RIGHT COLUMN: Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 sticky top-24">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Ringkasan
                                Pesanan
                            </h2>

                            <!-- Mini Cart Preview -->
                            <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach($cart as $item)
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded overflow-hidden flex-shrink-0 border border-gray-200">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 truncate">{{ $item['name'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $item['quantity'] }} x Rp {{
                                            number_format((int)$item['price'], 0, ',', '.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-gray-900">Rp {{
                                            number_format((int)$item['price'] *
                                            (int)$item['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-2 text-sm mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($grandTotal, 0, ',', '.')
                                        }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Biaya Pengiriman</span>
                                    <span class="font-bold text-green-600 uppercase">Gratis</span>
                                </div>
                                <div
                                    class="flex justify-between items-center pt-2 mt-2 border-t border-dashed border-gray-200">
                                    <span class="text-lg font-bold text-gray-900">Total Bayar</span>
                                    <span class="text-2xl font-extrabold text-orange-600">Rp {{
                                        number_format($grandTotal,
                                        0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" id="pay-button"
                                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-4 rounded-xl shadow-md transition-all transform hover:-translate-y-1 block text-center flex items-center justify-center gap-2">
                                <span id="btn-text">Konfirmasi Pesanan</span>
                                <svg id="btn-spinner" class="animate-spin h-5 w-5 text-white hidden"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>

<!-- Midtrans Snap -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    const payButton = document.getElementById('pay-button');
    const form = document.getElementById('checkout-form');
    const btnText = document.getElementById('btn-text');
    const btnSpinner = document.getElementById('btn-spinner');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Basic Validation
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Loading State
        payButton.disabled = true;
        btnText.innerText = 'Processing...';
        btnSpinner.classList.remove('hidden');

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch("{{ route('checkout.process') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Terjadi kesalahan.');
            }

            // Snap Pop-up
            window.snap.pay(result.snap_token, {
                onSuccess: function (resultMidtrans) {
                    window.location.href = "{{ route('payment.finish') }}?order_id=" + result.order_db_id;
                },
                onPending: function (resultMidtrans) {
                    alert("Menunggu pembayaran!");
                    window.location.href = "{{ route('payment.finish') }}?order_id=" + result.order_db_id;
                },
                onError: function (resultMidtrans) {
                    alert("Pembayaran gagal!");
                    payButton.disabled = false;
                    btnText.innerText = 'Konfirmasi Pesanan';
                    btnSpinner.classList.add('hidden');
                },
                onClose: function () {
                    payButton.disabled = false;
                    btnText.innerText = 'Konfirmasi Pesanan';
                    btnSpinner.classList.add('hidden');
                }
            });

        } catch (error) {
            console.error(error);
            alert(error.message);
            payButton.disabled = false;
            btnText.innerText = 'Konfirmasi Pesanan';
            btnSpinner.classList.add('hidden');
        }
    });
</script>
@endsection