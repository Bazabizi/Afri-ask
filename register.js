const form = document.getElementById('reg-form');
const names = document.getElementById('name');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const showTextareaBtn = document.getElementById('showTextareaBtn');
const hideTextareaBtn = document.getElementById('hideTextareaBtn');
const textareaContainer = document.getElementById('textareaContainer');

showTextareaBtn.addEventListener('click', () => {
  textareaContainer.style.display = 'block';
});

hideTextareaBtn.addEventListener('click', () => {
  textareaContainer.style.display = 'none';
});

form.addEventListener('submit', e => {
  e.preventDefault();

  validateInputs();
});

const setError = (element, message) => {
  const inputControl = element.parentElement;
  const errorDisplay = inputControl.querySelector('.error');

  errorDisplay.innerText = message;
  inputControl.classList.add('error');
  inputControl.classList.remove('success');
}

const setSuccess = element => {
  const inputControl = element.parentElement;
  const errorDisplay = inputControl.querySelector('.error');

  errorDisplay.innerText = '';
  inputControl.classList.add('success');
  inputControl.classList.remove('error');
}

const isValidEmail = email => {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
  const nameValue = names.value.trim();
  const usernameValue = username.value.trim();
  const emailValue = email.value.trim();
  const passwordValue = password.value.trim();
  const password2Value = password2.value.trim();

  if(nameValue === ''){
    setError(names, 'Please enter a valid name.');
  } else {
    setSuccess(names);
  }

  if(usernameValue === ''){
    setError(username, 'Please enter a valid username.');
  } else {
    setSuccess(username);
  }

  if(emailValue === ''){
    setError(email, 'Please enter an email.');
  } else if(!isValidEmail(emailValue)){
    setError(email, 'Enter a valid email');
  } else{
    setSuccess(email);
  }

  if(passwordValue === ''){
    setError(password, 'Please enter a password.');
  } else if(passwordValue.length < 8){
    setError(password, 'Email must be atleast 8 characters long');
  } else{
    setSuccess(password);
  }

  if(password2Value === ''){
    setError(password2, 'Please confirm your password.');
  } else if(password2Value !== passwordValue){
    setError(password2, 'Password doesn\'t match');
  } else{
    setSuccess(password2);
    
    document.getElementById("register").onclick = function () {
      location.href = "/Course.html";
    };
    
  }
};