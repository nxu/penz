import Alpine from 'alpinejs'

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data('entry', (allCategories) => ({
        categories: allCategories,

        selectedCategoryId: null,

        formDisabled: false,

        get selectedCategory() {
            return this.categories.find((e) => e.id == this.selectedCategoryId);
        },

        get availableSubcategories() {
            return this.selectedCategory?.subcategories;
        },

        init() {

        }
    }))
});

document.addEventListener('DOMContentLoaded', function () {
    const notification = document.getElementById('success-notification');
    if (notification) {
        window.setTimeout(() => notification.remove(), 3000);
    }
});

Alpine.start()
