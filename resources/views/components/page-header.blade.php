<div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

    <div>

        <h1 class="text-3xl font-bold text-gray-900">
            {{ $title }}
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            {{ $description }}
        </p>

    </div>

    <a href="{{ route($createRoute) }}"
        class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">

        <i class="bi bi-plus-circle mr-2"></i>

        {{ $button }}

    </a>

</div>