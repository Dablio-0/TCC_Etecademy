function onChange() {
    const password = document.querySelector('input[name=senha]');
    const confirm = document.querySelector('input[name=confirmasenha]');
    if (confirm.value === password.value) {
      confirm.setCustomValidity('');
    } else {  
      confirm.setCustomValidity('Senhas não coincidem!');
    }
  }