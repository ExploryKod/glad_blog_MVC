const fadingAlert = document.getElementById('fading-alert');

if(fadingAlert.classList.contains('fading')) {
    fadingAlert.style.display = 'block';
    fadingAlert.style.opacity = '1';
} else {
    setTimeout(() => {
        fadingAlert.classList.add('fading');
    }, "1000")

    setTimeout(() => {
        fadingAlert.classList.add('display-transition');
        fadingAlert.style.display = 'none';
    }, "2000")
}

console.log(fadingAlert);