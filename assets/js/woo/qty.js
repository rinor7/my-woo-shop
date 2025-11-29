document.addEventListener('click', function(e) {

    if (e.target.classList.contains('qty-btn')) {
        const input = e.target.parentElement.querySelector('input.qty');
        const step = parseFloat(input.step) || 1;
        const min = parseFloat(input.min) || 1;
        const max = parseFloat(input.max) || null;
        let value = parseFloat(input.value) || 1;

        if (e.target.classList.contains('plus')) {
            value += step;
            if (max && value > max) value = max;
        }

        if (e.target.classList.contains('minus')) {
            value -= step;
            if (value < min) value = min;
        }

        input.value = value;
        input.dispatchEvent(new Event('change'));
    }

});
