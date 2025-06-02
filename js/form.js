document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('supportForm');
    const responseMessage = document.getElementById('response-message');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Валидация на клиенте
            if (!form.checkValidity()) {
                responseMessage.innerHTML = `
                    <div class="alert alert-danger">
                        <p>Пожалуйста, заполните все обязательные поля правильно</p>
                    </div>
                `;
                responseMessage.style.display = 'block';
                return;
            }

            const formData = {
                name: form.elements.name.value.trim(),
                tel: form.elements.tel.value.trim(),
                email: form.elements.email.value.trim(),
                message: form.elements.message.value.trim(),
                contract: form.elements.contract.checked,
                csrf_token: form.elements.csrf_token.value
            };
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    form.reset();
                    responseMessage.innerHTML = `
                        <div class="alert alert-success">
                            <p>${data.message || 'Форма успешно отправлена!'}</p>
                            ${data.profile_url ? `<p><a href="${data.profile_url}">Перейти в профиль</a></p>` : ''}
                        </div>
                    `;
                    responseMessage.style.display = 'block';
                    
                    // Если есть данные пользователя (при регистрации)
                    if (data.username && data.password) {
                        alert(`Ваш логин: ${data.username}\nВаш пароль: ${data.password}\nСохраните эти данные!`);
                    }
                } else {
                    responseMessage.innerHTML = `
                        <div class="alert alert-danger">
                            <p>${data.error || 'Произошла ошибка при отправке формы'}</p>
                            ${data.details ? `<pre>${JSON.stringify(data.details, null, 2)}</pre>` : ''}
                        </div>
                    `;
                    responseMessage.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseMessage.innerHTML = `
                    <div class="alert alert-danger">
                        <p>Ошибка при отправке формы: ${error.message || 'Неизвестная ошибка'}</p>
                    </div>
                `;
                responseMessage.style.display = 'block';
            });
        });
    }
});