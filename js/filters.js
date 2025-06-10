document.addEventListener('DOMContentLoaded', function () {
    const selects = [
        document.getElementById('filter-categorie'),
        document.getElementById('filter-format'),
        document.getElementById('filter-order')
    ];
    selects.forEach(sel => {
        if (sel) {
            const instance = new Choices(sel, {
                searchEnabled: false,
                itemSelectText: '',
                shouldSort: false,
                classNames: {
                    containerOuter: 'custom-choices' // Un seul nom de classe ici !
                }
            });
            // Ajoute la classe 'choices' manuellement pour garder la compatibilité CSS
            instance.containerOuter.element.classList.add('choices');
        }
    });
});