document.addEventListener("DOMContentLoaded", () => {
    const cells = document.querySelectorAll('.plateau td');

    cells.forEach(cell => {
        cell.addEventListener('click', () => {
            if (cell.classList.contains('blanc')) {
                cell.classList.remove('blanc');
                cell.classList.add('noir');
            } else if (cell.classList.contains('noir')) {
                cell.classList.remove('noir');
            } else {
                cell.classList.add('blanc');
            }
        });
    });
});
