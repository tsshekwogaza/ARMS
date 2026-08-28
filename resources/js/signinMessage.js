document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    
    btn.disabled = true;
    btn.classList.add('opacity-80', 'cursor-wait');
    btnText.innerText = 'Authenticating...';
});
