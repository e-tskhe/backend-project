document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('supportForm');
    const responseMessage = document.getElementById('response-message');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                name: form.elements.name.value,
                tel: form.elements.tel.value,
                email: form.elements.email.value,
                mesg: form.elements.mesg.value,
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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.username) {
                        responseMessage.innerHTML = `
                            <div class="alert alert-success">
                                <p>Ваша заявка принята! Создан аккаунт:</p>
                                <p><strong>Логин:</strong> ${data.username}</p>
                                <p><strong>Пароль:</strong> ${data.password}</p>
                                <p><a href="${data.profile_url}">Перейти в профиль</a></p>
                                <p>Сохраните эти данные для входа в систему.</p>
                            </div>
                        `;
                    } else {
                        responseMessage.innerHTML = `
                            <div class="alert alert-success">
                                <p>Ваши данные успешно обновлены!</p>
                            </div>
                        `;
                    }
                } else {
                    responseMessage.innerHTML = `
                        <div class="alert alert-danger">
                            <p>Ошибка: ${data.error || 'Неизвестная ошибка'}</p>
                        </div>
                    `;
                }
                responseMessage.style.display = 'block';
            })
            .catch(error => {
                responseMessage.innerHTML = `
                    <div class="alert alert-danger">
                        <p>Произошла ошибка при отправке формы. Пожалуйста, попробуйте еще раз.</p>
                    </div>
                `;
                responseMessage.style.display = 'block';
                console.error('Error:', error);
            });
        });
    }
});