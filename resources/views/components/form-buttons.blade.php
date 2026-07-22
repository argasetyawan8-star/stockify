<div class="mt-6 flex justify-end gap-3">

    <a href="{{ route($backRoute) }}"
        class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300">

        <i class="bi bi-arrow-left mr-1"></i>

        Kembali

    </a>

    <button
        type="submit"
        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">

        <i class="bi bi-check-circle mr-1"></i>

        {{ $submit }}

    </button>

</div>