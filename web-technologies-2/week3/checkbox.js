/* à compléter */
document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('transparent_bg');
    const bgInput = document.getElementById('bg');

    function toggleBg() {
        bgInput.disabled = checkbox.checked; 
    }

    checkbox.addEventListener('change', toggleBg);

    toggleBg();
});
