@php
/**
 * @var \App\Models\User $user
 */
@endphp
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/entry-icon.png" type="image/png">
    <title>Pénz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-100 dark:bg-stone-900 text-stone-800 dark:text-stone-200">

    @if (session()->pull('success'))
        <div id="success-notification" class="fixed top-4 left-1/2 -translate-x-1/2 w-full max-w-2xl p-4 bg-lime-400 border border-lime-600 text-lime-900 dark:bg-lime-800 dark:border-lime-900 dark:text-lime-400 rounded">
            Sikeresen elmentve.
        </div>
    @endif

    <form
        method="POST"
        x-data='entry(@json($categories))'
        x-on:submit="formDisabled = true"
        autocomplete="off"
        class="px-4 pt-8"
    >
        <div class="mx-auto w-full max-w-2xl rounded bg-stone-50 dark:bg-stone-800 border border-stone-200 dark:border-stone-700">
            <div class="px-4 py-2 rounded-t border-b border-stone-200 dark:border-stone-700">
                <p class="text-lg">Szia, <span class="font-bold">{{ $user->name }}</span>!</p>
            </div>

            <div class="p-4 rounded-b space-y-6">
                <div>
                    <label for="amount" class="block text-sm/6 font-medium">Összeg</label>

                    <div class="flex items-stretch w-full has-[:focus]:outline-1">
                        <input type="number"
                               name="amount"
                               id="amount"
                               min="1"
                               step="1"
                               required
                               class="basis-full grow text-right px-3 py-1 rounded-l border border-stone-200 dark:border-stone-700 focus:outline-hidden"
                        >

                        <div class="rounded-r bg-stone-200 dark:bg-stone-700 inline-flex items-center px-2">
                            Ft
                        </div>
                    </div>
                </div>

                <div>
                    <label for="date" class="block text-sm/6 font-medium">Dátum</label>

                    <div class="flex items-stretch w-full has-[:focus]:outline-1">
                        <input type="date"
                               name="date"
                               id="date"
                               required
                               value="{{ now()->format('Y-m-d') }}"
                               class="basis-full grow px-3 py-1 rounded-l border border-stone-200 dark:border-stone-700 focus:outline-hidden">
                    </div>
                </div>

                <div>
                    <label for="transaction_category_id" class="block text-sm/6 font-medium">Kategória</label>

                    <div class="flex items-stretch w-full has-[:focus]:outline-1">
                        <select
                            x-model="selectedCategoryId"
                            name="transaction_category_id"
                            id="transaction_category_id"
                            required
                            class="basis-full grow px-3 py-2 rounded-l border border-stone-200 dark:border-stone-700 focus:outline-hidden"
                        >
                            <option value="">- Válassz -</option>

                            <template x-for="category in categories">
                                <option
                                    x-bind:value="category.id"
                                    x-text="category.title"
                                ></option>
                            </template>
                        </select>
                    </div>
                </div>

                <template x-if="availableSubcategories?.length > 0">
                    <div>
                            <label for="transaction_subcategory_id" class="block text-sm/6 font-medium">Alkategória</label>

                            <div class="flex items-stretch w-full has-[:focus]:outline-1">
                                <select
                                    name="transaction_subcategory_id"
                                    id="transaction_subcategory_id"
                                    required
                                    class="basis-full grow px-3 py-2 rounded-l border border-stone-200 dark:border-stone-700 focus:outline-hidden"
                                >
                                    <option value="">- Válassz -</option>

                                    <template x-for="category in availableSubcategories">
                                        <option
                                            x-bind:value="category.id"
                                            x-text="category.title"
                                        ></option>
                                    </template>
                                </select>
                            </div>
</div>
                </template>

                <div>
                    <label for="comments" class="block text-sm/6 font-medium">Megjegyzés</label>

                    <div class="flex items-stretch w-full has-[:focus]:outline-1">
                        <textarea
                            name="comments"
                            id="comments"
                            rows="2"
                            class="basis-full grow px-3 py-1 rounded-l border border-stone-200 dark:border-stone-700 focus:outline-hidden"
                        ></textarea>
                    </div>
                </div>

                <button
                    x-bind:disabled="formDisabled"
                    type="submit"
                    class="rounded w-full py-2 px-4 bg-fuchsia-500 disabled:bg-fuchsia-200 text-fuchsia-50  dark:bg-fuchsia-800 dark:disabled:bg-fuchsia-500 dark:text-fuchsia-200 hover:opacity-90 active:opacity-80"
                >
                    Mentés
                </button>
            </div>
        </div>
    </form>

    <p class="mt-4 mx-auto text-center text-xs text-stone-300 dark:text-stone-400">
        &copy; {{ date('Y') }} nxu
    </p>
</body>
</html>
