document.addEventListener('DOMContentLoaded', function () {
    const selects = [
        {el: document.getElementById('filter-categorie'), key: 'categorie'},
        {el: document.getElementById('filter-format'), key: 'format'},
        {el: document.getElementById('filter-order'), key: 'order'}
    ];
    selects.forEach(obj => {
        if (obj.el) {
            const instance = new Choices(obj.el, {
                searchEnabled: false,
                itemSelectText: '',
                shouldSort: false,
                classNames: {
                    containerOuter: 'custom-choices'
                }
            });
            instance.containerOuter.element.classList.add('choices');
            instance.containerOuter.element.setAttribute('data-filter', obj.key);
        }
    });
});