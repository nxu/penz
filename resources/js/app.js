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

Alpine.start()
