var input = document.getElementById('username');
    input.addEventListener('input', function () {
        if (this.value.length > 11)
            this.value = this.value.slice(0, 10);
})
var input = document.getElementById('password');
    input.addEventListener('input', function () {
        if (this.value.length > 15)
            this.value = this.value.slice(0, 10);
})