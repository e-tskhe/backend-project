document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const supportForm = document.getElementById('supportForm');
    const responseMessage = document.getElementById('response-message');
    
    // Функция для отображения сообщений
    function showMessage(type, message, details = null) {
        if (!responseMessage) return;
        
        const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
        let messageHtml = `
            <div class="alert ${alertClass}">
                <p>${message}</p>
        `;
        
        if (details) {
            messageHtml += `<pre>${JSON.stringify(details, null, 2)}</pre>`;
        }
        
        messageHtml += `</div>`;
        
        responseMessage.innerHTML = messageHtml;
        responseMessage.style.display = 'block';
        
        // Автоматическое скрытие через 5 секунд
        setTimeout(() => {
            responseMessage.style.display = 'none';
        }, 5000);
    }

    // Обработка формы входа
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(loginForm);
            const formDataObj = Object.fromEntries(formData.entries());
            
            fetch('/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formDataObj)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = data.profile_url || '/profile.php';
                } else {
                    showMessage('error', data.error || 'Произошла ошибка при авторизации');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', error.message || 'Неизвестная ошибка при авторизации');
            });
        });
    }
    
    // Обработка формы поддержки
    if (supportForm) {
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Валидация на клиенте
            if (!supportForm.checkValidity()) {
                showMessage('error', 'Пожалуйста, заполните все обязательные поля правильно');
                return;
            }

            const formData = new FormData(supportForm);
            const formDataObj = {
                name: formData.get('name').trim(),
                tel: formData.get('tel').trim(),
                email: formData.get('email').trim(),
                message: formData.get('message').trim(),
                contract: formData.get('contract') === 'on',
                csrf_token: formData.get('csrf_token')
            };
            
            fetch(supportForm.action, {
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
                if (data.success) {
                    showMessage('success', data.message || 'Форма успешно отправлена!');
                    
                    // Очистка формы для новых пользователей
                    if (!data.username) {
                        supportForm.reset();
                    }
                    
                    // Обработка данных нового пользователя
                    if (data.username && data.password) {
                        const loginConfirmed = confirm(
                            `Ваш логин: ${data.username}\nВаш пароль: ${data.password}\n\nХотите войти в систему сейчас?`
                        );
                        
                        if (loginConfirmed) {
                            fetch('/login.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    username: data.username,
                                    password: data.password,
                                    csrf_token: formDataObj.csrf_token
                                })
                            })
                            .then(response => response.json())
                            .then(loginData => {
                                if (loginData.success) {
                                    window.location.href = loginData.profile_url || '/profile.php';
                                }
                            });
                        }
                    }
                } else {
                    showMessage('error', data.error || 'Произошла ошибка при отправке формы');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('error', error.message || 'Неизвестная ошибка при отправке формы', error.details);
            });
        });
    }
    
    // Маска для телефона
    const phoneInput = document.querySelector('input[name="tel"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            let formattedValue = '';
            
            if (value.length > 0) {
                formattedValue = '+7 (' + value.substring(1, 4);
            }
            if (value.length >= 4) {
                formattedValue += ') ' + value.substring(4, 7);
            }
            if (value.length >= 7) {
                formattedValue += '-' + value.substring(7, 9);
            }
            if (value.length >= 9) {
                formattedValue += '-' + value.substring(9, 11);
            }
            
            this.value = formattedValue;
        });
    }
});