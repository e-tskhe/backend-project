document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const supportForm = document.getElementById('supportForm');
    const responseMessage = document.getElementById('response-message');
    
    // Обработка формы входа
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Валидация на клиенте
            if (!loginForm.checkValidity()) {
                showError('Пожалуйста, заполните все обязательные поля');
                return;
            }

            const formData = {
                username: loginForm.elements.username.value.trim(),
                password: loginForm.elements.password.value.trim(),
                csrf_token: loginForm.elements.csrf_token.value
            };
            
            fetch('/login.php', {
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
                    // Перенаправляем на страницу профиля после успешной авторизации
                    window.location.href = data.profile_url || '/profile.php';
                } else {
                    showError(data.error || 'Произошла ошибка при авторизации');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError(error.message || 'Неизвестная ошибка при авторизации');
            });
        });
    }
    
    // Обработка формы поддержки
    if (supportForm) {
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Валидация на клиенте
            if (!supportForm.checkValidity()) {
                showError('Пожалуйста, заполните все обязательные поля правильно');
                return;
            }

            const formData = {
                name: supportForm.elements.name.value.trim(),
                tel: supportForm.elements.tel.value.trim(),
                email: supportForm.elements.email.value.trim(),
                message: supportForm.elements.message.value.trim(),
                contract: supportForm.elements.contract.checked,
                csrf_token: supportForm.elements.csrf_token.value
            };
            
            fetch(supportForm.action, {
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
                    // Очистка формы только если это новая заявка (не авторизованный пользователь)
                    if (!data.username) {
                        supportForm.reset();
                    }
                    
                    let successMessage = `
                        <div class="alert alert-success">
                            <p>${data.message || 'Форма успешно отправлена!'}</p>
                    `;
                    
                    // Добавляем ссылку на профиль если есть
                    if (data.profile_url) {
                        successMessage += `<p><a href="${data.profile_url}">Перейти в профиль</a></p>`;
                    }
                    
                    successMessage += `</div>`;
                    
                    responseMessage.innerHTML = successMessage;
                    responseMessage.style.display = 'block';
                    
                    // Показываем данные для входа если это регистрация
                    if (data.username && data.password) {
                        alert(`Ваш логин: ${data.username}\nВаш пароль: ${data.password}\nСохраните эти данные!`);
                        
                        // Предлагаем войти
                        if (confirm('Хотите войти в систему сейчас?')) {
                            // Автоматический вход
                            fetch('/login.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    username: data.username,
                                    password: data.password,
                                    csrf_token: formData.csrf_token
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
                    showError(data.error || 'Произошла ошибка при отправке формы');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError(error.message || 'Неизвестная ошибка при отправке формы');
            });
        });
    }
    
    // Функция для отображения ошибок
    function showError(message, details) {
        if (responseMessage) {
            let errorHtml = `
                <div class="alert alert-danger">
                    <p>${message}</p>
            `;
            
            if (details) {
                errorHtml += `<pre>${JSON.stringify(details, null, 2)}</pre>`;
            }
            
            errorHtml += `</div>`;
            
            responseMessage.innerHTML = errorHtml;
            responseMessage.style.display = 'block';
            
            // Автоматическое скрытие через 5 секунд
            setTimeout(() => {
                responseMessage.style.display = 'none';
            }, 5000);
        } else {
            alert(message);
        }
    }
    
    // Добавляем маску для телефона
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