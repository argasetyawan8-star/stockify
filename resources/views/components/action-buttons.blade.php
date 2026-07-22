<div class="flex justify-center gap-2">

    <a href="{{ $editUrl }}"
        class="rounded-lg bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">

        <i class="bi bi-pencil-square"></i>

    </a>

    <form
        action="{{ $deleteUrl }}"
        method="POST">

        @csrf

        @method('DELETE')

        <button
            onclick="return confirm('Yakin ingin menghapus data ini?')"
            class="rounded-lg bg-red-600 px-3 py-2 text-white hover:bg-red-700">

            <i class="bi bi-trash"></i>

        </button>

    </form>

</div>