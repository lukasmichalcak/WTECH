document.querySelectorAll('.my-card-stepper').forEach(cardItem => {
    let count = parseInt(cardItem.querySelector('.amount-value').textContent);

    const display = cardItem.querySelector('.amount-value');
    const incBtn = cardItem.querySelector('.increase-amount');
    const decBtn = cardItem.querySelector('.decrease-amount');

    incBtn.addEventListener('click', () => {
        count++;
        display.textContent = count.toString();
    });

    decBtn.addEventListener('click', () => {
        count--;
        if (count <= 0) {
            cardItem.closest('.my-card').remove(); //removes closest .my-card ancestor i.e. the card
        } else {
            display.textContent = count.toString();
        }
    });
});
