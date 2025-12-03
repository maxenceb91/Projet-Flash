const passwordInput = document.getElementById("password");
const feedback = document.getElementById("feedback");
const passwordBar = document.getElementById("password-bar"); 

passwordInput.addEventListener("input", ()=>{
    const pwd = passwordInput.value;
    const length = pwd.length >= 8;
    const upper = /[A-Z]/.test(pwd);
    const lower = /[a-z]/.test(pwd);
    const number = /[0-9]/.test(pwd);
    const special = /[!@#$%*]/.test(pwd);

    const passed = [length, upper, lower, number, special].filter(Boolean).length;
    
    const width = (passed / 5) * 100; 
    passwordBar.style.width = width + '%';
    
    passwordBar.classList.remove('bg-red', 'bg-orange', 'bg-green'); 

    let strength = '';
    
    if (passed === 5){
        strength = 'strong';
        feedback.style.color = 'green';
        passwordBar.classList.add('bg-green');
    }
    else if (passed >= 3){
        strength = 'medium';
        feedback.style.color = 'orange'; 
        passwordBar.classList.add('bg-orange'); 
        
    }
    else{
        strength = 'weak';
        feedback.style.color = 'red';
        passwordBar.classList.add('bg-red'); 
    }
    
    feedback.textContent = strength;
});