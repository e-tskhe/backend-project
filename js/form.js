document.addEventListener('DOMContentLoaded', function() {
    const profileForm = document.getElementById('profileForm');
    const responseMessage = document.getElementById('response-message');
    
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(profileForm);
            const formDataObj = {
                name: formData.get('name').trim(),
                tel: formData.get('tel').trim(),
                email: formData.get('email').trim(),
                message: formData.get('message').trim(),
                contract: formData.get('contract') === 'on',
                csrf_token: formData.get('csrf_token')
            };
            
            fetch(profileForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formDataObj)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                showMessage('success', data.message || 'Данные успешно обновлены');
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', error.message || 'Ошибка при обновлении данных');
            });
        });
    }
    
    // Функция для отображения сообщений
    function showMessage(type, message) {
        if (!responseMessage) return;
        
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
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