document.addEventListener('DOMContentLoaded', function() {
    const supportForm = document.getElementById('supportForm');
    const responseMessage = document.getElementById('response-message');
    
    if (supportForm) {
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(supportForm);
            const formDataObj = {
                name: formData.get('name').trim(),
                tel: formData.get('tel').trim(),
                email: formData.get('email').trim(),
                message: formData.get('message').trim(),
                contract: formData.get('contract') === 'on',
                csrf_token: formData.get('csrf_token')
            };
            
            // Показываем индикатор загрузки
            const submitBtn = supportForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Отправка...';
            
            fetch(supportForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData).toString()
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                showMessage('success', data.message || 'Форма успешно отправлена');
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
                if (data.username && data.password) {
                    showMessage('info', `Логин: ${data.username}, Пароль: ${data.password}`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', error.error || error.message || 'Ошибка при отправке формы');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        });
    }
    
    function showMessage(type, message) {
        if (!responseMessage) return;
        
        const alertClass = type === 'error' ? 'alert-danger' : 
                          type === 'success' ? 'alert-success' : 'alert-info';
        responseMessage.innerHTML = `
            <div class="alert ${alertClass}">
                ${message}
            </div>
        `;
        responseMessage.style.display = 'block';
        
        setTimeout(() => {
            responseMessage.style.display = 'none';
        }, 5000);
    }
});