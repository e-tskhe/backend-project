document.getElementById('supportForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.querySelector('input[name="name"]').value,
        tel: document.querySelector('input[name="tel"]').value,
        email: document.querySelector('input[name="email"]').value,
        message: document.querySelector('textarea[name="message"]').value,
        contract: document.querySelector('input[name="contract"]').checked,
        csrf_token: document.querySelector('input[name="csrf_token"]').value
    };

    fetch('api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.credentials) {
                alert('Аккаунт создан!\nЛогин: ${data.credentials.username}\nПароль: ${data.credentials.password}');
            }
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } else {
            alert('Ошибка: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка');
    });
});

// document.addEventListener('DOMContentLoaded', function() {
//     const supportForm = document.getElementById('supportForm');
//     const responseMessage = document.getElementById('response-message');
    
//     if (supportForm) {
//         supportForm.addEventListener('submit', function(e) {
//             e.preventDefault();
            
//             const formData = new FormData(supportForm);
//             const formDataObj = {
//                 name: formData.get('name').trim(),
//                 tel: formData.get('tel').trim(),
//                 email: formData.get('email').trim(),
//                 message: formData.get('message').trim(),
//                 contract: formData.get('contract') === 'on',
//                 csrf_token: formData.get('csrf_token')
//             };
            
//             // Показываем индикатор загрузки
//             const submitBtn = supportForm.querySelector('button[type="submit"]');
//             const originalBtnText = submitBtn.textContent;
//             submitBtn.disabled = true;
//             submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Отправка...';
            
//             fetch(supportForm.action, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded',
//                 },
//                 body: new URLSearchParams(formData).toString()
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     return response.json().then(err => Promise.reject(err));
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 showMessage('success', data.message || 'Форма успешно отправлена');
//                 if (data.redirect) {
//                     window.location.href = data.redirect;
//                 }
//                 if (data.username && data.password) {
//                     showMessage('info', `Логин: ${data.username}, Пароль: ${data.password}`);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 showMessage('error', error.error || error.message || 'Ошибка при отправке формы');
//             })
//             .finally(() => {
//                 submitBtn.disabled = false;
//                 submitBtn.textContent = originalBtnText;
//             });
//         });
//     }
    
//     function showMessage(type, message) {
//         if (!responseMessage) return;
        
//         const alertClass = type === 'error' ? 'alert-danger' : 
//                           type === 'success' ? 'alert-success' : 'alert-info';
//         responseMessage.innerHTML = `
//             <div class="alert ${alertClass}">
//                 ${message}
//             </div>
//         `;
//         responseMessage.style.display = 'block';
        
//         setTimeout(() => {
//             responseMessage.style.display = 'none';
//         }, 5000);
//     }
// });